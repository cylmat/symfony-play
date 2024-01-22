
<script>
    export default {
        date() {
            return {
                count: 0
            }
        }
    }
</script>

<template>
    <time :title="toTitleDate()" :datetime="date">
       {{ formatDate(date)}} 
    </time>
</template>

<style scoped>
    button {
        font-weight: bold;
    }
</style>