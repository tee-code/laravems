<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div v-if="showMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="d-sm-flex align-items-center justify-content-between mb-4">

                    <a @click="alert('Not available.');" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Sheet</a>
                    <!-- Topbar Search -->
                    <form
                        method = "POST"
                        action=""
                        @submit.prevent="filterEmployee()"
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input v-model="searchText" type="search" name = "search" class="form-control bg-light border-0 small" placeholder="Search employee"
                                   aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <router-link
                        :to="{ name: 'CreateEmployee'}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    ><i
                        class="fas fa-user fa-sm text-white-50"></i> Create Employee
                    </router-link>
                </div>

                <div class="card">

                    <div class="card-header bg-primary text-white">Employees
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Other Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Department</th>
                                <th scope="col">Manage</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="employee in employees" :key="employee.id">
                                <td>{{ employee.id }}</td>
                                <td>{{ employee.first_name }}</td>
                                <td>{{ employee.last_name }}</td>
                                <td>{{ employee.other_name }}</td>
                                <td>{{ employee.email }}</td>
                                <td>{{ employee.department.name }}</td>

                                <td>
                                    <router-link
                                        class="btn btn-primary"
                                        :to="{
                                            name: 'EditEmployee',
                                            params:{ id: employee.id }
                                            }"
                                    >
                                        <i class="fas fa-pen fa-sm"></i>
                                    </router-link>

                                    <form class = "d-inline" method = "POST" action="">
                                        <button @click="deleteEmployee(employee.id)" class="btn btn-danger"><i class="fas fa-trash fa-sm"></i> </button>
                                    </form>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="text-center my-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EmployeeIndex",

    data(){
        return {
            results: [],
            employees: [],
            message: "",
            showMessage: false,
            searchText: ""
        }
    },
    created(){
        this.getEmployees();
    },
    methods: {

        getEmployees(){
            axios.get('/api/employees').then((res) => {

                this.employees = res.data.data;
                this.results = res.data.data;

            }).catch(e => console.log(e));
        },

        deleteEmployee(id){
            axios.delete(`/api/employees/${id}`).then(res => {
                this.showMessage = true;
                this.message = res.data;
            }).catch(e => console.log(e));
        },

        filterEmployee(){

           this.employees = this.results.filter((employee) => employee.first_name.toLowerCase().includes(this.searchText.toLowerCase()) 
                || employee.last_name.toLowerCase().includes(this.searchText.toLowerCase()) 
                || employee.other_name.toLowerCase().includes(this.searchText.toLowerCase())
                || employee.department.name.toLowerCase().includes(this.searchText.toLowerCase()));
            }  
            

    },
    watch: {
        searchText: function(){

            if(this.searchText.trim().length > 0){
                this.filterEmployee();
            }
        }
    }
}
</script>

<style scoped>

</style>
