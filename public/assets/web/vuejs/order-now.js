const app = Vue.createApp({
    data() {
        return {

            status: false,
            message: null,
            loading: false,
            brandLoading: false,
            search_word: '',

            type: 'cars',
            user_id: '',
            brands: [],
            years: [],
            requests: [
                this.newRequestRow()
            ],
            orderImagesLoading: true,
            order_images: [],
            headers: null,
            images: [],
            selectedFiles: [],
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

            this.fetchBrands('cars');
            this.fetchYears();
        },
        newRequestRow() {
            return {
                brand_id: '',
                model_id: '',
                manufacturing_year_id: '',
                quantity: '',
                description: '',

                is_attachments_enabled: false,
                attachment_type_id: '',
                attachment_description: '',

                images: [],
                models: []
            };
        },
        addNewRequest() {
            this.requests.push(this.newRequestRow());
        },
        removeRequest(index) {
            this.requests.splice(index, 1);
        },
        async onBrandChange(index) {
            const brandId = this.requests[index].brand_id;

            if (!brandId) return;

            const response = await fetch(
                "/api/web/models/" + brandId,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.requests[index].models = this.response.data.models;
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
        async saveOrder () {
            this.loading = true;
            const formData = new FormData();
            this.requests.forEach((req, i) => {
                formData.append(`requests[${i}][brand_id]`, req.brand_id);
                formData.append(`requests[${i}][model_id]`, req.model_id);
                formData.append(`requests[${i}][manufacturing_year_id]`, req.manufacturing_year_id);
                formData.append(`requests[${i}][quantity]`, req.quantity);
                formData.append(`requests[${i}][description]`, req.description);

                if (req.images.length > 0) {
                    req.images.forEach((file, f) => {
                        formData.append(`requests[${i}][images][${f}]`, file);
                    });
                }
            });


            formData.append('user_id', $("#authed_user_id").val());
            formData.append('_method', 'POST');

            const requestOptions = {
                method: "POST",
                body: formData
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
        onFileChange(event, index) {
            var selectedFiles = event.target.files;
            this.selectedFiles = Array.from(event.target.files);
            for (let i=0; i < selectedFiles.length; i++) {
                this.requests[index].images.push(selectedFiles[i]);
            }
            for (let i=0; i< this.requests[index].images.length; i++) {
                let reader = new FileReader();
                reader.addEventListener('load', function(){
                    this.$refs['image' + parseInt( i )][0].src = reader.result;
                }.bind(this), false);

                reader.readAsDataURL(this.requests[index].images[i]);
            }
        },
        removeImage (i) {
            if (i === 0){
                this.images.splice(0, 1);
            }else {
                this.images.splice(i, 1);
            }

        }
    }
});

const vm = app.mount("#app");
vm.initialize();
