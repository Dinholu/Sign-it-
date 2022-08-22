<template>
    <div>
        bonjour
        {{this.hello}}
        <input type="file" name="" id="" accept="application/pdf,application/vnd.ms-excel">
    </div>
</template>
<script>
    export default {
        name: 'Hello',
        props: {
            hello: {
                type: String,
            }
        },
        mounted() {
            console.log(this.hello);
        }
    }
</script>
