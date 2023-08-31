<script setup>
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const form = reactive({
    channel_name: null,
    user_name: null
});

const send = () => {
    router.post('/create', {
        channel_name: form.channel_name,
        user_name: form.user_name,
        url: crypto.randomUUID(),
    })
}
</script>


<template>
    <form @submit.prevent="submit">
        <label for="channel_name">チャンネル名称：</label>
        <input id="channel_name" v-model="form.channel_name" placeholder="チャンネル"/>
        <label for="user_name">ユーザー名称：</label>
        <input id="user_name" v-model="form.user_name" placeholder="ゲスト"/>
        <button v-on:click="send" class="btn btn-primary">チャンネルを作成</button>
    </form>
  </template>
