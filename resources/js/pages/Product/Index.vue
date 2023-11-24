<template>
  <Hero title="Product" :category=categoryQuery />
  <section class="container mt-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start">
      <div class="">
        <b-breadcrumb>
          <b-breadcrumb-item
            v-for="(item, index) in breadcrumb"
            :key="index"
            :to="item.href"
            :active="index === breadcrumb.length - 1"
          >
            {{ item.text }}
          </b-breadcrumb-item>
        </b-breadcrumb>

        <div
          @click.prevent="downloadPDFCatalogue()"
          class="btn btn-p-grey-43 rounded-0 p-2 text-p-orange-13 font-weight-700 font-size-16"
        >
          Download PDF Catalogue
        </div>
      </div>
      <div class="ms-auto text-end">
        <div
          class="d-flex justify-content-between align-items-center position-relative bg-p-grey-43 mb-4"
        >
          <input
            v-model="searchQuery"
            type="text"
            class="rounded-0 py-1 px-3 border-0 bg-transparent"
            placeholder="Search"
            style="min-width: 250px;"
          />
          <div class="btn btn-p-orange-13 rounded-0" v-on:click="getData()">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-search text-p-white"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
              <path d="M21 21l-6 -6"></path>
            </svg>
          </div>
        </div>
        <router-link
          :to="{ name: 'Inquiry'}"
          class="btn btn-p-grey-43 rounded-0 p-2 text-p-orange-13 font-weight-700 font-size-16"
        >
          request quote by your self
        </router-link>
      </div>
    </div>
  </section>
  <section class="container mt-4">
    <div class="row g-5 flex-container">
      <div class="col-lg-3 col-md-4 col-sm-6 flex-item" v-for="item in products">
        <div class="card rounded-0 border-0 bg-transparent">
          <div class="card-body p-0 position-relative">
            <div>
              <img :src="item.image" class="img-fluid w-100" />
            </div>
            <div>
              <div class="mt-2">
                <div class="font-size-15 font-weight-400 text-p-grey-56 mx-3">
                  {{ item.category_title }}
                </div>
                <div
                  class="font-size-16 font-weight-600 text-p-black mx-3 my-2"
                >
                  {{ item.title }}
                </div>
              </div>
              <router-link
                :to="{ name: 'InquiryShow', params: { code: item.code }}"
                class="btn btn-p-grey-43 font-size-14 font-weight-700 cursor-pointer text-p-orange-13 text-center w-100 rounded-0 mt-2"
              >
                Request Quote
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center align-items-center position-relative" v-if="hasPagination">
          <Pagination :data="dataLinkPagination" @getData="getData" />
      </div>
    </div>
  </section>
</template>

<script>
  import Hero from "../../components/Hero.vue";
  import Pagination from '../../components/Pagination.vue';
  import { titleCase } from '../../utils/helpers.js'
  import { useToastr } from '@/admin/toastr';
  const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';
  const toastr = useToastr();

  export default {
    components: {
      Hero, Pagination
    },
    data() {
      return {
        searchQuery: null,
        categoryQuery: this.$route.query.category,
        breadcrumb: [
          {
            text: "Products",
            href: "/products",
          },
        ],
        products: [],
        getProduct: [],
        dataLinkPagination: null,
        hasPagination: false,
      };
    },
    name: "Product",
    mounted() {
      this.getData()
      this.updateBreadcrumb();
    },
    beforeRouteUpdate(to, from, next) {
      this.categoryQuery = to.query.category;
      this.getData()
      this.updateBreadcrumb();
      next();
    },
    methods: {
      updateBreadcrumb() {
        this.breadcrumb = [
          {
            text: "Products",
            href: "/products",
          },
        ];
        if (this.categoryQuery) {
          this.breadcrumb.push({
            text: titleCase(this.categoryQuery),
          });
        }
      },
      downloadPDFCatalogue() {
        axios.get(BASE_URL + 'frontend/download/pdf')
              .then((RESPONSE) => {
                if (RESPONSE.data.data)
                  window.open(RESPONSE.data.data, '_blank');
              })
              .catch((err) => {
                if (err.response.status = 404)
                  toastr.error("System Error");
              });
      },
      getData(page = 1) {
        let queryParam = {
                page: page,
                per_page: 8,
                search: this.searchQuery,
                category_name: this.categoryQuery
            };

        axios.get(BASE_URL + 'frontend/products', {params: queryParam})
              .then((RESPONSE) => {
                this.products = RESPONSE.data.data.data
                this.dataLinkPagination = RESPONSE.data.data.meta.links;

                if (RESPONSE.data.data.meta.last_page > 1) {
                  this.hasPagination = true
                }
              })
              .catch((err) => {
                  console.error(err);
              });
      },
    },
  };
</script>