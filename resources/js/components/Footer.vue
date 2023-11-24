<template>
    <footer class="mt-5">
        <div class="container pt-5 pb-4">
            <div class="row align-items-center px-4 gx-lg-4 g-md-5 gy-5">
                <div class="col-lg-4 col-md-6 order-lg-0 order-1">
                    <div class="hstack align-items-center flex-wrap gap-3 pe-5 mb-2">
                        <router-link to="/" class="font-weight-700 font-size-16 text-decoration-none text-dark">
                            Home
                        </router-link>
                        <router-link to="/" class="font-weight-700 font-size-16 text-decoration-none text-dark">
                            Product
                        </router-link>
                        <router-link to="/" class="font-weight-700 font-size-16 text-decoration-none text-dark">
                            Contact Us
                        </router-link>
                    </div>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <router-link to="/become-a-customer" class="btn btn-p-grey-57 text-p-black font-weight-600 font-size-13 me-3 hover-bg-p-orange-9 px-4 py-2 rounded-0">
                            Become a Customer
                        </router-link>
                        <router-link to="/become-a-supplier" class="btn btn-p-grey-57 text-p-black font-weight-600 font-size-14 hover-bg-p-orange-9 px-4 py-2 rounded-0">
                            Become a Supplier
                        </router-link>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 order-0 orderlg-1">
                    <div class="text-center">
                        <div>
                            <img style="height: 55px;" src="/assets/images/logo-espn.png" />
                        </div>
                        <div class="">
                            <img style="height: 45px;" src="/assets/images/elevenis-biz-black.png" />
                            <img class="pt-3" style="height: 38px;" src="/assets/images/nustantrara-black.png" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ms-lg-auto order-2 orderlg-2">
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
                <!-- <div class="col-12">
                    <div class="text-center mt-3 font-weight-400 font-size-12">
                        © 2022 espn all rights reserved
                    </div>
                </div> -->
            </div>
        </div>
        <div class="text-center my-2 font-weight-400 font-size-12">
            © 2022 espn all rights reserved
        </div>
    </footer>
</template>

<script>
const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';

export default {
    name: 'Footer',
    data() {
        return {
            footerData: [],
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
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
