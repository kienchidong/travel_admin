<template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img :src="user.avatar" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ user.name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <!-- <form action="#" method="get" class="sidebar-form">
                 <div class="input-group">
                     <input type="text" name="q" class="form-control" placeholder="Search...">
                     <span class="input-group-btn">
             <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
           </span>
                 </div>
             </form>-->
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview"
                    v-for="(item, index) in listRoutes"
                    :key="index"
                    :class="{active: $route.path == item.link}"
                    v-if="item.permission == 'all' || userHasPermission(item.permission)"
                >
                    <a
                            href="javascript:void(0)"
                            v-if="item.listChildren"
                    >
                        <i class="fa" :class="item.icon"></i>
                        <span>
                            {{ $te(item.text) ? $t(item.text) : item.text }}
                        </span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <router-link
                            v-else
                            :to="item.link"
                    >
                        <i class="fa" :class="item.icon"></i>
                        <span>
                            {{ $te(item.text) ? $t(item.text) : item.text }}
                        </span>
                    </router-link>
                    <ul
                            class="treeview-menu"
                            v-if="item.listChildren"
                    >
                        <li
                                v-for="(value, indexChildren) in item.listChildren"
                                :key="indexChildren"
                                :class="{active: $route.path == value.link}"
                                v-if="value.permission == 'all' || userHasPermission(value.permission)"
                        >
                            <router-link
                                    :to="value.link"
                            >
                                <i class="fa" :class="value.icon"></i>
                                <span>
                                    {{ $te(value.text) ? $t(value.text) : value.text }}
                                </span>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    export default {
        name: "AsideLayout",
        data() {
            return {
                listRoutes: [
                    {
                        icon: 'fa-dashboard',
                        link: '/dashboard',
                        text: 'Dashboard',
                        permission: 'all',
                    }, {
                        icon: 'fa-users',
                        link: '/admin-list.html',
                        text: 'router-name.adminlist',
                        permission: this.$myConstant.PERMISSION_ACCOUNT_VIEW,
                    }, {
                        icon: 'fa-files-o',
                        link: '#',
                        text: 'Example',
                        permission: 'all',
                        listChildren: [
                            {
                                icon: 'fa-spinner',
                                link: '/example-loading.html',
                                text: 'Loading',
                                permission: 'all',
                            }, {
                                icon: 'fa-users',
                                link: '/test2.html',
                                text: 'Test2',
                                permission: 'all',
                            }, {
                                icon: 'fa-users',
                                link: '/test3.html',
                                text: 'Test3',
                                permission: 'all',
                            },
                        ]
                    },{
                        icon: 'fa-files-o',
                        link: '#',
                        text: 'Product',
                        permission: 'all',
                        listChildren: [
                            {
                                icon: 'fa-list-alt',
                                link: '/list-product-categories.html',
                                text: 'router-name.product-cate.list',
                                permission: this.$myConstant.PERMISSION_PRODUCT_CATE_VIEW,
                            },{
                                icon: 'fa-list-alt',
                                link: '/list-product.html',
                                text: 'router-name.product.list',
                                permission: this.$myConstant.PERMISSION_PRODUCT_VIEW,
                            }
                        ]
                    },
                ]
            }
        },
        computed: {
            user: function () {
                return this.$store.getters.userInfo;
            }
        },
        watch: {},
        mounted() {
        },
        methods: {}
    }
</script>

<style scoped>

</style>
