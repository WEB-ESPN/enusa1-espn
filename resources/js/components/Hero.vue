<template>
    <section class="hero">
        <div class="image-hero position-relative" style="margin-top: 4rem !important;">
            <img :src=header_image style="width: 100%;" />
            <div class="position-absolute w-100 py-md-5 py-lg-4 py-xl-5" style="top: 30%;">
                <div class="container">
                    <div class="row align-items-center">
                        <div :class="`${showMenu ? 'col-3' : 'col-6'}`">
                            <div
                            class="font-weight-700 font-size-xl-40 font-size-lg-30 font-size-md-20 font-size-sm-18 font-size-14 text-p-orange-12">
                            {{ title }}
                        </div>
                        </div>
                        <div v-if="showMenu" class="col-9 mx-auto">
                            <div class="d-flex gap-md-4 justify-content-start text-center gap-2 flex-wrap w-100">
                                <router-link :to="`/products?category=${item.code}`" v-for="item in categoryProduct"
                                    class="font-weight-600 text-nowrap font-size-xl-20 font-size-lg-20 font-size-md-10 font-size-sm-5 font-size-8 text-p-black text-decoration-none">
                                    {{ item.title }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';

export default {
    name: "Hero",
    props: {
        title: {
            type: String,
            default: "",
        },
        showMenu: {
            type: Boolean,
            default: true,
        },
        category: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            categoryProduct: [],
            header_image: "/assets/images/hero-product-bg.png"
        };
    },
    mounted() {
        if (this.title == "Product") {
            this.getData()
        }
    },
    methods: {
        getData() {
            axios.get(BASE_URL + 'frontend/categories')
                .then((RESPONSE) => {
                    this.categoryProduct = RESPONSE.data.data
                    this.categoryProduct.push({
                            title: 'Others',
                            code: 'other',
                        });
                    
                    this.setHeaderImage(this.category)
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        setHeaderImage(value = null) {
            let imagePath = "/assets/images/hero-product-bg.png"
            
            if (this.title == "Product" && value && value !== "other") {
                imagePath = this.categoryProduct
                                .find(obj => {
                                    return obj.code === value
                                })
                                .header_image;
            }

            this.header_image = imagePath
        }
    },
    watch: {
        category(newValue, oldValue) {
            this.setHeaderImage(newValue)
        }
    }
};
</script>
