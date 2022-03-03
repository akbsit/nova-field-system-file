<template>
  <div class="file-item mb-3 p-3">
    <img v-if="file"
         :src="file.file_url"
         :alt="file.file_name"
         class="file-image"/>
  </div>
</template>

<script>
export default {
  props: {
    file: Object
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
  float: left;

  & .file-image {
    border-radius: 10px;
  }
}
</style>
