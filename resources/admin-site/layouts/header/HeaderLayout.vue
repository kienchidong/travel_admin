<template>
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="flag-icon" :class="languageList[language].icon "></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li
                                            v-for="(item, index) in languageList"
                                            :key="index"
                                    >
                                        <a
                                                href="javascript:void(0);"
                                                @click="changeLanguage(index)"
                                        >
                                            <i class="flag-icon" :class="item.icon"></i>
                                            {{ item.text}}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img :src="user.avatar" class="user-image" alt="User">
                            <span class="hidden-xs">{{ user.name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <!-- <li class="user-header">
                                 <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                 <p>
                                     {{ user.name }}
                                 </p>
                             </li>-->
                            <!-- Menu Body -->
                            <!--<li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>-->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <!-- <div class="pull-left">
                                     <a href="#" class="btn btn-default btn-flat">Profile</a>
                                 </div>-->
                                <div class="pull-right">
                                    <a :href="laravelRoutes($myConstant['ADMIN_LOGOUT'])"
                                       class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
</template>

<script>
    export default {
        name: "HeaderLayout",
        data() {
            return {
                language: this.$i18n.locale,
                languageList: {
                    vi: {
                        text: 'Tiếng Việt',
                        icon: 'flag-icon-vnm'
                    },
                    en: {
                        text: 'English',
                        icon: 'flag-icon-usa'
                    },
                },
            }
        },
        computed: {
            user() {
                return this.$store.getters.userInfo;
            }
        },
        methods: {
            changeLanguage(lang) {
                this.$i18n.locale = lang;
                this.language = lang;
                this.$axios.get(this.laravelRoutes(this.$myConstant.CHANGE_LANGUAGE, {language: lang}))
            }
        }
    }
</script>

<style scoped>

</style>