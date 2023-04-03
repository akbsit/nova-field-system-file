<template>
  <input :id="`__file__${field.attribute}`"
         @change="uploadFile"
         class="form-file-input"
         type="file"
         ref="file"/>
  <label :for="`__file__${field.attribute}`"
         class="bg-primary-500 hover:bg-primary-400 nfsf_inline-flex nfsf_shadow nfsf_cursor-pointer nfsf_rounded nfsf_text-sm nfsf_font-bold nfsf_h-9 nfsf_px-3 nfsf_items-center nfsf_justify-center nfsf_text-white">
    <template v-if="file">
      Replace {{ type }}
    </template>
    <template v-else>
      Upload new {{ type }}
    </template>
  </label>
</template>

<script>
import { isFile, isImage } from '../../utils';

export default {
  props: {
    field: Object,
    file: Object
  },
  computed: {
    type() {
      if (isFile(this.field.type)) {
        return 'file';
      }

      if (isImage(this.field.type)) {
        return 'image';
      }
    }
  },
  methods: {
    uploadFile() {
      const files = Array.from(this.$refs.file.files);
      this.$refs.file.value = null;
      if (!files.length) {
        return;
      }

      const file = files.shift();
      const blobFile = new Blob([file], {
        type: file.type
      });

      blobFile.lastModifiedDate = new Date();
      blobFile.name = file.name;

      this.readFile(blobFile);
    },
    readFile(file) {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => {
        this.$emit('change', {
          file,
          file_url: reader.result,
          file_name: file.name
        });
      };
    }
  }
}
</script>
