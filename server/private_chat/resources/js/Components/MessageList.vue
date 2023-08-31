<script setup>
    import axios from 'axios';
    import { inject } from 'vue';

    const userId = inject('userId');

    window.onload = function() {
        getMessage()
    }

    // 時刻のみを取得する
    const dateFormat = (createdDate) => {
        let date = new Date(createdDate);
        date = date.toLocaleTimeString()
        return date.slice(0, 5);
    }

    // メッセージ取得しhtml要素として反映
    const getMessage = () => {
        const message = document.getElementById('message');
        let messageHtml = '';
        let rightOrLeft = 'left';
        let url = location.pathname;
        url = url.replace('/chat-space/', '')
        axios.post('/get/messages', {'url': url})
            .then((response) => {
                response.data.forEach(element => {
                    let userName = `
                        <p class="user-name">
                            ${element.user.user_name}
                        </p>
                    `
                    // 自身のメッセージ判別
                    if(userId === element.user_id) {
                        rightOrLeft = 'right';
                        userName = '';
                    }

                    messageHtml +=  `
                        <div class="speech-bubble">
                            <div class="user-name">${userName}</div>
                            <div class="sb-bubble sb-line2 sb-${rightOrLeft}">
                                <p>${element.message}</p>
                            </div>
                            <span class="${rightOrLeft}time">${dateFormat(element.created_at)}</span>
                        </div>



                    `
                });
                message.innerHTML = messageHtml;
                message.scrollTo(0, message.scrollHeight);
            })
            .catch(err => {
                if(err.response) {
                console.log(err);
                }
            });
    }
    defineExpose({ getMessage });
    // fedege
</script>

<template>
    <div id="message">
        <!-- メッセージ反映 -->
    </div>
</template>
