const app = Vue.createApp({
    data() {
        return {
            isFromViewUser: false,
            offers_per_page : 10,
            offers_current_page : 1,

            status: false,
            message: null,
            loading: true,
            search_word: "",
            type: "",
            year: "",
            month: "",
            week: "",

            response: null,
            lists: [],

            part: null,
            isFromListingNotes: false,
            logsLoading: true,
            logs: [],

            part_logs: [],

            offersLoading: true,
            offers: [],

            paymentsLoading: true,
            payments: [],

            customerCareNotesLoading: true,
            customer_care_notes: [],

            partImagesLoading: true,
            part_images: [],
            voice_note: null,
            video_note: null,

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

            this.fetchLogs();
        },
        emptyFilters () {
            this.search_word = "";
            this.type = "";
            this.year = "";
            this.month = "";
            this.week = "";
            this.fetchLogs();
        },
        async fetchLogs(){
            this.loading = true;
            const response = await fetch(
                "/api/admin/logs?search_word="+this.search_word+"&type="+this.type+"&year="+this.year+"&month="+this.month+"&week="+this.week,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.lists = this.response.lists;
            this.loading = false;
        },
        showLogs(divID){
            $(".activity-content").addClass("hidden");
            $("#"+divID).removeClass('hidden');
            $(".activity-link").removeClass("active");
           // $("#"+linkID).addClass("active");
        },
        async editCustomerCareNotes (row, key, index) {
            this.addCustomerCareNoteModal = row;
            this.key = key;
            this.index = index;
        },
        async postEditCustomerCareNotes (row, key, index) {
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.addCustomerCareNoteModal)
            };
            const response = await fetch("/api/admin/customer-care-notes/update/"+row.id, requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            if (this.status) {
                $(".close-link").click();
                window.scroll(0,0);
                this.customer_care_notes.splice(index, 1, this.response.customer_care_note);
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
        async getPartLogs(id) {
            const response = await fetch(
                "/api/admin/orders/logs/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.part_logs = this.response.logs;
            this.logsLoading = false;
        },
        async getPartCustomerCareNotes(id) {
            const response = await fetch(
                "/api/admin/orders/customer-care-notes/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.customer_care_notes = this.response.customer_care_notes;
            this.customerCareNotesLoading = false;
        },
        async getPartOffers(id) {
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
        async getPartPayments(request_id, id) {
            const response = await fetch(
                "/api/admin/orders/payments/"+request_id+"/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.payments = this.response.payments;
            this.paymentsLoading = false;
        },
        viewModal (part) {
            this.part = part;
            this.offersLoading = true;
            this.logsLoading = true;
            this.paymentsLoading = true;

            this.offers = [];
            this.payments = [];
            this.part_logs = [];
            this.customer_care_notes = [];
            this.part_images = [];

            this.getPartImages(part.id);
            this.getPartLogs(part.id);
            this.getPartOffers(part.id);
            this.getPartCustomerCareNotes(part.id);
            this.getPartPayments(part.request_id, part.id);
        },
        async deleteOrderVoice (row) {
            const response = await fetch(
                "/api/admin/orders/delete-voice/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            this.voice_note = null;
        },
        async deleteOrderVideo (row) {
            const response = await fetch(
                "/api/admin/orders/delete-video/"+row.id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            this.video_note = null;
        },
        async deletePartImage (part, image) {
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
                this.part_images = this.response.images
            }
        },
        async getPartImages(id) {
            const response = await fetch(
                "/api/admin/orders/images/"+id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.part_images = this.response.data.images;
            this.voice_note = this.response.data.voice_note;
            this.video_note = this.response.data.video_note;
            this.partImagesLoading = false;
        }
    }
});

const vm = app.mount("#app");
vm.initialize();
