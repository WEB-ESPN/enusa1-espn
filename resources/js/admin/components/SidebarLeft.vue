<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">ENUSA</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <router-link to="/admin/profile" class="d-block">{{ authStore.user.email }}</router-link>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <router-link to="/admin/dashboard" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/categories" active-class="active" :class="$route.path.startsWith('/admin/categories') ? 'active' : ''" class="nav-link">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                                Categories
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/products" :class="$route.path.startsWith('/admin/products') ? 'active' : ''" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Products
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/product-inquiries" :class="$route.path.startsWith('/admin/product-inquiries') ? 'active' : ''" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Product Inquiries
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/supplier-inquiries" :class="$route.path.startsWith('/admin/supplier-inquiries') ? 'active' : ''" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Supplier Inquiries
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/customer-inquiries" :class="$route.path.startsWith('/admin/customer-inquiries') ? 'active' : ''" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Customer Inquiries
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/home-setting" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-ad"></i>
                            <p>
                                Home Settings
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <form class="nav-link">
                            <a href="#" @click.prevent="loggingOut === false && handleLogOut()">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </form>

                    </li>

                </ul>
            </nav>

        </div>

    </aside>
</template>

<script setup>
    import useAuthStore from '../stores/auth';
    import { ref } from 'vue';
    import { useRouter } from "vue-router";
    import { requestPost } from '../api/api';

    const router    = useRouter();
    const authStore = useAuthStore();

    const loggingOut = ref(false);

    const handleLogOut = () => {
        loggingOut.value = true;
        requestPost('admin/logout', {}).then(RESPONSE => {
            authStore.logoutUser();
            router.replace({ name: 'admin.login' });
        }).catch(ERROR => {
            alert(ERROR.response.data.message);
        });
        
    }
</script>