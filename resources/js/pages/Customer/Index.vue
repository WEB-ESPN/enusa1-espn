<template>
  <hero style="left: 32%;" title="Become a Customer" :showMenu="false" />
  <section class="container mt-5">
    <div class="col-sm-8">
      <div class="font-size-18 font-weight-400">
        We are committed to supplying customers no matter how big or small, with
        the same value and qualities that Enusantara has been renowned for.
      </div>
      <div class="mt-4 font-size-18 font-weight-400">
        To become a customer, please use the contact form below, and you will be
        contacted by a sales agent as soon as possible. Please only use this
        form if you have a registered business, Enusantara does not sell
        directly to consumers. If you are interested in seeing where you can
        findour products at retail locations, please contact the office
        directly.
      </div>
    </div>
  </section>
  <section class="container mt-4">
    <Form ref="form" @submit="handleSubmitInquiryForm" :validation-schema="submitInquirySchema" :initial-values="formValues" v-slot="{ errors }">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="product">Product</label>
              <Field name="product" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.product }" id="product" placeholder="Product" />
              <span class="invalid-feedback">{{ errors.product }}</span>
            </div>
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="business_name">Business Name</label>
              <Field name="business_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.business_name }" id="business_name" placeholder="Business Name" />
              <span class="invalid-feedback">{{ errors.business_name }}</span>
            </div>
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="contact">Contact Name</label>
              <Field name="contact_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.contact_name }" id="contact_name" placeholder="Contact Name" />
              <span class="invalid-feedback">{{ errors.contact_name }}</span>
            </div>
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="email">Email</label>
              <Field name="email" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.email }" id="email" placeholder="Email" />
              <span class="invalid-feedback">{{ errors.email }}</span>
            </div>
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="phone">Phone Number</label>
              <Field name="phone_number" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.phone_number }" id="phone_number" placeholder="ex +62 877 7878 8989" />
              <span class="invalid-feedback">{{ errors.phone_number }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
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
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="category">Categories of Interst</label>
              <Field name="category" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.category }" id="category" placeholder="" />
              <span class="invalid-feedback">{{ errors.category }}</span>
            </div>
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="additional_detail">Additional Detail</label>
              <Field name="additional_detail" as="textarea" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.additional_detail }" id="additional_detail" placeholder="" />
              <span class="invalid-feedback">{{ errors.additional_detail }}</span>
            </div>
          </div>
          <Field name="type" type="hidden" value="customer" placeholder="" />
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-center mt-5">
        <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <button class="btn btn-success px-5 py-3" v-else>
          Submit
        </button>
      </div>
    </Form>
  </section>
</template>

<script setup>
  import Hero from "@/components/Hero.vue";

  import { watch, ref, onMounted } from "vue";
  import { useToastr } from '@/admin/toastr';
  import * as yup from 'yup';
  import { Form, Field } from 'vee-validate';

  const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';
  const toastr = useToastr();
  const loading = ref(false);
  const form = ref(null)

  const submitInquirySchema = yup.object({
    product: yup.string().required('Product must be filled'),
    business_name: yup.string().required('Business Name must be filled'),
    contact_name: yup.string().required('Contact Name must be filled'),
    phone_number: yup.string().required('Phone Number must be filled'),
    email: yup.string().required('Email must be filled').email('must be a valid email'),
    country: yup.string().required('Country must be filled'),
    city: yup.string().required('City must be filled'),
    sub_distric: yup.string().required('Sub Distric must be filled'),
    category: yup.string().required('Category must be select'),
    additional_detail: yup.string().required('Additional Detail must be filled'),
  });

  //METHOD
  const handleSubmitInquiryForm = (values, { resetForm, setErrors }) => {
    loading.value = true;

    const formData = new FormData();

    Object.keys(values).forEach(key => {
        if (values[key] && key !== 'id') {
            formData.append(key, values[key])                
        }
    });

    axios.post(BASE_URL + 'frontend/send-contact-us-inquiry', formData)
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
</script>
