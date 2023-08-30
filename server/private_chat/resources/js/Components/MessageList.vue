<script setup>
    import axios from 'axios';

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
                response.data.forEach(element => {
                    messageHtml +=  `
                        <div class="messages">
                            ${element.created_at}<br>
                            ${element.message}<br>
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
    <div id="message">
        <!-- メッセージ反映 -->
    </div>
</template>
