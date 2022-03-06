<template>
  <div v-if="file" :class="`file-item ${className}`">
    <div v-if="showDeleteButton" class="file-item-info">
      <span class="delete" @click.prevent="$emit('delete')">
        <icon type="delete" view-box="0 0 20 20" width="16" height="16"/>
      </span>
    </div>
    <img :src="file.file_url"
         :alt="file.file_name"
         class="file-image"/>
  </div>
</template>

<script>
export default {
  props: {
    file: Object,
    className: String,
    showDeleteButton: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
.file-item {
  background-color: #e8f5fb;
  justify-content: center;
  flex-direction: column;
  border-radius: 10px;
  position: relative;
  display: flex;
  height: 150px;
  width: 150px;

  &:hover .file-item-info {
    display: flex;
  }

  & .file-item-info {
    position: absolute;
    display: none;
    bottom: 0;
    right: 0;
    left: 0;
    top: 0;

    & .delete {
      color: var(--danger);
      position: absolute;
      cursor: pointer;
      right: 10px;
      top: 10px;
    }
  }

  & .file-image {
    border-radius: 10px;
  }
}
</style>
