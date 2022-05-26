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
                <!--  <li class="active treeview">
                      <a href="#">
                          <i class="fa fa-dashboard"></i>
                          <span>
                              Dashboard
                          </span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                          <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-files-o"></i>
                          <span>Layout Options</span>
                          <span class="label label-primary pull-right">4</span>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                          <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                          <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                          <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed
                              Sidebar</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-pie-chart"></i>
                          <span>Charts</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                          <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                          <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                          <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-laptop"></i>
                          <span>UI Elements</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                          <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                          <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                          <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                          <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                          <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-edit"></i> <span>Forms</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                          <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a>
                          </li>
                          <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-table"></i> <span>Tables</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                          <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-folder"></i> <span>Examples</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                          <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                          <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                          <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                          <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                          <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                          <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                          <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-share"></i> <span>Multilevel</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                          <li>
                              <a href="#"><i class="fa fa-circle-o"></i> Level One <i
                                      class="fa fa-angle-left pull-right"></i></a>
                              <ul class="treeview-menu">
                                  <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                  <li>
                                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i
                                              class="fa fa-angle-left pull-right"></i></a>
                                      <ul class="treeview-menu">
                                          <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                          <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                          <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                      </ul>
                  </li>-->
                <!-- <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                 <li class="header">LABELS</li>
                 <li>
                     <a href="#">
                         <i class="fa fa-circle-o text-red"></i>
                         <span>
                         Important
                     </span>
                     </a>
                 </li>
                 <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                 <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
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
                                icon: 'fa-spinner',
                                link: '/list-product-categories.html',
                                text: 'router-name.product-cate.list',
                                permission: this.$myConstant.PERMISSION_PRODUCT_CATE_VIEW,
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
