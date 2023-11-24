import { createRouter, createWebHistory } from 'vue-router';
import Login from '../pages/auth/Login.vue';
import Dashboard from '../pages/dashboard/Dashboard.vue';
import CategoryList from '../pages/categories/CategoryList.vue';
import HomeSettingList from '../pages/home_settings/HomeSettingList.vue';
import ProductList from '../pages/products/ProductList.vue';
import ProductInquiryList from '../pages/product-inquiries/ProductInquiryList.vue';
import SupplierInquiryList from '../pages/contact-us-inquiries/SupplierInquiryList.vue';
import CustomerInquiryList from '../pages/contact-us-inquiries/CustomerInquiryList.vue';
import Profile from '../pages/profile/Profile.vue';
import useAuthStore from '../stores/auth';

const routeForAdmin = [
    {
        path: '/login',
        name: 'admin.login',
        component: Login,
        meta: {
            title: 'Admin | Login'
        }
    },
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard,
        meta: {
            title: 'Admin | Dashboard'
        }
    },
    {
        path: '/admin/categories',
        name: 'admin.categories',
        component: CategoryList,
        meta: {
            title: 'Admin | Categories'
        }
    },  
    {
        path: '/admin/products',
        name: 'admin.products',
        component: ProductList,
        meta: {
            title: 'Admin | Products'
        }
    },
    {
        path: '/admin/product-inquiries',
        name: 'admin.product-inquiries',
        component: ProductInquiryList,
        meta: {
            title: 'Admin | Product Inquiries'
        }
    },
    {
        path: '/admin/supplier-inquiries',
        name: 'admin.supplier-inquiries',
        component: SupplierInquiryList,
        meta: {
            title: 'Admin | Supplier Inquiries'
        }
    },
    {
        path: '/admin/customer-inquiries',
        name: 'admin.customer-inquiries',
        component: CustomerInquiryList,
        meta: {
            title: 'Admin | Customer Inquiries'
        }
    },
    {
        path: '/admin/home-setting',
        name: 'admin.home_setting',
        component: HomeSettingList,
        meta: {
            title: 'Admin | Home Settings'
        }
    },
    {
        path: '/admin/profile',
        name: 'admin.profile',
        component: Profile,
        meta: {
            title: 'Admin | Profile'
        }
    },
];

const routeAdmin = createRouter({
    history: createWebHistory(),
    routes: routeForAdmin,
});

routeAdmin.beforeEach(async (to, from) => {
    const authStore = useAuthStore();
    if (authStore.userIsAuth === null && to.name !== 'admin.login') {
        return { name: 'admin.login' };        
    }

    if (authStore.userIsAuth !== null && to.name === 'admin.login') {
        return { name: 'admin.dashboard' };
    }

    const title = to.meta.title;
    if (title) {
        document.title = title;
    }
});

export default routeAdmin;