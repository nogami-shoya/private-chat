<script setup>
    import { inject } from 'vue';
    const channelName = inject('channelName');
    console.log(channelName);

</script>
<template>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <slot>
            <ul class="nav nav-pills">
                <li id="channelName" class="nav-item">{{ channelName }}</li>
                <li class="nav-item"><a href="#" class="nav-link">チャンネル名称の変更</a></li>
                <li class="nav-item"><a href="#" class="nav-link">名前の変更</a></li>
                <li class="nav-item"><a href="#" class="nav-link">URLの共有</a></li>
            </ul>
        </slot>

  </header>
</template>
