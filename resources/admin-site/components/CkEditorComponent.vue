<template>
    <div class="root">
        <textarea
            :id="id"
        >
        </textarea>
    </div>
</template>

<script>
    export default {
        name: "CkEditorComponent",
        props: {
            id: {
                type: String,
                required: true,
                default: ''
            },
            value: {
                type: String,
                default: '',
                editor: []
            },
            language: {
                type: String,
                default: 'en'
            },
            uiColor: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                content: 'aaaaa',
                setData: true,
                editor: [],
                lastEditorData: '',
            }
        },
        mounted() {
            if(this.id != ''){
                this.editor = CKEDITOR.replace(this.id, {
                    language: this.language,
                    uiColor: this.uiColor
                });
                CKFinder.setupCKEditor( this.editor );
                this.editor.setData(this.value);
                this.editor.on('change', (evt) => {
                    let content = evt.editor.getData();
                    this.lastEditorData = content;
                    this.$emit('input', content);
                });
            }
        },
        watch: {
            value: function (newValue, oldValue) {
                if ( newValue !== oldValue && newValue !== this.lastEditorData ) {
                    this.editor.setData( newValue );
                }
                //this.editor.setData(newValue);
            }
        },
        methods: {}
    }
</script>

<style scoped>

</style>
