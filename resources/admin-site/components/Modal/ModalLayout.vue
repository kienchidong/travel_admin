<template>
    <div class="modal fade"
         :id="id"
         tabindex="-1"
         role="dialog"
         :data-backdrop="(backDrop == true) ? true : 'static'"
         aria-hidden="true">
        <div class="modal-dialog"
             role="document">
            <div class="modal-content">
                <div class="modal-header" v-if="showHeader">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body" :class="classContent">
                    <slot name="modal_content"></slot>
                </div>
                <div class="modal-footer" v-if="showFooter">
                    <slot v-if="$slots.modal_footer != undefined" name="modal_footer"></slot>
                    <button v-else
                            type="button"
                            class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>
                    <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalLayout",
        props: {
            id: {
                type: String,
                required: true
            },
            value: {
                type: Boolean,
                default: false
            },
            backDrop: {
                type: Boolean,
                default: true
            },
            linkRedirect: {
                type: String,
                default: '#'
            },
            showHeader: {
                type: Boolean,
                default: true
            },
            title: {
                type: String,
                default: 'Modal Header'
            },
            showFooter: {
                type: Boolean,
                default: true
            },
            classContent: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                openModal: false
            }
        },
        watch: {
            value: function (val) {
                this.openModal = val;
            },
            openModal: function (val) {
                if (val == true) {
                    $(`#${this.id}`).modal();
                } else {
                    $(`#${this.id}`).modal('hide');
                }
            }
        },
        mounted() {
            $(document).ready(() => {
                $(`#${this.id}`).on('hidden.bs.modal', () => {
                    this.$emit('input', false);
                    if (this.linkRedirect == '#') {
                        window.location.href = this.linkRedirect;
                    }
                });
            });
        },
        methods: {
            click() {
                $(`#${this.id}`).modal();
            }
        }
    }
</script>

<style scoped>

</style>