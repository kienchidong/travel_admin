<template>
    <div>
        isloading
    </div>
</template>

<script>
    export default {
        name: "LoadingExample",
        mounted() {
            setTimeout(() => {
                GlobalEvent.fire('ShowLoading', {isLoading: true});
            }, 2000);

            setTimeout(() => {
                GlobalEvent.fire('ShowLoading', {isLoading: false});
            }, 10000);

        }
    }
</script>

<style scoped>

</style>