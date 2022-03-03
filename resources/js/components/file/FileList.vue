<template>
  <div class="file-list">
    <FileItem :file="file"/>
  </div>
</template>

<script>
import FileItem from './FileItem';

export default {
  props: {
    file: Object
  },
  components: {
    FileItem
  }
}
</script>

<style lang="scss" scoped>
.file-list:after {
  content: '';
  display: block;
  clear: both;
  height: 0;
}
</style>
