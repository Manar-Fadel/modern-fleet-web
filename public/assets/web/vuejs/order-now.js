const app = Vue.createApp({
    data() {
        return {

            status: false,
            message: null,
            loading: false,
            brandLoading: false,
            search_word: '',

            addModal: {
                brand_id: '',
                description: '',
                user_id: '',
            },
            brands: [],
            orderImagesLoading: true,
            order_images: [],
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

            this.fetchBrands();
        },
        emptyFilters () {
            this.addModal = {};
            this.order_images = [];
            this.fetchBrands();
        },
        onBrandChange(event){
            this.fetchBrands()
        },
        changeBrand(id){
            this.addModal.brand_id = id;
        },
        async fetchBrands () {
            this.brandLoading = true;
            const response = await fetch(
                "/api/web/brands?search_word="+this.search_word,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.brands = this.response.data.brands;
            this.brandLoading = false;
        },
        async saveOrder () {
            this.loading = true;
            this.addModal.user_id = $("#authed_user_id").val();
            const requestOptions = {
                method: "POST",
                headers: this.headers,
                body: JSON.stringify(this.addModal)
            };
            const response = await fetch("/api/web/save-order", requestOptions);
            this.response = await response.json();
            this.status = this.response.status;
            this.message = this.response.message;
            this.loading = false;
            if (this.status) {
                window.location.href = '/my-orders';
            }
        },
    }
});

const vm = app.mount("#app");
vm.initialize();
