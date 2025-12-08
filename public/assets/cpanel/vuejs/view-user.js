const app = Vue.createApp({
    data() {
        return {
            isFromViewUser: true,

            url: null,
            status: false,
            message: null,
            ordersLoading: true,
            user_id: null,
            user_type: null,
            loading: true,

            search_word: "",
            offer_status: "",
            year: "",
            month: "",
            week: "",

            response: null,
            orders_list: null,
            orders_list_total: null,

            previousPage: null,
            nextPage: null,

            part: null,
            isFromListingNotes: false,
            paymentsLoading: true,
            payments: [],

            logsLoading: true,
            part_logs: [],

            offersLoading: true,
            offers: [],

            from_date: '',
            to_date: '',
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

            this.user_id = $("#user_id").val();
            this.user_type = $("#user_type").val();
            this.fetchOrders();
            this.getDealerOffers();
        },
        emptyOrdersFilters () {
            this.search_word = "";
            this.year = "";
            this.month = "";
            this.week = "";
            this.fetchOrders();
        },
        async fetchOrders () {
            this.ordersLoading = true;
            const response = await fetch(
                "/api/admin/customers/"+this.user_id+"/orders?search_word="+this.search_word+"&year="+this.year+"&month="+this.month+"&week="+this.week,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response = await response.json();
            this.orders_list = this.response.data.orders;
            this.orders_list_total = this.response.data.total;
            this.ordersLoading = false;
        },
        fetch (url) {
            this.url = url;
            this.fetchOrders();
        },
        viewModal (order) {
            this.order = order;
            this.logsLoading = true;
        },
        async getDealerOffers() {
            const response = await fetch(
                "/api/admin/orders/offers/"+this.user_id,
                {
                    method: 'GET',
                    headers: this.headers,
                }
            );
            this.response =await response.json();
            this.offers = this.response.offers;
            this.offersLoading = false;
        },
        async deleteOrder (row, index) {
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
                this.orders_list.splice(index, 1);
                this.orders_list_total = this.orders_list.length;
            }
        },
    }
});

const vm = app.mount("#app");
vm.initialize();
