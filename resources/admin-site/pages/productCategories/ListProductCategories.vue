<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <!--<h3 class="box-title">Bordered Table</h3>-->
                        <a href="javascript:void(0)"
                           class="btn btn-primary"
                           @click="create"
                        >
                            {{ $t('button.addNew', {content: ''}) }}
                        </a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class=" clearfix" v-if="totalPage > 1">
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
                                <th v-for="(col) in table.columns">{{ $t(col) }}</th>
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
                                                @click="editCate(item)"
                                        >
                                            Edit
                                        </button>
                                    </div>

                                    <div class="input-group-prepend">
                                        <button type="button"
                                                class="btn btn-danger"
                                                @click="editCate(item, true)"
                                        >
                                            {{ (item.status == 1) ? 'Lock' : 'unLock' }}
                                        </button>
                                    </div>
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
                    <create-category/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PaginateComponent from "../../components/PaginateComponent";
    import CreateCategory from "./CreateCategory";

    const table_columns = ['table.#', 'account.admins.name', 'table.banner.redirect_url', 'table.banner.image', 'table.status', 'account.admins.action'];
    const table_index = ['#', 'name', 'slug', 'image', 'status'];

    export default {
        name: "ListProductCategories",
        components: {CreateCategory, PaginateComponent},
        data() {
            return {
                table: {
                    data: [],
                    columns: [...table_columns],
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
            this.getListCate();
            GlobalEvent.listen('getListCate', (data) => {
                this.getListCate();
            })
        },
        methods: {
            getListCate() {
                this.$axios.get(this.laravelRoutes(this.$myConstant.GET_LIST_PRODUCT_CATE), {params: this.formLoad}).then(response => {
                    let {data} = response;

                    this.table.data = data.lists;
                    this.totalPage = data.total_page;

                })
            },
            collumnItem(index, key) {
                let item = this.table.data[index];
                switch (key) {
                    case table_index[0]: {
                        return this.size * (this.currentPage - 1) + index + 1;
                    }
                    case table_index[4]: {
                        return (item[key] == 1) ? 'Actived' : 'Locked';
                    }
                    default: {
                        return item[key]
                    }
                }
            },
            create() {
                GlobalEvent.fire('showModalCreateategory', {})
            },
            editCate(item, lock = false) {
                if (lock == true) {
                    GlobalEvent.fire('editCategory', {
                        id: item.id,
                        name: item.name,
                        image: item.image,
                        status: (item.status == 1) ? 0 : 1
                    })
                } else {
                    GlobalEvent.fire('showModalCreateategory', {
                        id: item.id,
                        name: item.name,
                        image: item.image,
                        status: item.status
                    })
                }

            }
        }
    }
</script>

<style scoped>

</style>
