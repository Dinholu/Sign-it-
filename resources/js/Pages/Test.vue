<template>
    <button @click="toggleBigger">
        <transition name="expand" mode="out-in">
            <div class="default" v-bind:class="{ bigger: showButton }" key="small"> B </div>

            <!--<input-div><</input-div>-->
        </transition>
    </button>
</template>
<script>
import { ref } from 'vue'

export default {
    data() {
        return {
            showButton: false
        }
    },

    methods: {
        toggleBigger() {
            this.showButton = !this.showButton;
        }
    }
}
</script>
<style scoped>
.default {
    transition: max-height 0.25s ease-out;
    width: 20px;
    transition-property: width;
}

.bigger {
    transition: max-height 0.25s ease-out;
    width: 200px;
    transition-duration: 5s;
    transition-property: width;
}
</style>
