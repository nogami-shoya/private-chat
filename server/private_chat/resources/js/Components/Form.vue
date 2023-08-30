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
    <div>
        <MessageList ref="messageList"/>
        <form @submit.prevent="send">
            <input id="channel_name" v-model="form.message" placeholder="Aa"/>
            <button type="button" v-on:click="sendMessage" class="btn btn-primary">送信</button>
        </form>
    </div>
</template>
