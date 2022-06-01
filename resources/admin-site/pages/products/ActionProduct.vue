<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{ $t('button.addNew', {content: ''}) }}
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class=" clearfix">

                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                                            {{ $t('account.admins.form.name') }}:
                                        </label>
                                        <div class="col-sm-10">
                                            <select
                                                    class="form-control"
                                                    v-model="selectCate"
                                            >
                                                <option value=""
                                                        v-for="(item, index) in listCate"
                                                        :key="index"
                                                        :value="item.id"
                                                >
                                                    {{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{ $t('table.content') }}:
                                        </label>
                                        <div class="col-sm-10">
                                            <ck-editor-component id="product-describe" v-model="content"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{ $t('table.banner.image') }}:
                                        </label>
                                        <div class="col-sm-10">
                                            <upload-image-component
                                                    class-image="img--product-pv"
                                                    v-model="image"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="parent--hover">
                                {{ $t('form.imageDetail') }}:
                                <a href="javascript:void(0)"
                                   class="hover--hidden"
                                   @click="imageDetail.push('')"
                                >
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                </a>
                            </h4>
                            <div class="form-horizontal"
                                 v-for="(item, index) in imageDetail"
                                 :key="index"
                            >
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label parent--hover">
                                            {{ $t('table.banner.image') }} {{ index + 1 }}:
                                            <a href="javascript:void(0)"
                                               class="hover--hidden"
                                               @click="deleteImage(index)"
                                            >
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </label>
                                        <div class="">
                                            <upload-image-component
                                                    class-image="img--product-pv"
                                                    v-model="imageDetail[index]"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary" v-on:click="onSubmit">Submit</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import UploadImageComponent from "../../components/UploadImageComponent";
    import CkEditorComponent from "../../components/CkEditorComponent";

    export default {
        name: "ActionProduct",
        components: {CkEditorComponent, UploadImageComponent},
        data() {
            return {
                name: '',
                content: '',
                image: '',
                imageDetail: [],
                listCate: [],
                selectCate: ''
            }
        },

        computed: {
            formData: function () {
                return {
                    name: this.name,
                    content: this.content,
                    image: this.image,
                    imageDetail: JSON.stringify(this.imageDetail),
                    categoryId: this.selectCate,
                }
            }
        },
        watch: {},
        mounted() {
            this.getCate()
        },
        methods: {
            onSubmit() {
                this.$axios.post(this.laravelRoutes(this.$myConstant.CREATE_PRODUCT), this.formData).then(response => {
                    console.log(response)
                    alertify.success('thành công');
                    this.$router.push('list-product.html')
                    /* if(response.data.status == 200) {
                         //alertify.success('Create Admin Success');
                         //this.$router.push('/adminAccount');
                     } else if (response.data.status == 414) {
                         $.each(response.data.message, (key, value) => {
                             this.errors[key + 'Sate'] = false;
                             this.errors[key + 'Message'] = value[0];
                         });
                     } else {
                         alertify.error(data.message)
                     }*/
                }).catch(err => {

                    const {data} = err.response;
                    if (typeof data.errors === 'object') {
                        $.each(data.errors, (key, value) => {
                            alertify.error(value[0]);
                        });
                    } else {
                        alertify.error(data.message);
                    }
                })
            },
            getCate() {
                this.$axios.get(this.laravelRoutes(this.$myConstant.GET_LIST_PRODUCT_CATE), {params: {size: 100}}).then(response => {
                    let {data} = response;
                    this.listCate = data.lists;
                })
            },
            deleteImage(index) {
                this.imageDetail.splice(index, 1);
                alert('ok');
            }
        }
    }
</script>

<style scoped>

</style>