<template>
    <div>
        {{ $route.name }}

        <button @click="showModal = !showModal">click2</button>
        <modal-layout
                id="modal-test"
                v-model="showModal"
                :back-drop="true"
        >
            <template slot="modal_content">
                modal
            </template>
        </modal-layout>

       <input-json number-line="10"
       v-model="content"
       />
        {{content}}
    </div>
</template>

<script>
    import ModalLayout from "../components/Modal/ModalLayout";
    import CkEditorComponent from "../components/CkEditorComponent";
    import InputJson from "../components/input/InputJson";

    export default {
        name: "TestComponent",
        components: {InputJson, CkEditorComponent, ModalLayout},
        data() {
            return {
                showModal: false,
                content: '',
            }
        },
        mounted() {

        }

    }
</script>

<style scoped>

</style>