<script setup>
    import Header from '@/Components/Header.vue';
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
    <div id="home">
        <Header>
            <!-- TODO:ロゴと左寄せ -->
            private-chat
        </Header>
        <div class="container d-flex align-items-center">
            <div class="row">
                <div class="col-5 d-flex flex-column">
                    <div class="flex-fill border-bottom">
                        <h2>会員登録不要なチャットサービス</h2>
                        作成から簡単にチャット画面を作成でき、URLを共有された方がチャットに入室できます<br>
                        作成後URLを共有からURLの共有が行えます
                    </div>
                    <!-- チャンネル作成 -->
                    <form class="flex-fill border-bottom" id="create-channel-form" @submit.prevent="submit">
                        <div id="form">
                            <input class="form-input" id="channel_name" v-model="form.channel_name" placeholder="チャンネル名"/>
                            <input class="form-input" id="user_name" v-model="form.user_name" placeholder="ユーザー名称"/>
                            <button id="create-channel-btn" v-on:click="send" class="btn btn-primary">作成</button>
                        </div>
                    </form>
                    <div class="flex-fill" id="explanation">
                        チャンネル名称を空で参加した場合：参加しているメンバー名の一覧になります。<br>
                        ユーザー名称を空で作成した場合：初期値はゲストとなります。
                    </div>
                </div>

                <!-- 画像部分 -->
                <div class="col-7">
                    <img :src="'/images/chat3.jpeg'" alt="" class="c-img">
                </div>
            </div>
        </div>
    </div>
  </template>
