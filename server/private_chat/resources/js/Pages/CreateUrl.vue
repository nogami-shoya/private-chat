
<script setup>
import { Link, router } from '@inertiajs/vue3'

const createUrl = () => {
    router.post('/create-url', {
        url: crypto.randomUUID()
    })
}
</script>

<template>
    <button type="button" class="btn btn-primary" @click="createUrl">URLを作成</button>
</template>
