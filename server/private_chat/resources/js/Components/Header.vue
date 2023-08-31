<script setup>
    import { inject } from 'vue';
    const channelName = inject('channelName');
    console.log(channelName);

</script>
<template>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-4">{{ channelName }}</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item"><a href="#" class="nav-link">チャンネル名称の変更</a></li>
      <li class="nav-item"><a href="#" class="nav-link">名前の変更</a></li>
      <li class="nav-item"><a href="#" class="nav-link">URLの共有</a></li>
    </ul>
  </header>
</template>
