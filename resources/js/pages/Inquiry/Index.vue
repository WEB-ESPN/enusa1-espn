<template>
  <Hero title="Inquiry" />
  <section class="container mt-4">
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
  </section>
  <section class="container mt-4">
    <div class="card border-1 radius-10 border-p-orange-13">
      <div class="card-body">
        <Form ref="form" @submit="handleSubmitInquiryForm" :validation-schema="submitInquirySchema" :initial-values="formValues" v-slot="{ errors }">
          <div class="row">
            <div class="col-md-6">
              <div class="font-size-20 font-weight-500 text-p-orange-13">
                Personal & Company Information
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="position-relative mt-5">
                    <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="first_name">First Name</label>
                    <Field name="first_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.first_name }" id="first_name" placeholder="First Name" />
                    <span class="invalid-feedback">{{ errors.first_name }}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="position-relative mt-5">
                    <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="last_name">Last Name</label>
                    <Field name="last_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.last_name }" id="last_name" placeholder="Last Name" />
                    <span class="invalid-feedback">{{ errors.last_name }}</span>
                  </div>
                </div>
              </div>
              <div>
                <div class="position-relative mt-5">
                  <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="phone_number">Phone Number</label>
                  <Field name="phone_number" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.phone_number }" id="phone_number" placeholder="+62 822 6767 7878" />
                  <span class="invalid-feedback">{{ errors.phone_number }}</span>
                </div>
              </div>
              <div>
                <div class="position-relative mt-5">
                  <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="email">Email</label>
                  <Field name="email" type="email" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.email }" id="email" placeholder="john@mail.com" />
                  <span class="invalid-feedback">{{ errors.email }}</span>
                </div>
              </div>
              <div>
                <div class="position-relative mt-5">
                  <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="company_name">Company Name</label>
                  <Field name="company_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.company_name }" id="company_name" placeholder="" />
                  <span class="invalid-feedback">{{ errors.company_name }}</span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="position-relative mt-5">
                    <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="country">Country</label>
                    <Field name="country" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.country }" id="country" placeholder="" />
                    <span class="invalid-feedback">{{ errors.country }}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="position-relative mt-5">
                    <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="city">City</label>
                    <Field name="city" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.city }" id="city" placeholder="" />
                    <span class="invalid-feedback">{{ errors.city }}</span>
                  </div>
                </div>
              </div>
              <div>
                <div class="position-relative mt-5">
                  <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="sub_distric">Sub Distric</label>
                  <Field name="sub_distric" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.sub_distric }" id="sub_distric" placeholder="" />
                  <span class="invalid-feedback">{{ errors.sub_distric }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="font-size-20 font-weight-500 text-p-orange-13">
                Product Data
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="position-relative mt-5">
                    <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500" for="category">Category</label>
                    <Field name="category" as="select" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.category }" id="category">
                      <option value="">Select Category</option>
                      <template v-for="(v) in categories" :key="v">
                          <option :value="v.value">{{ v.label }}</option>
                      </template>
                    </Field>
                    <div style="position: absolute;top: 15%;left: 85%;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6 9l6 6l6 -6"></path>
                        </svg>
                    </div>
                    <span class="invalid-feedback">{{ errors.category }}</span>
                  </div>
                </div>
              </div>
              <div>
                <div class="position-relative mt-5">
                  <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="product_name">Name Product</label>
                  <Field name="product_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.product_name }" id="product_name" placeholder="" />
                  <span class="invalid-feedback">{{ errors.product_name }}</span>
                </div>
              </div>
              <div>
                <div class="position-relative mt-5">
                  <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="quantity">Quantity</label>
                  <Field name="quantity" type="number" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.quantity }" id="quantity" placeholder="" />
                  <span class="invalid-feedback">{{ errors.quantity }}</span>
                </div>
              </div>
              <div>
                <div class="position-relative mt-5">
                  <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="note">Spect and Note</label>
                  <Field name="note" as="textarea" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.note }" id="note" placeholder="" />
                  <span class="invalid-feedback">{{ errors.note }}</span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="position-relative mt-5">
                    <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500" for="payment_method">Payment Method</label>
                    <Field name="payment_method" as="select" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.payment_method }" id="payment_method">
                      <option value="">Select Payment Method</option>
                      <template v-for="(v) in paymentMethod" :key="v">
                          <option :value="v.value">{{ v.label }}</option>
                      </template>
                    </Field>
                    <div style="position: absolute;top: 15%;left: 85%;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6 9l6 6l6 -6"></path>
                        </svg>
                    </div>
                    <span class="invalid-feedback">{{ errors.payment_method }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <button class="btn btn-success px-5 py-3" v-else>
              Submit
            </button>
          </div>
        </Form>
      </div>
    </div>
  </section>
</template>

<script setup>
  import Hero from "@/components/Hero.vue";
  const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';

  import { watch, ref, onMounted } from "vue";
  import { useRouter, useRoute } from "vue-router";
  import { requestDelete, requestGet, requestPatch, requestPost } from "../../admin/api/api";
  import { useToastr } from '@/admin/toastr';
  import { debounce } from 'lodash';

  import * as yup from 'yup';
  import $ from 'jquery';
  import { Form, Field } from 'vee-validate';

  const route  = useRoute();
  const router = useRouter();
  const toastr = useToastr();
  const loading = ref(false);

  const formValues = ref(null)
  const paymentMethod = ref([
    {
      value: "cash",
      label: "Cash",
    },
    {
      value: "credit",
      label: "Credit",
    },
  ])

  const submitInquirySchema = yup.object({
    first_name: yup.string().required('First Name must be filled'),
    last_name: yup.string().required('Last Name must be filled'),
    phone_number: yup.string().required('Phone Number must be filled'),
    email: yup.string().required('Email must be filled').email('must be a valid email'),
    company_name: yup.string().required('Company Name must be filled'),
    country: yup.string().required('Country must be filled'),
    city: yup.string().required('City must be filled'),
    sub_distric: yup.string().required('Sub Distric must be filled'),
    category: yup.string().required('Category must be select'),
    product_name: yup.string().required('Product Name must be filled'),
    quantity: yup.number().required('Quantity must be filled'),
    note: yup.string().required('Spect and Note must be filled'),
    payment_method: yup.string().required('Payment Method must be select'),
  });

  const breadcrumb = ref([])
  const form = ref(null)
  const categories = ref([])

  //METHOD
  const getData = () => {
    axios.get(BASE_URL + `frontend/inquiry/custom`)
          .then((RESPONSE) => {
            categories.value = RESPONSE.data.data.categories
            updateBreadcrumb();
          })
          .catch((err) => {
              
          });
  }

  const updateBreadcrumb = () => {
    breadcrumb.value = [
        {
          text: "Products",
          href: "/products",
        },
        {
          text: 'Inquiry - Custom Product'
        }
      ];
  }

  const handleSubmitInquiryForm = (values, { resetForm, setErrors }) => {
    loading.value = true;

    const formData = new FormData();

    Object.keys(values).forEach(key => {
        if (values[key] && key !== 'id') {
            formData.append(key, values[key])                
        }
    });

    axios.post(BASE_URL + 'frontend/send-inquiry', formData)
          .then(res => {
            resetForm()
            toastr.success(res.data.message)
            loading.value = false;
          })
          .catch(er => {
            if (er.response.status == 429) {
              toastr.error("Too much submit form")
            } else if (er.response.data.message) {
              toastr.error(er.response.data.message)
            }

            loading.value = false;
          });
  };

  // MOUNTED
  onMounted(() => {
    getData()
  });
</script>
