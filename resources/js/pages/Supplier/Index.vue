<template>
  <hero style="left: 32%;" title="Become a Supplier" :showMenu="false" />
  <section class="container mt-5">
    <div class="col-sm-8">
      <div class="font-size-18 font-weight-400">
        To become a supplier, please fill out the application form below. A
        member from our purchasing team will contact_name you as soon as possible.
      </div>
      <div class="mt-4 font-size-18 font-weight-400">
        Before submitting the contact_name form, please verify that your products are
        compliable with CFIA’s labeling requirements, have billingual
        translation, and must contain a barcode.
      </div>
    </div>
  </section>
  <section class="container mt-4">
    <Form ref="form" @submit="handleSubmitInquiryForm" :validation-schema="submitInquirySchema" :initial-values="formValues" v-slot="{ errors }">
      <div class="row">
        <div class="col-md-6">
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="company_name">Company Name</label>
              <Field name="company_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.company_name }" id="company_name" placeholder="Company Name" />
              <span class="invalid-feedback">{{ errors.company_name }}</span>
            </div>
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="brand_name">Brand Name</label>
              <Field name="brand_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.brand_name }" id="brand_name" placeholder="Brand Name" />
              <span class="invalid-feedback">{{ errors.brand_name }}</span>
            </div>
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="business_name">Legal Business Name</label>
              <Field name="business_name" type="text" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.business_name }" id="business_name" placeholder="Legal Business Name" />
              <span class="invalid-feedback">{{ errors.business_name }}</span>
            </div>
          </div>
          <div>
            <input-group label="Type of Product" name="type" :required="true" />
          </div>
          <div>
            <div class="position-relative mt-5">
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="contact_name">Contact Name</label>
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
              <label style="top: -17px;left: 12px;" class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 " for="additional_detail">Additional Detail</label>
              <Field name="additional_detail" as="textarea" class="form-control rounded-8 border-1 border-p-grey-56" :class="{ 'is-invalid': errors.additional_detail }" id="additional_detail" placeholder="" />
              <span class="invalid-feedback">{{ errors.additional_detail }}</span>
            </div>
          </div>
          <Field name="type" type="hidden" value="supplier" placeholder="" />
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
    </form>
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
    company_name: yup.string().required('Company Name must be filled'),
    brand_name: yup.string().required('Brand Name must be filled'),
    business_name: yup.string().required('Business Name must be filled'),
    contact_name: yup.string().required('Contact Name must be filled'),
    phone_number: yup.string().required('Phone Number must be filled'),
    email: yup.string().required('Email must be filled').email('must be a valid email'),
    country: yup.string().required('Country must be filled'),
    city: yup.string().required('City must be filled'),
    sub_distric: yup.string().required('Sub Distric must be filled'),
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
