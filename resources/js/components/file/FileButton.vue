<template>
  <div class="file-button">
    <input :id="`__file__${field.attribute}`"
           @change="uploadFile"
           class="form-file-input"
           type="file"
           ref="file"/>
    <label :for="`__file__${field.attribute}`"
           class="form-file-btn btn btn-default btn-primary">
      <template v-if="file">
        Replace file
      </template>
      <template v-else>
        Upload new file
      </template>
    </label>
  </div>
</template>

<script>
export default {
  props: {
    field: Object,
    file: Object
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
