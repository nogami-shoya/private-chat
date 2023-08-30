<script setup>
    import axios from 'axios';
    import { inject } from 'vue';

    const userId = inject('userId');

    window.onload = function() {
        getMessage()
    }

    // メッセージ取得しhtml要素として反映
    const getMessage = () => {
        let messageHtml = '';
        let url = location.pathname;
        url = url.replace('/chat-space/', '')
        axios.post('/get/messages', {'url': url})
            .then((response) => {
                console.log(userId);
                response.data.forEach(element => {
                    console.log(element);
                    messageHtml +=  `
                        <div class="c-talk__fukidashi c-talk__fukidashi--left">
                            <div class="c-talk__icon">
                                ${element.created_at}
                            </div>
                            <div class="c-talk__text messages">
                                <p>${element.message}</p>
                            </div>
                        </div>
                    `
                });
                document.getElementById('message').innerHTML = messageHtml;
            })
            .catch(err => {
                if(err.response) {
                console.log(err);
                }
            });
    }
    defineExpose({ getMessage });
</script>

<template>
    <div id="message" class="c-talk__body">
        <!-- メッセージ反映 -->
    </div>
</template>
