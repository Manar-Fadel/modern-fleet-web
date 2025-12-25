const app = Vue.createApp({
    data() {
        return {

            status: false,
            message: null,
            loading: false,

            offerModal: {
                user_id: '',
                price: '',
                is_with_vat: "with_vat",
                description: '',
                order_id: ''
            },

            headers: null
        }
    },
    methods: {
        initialize () {
            const authToken = $("#auth_token").val();
            this.headers = {
                'Authorization': `Bearer ${authToken}`,
                'Content-Type': 'application/json',
                'accept': 'application/json'
            };
        },
        emptyFilters () {
            this.offerModal = {};
        },
        async sendOfferBtn (id) {
            this.emptyFilters();
            this.offerModal.order_id = id;
            $(".vat-select").val('with_vat').trigger('change');
            this.offerModal.is_with_vat = 'with_vat';
        },
        async saveOffer () {
            this.loading = true;
            this.offerModal.user_id = $("#authed_user_id").val();
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.offerModal)
            };
            const response = await fetch("/api/web/send-offer", requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            this.loading = false;
            if (this.status) {
                this.emptyFilters();
                $(".send-offer-container").addClass("hidden");
                window.location.href = '/orders';
            }
        },
    }
});

const vm = app.mount("#app");
vm.initialize();
