import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Customers from '../components/Customers';
import AddCustomer from '../components/AddCustomer';
import EditCustomer from '../components/EditCustomer';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'customers',
        path: '/customers',
        component: Customers
    },
    {
        name: 'addcustomer',
        path: '/customers/add',
        component: AddCustomer
    },
    {
        name: 'editcustomer',
        path: '/customers/edit/:id',
        component: EditCustomer
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
