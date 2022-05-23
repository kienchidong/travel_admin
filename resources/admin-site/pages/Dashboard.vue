<template>
   <div>
       {{ $t('gender.male')}}
       {{ $myConstant['ROUTE_TEST'] }}
   </div>
</template>

<script>
    export default {
        name: "Dashboard",
        mounted() {
            console.log(this.$myConstant['ROUTE_TEST'])
        }
    }
</script>

<style scoped>

</style>
