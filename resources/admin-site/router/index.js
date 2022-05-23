import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";


Vue.use(VueRouter);


const whiteList = [
    '/not-authorized.html',
    '/not-found.html',
];
// configure router
const router = new VueRouter({
    base: '/admin/',
    mode: 'history',
    routes,
});

router.beforeEach(async (to, from, next) => {
    if (to.name === null) {
        return next('/not-found.html');
    }
    /*var permission = JSON.parse(localStorage.getItem('permission'));
    if (whiteList.indexOf(to.path) !== -1) {
        // in the free login whitelist, go directly
        return next();
    }
    if(to.meta.permissions != 'all' && permission != null && permission.includes(to.meta.permissions) == false){
        return next('/not-authorized.html');
    }*/

    /*if (to.name === null) {
        return next('/404');
    }*/
    return next();
    //return next(`/login`);
});

export default router;
