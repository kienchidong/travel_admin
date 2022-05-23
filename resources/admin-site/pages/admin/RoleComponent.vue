<template>
    <modal-layout
            id="roleModal"
            v-model="showModal"
            :back-drop="false"
            :title="$t('button.editRole')"
    >
        <template slot="modal_content">
            <div class="form-group">
                <div class="checkbox"
                     v-for="(itemPer, indexPer) in listPermission"
                     :key="indexPer"
                >
                    <label>
                        <input type="checkbox"
                               name="permission_id"
                               :value="itemPer.id"
                               v-model="permissions">
                        {{ $t(itemPer.name) }}
                    </label>
                </div>
            </div>
        </template>
        <template slot="modal_footer">
            <button type="button"
                    class="btn btn-default pull-left"
                    @click="showModal = false"
            >
                {{ $t('button.cancel') }}
            </button>
            <button
                    type="button"
                    class="btn btn-primary"
                    @click="setPermission"
            >
                {{ $t('button.save') }}
            </button>

        </template>
    </modal-layout>
</template>

<script>
    import ModalLayout from "../../components/Modal/ModalLayout";

    export default {
        name: "RoleComponent",
        components: {ModalLayout},
        data() {
            return {
                showModal: false,
                permissions: [],
                listPermission: [],
                user: []
            }
        },
        computed: {
            formData: function () {
                return {
                    id: this.user.id ?? 0,
                    permissions: this.permissions,
                }
            }
        },
        mounted() {
            GlobalEvent.listen('showRoleModal', data => {
                this.user = data.user ?? [];
                if (data.user != undefined) {
                    this.getPermissionList(data.user.role ?? '');
                    this.userHaspermission(data.user.id ?? 0);
                    this.showModal = true;
                }
            });
        },
        methods: {
            getPermissionList(role_id) {
                this.$axios.get(this.laravelRoutes(this.$myConstant.GET_LIST_PERMISSIONS), {
                    params: {
                        role: role_id
                    }
                }).then(response => {
                    //this.formData.permission_id = [],
                    this.listPermission = response.data;
                }).catch(error => {
                    console.log(error)
                })
            },
            userHaspermission(id) {
                this.$axios.get(this.laravelRoutes(this.$myConstant.ADMIN_HAS_PERMISSIONS), {
                    params: {
                        id: id
                    }
                }).then(response => {
                    //this.formData.permission_id = [],
                    this.permissions = response.data;
                }).catch(error => {
                    console.log(error)
                })
            },
            setPermission() {
                this.$axios.post(this.laravelRoutes(this.$myConstant.ADMIN_SET_PERMISSIONS), this.formData).then(response => {
                    console.log(response.data)
                    let {data} = response
                        if (data.isYour == true) {
                            let user = this.$store.getters.userInfo;
                            user.permission = data.permission
                            this.$store.dispatch('handleChangeUserInfo', user);
                            //alertify.success('Sửa Quyền user thành công')
                        }
                        this.showModal = false;

                }).catch(err => {
                    console.log(err.response);
                })
            }
        }
    }
</script>

<style scoped>

</style>