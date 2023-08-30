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
        <Form
            v-bind:userId="userId"
            v-bind:channelId="channelId"
        />
    </div>
</template>


