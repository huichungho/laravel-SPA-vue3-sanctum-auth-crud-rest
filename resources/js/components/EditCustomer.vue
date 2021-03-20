<template>
    <div>
        <h4 class="text-center">Edit Customer</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCustomer">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="customer.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="customer.email">
                    </div>
                    <div class="form-group">
                        <label>Nationality</label>
                        <input type="text" class="form-control" v-model="customer.nationality">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Customer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            customer: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/customers/edit/${this.$route.params.id}`)
                .then(response => {
                    this.customer = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateCustomer() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/customers/update/${this.$route.params.id}`, this.customer)
                    .then(response => {
                        this.$router.push({name: 'customers'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>