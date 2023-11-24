<template>
    <header class="header fixed-top">
        <div class="container-lg container-fluid d-none d-md-block">
            <div class="top-navbar gap-4">
                <div class="mx-auto item-topbar">
                    <img src="/assets/images/logo-espn.png" alt="logo"
                        style="height: 40px; object-fit: cover;" />
                </div>
                <div class="d-flex align-items-center gap-lg-2 gap-xl-5 mx-auto flex-wrap gap-1 item-topbar gap-2">
                    <div class="font-weight-400 font-size-12 hstack align-items-center gap-2" style="max-height: 15px;">
                        <div>
                            <img src="/assets/images/icons/location.svg" />
                        </div>
                        <span>{{ footerData.address }}</span>
                    </div>
                    <div class="font-weight-400 font-size-12 hstack align-items-center gap-2" style="max-height: 15px;">
                        <div>
                            <img src="/assets/images/icons/mail.svg" />
                        </div>
                        <span>{{ footerData.email }}</span>
                    </div>
                </div>
            </div>
        </div>
        <b-navbar class="navbar-top navbar-expand-lg bg-body-tertiary" toggleable="md" type="light" variant="light">
            <div class="container-md">
                <b-navbar-brand class="d-md-none focus-border-0">
                    <img src="/assets/images/logo-espn.png" alt="logo"
                        style="height: 35px;" />
                </b-navbar-brand>
                <div v-if="isCollapse" role="button" class="btn border-0 d-md-none" @click="toggleCollapse(false)">
                    <i class="fas fa-times font-size-30"></i>
                </div>
                <div v-else role="button" class="btn border-0 d-md-none" @click="toggleCollapse(true)">
                    <i class="fas fa-bars font-size-30"></i>
                </div>
                <b-collapse id="navBarCollapse" is-nav>
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li  class="nav-item">
                            <router-link :class="`nav-link`" to="/" >
                                <img
                                    src="/assets/images/logo-enusa-black.png"
                                    style="height: 18px;"
                                />
                            </router-link>
                        </li>
                        <li v-for="item in navbar" class="nav-item">
                            <router-link :class="`nav-link ${item.link == currentUrl ? 'active' : ''}`" :to="item.link" >{{ item.name }}</router-link>
                        </li>
                        <li class="nav-item d-md-none pt-0">
                            <div class="nav-link px-3 pb-3 pt-0">
                                <table class="navbar-contact font-weight-400 font-size-12">
                                    <tr>
                                        <td>
                                            <img src="/assets/images/icons/location.svg" />
                                        </td>
                                        <td>
                                            {{ footerData.address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="me-2" src="/assets/images/icons/mail.svg" />
                                        </td>
                                        <td>
                                            {{ footerData.email }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                    </ul>
                </b-collapse>
            </div>
        </b-navbar>
    </header>
</template>

<script>
import $ from 'jquery';
const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';

export default {
    name: 'Navbar',
    data() {
        return {
            isCollapse: false,
            currentUrl: window.location.pathname,
            footerData: [],
            navbar: [
                {
                    name: 'Home',
                    link: '/'
                },
                {
                    name: 'Product',
                    link: '/products'
                },
                {
                    name: 'Contact Us',
                    link: '/contact-us'
                }
            ]
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        toggleCollapse(status) {
            this.isCollapse = status;
            const navBarCollapse = $('#navBarCollapse');
            if(status)
                navBarCollapse.show('slow');
            else
                navBarCollapse.hide('slow');
        },
        getData() {
            axios.get(BASE_URL + 'frontend/contact-us/get')
                .then((data) => {
                    this.footerData = data.data.data
                })
                .catch((err) => {
                    console.error(err);
                });
        },
    }
}
</script>
