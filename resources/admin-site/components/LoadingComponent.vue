<template>
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="wrap_loading">
            <div class="modal-body">
                <img :src="clientLink + '/images/loading.gif'" alt="">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LoadingComponent",
        data() {
            return {}
        },
        mounted() {
            GlobalEvent.listen('ShowLoading', data => {
                if (data.isLoading == true) {
                    $('#loadingModal').modal();
                } else {
                    $('#loadingModal').modal('hide');
                }
            });
        }
    }
</script>

<style scoped>
    .wrap_loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        max-width: unset;
        max-height: unset;
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .wrap_loading img {
        width: 14%;
    }
</style>