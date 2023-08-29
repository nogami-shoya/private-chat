<script setup>
    import Header from '@/Components/Header.vue';
    import Form from '@/Components/Form.vue';

    // コントローラーから値を受け取り用
    const props = defineProps({
        userMessages: {
            type: Array
        },
        userId: {
            type: Number
        },
        channelId: {
            type: Number
        }
    })
</script>

<template>
    <div>
        <Header />
        <h1>{{ userMessages }}</h1>
        <h2>{{ userId }}</h2>
        <h2>{{ channelId }}</h2>
        <Form
            v-bind:userId="userId"
            v-bind:channelId="channelId"
        />
    </div>
</template>


