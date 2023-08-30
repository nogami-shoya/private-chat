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
        let rightOrLeft = 'chatLeft';
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
                        rightOrLeft = 'chatRight';
                        userName = '';
                    }

                    messageHtml +=  `
                        <div class="${rightOrLeft} clearfix">
                            ${userName}
                            <div class="comments">
                                <div class="comment">
                                    ${element.message}
                                </div>
                                <div class="time-box">
                                    <span class="time">${dateFormat(element.created_at)}</span>
                                </div>
                            </div>
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
