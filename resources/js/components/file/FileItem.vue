<template>
  <div v-if="file" :class="`file-item ${className}`">
    <img :src="file.file_url"
         :alt="file.file_name"
         class="file-image"/>
  </div>
</template>

<script>
export default {
  props: {
    file: Object,
    className: String
  }
}
</script>

<style lang="scss" scoped>
.file-item {
  background-color: #e8f5fb;
  justify-content: center;
  flex-direction: column;
  border-radius: 10px;
  display: flex;
  height: 150px;
  width: 150px;

  & .file-image {
    border-radius: 10px;
  }
}
</style>
