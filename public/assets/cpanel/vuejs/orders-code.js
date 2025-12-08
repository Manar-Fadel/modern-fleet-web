const app = Vue.createApp({
    data() {
        return {
            isFromViewUser: false,
            offers_per_page : 10,
            offers_current_page : 1,

            status: false,
            message: null,
            offersLoading: true,
            logsLoading: true,

            orderImagesLoading: true,
            order_images: [],
            loading: true,

            stat_start_date: "",
            stat_to_date: "",

            search_word: "",
            brand_id: '',
            year: "",
            month: "",
            week: "",
            response: null,
            lists: [],
            years: null,
            brands: null,
            models: null,
            order_logs: [],
            offers: [],
            lists_count: 0,
            changeStatusModal: null,
            editModal: null,

            addCustomerCareNoteModal: null,
            customerCareNotesLoading: true,
            customer_care_notes: [],

            isFromListingNotes: false,
            key: null,
            index: null,

            uploadAttachmentModal: null,
            uploadAttachmentLoading: false,
            file: null,

            headers: null
        }
    },
    methods: {
        initialize () {
            const authToken = $("#auth_token").val();

            this.stat_start_date = $("#stat_start_date").val();
            this.stat_to_date = $("#stat_to_date").val();

            this.headers = {
                'Authorization': `Bearer ${authToken}`,
                'Content-Type': 'application/json'
            };

            this.fetchOrders();
        },
        emptyFilters () {
            this.search_word = '';
            this.brand_id = '';
            this.year = '';
            this.month = '';
            this.week = '';
            this.fetchOrders();
        },
        async fetchOrders () {
            this.loading = true;
            const response = await fetch(
                "/api/admin/orders?search_word="+this.search_word+"&brand_id="+this.brand_id+"&year="+this.year+"&month="+this.month+"&week="+this.week+"&stat_start_date="+this.stat_start_date+"&stat_to_date="+this.stat_to_date,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.lists = this.response.data.lists;
            this.loading = false;
        },
        async changeStatus (row, key, index) {
            this.changeStatusModal = row;
            this.key = key;
            this.index = index;

            this.getOrderOffers(row.id);
        },
        async postChangeStatus (row, key, index) {
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.changeStatusModal)
            };
            const response = await fetch("/api/admin/orders/change-status/"+row.id, requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                $(".close-link").click();
                window.scroll(0,0);
                this.lists[key].splice(index, 1, this.response.order);
            }
        },
        async deleteOrder (row, key, index) {
            const response = await fetch(
                "/api/admin/orders/delete/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.lists[key].splice(index, 1);
            }
        },
        async deleteOrderImage (order, image) {
            const response = await fetch(
                "/api/admin/orders/delete-image/"+image.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.order_images = this.response.images
            }
        },
        async deleteOffer (row, offerIndex) {
            const response = await fetch(
                "/api/admin/offers/delete/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.offers.splice(offerIndex, 1);
            }
        },
        showOrders(divID){
            $(".activity-content").addClass("hidden");
            $("#"+divID).removeClass('hidden');

            $(".activity-link").removeClass("active");
            $(this).addClass("active");
        },
        async getOrderLogs(id) {
            const response = await fetch(
                "/api/admin/orders/logs/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.order_logs = this.response.logs;
            this.logsLoading = false;
        },
        async getOrderImages(id) {
            const response = await fetch(
                "/api/admin/orders/images/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.order_images = this.response.data.images;
            this.voice_note = this.response.data.voice_note;
            this.video_note = this.response.data.video_note;
            this.orderImagesLoading = false;
        },
        async getOrderOffers(id) {
            const response = await fetch(
                "/api/admin/orders/offers/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.offers = this.response.offers;
            this.offersLoading = false;
        },
        viewModal (order) {
            this.offersLoading = true;
            this.offers = [];
            this.order_images = [];

            this.getOrderImages(order.id);
            this.getOrderOffers(order.id);
        }
    }
});

const vm = app.mount("#app");
vm.initialize();
