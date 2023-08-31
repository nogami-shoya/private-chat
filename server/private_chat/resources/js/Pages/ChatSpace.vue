<script setup>
    import Header from '@/Components/Header.vue';
    import Form from '@/Components/Form.vue';
    import { provide } from 'vue';

    // userIdとchannelIdを保存しておく
    provide('userId', props.userId);
    provide('channelId', props.channelId);
    provide('channelName', props.channelName);

    // コントローラーから値を受け取り用
    const props = defineProps({
        userId: {
            type: Number
        },
        channelId: {
            type: Number
        },
        channelName: {
            type: String
        }
    })
</script>

<template>
    <div id="chat-space">
        <Header />
        <Form/>
    </div>
</template>


