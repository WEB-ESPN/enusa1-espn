<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inquiries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Inquiries</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-end">
                <div class="d-flex mb-2">
                    <div class="d-flex">
                        <div class="pr-1">
                            <VueDatePicker v-model="daterange" range :format="format" :enableTimePicker="false" placeholder="Select Date"></VueDatePicker>
                        </div>
                        <div class="pr-1">
                            <select v-model="searchQueryPaymentMethod" class="form-control" placeholder="Choose by key">
                                <option value="" selected>All Payment Method</option>
                                <template v-for="(v) in paymentMethods" :key="v">
                                    <option :value="v.content">{{ v.content }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="pl-1">
                            <input type="text" v-model="searchQuery" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body table-responsive table-hover">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Date</th>
                                <th>Invoice Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Sub Distric</th>
                                <th>Category</th>
                                <th>Name Product</th>
                                <th>Quantity</th>
                                <th>Spect and Note</th>
                                <th>Payment Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="datas.data.length > 0" class="tbody-">
                            <tr v-for="(data, index) in datas.data" :key="index">                                    
                                <td v-if="pageNumber > 1">{{ pageNumber - 1 }}{{ index + 1 }}</td>
                                <td v-else>{{ index + 1 }}</td>
                                <td>{{ data.created_at }}</td>
                                <td>{{ data.invoice_number }}</td>
                                <td>{{ data.first_name }}</td>
                                <td>{{ data.last_name }}</td>
                                <td>{{ data.phone_number }}</td>
                                <td>{{ data.email }}</td>
                                <td>{{ data.company_name }}</td>
                                <td>{{ data.country }}</td>
                                <td>{{ data.city }}</td>
                                <td>{{ data.sub_distric }}</td>
                                <td>{{ data.category }}</td>
                                <td>{{ data.product_name }}</td>
                                <td>{{ data.quantity }}</td>
                                <td>{{ data.note }}</td>
                                <td>{{ data.payment_method }}</td>
                                <td>
                                    <a href="#" @click.prevent="confirmDeletion(data.id)"><i class="fa fa-trash text-danger ml-2"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="17" class="text-center">No results found...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <Pagination :data="dataLinkPagination" @getDatas="getDatas" />
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalDeleteForm" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span>Delete Data</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to delete this data ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button @click.prevent="deleteData" type="button" class="btn btn-primary">Delete Data</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { watch, ref, onMounted } from "vue";
    import { requestDelete, requestGet, requestPatch, requestPost } from "../../api/api";
    import { useToastr } from '../../toastr';
    import { debounce } from 'lodash';
    import Pagination from '../../components/Pagination.vue';
    import $ from 'jquery';
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'
    import moment from 'admin-lte/plugins/moment/moment-with-locales.js';

    // CONST
    const datas                    = ref({'data': []});
    const searchQuery              = ref(null);
    const searchQueryPaymentMethod = ref('');
    const dataLinkPagination       = ref(null);
    const pageNumber               = ref(0);
    const dataIdBeingDeleted       = ref(null);
    const paymentMethods           = ref([]);
    const toastr                   = useToastr();
    const daterange = ref()

    const getDatas = (page = 1) => {
        pageNumber.value = page;

        let queryParam;
        if (searchQueryPaymentMethod.value !== '') {
            queryParam = {
                page: page,
                search: searchQuery.value,
                daterange: daterange.value,
                payment_method: searchQueryPaymentMethod.value
            };            
        } else {
            queryParam = {
                page: page,
                search: searchQuery.value,
                daterange: daterange.value,
            };  
        }

        requestGet(`admin/product-inquiry`, queryParam)
        .then((RESPONSE) => {
            datas.value              = RESPONSE.data.productInquiries;
            paymentMethods.value       = RESPONSE.data.paymentMethods;
            dataLinkPagination.value = RESPONSE.data.productInquiries.meta.links;
        })
        .catch((ERROR) => {
            // alert(ERROR.response.data.message);
        });
    };

    const confirmDeletion = (id) => {
        dataIdBeingDeleted.value = id;
        $('#modalDeleteForm').modal('show');
    };

    const deleteData = () => {
        requestDelete(`admin/product-inquiry/destroy/${dataIdBeingDeleted.value}`)
        .then(() => {
            $('#modalDeleteForm').modal('hide');
            toastr.success('Data deleted successfully!');
            datas.value.data = datas.value.data.filter(data => data.id !== dataIdBeingDeleted.value);
        }).catch((error) => {
            toastr.error(error.response.data.message);
        });
    };

    const format = (date) => {
        const startDate = moment(date[0]).format("yyyy-MM-DD");
        const endDate = moment(date[1]).format("yyyy-MM-DD");
        return `${startDate} - ${endDate}`;
    }

    // WATCH
    watch(searchQuery, debounce(() => {
        getDatas();
    }, 300));
    watch(searchQueryPaymentMethod, debounce(() => {
        getDatas();
    }, 300));

    watch(daterange, debounce(() => {
        getDatas();
    }, 300));

    // MOUNTED
    onMounted(() => {
        getDatas();
    });
</script>

<style>

</style>