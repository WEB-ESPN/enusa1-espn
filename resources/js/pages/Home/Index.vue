<template>
  <section class="hero">
    <div class="position-relative">
      <img :src="headerData.image" style="width: 100%;" />
      <div>
        <div class="position-absolute text-center text-white w-100 header-text">
          <div class="container-lg">
            <div class="row justify-content-between align-items-center w-100">
              <div class="col-4 text-start">
                <div
                  class="font-weight-700 font-size-xl-40 font-size-lg-36 font-size-md-30 font-size-sm-20 font-size-10"
                >
                  {{ headerData.title }}
                </div>
              </div>
              <div class="col-8 text-end">
                <div
                  class="font-size-xl-21 font-size-lg-18 font-size-md-16 font-size-sm-10 font-size-6 font-weight-400"
                >
                {{ headerData.description }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="product">
    <div class="image-hero position-relative">
      <img src="/assets/images/product-bg.png" style="width: 100%;" />
      <div class="container">
        <div
          class="position-absolute text-center text-white"
          style="top: 50%; left: 15%; transform: translate(-50%, -50%);"
        >
          <div
            class="py-md-4 px-md-5 px-sm-4 py-sm-3 px-3 py-2"
            style="
              filter: drop-shadow(4px 4px 4px rgba(0, 0, 0, 0.25));
              border: 3px solid white;
            "
          >
            <div
              class="font-size-xl-40 font-size-lg-36 font-size-md-20 font-size-10 font-weight-700 text-center text-p-orange-12"
            >
              New <br />
              Product
            </div>
          </div>
        </div>
        <div
          class="position-absolute"
          style="top: 50%; left: 67%; transform: translate(-50%, -50%);"
        >
          <div class="d-flex justify-content-between list-product">
            <div class="product-item" v-for="(item, index) in latestProducts">
              <div class="position-relative product-item-image">
                <div class="bg-p-white">
                  <img :src="item.image" :width="140"/>
                </div>
                <div
                  class="img-product-overlay d-flex align-items-center pe-md-4 ps-md-2 pe-1"
                >
                  <p
                    class="text-p-white font-weight-600 text-center font-size-lg-12 font-size-md-10 font-size-4"
                  >
                    {{ item.description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="">
      <swiper :navigation="true" :modules="modules" class="mySwiper">
        <swiper-slide v-for="(item, index) in homeSlider">
          <img :src="item.image" class="w-100" />
        </swiper-slide>
      </swiper>
    </div>
  </section>
  <section class="container mt-5">
    <div
      class="font-size-28 font-weight-600 text-p-green-20 text-center"
      style="text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"
    >
      Category Product
    </div>
    <div class="row align-items-start py-5 px-xl-5 px-md-3 g-5">
      <div class="col-lg-3 col-md-4 col-6" v-for="(item, index) in categories">
        <div class="px-xl-4">
          <div
            class="p-2 d-flex align-items-center justify-content-center"
            style="background: linear-gradient(#ccc694, #7b906f, #99a97c);"
          >
            <img
              :src="item.image"
              class="img-fluid"
              style="height: 142px; min-width: 80px;"
            />
          </div>
          <div class="bg-p-green-20 py-3 px-4 text-center">
              <router-link
                :to="`/products?category=${item.code}`"
                class="font-weight-700 text-p-white font-size-18"
              >
              {{ item.title }}
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';

export default {
  name: "Home",
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    return {
      modules: [Navigation],
    };
  },
  data() {
    return {
      categories: [],
      latestProducts: [],
      homeSlider:[],
      headerData: [],
    }
  },
  mounted() {
    this.getData()
  },
  methods: {
    getData() {
        axios.get(BASE_URL + 'frontend/home')
              .then((RESPONSE) => {
                this.categories = RESPONSE.data.data.categories
                this.latestProducts = RESPONSE.data.data.latestProducts
                this.homeSlider = RESPONSE.data.data.homeSettings.home_slider
                this.headerData = RESPONSE.data.data.headerData
              })
              .catch((err) => {
                  console.error(err);
              });
      },
  }
};
</script>
<style>
.swiper-button-next:after,
.swiper-button-prev:after {
  color: white;
}
</style>
