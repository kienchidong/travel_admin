<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{ $t('button.addNew', {content: 'Admin'}) }}
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class=" clearfix">

                    </div>
                    <div class="row">
                        <div class="col-md-8">
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
                                            {{ $t('account.admins.form.email') }}:
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="email"
                                                   class="form-control"
                                                   placeholder="Email"
                                                   v-model="email"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{ $t('account.admins.form.password') }}:
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="password"
                                                   class="form-control"
                                                   placeholder="Password"
                                                   v-model="password"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{ $t('account.admins.form.repassword') }}:
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="password"
                                                   class="form-control"
                                                   placeholder="Confirm Password"
                                                   v-model="repassword"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            {{ $t('account.admins.form.image') }}:
                                        </label>
                                        <div class="col-sm-10">
                                          <upload-image-component v-model="avatar"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ $t('account.admins.role') }}:</label>
                                <select class="form-control" v-model="role_id">
                                    <option :value="null">Please select an option</option>
                                    <option v-for="(item, indexRole) in roles"
                                            :key="indexRole"
                                            :value="item.id">
                                        {{ $t(item.name)}}
                                    </option>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="checkbox"
                                     v-for="(itemPer, indexPer) in permission"
                                     :key="indexPer"
                                >
                                    <label>
                                        <input type="checkbox"
                                               name="permission_id"
                                               :value="itemPer.id"
                                               v-model="permission_id">
                                        {{ $t(itemPer.name) }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-primary" v-on:click="onSubmit">Submit</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    import UploadImageComponent from "../../components/UploadImageComponent";
    export default {
        name: "CreateAdmin",
        components: {UploadImageComponent},
        data() {
            return {
                name: null,
                email: null,
                password: null,
                repassword: null,
                roles: [],
                role_id: null,
                permission: [],
                permission_id: [],
                avatar: ''
            }
        },
        computed: {
          formData: function () {
              return {
                  name: this.name,
                  email: this.email,
                  password: this.password,
                  repassword: this.repassword,
                  avatar: this.avatar,
                  role_id: this.role_id,
                  permission_id: this.permission_id,
              }
          }
        },
        watch: {
            role_id: function (val) {
                //this.errors.role_idSate = null;
                this.getPermissionList(val);
            },
        },
        mounted() {
            this.getListRole();
        },
        methods: {
            getListRole() {
                this.$axios.get(this.laravelRoutes(this.$myConstant.GET_LIST_ROLES)).then(response => {
                    this.roles = response.data;
                })
            },
            getPermissionList(role_id) {
                this.$axios.get(this.laravelRoutes(this.$myConstant.GET_LIST_PERMISSIONS), {
                    params: {
                        role: role_id
                    }
                }).then(response => {
                    //this.formData.permission_id = [],
                    this.permission = response.data;
                }).catch(error => {
                    console.log(error)
                })
            },
            onSubmit() {
                this.$axios.post(this.laravelRoutes(this.$myConstant.CREATE_ADMIN), this.formData).then(response => {
                    console.log(response)
                    this.$router.push('admin-list.html')
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

                    console.log(err)
                    const {data} = err.response;
                    if (typeof data.errors === 'object') {
                        $.each(data.errors, (key, value) => {
                            this.errors[key + 'Sate'] = false;
                            this.errors[key + 'Message'] = value[0];
                        });
                    } else {
                        alert(data.message);
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .form-horizontal .control-label {
        text-align: left;
    }
</style>