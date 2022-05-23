<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <!--<h3 class="box-title">Bordered Table</h3>-->
                        <router-link to="admin-create.html"
                                     class="btn btn-primary"

                        >
                            {{ $t('button.addNew', {content: 'Admin'}) }}
                        </router-link>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class=" clearfix" v-if="totalPage > 1">
                            <!-- <ul class="pagination pagination-sm no-margin">
                                 <li><a href="#">&laquo;</a></li>
                                 <li><a href="#">1</a></li>
                                 <li><a href="#">2</a></li>
                                 <li><a href="#">3</a></li>
                                 <li><a href="#">&raquo;</a></li>
                             </ul>-->
                            <paginate-component
                                    :total-page="totalPage"
                                    v-model="currentPage"
                                    class-paginate="pagination-sm no-margin"
                                    @handler="getListAdmin"
                            />

                        </div>
                        <hr>
                        <table class="table table-dark table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th v-for="(col) in table.collumns">{{ $t(col) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in table.data">
                                <slot v-for="(columnIndex, indexColumn) in table.index">
                                    <td :key="indexColumn" v-html="collumnItem(index, columnIndex)"></td>
                                </slot>
                                <td>
                                    <div class="input-group-prepend">
                                        <button type="button"
                                                class="btn btn-info"
                                                @click="editPermission(item)"
                                        >
                                            Edit Role
                                        </button>
                                    </div>
                                    <!--<b-dropdown split
                                                 split-variant="outline-primary"
                                                 variant="primary" id="dropdown-1" size="sm" text="Actions"
                                                 class="m-md-2">
                                         <b-dropdown-item-button
                                         v-on:click="chooseRole(item.id)">
                                         <i class="fa fa-edit"></i>Edit
                                     </b-dropdown-item-button>
                                         <b-dropdown-item-button >
                                             <role-components :users="item"></role-components>
                                         </b-dropdown-item-button>
                                     </b-dropdown>-->
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="thead-dark">
                            <tr>
                                <th v-for="(col) in table.collumns">{{ $t(col) }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <role-component/>
    </div>
</template>

<script>
    import RoleComponent from "./RoleComponent";
    import PaginateComponent from "../../components/PaginateComponent";

    const table_collumns = ['account.admins.#', 'account.admins.name', 'account.admins.email', 'account.admins.role', 'account.admins.action'];
    const table_index = ['#', 'name', 'email', 'role'];
    export default {
        name: "ListAdminsComponent",
        components: {PaginateComponent, RoleComponent},
        data() {
            return {
                table: {
                    data: [],
                    collumns: [...table_collumns],
                    index: [...table_index],
                },
                size: 10,
                totalPage: 0,
                currentPage: 1,
            }
        },
        computed: {
            formLoad: function () {
                return {
                    size: this.size,
                    page: this.currentPage,
                }
            }
        },
        mounted() {
            this.getListAdmin();
        },
        methods: {
            getListAdmin() {
                this.$axios.get(this.laravelRoutes(this.$myConstant.GET_LIST_ADMIN), {params: this.formLoad}).then(response => {
                    let {data} = response;

                    this.table.data = data.lists;
                    this.totalPage = data.total_page;
                  
                })
            },
            collumnItem(index, key) {
                switch (key) {
                    case table_index[0]: {
                        return this.size * (this.currentPage - 1) + index + 1;
                    }
                    case table_index[3]: {
                        return this.$t(this.table.data[index][key]);
                    }
                    default: {
                        return this.table.data[index][key]
                    }
                }
            },
            editPermission(item) {
                GlobalEvent.fire('showRoleModal', {user: item});
            }
        }
    }
</script>

<style scoped>

</style>