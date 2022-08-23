<template>
    <div>
        bonjour
        <form @submit.prevent="submit">
        <input type="file" name="" id="file" @change="FileUpload" accept="application/pdf,application/vnd.ms-excel">
        <button>upload</button>
        </form>
    </div>
</template>
<script>
import {Inertia} from '@inertiajs/inertia'
    export default {
        name: 'Hello',
        props: {
        },
        data(){
            return {
                form : this.$inertia.form({
                    file : null
                })
            }
        },
        mounted() {

        },
        methods: {
            FileUpload(e) {
                this.form.file = e.target.files[0];

                console.log(this.form.file);
            },
            submit() {
                this.form.post("/hello")
            }

        }
    }
</script>
