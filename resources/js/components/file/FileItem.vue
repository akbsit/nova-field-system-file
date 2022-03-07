<template>
  <div v-if="file" class="file-item-container">
    <div :class="`file-item ${classNameList}`">
      <div v-if="showDeleteButton" class="file-item-info">
        <span class="delete" @click.prevent="$emit('delete')">
          <icon type="delete" view-box="0 0 20 20" width="16" height="16"/>
        </span>
      </div>

      <template v-if="showFile">
        <div class="archive" v-html="archiveIcon"></div>
      </template>

      <template v-if="showImage">
        <img :src="file.file_url"
             :alt="file.file_name"
             class="file-image"/>
      </template>
    </div>
    <div v-if="showFileName" class="file-name">
      {{ file.file_name }}
    </div>
  </div>
</template>

<script>
import { isFile, isImage } from '../../utils';

export default {
  props: {
    field: Object,
    file: Object,
    className: String,
    showDeleteButton: {
      type: Boolean,
      default: false
    },
    showFileName: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      showFile: isFile(this.field.type),
      showImage: isImage(this.field.type),
      classNameList: this.className
    };
  },
  mounted() {
    this.init();
  },
  computed: {
    archiveIcon() {
      return '<?xml version="1.0" encoding="UTF-8" standalone="no"?><svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="24px" height="24px" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2zm0-2V5H4v2h16zM6 9v10h12V9H6zm4 2h4a1 1 0 0 1 0 2h-4a1 1 0 0 1 0-2z" fill="#00947e"/></svg>';
    }
  },
  methods: {
    init() {
      if (this.showFile) {
        this.classNameList += ' file-item-file';
      }

      if (this.showImage) {
        this.classNameList += ' file-item-image';
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.file-item-container {
  & .file-item {
    justify-content: center;
    flex-direction: column;
    border-radius: 10px;
    position: relative;
    display: flex;
    height: 150px;
    width: 150px;

    &.file-item-file {
      background-color: #ebfffc;
    }

    &.file-item-image {
      background-color: #e8f5fb;
    }

    &:hover .file-item-info {
      display: flex;
    }

    & .archive {
      text-align: center;
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

  & .file-name {
    margin-bottom: 10px;
    font-size: 13px;
    color: #63718d;
  }
}
</style>
