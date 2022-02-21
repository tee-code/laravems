<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header bg-primary text-white">
                        Create Employee

                        <router-link :to="{ name: 'EmployeeIndex' }" class="text-white float-right">
                            <i class="fas fa-arrow-left"></i> Back
                        </router-link>

                    </div>

                    <div class="card-body">
                        <form @submit.prevent="storeEmployee">

                            <div class="form-group row">

                                <label for="first-name" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input v-model="form.first_name" id="first-name" type="text" class="form-control" value="" required autofocus>
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="last-name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-6">
                                    <input v-model="form.last_name" id="last-name" type="text" class="form-control" value="" required>
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="other-name" class="col-md-4 col-form-label text-md-right">Other Name</label>

                                <div class="col-md-6">
                                    <input v-model="form.other_name" id="other-name" type="text" class="form-control" value="" required>
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input v-model="form.email" id="email" type="email" class="form-control" value="" required>
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">
                                    <input v-model="form.address" id="address" type="text" class="form-control" value="" required>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="country_id" class="col-md-4 col-form-label text-md-right">Country</label>

                                <div class="col-md-6">
                                    <select v-model="form.country_id" @change="getStates()" name="country_id" id="country_id" class="form-control"  required>
                                        <option class = "bg-primary p-2 mb-3" :value="0">Select Country</option>
                                        <option v-for="country in countries" class = "p-2 mb-3" :value="country.id" :key="country.code">{{ country.name }}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state_id" class="col-md-4 col-form-label text-md-right">State</label>

                                <div class="col-md-6">
                                    <select v-model="form.state_id" @change="getCities()" name="state_id" id="state_id" class="form-control" required>
                                        <option class = "bg-primary p-2 mb-3" :value="0">Select State</option>
                                        <option v-for="state in states" class = "p-2 mb-3" :value="state.id" :key="state.id">{{ state.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city_id" class="col-md-4 col-form-label text-md-right">City</label>

                                <div class="col-md-6">
                                    <select v-model="form.city_id"  name="city_id" id="city_id" class="form-control"  required>
                                        <option class = "bg-primary p-2 mb-3" :value="0">Select City</option>
                                        <option v-for="city in cities" class = "p-2 mb-3" :value="city.id" :key="city.id">{{ city.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="department_id" class="col-md-4 col-form-label text-md-right">Department</label>

                                <div class="col-md-6">
                                    <select v-model="form.department_id" name="department_id" id="department_id" class="form-control"  required>
                                        <option class = "bg-primary p-2 mb-3" value="0">Select Department</option>
                                        <option v-for="department in departments" class = "p-2 mb-3" :value="department.id" :key="department.id">{{ department.name }}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="zip-code" class="col-md-4 col-form-label text-md-right">Zip Code</label>

                                <div class="col-md-6">
                                    <input v-model="form.zip_code" id="zip-code" type="text" class="form-control" value="" required>
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="birthdate" class="col-md-4 col-form-label text-md-right">Birthday</label>

                                <div class="col-md-6">
                                    <datepicker id="birthdate" v-model="form.birthdate" :typeable="true" input-class="form-control"></datepicker>
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="date-hired" class="col-md-4 col-form-label text-md-right">Date Hired</label>

                                <div class="col-md-6">
                                    <datepicker id="date-hired" v-model="form.date_hired" :typeable="true" input-class="form-control"></datepicker>
                                </div>

                            </div>

                            <div class="form-group row mb-0">

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Create
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

export default {
    name: "CreateEmployee",
    components: {
        Datepicker
    },
    data(){
        return {

            countries: [],
            departments: [],
            cities: [],
            states: [],
            form: {
                address:"",
                first_name: "",
                last_name: "",
                other_name: "",
                zip_code: "",
                department_id: "",
                state_id: "",
                country_id: "",
                city_id: "",
                birthdate: null,
                date_hired: null,
            }

        }
    },
    created() {
        this.getCountries();
        this.getDepartments();
    },
    methods: {
        getCountries(){
            axios.get('/api/employees/countries').then(res => {

                this.countries = res.data;

            }).catch((e) => console.log(e));
        },
        getDepartments(){
            axios.get('/api/employees/departments').then(res => {

                this.departments = res.data;

            }).catch((e) => console.log(e));
        },
        getStates(){
            axios.get(`/api/employees/${this.form.country_id}/states`).then(res => {

                this.states = res.data;

            }).catch((e) => console.log(e));
        },
        getCities(){
            axios.get(`/api/employees/${this.form.state_id}/cities`).then(res => {

                this.cities = res.data;

            }).catch((e) => console.log(e));
        },

        storeEmployee(){
            axios.post(`/api/employees`, {

                "first_name": this.form.first_name,
                "last_name": this.form.last_name,
                "other_name": this.form.other_name,
                "birthdate": this.format_date(this.form.birthdate),
                "date_hired": this.format_date(this.form.date_hired),
                "city_id": this.form.city_id,
                "state_id": this.form.state_id,
                "country_id": this.form.country_id,
                "department_id": this.form.department_id,
                "zip_code": this.form.zip_code,
                "address": this.form.address,
                "email": this.form.email

            }).then((res) => {
                this.$router.push({ name: 'EmployeeIndex'});
            }).catch((e) => console.log(e));
        },
        format_date(date){
            if(date){
                return moment(String(date)).format('YYYYMMDD');
            }
        }

    }
}
</script>

<style scoped>

</style>
