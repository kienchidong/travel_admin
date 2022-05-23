<template>
    <div>
        <div v-if="content != ''" class="tool-json">
            <button
                    class="btn btn-sm btn-default"
                    @click="beautyContent(4)"
                    title="Format JSON data, with proper indentation and line feeds"
            >
                <i class="fa fa-indent" aria-hidden="true"></i>
            </button>
            <button
                    class="btn btn-sm btn-default"
                    @click="beautyContent(0)"
                    title="Compact JSON data, remove all whitespaces"
            >
                <i class="fa fa-list" aria-hidden="true"></i>
            </button>
            <small class="text-danger">{{ invaidJson }}</small>
        </div>
        <textarea
                class="form-control"
                :class="classTextArea"
                :rows="numberLine"
                placeholder="{}"
                v-model="content"
        ></textarea>

    </div>
</template>

<script>
    export default {
        name: "InputJson",
        props: {
            numberLine: {
                default: 3
            },
            classTextArea: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                content: '',
                invaidJson: '',
            }
        },
        watch: {
            value: function (val) {
                this.content = val;
            },
            content: function (val) {
                this.$emit('input', val)
            }
        },
        methods: {
            beautyContent(number = 4) {
                try {
                    var obj = JSON.parse(this.content);
                    var pretty = JSON.stringify(obj, undefined, number);
                    this.content = pretty;
                    this.invaidJson = '';
                } catch (e) {
                    this.invaidJson = 'incorrect format of json!';
                }
            }
        }
    }
</script>

<style scoped>
    .tool-json {
        border-radius: 5px 5px 0 0;
        border: #d2d6de solid 1px;
        border-bottom: 0;
        padding: 1px 10px;
        background-color: #ffffff;
    }
</style>