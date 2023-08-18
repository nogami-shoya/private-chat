<script setup>
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const form = reactive({
    channel_name: null,
});

const submit = () => {
    router.post('/create', {
        channel_name: form.channel_name,
        url: crypto.randomUUID(),
    })
}
</script>



<template>
    <form @submit.prevent="submit">
            <input id="channel_name" v-model="form.channel_name" placeholder="チャンネル名を入力（空でも可）"/>
            <button type="submit" class="btn btn-primary">チャンネルを作成</button>
        </form>
  </template>
