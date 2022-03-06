<template>
  <FileItem :file="field.value"
            className="mb-3 mt-3 p-3"/>
</template>

<script>
import FileItem from './file/FileItem';

export default {
  props: ['resourceName', 'field'],
  components: {
    FileItem
  }
}
</script>

<style lang="scss" scoped>
.file-item {
  height: 110px !important;
}
</style>
