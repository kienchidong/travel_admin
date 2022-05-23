<template>
    <div class="wrapper">
        <header-layout/>

        <aside-layout/>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    {{ $te($route.name) ? $t($route.name) : $route.name }}
                </h1>
                <!--<ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>-->
            </section>

            <!-- Main content -->
            <section class="content">
                <router-view></router-view>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer-layout/>

        <control-sidebar/>
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
        <loading-component />
    </div>
</template>

<script>
    import HeaderLayout from "./header/HeaderLayout";
    import AsideLayout from "./aside/AsideLayout";
    import FooterLayout from "./footer/FooterLayout";
    import ControlSidebar from "./aside/ControlSidebar";
    import LoadingComponent from "../components/LoadingComponent";

    export default {
        name: "MasterLayout",
        components: {LoadingComponent, ControlSidebar, FooterLayout, AsideLayout, HeaderLayout}
    }
</script>

<style scoped>

</style>