import MasterLayout from "../layouts/MasterLayout";
import constant from '../../layouts/js/constants';
/* page */

import Dashboard from "../pages/Dashboard";
import ListAdminsComponent from "../pages/admin/ListAdminsComponent";
import TestComponent from "../pages/TestComponent";
import ErrorComponent from "../pages/errors/ErrorComponent";
import CreateAdmin from "../pages/admin/CreateAdmin";
import LoadingExample from "../pages/Examples/LoadingExample";
import ListProductCategories from "../pages/productCategories/ListProductCategories";


const routes = [
    {
        path: "/",
        component: MasterLayout,
        redirect: "dashboard",
        children: [
            {
                path: "dashboard",
                name: "router-name.home",
                component: Dashboard,
                meta: {permissions: "all"}
            },{
                path: "admin-list.html",
                name: "router-name.adminlist",
                component: ListAdminsComponent,
                meta: {permissions: constant.PERMISSION_ACCOUNT_VIEW}
            },{
                path: "admin-create.html",
                name: "router-name.adminCreate",
                component: CreateAdmin,
                meta: {permissions: constant.PERMISSION_ACCOUNT_VIEW}
            },
            {
                path: "example-loading.html",
                name: "LoadingExample",
                component: LoadingExample,
                meta: {permissions: 'all'}
            },
            {
                path: "test2.html",
                name: "test2",
                component: TestComponent,
                meta: {permissions: 'all'}
            },
            {
                path: "test3.html",
                name: "test3",
                component: TestComponent,
                meta: {permissions: 'all'}
            },
            {
                path: "list-product-categories.html",
                name: "listProductCategories",
                component: ListProductCategories,
                meta: {permissions: constant.PERMISSION_PRODUCT_CATE_VIEW}
            },
            {
                path: "/not-found.html",
                name: "router-name.errors.notfound",
                component: ErrorComponent,
                meta: {
                    permissions: "all",
                    code: '404',
                    message: 'Oops! Page not found.'
                }
            }
        ],
    },
];


export default routes;
