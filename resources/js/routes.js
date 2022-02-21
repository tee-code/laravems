import CreateEmployee from './components/employee/CreateEmployee';
import EmployeeIndex from './components/employee/EmployeeIndex';
import EditEmployee from './components/employee/EditEmployee';

export const routes = [
    {
        path: '/employees/create',
        component: CreateEmployee,
        name: 'CreateEmployee'
    },
    {
        path: '/employees',
        component: EmployeeIndex,
        name: 'EmployeeIndex'
    },
    {
        path: '/employees/:id',
        component: EditEmployee,
        name: 'EditEmployee'
    }
];
