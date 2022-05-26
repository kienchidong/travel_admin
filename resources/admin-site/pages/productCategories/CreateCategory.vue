<template>
    <div class="row">
        <modal-layout
            id="modal-create-catefory"
            v-model="showModal"
            :back-drop="false"
        >
            <template slot="modal_content">
                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ $t('account.admins.form.name') }}:
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       placeholder="Name"
                                       v-model="name"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ $t('account.admins.form.image') }}:
                            </label>
                            <div class="col-sm-10">
                                <upload-image-component v-model="image"/>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template slot="modal_footer">
                <button type="submit"
                        class="btn btn-primary"
                        v-on:click="onSubmit">
                    Submit
                </button>
                <button class="btn btn-danger"
                        v-on:click="showModal = !showModal">
                    Cancel
                </button>
            </template>
        </modal-layout>
    </div>
</template>

<script>
    import UploadImageComponent from "../../components/UploadImageComponent";
    import ModalLayout from "../../components/Modal/ModalLayout";

    export default {
        name: "CreateCategory",
        components: {ModalLayout, UploadImageComponent},
        data() {
            return {
                showModal: false,
                id: '',
                name: '',
                image: '',
                status: 1
            }
        },
        computed: {
            formData: function () {
                return {
                    id: this.id,
                    name: this.name,
                    image: this.image,
                    status: this.status
                }
            }
        },
        watch: {
            showModal: function (val) {
                if (val == false) {
                    this.resetData()
                }
            }
        },
        mounted() {
            GlobalEvent.listen('showModalCreateategory', (data) => {
                this.showModal = true;

                this.id = (data.id) ?? this.id;
                this.name = (data.name) ?? this.name;
                this.image = (data.image) ?? this.image;
                this.status = (data.status) ?? this.status;
            });

            GlobalEvent.listen('editCategory', (data) => {
                this.id = (data.id) ?? this.id;
                this.name = (data.name) ?? this.name;
                this.image = (data.image) ?? this.image;
                this.status = (data.status) ?? this.status;

                this.onSubmit();
            });
        },
        methods: {
            onSubmit() {
                GlobalEvent.fire('ShowLoading', {isLoading: true});
                this.$axios.post(this.laravelRoutes(this.$myConstant.CREATE_PRODUCT_CATE), this.formData).then(response => {
                    this.showModal = false;
                    GlobalEvent.fire('getListCate', {})
                }).catch(err => {
                    const {data} = err.response;
                    console.log(data)
                    if (typeof data.errors === 'object') {
                        $.each(data.errors, (key, value) => {
                            alertify.error(value);
                        });
                    } else {
                        alertify.error(data.message);
                    }
                }).then(() => {
                    GlobalEvent.fire('ShowLoading', {isLoading: false});
                })
            },
            resetData() {
                this.name = '';
                this.image = '';
            }
        }
    }
</script>

<style scoped>
    .form-horizontal .control-label {
        text-align: left;
    }
</style>
