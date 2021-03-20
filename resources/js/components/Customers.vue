<template>
    <div>
        <h4 class="text-center">All Customers</h4><br/>
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Nationality</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="customer in customers" :key="customer.id">
                <td>{{ customer.id }}</td>
                <td>{{ customer.name }}</td>
                <td>{{ customer.email }}</td>
                <td>{{ customer.nationality }}</td>
                <td>{{ format(customer.created_at)}}</td>
                <td>{{ format(customer.updated_at) }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editcustomer', params: { id: customer.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteCustomer(customer.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        </div>

        <button type="button" class="btn btn-info" @click="this.$router.push('/customers/add')">Add Customer</button>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    data() {
        return {
            customers: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/customers')
                .then(response => {
                    this.customers = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {

        format(date) {
            return moment(date).format('YYYY-MM-DD HH:MM:SS');
        },

        deleteCustomer(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/customers/delete/${id}`)
                    .then(response => {
                        let i = this.customers.map(item => item.id).indexOf(id); // find index of your object
                        this.customers.splice(i, 1)
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