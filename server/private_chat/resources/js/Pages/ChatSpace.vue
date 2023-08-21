<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            userMessages: Array
        }
    })
</script>
<template>
    <h1>{{ userMessages }}</h1>
</template>
