<!--  Single-File Components (SFCs). -->

<script setup>
    // declare reactive state
    import { ref, reactive, onMounted } from 'vue'

    const count = ref(0) // object value, used for primitives
    
    // JS Proxies reactive object
    // proxy !== raw, reactive(raw) === proxy
    const state = reactive({ count: 0 }) 

    async function increment() {
        count.value++
        state.count++
        await nextTick() // nextTick() global API
        // Now the DOM is updated
    }
</script>

<script>
    export default {
        data() {
            return {
                //count: 0
            }
        }
    }
</script>

<template>
    <button @click="increment">
        Sfc Count is: {{ count }}
    </button>
</template>

<style scoped>
    button {
        font-weight: bold;
    }
</style>