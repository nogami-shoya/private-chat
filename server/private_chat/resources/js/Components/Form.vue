<script setup>
    import MessageList from '@/Components/MessageList.vue';
    import { inject, ref, reactive } from 'vue';

    // userIdとchannelIdのの取得
    const userId = inject('userId');
    const channelId = inject('channelId');

    // 子コンポーネントメソッド呼び出し用
    const messageList = ref();

    // form用
    const form = reactive({
        message: null,
    });

    // メッセージ送信
    const sendMessage = () => {
        const data = new FormData();
        data.append('message', form.message);
        data.append('userId', userId);
        data.append('channelId', channelId);

        axios.post('/send/message', data)
            .then(() => {
                form.message = "";
                // 送信時非同期でメッセージ一覧を取得
                messageList.value.getMessage();
            })
            .catch(err => {
                if(err.response) {
                    console.log(err);
                }
            });
    }
</script>


<template>
    <div id="message-send">
        <MessageList ref="messageList"/>
        <form @submit.prevent="send" id="form">
            <textarea id="message-form" rows="1" v-model="form.message" placeholder="Aa"></textarea>
            <button class="btn btn-primary" type="button" v-on:click="sendMessage">>></button>
        </form>
    </div>
</template>
