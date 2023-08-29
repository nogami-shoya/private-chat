<script setup>
    import Header from '@/Components/Header.vue';
    import { reactive } from 'vue';

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

    // form用
    const form = reactive({
        message: null,
    });

    // メッセージ取得
    const getMessage = () => {
        let url = location.pathname;
        url = url.replace('/chat-space/', '')
        axios.post('/get/messages', {'url': url})
            .then((response) => {
                console.log(response);
            })
            .catch(err => {
                if(err.response) {
                console.log(err);
                }
            });
    }

    // メッセージ送信
    const sendMessage = () => {
        console.log('test');
        const params = new URLSearchParams();
        params.append('message', form.message);
        params.append("userId", props.userId);
        params.append("channelId", props.channelId);

        axios.post('/send/message', params, {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }})
            .then(() => {
                form.message = "";
                getMessage();
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
        <Header />
        <h1>{{ userMessages }}</h1>
        <h2>{{ userId }}</h2>
        <h2>{{ channelId }}</h2>
        <form @submit.prevent="send">
            <input id="channel_name" v-model="form.message" placeholder="Aa"/>
            <button type="button" v-on:click="sendMessage" class="btn btn-primary">送信</button>
        </form>
        <button type="button" v-on:click="getMessage">testbutton</button>
    </div>
</template>


