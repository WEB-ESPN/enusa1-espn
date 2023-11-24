<template>
    <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Profile</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Profile</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  
  
      <div class="content">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <Form ref="form" @submit="updateData" :validation-schema="submitProfileSchema" v-slot="{ errors }" :initial-values="formValues">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <Field name="email" type="text" class="form-control" :class="{ 'is-invalid': errors.email }" id="email"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Old Password</label>
                                    <Field name="old_password" type="password" class="form-control" :class="{ 'is-invalid': errors.old_password }" id="old_password" placeholder="Old Password" />
                                    <span class="invalid-feedback">{{ errors.old_password }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">New Password</label>
                                    <Field name="new_password" type="password" class="form-control" :class="{ 'is-invalid': errors.new_password }" id="new_password" placeholder="New Password" />
                                    <span class="invalid-feedback">{{ errors.new_password }}</span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </Form>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </template>
  
<script setup>
    import useAuthStore from '../../stores/auth';
    import { watch, ref, onMounted, onBeforeMount } from "vue";
    import { requestPatch } from '../../api/api';
    import { useToastr } from '@/admin/toastr';
    import * as yup from 'yup';
    import { Form, Field } from 'vee-validate';

    const toastr = useToastr();
    const form = ref(null)
    const formValues = ref(null);
    const authStore = useAuthStore();
    const submitProfileSchema = yup.object({
        old_password: yup.string().required('Old Password must be filled'),
        new_password: yup.string().required('New Password must be filled')
                        .notOneOf([yup.ref('old_password'), null],'New Password must be different'),
    });

    const initForm = (data) => {
        formValues.value = {
                id          : data ? data.id : null,
                email       : data ? data.email : null,
            };
    };

    //METHOD
    const updateData = (values, { resetForm, setErrors }) => {
        const formData = new FormData();

        Object.keys(values).forEach(key => {
            if (values[key] && key !== 'id') {
                formData.append(key, values[key])                
            }
        });

        requestPatch(`admin/user/update`, { _method: 'PATCH'}, formData)
        .then((RESPONSE) => {
            resetForm();
            toastr.success('Data updated successfully!');
        }).catch((error) => {
            setErrors({old_password: error.response.data});
        });
    };

    // MOUNTED
    onMounted(() => {
        initForm(authStore.user);
    });
</script>