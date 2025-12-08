const app = Vue.createApp({
    data() {
        return {
            isFromViewUser: false,
            offers_per_page : 10,
            offers_current_page : 1,

            status: false,
            message: null,
            loading: true,
            user_id: null,
            user_type: null,

            search_word: "",
            offer_status: "",
            is_with_vat: "",
            year: "",
            month: "",
            week: "",

            response: null,
            lists: [],
            editModal: null,
            index: null,
            key: null,

            order: null,
            isFromListingNotes: false,

            logsLoading: true,

            offersLoading: true,
            offers: [],

            headers: null
        }
    },
    methods: {
        initialize () {
            const authToken = $("#auth_token").val();
            this.headers = {
                'Authorization': `Bearer ${authToken}`,
                'Content-Type': 'application/json'
            };

            this.fetchOffers();
        },
        emptyOffersFilters () {
            this.search_word = "";
            this.offer_status = "";
            this.is_with_vat = "";
            this.year = "";
            this.month = "";
            this.week = "";
            this.fetchOffers();
        },
        async fetchOffers (){
            this.loading = true;
            const response = await fetch(
                "/api/admin/offers?search_word="+this.search_word+"&offer_status="+this.offer_status+"&is_with_vat="+this.is_with_vat+"&year="+this.year+"&month="+this.month+"&week="+this.week,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.lists = this.response.lists;
            this.loading = false;
        },
        async editOffer (row, key, index) {
            this.editModal = row;
            this.key = key;
            this.index = index;
        },
        async storeOffer (row, key, index) {
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.editModal)
            };
            const response = await fetch("/api/admin/offers/update/"+row.id, requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            window.scroll(0,0);
            if (this.status) {
                $(".close-link").click();
                this.lists[key].splice(index, 1, this.response.offer);
            }
        },
        async deleteOffer (row, key, index) {
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
            if (this.status){
                this.lists[key].splice(index, 1);
            }
        },
        showOffers(divID){
            $(".activity-content").addClass("hidden");
            $("#"+divID).removeClass('hidden');

            $(".activity-link").removeClass("active");
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
            this.orderImagesLoading = false;
        },
        viewModal (order) {
            this.order = order;
            this.offersLoading = true;

            this.offers = [];
            this.order_images = [];

            this.getOrderImages(order.id);
            this.getOrderOffers(order.id);
        },
        async deleteOfferImage (image, key, index) {
            const response = await fetch(
                "/api/admin/offers/delete-image/"+image.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                this.lists[key].splice(index, 1, this.response.offer);
            }
        },
    }
});

const vm = app.mount("#app");
vm.initialize();
