<template>
  <div v-if="file">
    <div v-bind:class="getClassList()">
      <div v-if="showDeleteButton"
           class="group-hover:nfsf_flex nfsf_absolute nfsf_hidden nfsf_inset-x-0 nfsf_inset-y-0">
        <span @click.prevent="$emit('delete')"
              class="nfsf_absolute nfsf_right-2.5 nfsf_top-2.5 nfsf_cursor-pointer">
          <Icon type="trash" :solid="false" class="nfsf_text-red-500"/>
        </span>
      </div>

      <template v-if="showFile">
        <div v-html="archiveIcon" class="nfsf_text-center"></div>
      </template>

      <template v-if="showImage">
        <img :src="file.file_url"
             :alt="file.file_name"
             :class="this.classNameImageList"/>
      </template>
    </div>
    <div v-if="showFileName" class="nfsf_mb-2.5 nfsf_text-sm">
      {{ file.file_name }}
    </div>
  </div>
  <div v-else>
    <p class="nfsf_text-center"> — </p>
  </div>
</template>

<script>
import { isFile, isImage } from '../../utils';

export default {
  props: {
    field: Object,
    file: Object,
    className: String,
    classNameImage: String,
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
      classNameList: this.className,
      classNameImageList: this.classNameImage
    };
  },
  computed: {
    archiveIcon() {
      return '<svg viewBox="0 0 24 24" class="nfsf_w-6 nfsf_h-6 nfsf_inline"><path class="heroicon-ui" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2zm0-2V5H4v2h16zM6 9v10h12V9H6zm4 2h4a1 1 0 0 1 0 2h-4a1 1 0 0 1 0-2z" fill="#00947e"/></svg>';
    }
  },
  methods: {
    getClassList() {
      let sClassList = `nfsf_flex nfsf_justify-center nfsf_flex-col nfsf_relative nfsf_group ${this.classNameList}`;

      if (this.showFile) {
        sClassList += ' nfsf_bg-cyan-50';
      }

      if (this.showImage) {
        sClassList += ' nfsf_bg-sky-100';
      }

      return sClassList;
    }
  }
}
</script>
