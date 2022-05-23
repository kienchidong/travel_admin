<template>

            <ul class="pagination"
            :class="classPaginate"
            >
                <li class="page-item">
                    <a
                        class="page-link"
                        href="javascript:void(0)"
                        @click="selectPage(currentPage - 1)"
                    >
                        &laquo;
                    </a>
                </li>
                <li
                    v-for="(page, index) in listPage"
                    class="page-item"
                    :class="currentPage == page ? 'active' : ''"
                    :key="index"
                >
                    <a
                        class="page-link"
                        href="javascript:void(0)"
                        @click="selectPage(page)"
                    >{{ page }}</a>

                </li>
                <li class="page-item">
                    <a
                        class="page-link"
                        href="javascript:void(0)"
                        @click="selectPage(currentPage + 1)"
                    >&raquo;</a>
                </li>
            </ul>
</template>

<script>
    export default {
        name: "PaginateComponent",
        props: {
            totalPage: {
                type: Number,
                default: 1
            },
            value: {
                default: 1
            },
            classPaginate: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                currentPage: 1,

            }
        },
        mounted() {
            this.changeListPage();
        },
        watch: {
            totalPage: function () {
                this.changeListPage();
            },
            value: function (val) {
                this.currentPage = val;
            },
            currentPage: function (val) {
                this.$emit('input', val)
                this.$emit('handler')
            }
        },
        computed: {
            listPage: function () {
                let list = [];
                switch (this.totalPage) {
                    case 2:
                    case 3:
                        list[1] = 1;
                        list[2] = 2;
                        if (this.totalPage == 3) {
                            list[3] = 3;
                        }
                        break;
                    default:
                        list[1] = 1;
                        list[2] = 2;
                        if (this.totalPage > 3) {
                            list[this.totalPage - 1] = '...';
                        }
                        list[this.totalPage] = this.totalPage;
                }

                if (Object.values(list).includes(this.currentPage)) {
                    if (this.currentPage == this.totalPage) {
                        if (this.currentPage > 2) {
                            list[this.totalPage - 2] = (list[this.totalPage - 2] != undefined) ? list[this.totalPage - 2] : '...';
                        }
                        list[this.totalPage - 1] = this.totalPage - 1;
                    } else if (this.currentPage == 2) {
                        list[3] = 3
                    }
                } else if (this.currentPage < this.totalPage - 1) {
                    list[this.currentPage - 2] = (list[this.currentPage - 2] != undefined) ? list[this.currentPage - 2] : '...';
                    list[this.currentPage - 1] = this.currentPage - 1;
                    list[this.currentPage] = this.currentPage;
                    list[this.currentPage + 1] = this.currentPage + 1;

                } else {
                    list[this.currentPage - 2] = (list[this.currentPage - 2] != undefined) ? list[this.currentPage - 2] : '...';
                    list[this.currentPage - 1] = this.currentPage - 1;
                    list[this.currentPage] = this.currentPage;
                }

                return Object.values(list);
            }
        },
        methods: {
            selectPage(page) {
                if (page >= 1 && page <= this.totalPage) {
                    this.currentPage = page;
                }
            },
            changeListPage() {

            }
        }
    }
</script>

<style scoped>

</style>
