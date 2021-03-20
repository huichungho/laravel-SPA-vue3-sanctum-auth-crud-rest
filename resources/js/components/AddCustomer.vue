<template>
    <div>
        <h4 class="text-center">Add Customer</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCustomer">
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
                    <button type="submit" class="btn btn-primary">Add Customer</button>
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
    methods: {
        addCustomer() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/customers/add', this.customer)
                    .then(response => {
                        this.$router.push({name: 'customers'})
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