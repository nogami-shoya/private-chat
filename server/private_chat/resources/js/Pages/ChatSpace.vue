<script setup>
    import Header from '@/Components/Header.vue';
    import { router } from '@inertiajs/vue3';
    import { reactive } from 'vue';

    // コントローラーから値を受け取り用
    const props = defineProps({
        userInfo: {
            type: Array
        },
        userId: {
            type: Number
        },
        channelId: {
            type: Number
        }
    })

    // v-model用
    const form = reactive({
        message: null,
    });

    // post用
    const send = () => {
        router.post('/send/message', {
            message: form.message,
            userId: props.userId,
            channelId: props.channelId
        })
        form.message = '';
    }


    // console.log(props.userInfo);
</script>

<template>
    <div>
        <Header />
        <h1>{{ userInfo }}</h1>
        <h2>{{ userId }}</h2>
        <h2>{{ channelId }}</h2>
        <form @submit.prevent="send">
            <input id="channel_name" v-model="form.message" placeholder="Aa"/>
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>

</template>
