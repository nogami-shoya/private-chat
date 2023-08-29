<script setup>

    const props = defineProps({
            message: {
                type: String
            },
            createdAt: {
                type: String
            },
            userId: {
                type: Number
            }
        })

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
    defineExpose({ getMessage });
</script>

<template>
    <div id="messages">
        {{ message }}
        {{ createdAt }}
        {{ userId }}
    </div>
</template>
