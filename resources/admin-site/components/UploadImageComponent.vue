<template>
    <div>
        <div class="input-group">
            <input type="text" class="form-control"
                   v-if="enterLink"
                   v-model="image"

            >
            <input type="file"
                   v-else
                   class="form-control"
                   v-on:change="uploadImage"
            >
            <div class="input-group-addon">
                <button
                        class="btn btn-sm btn-outline-primary"
                        type="button"
                        @click="enterLink = !enterLink"
                >Enter Link
                </button>
            </div>
        </div>
        <img :src="imageShow" alt="" class="image-preview">
    </div>
</template>

<script>
    import MegaPixImage from '../js/lib/megapix-image';

    export default {
        name: "UploadImageComponent",
        props: {
            value: {
                type: String,
                default: ''
            },
            name: {
                type: String,
                default: ''
            },
            folder: {
                type: String,
                default: ''
            },
            autoRemove: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                image: '',
                oldImage: '',
                enterLink: false
            }
        },
        watch: {
            value: function (val) {
                this.image = val
            },
            image: function (val) {
                if (this.enterLink == true) {
                    this.$emit('input', val)
                }
            }
        },
        computed: {
            imageShow: function () {
                let url = '';

                try {
                    url = new URL(this.image);
                } catch (_) {
                    return this.image;
                }
                return (url.protocol === "http:" || url.protocol === "https:") ? this.image : this.clientLink + this.image;

            }
        },
        mounted() {
            this.image = this.value;
            GlobalEvent.listen('removeOldImage', () => {
                //this.removeImage();
            })
        },
        methods: {
            uploadImage(e) {
                if (this.enterLink != true) {
                    if (this.image != '') {
                        this.oldImage = this.image;
                        this.autoRemoveImage();
                    }
                    let files = e.target.files || e.dataTransfer.files;
                    let arrayType = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!arrayType.includes(files[0].type)) {
                        e.target.value = '';
                        alertify.error('ngu')
                    } else {
                        let reader = new FileReader();
                        reader.onload = (e) => {
                            var image = new Image();
                            image.src = e.target.result;
                            image.onload = () => {
                                var resized = this.resizeMe(image);
                                this.saveImage(resized)
                            }
                        }
                        reader.readAsDataURL(files[0]);
                    }
                }
            },
            resizeMe(img) {
                var max_width = 800;
                var max_height = 800;
                var width = img.width;
                var height = img.height;

                if (width > height) {
                    if (width > max_width) {
                        height = Math.round(height * max_width / width);
                        width = max_width;
                    }
                } else {
                    if (height > max_height) {
                        width = Math.round(width * max_height / height);
                        height = max_height;
                    }
                }

                var mpImg = new MegaPixImage(img);
                return mpImg.render({width: width, height: height, quality: 0.6});
            },
            saveImage(image) {
                const form = new FormData();
                form.append('image', image);
                form.append('folder', this.folder);
                form.append('name', this.name);
                //ActionEvent.fire('loading', {is_loading: true});
                this.$axios.post(this.laravelRoutes(this.$myConstant.UPLOAD_IMAGE), form).then(response => {
                    this.image = response.data.file;
                    this.$emit('input', this.image);
                }).finally(() => {
                    GlobalEvent.fire('loading', {is_loading: false});
                });
            },
            autoRemoveImage() {
                if (this.autoRemove == true) {
                    this.removeImage()
                }
            },
            removeImage() {
                this.$axios.post(this.laravelRoutes(this.$myConstant.REMOVE_IMAGE), {
                    link: this.oldImage
                }).then(response => {
                        this.$emit('input', '');
                }).finally(() => {
                    //ActionEvent.fire('loading', {is_loading: false});
                });
            }
        }
    }
</script>

<style scoped>
    .input-group-addon {
        padding: 0;
    }
    .image-preview{
        width: 100%;
    }
</style>