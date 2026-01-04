const app = Vue.createApp({
    data() {
        return {

            status: false,
            message: null,
            loading: false,
            brandLoading: false,
            search_word: '',

            addModal: {
                type: 'cars',
                brand_id: '',
                model_id: '',
                manufacturing_year_id: '',
                quantity: 1,
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

            this.fetchBrands(this.addModal.type);
            this.fetchYears();
        },
        emptyFilters () {
            this.addModal = {};
            this.order_images = [];
            this.fetchBrands(this.addModal.type);
        },
        async fetchYears () {
            this.yearsLoading = true;
            const response = await fetch(
                "/api/web/years",
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.years = this.response.data.years;
            this.yearsLoading = false;
        },
        onBrandChange:function(event){
            this.model_id = '';
            this.getModels(event.target.value);
        },
        async getModels (brand_id) {
            const response = await fetch(
                "/api/brands/models/"+brand_id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.models = this.response.data.models;
        },
        changeBrand(id){
            this.addModal.brand_id = id;
        },
        async fetchBrands (type) {
            this.brandLoading = true;
            const response = await fetch(
                "/api/web/brands/"+type+"?search_word="+this.search_word,
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
