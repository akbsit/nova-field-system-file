<template>
  <default-field :field="field">
    <template slot="field">
      <FileList :file="file"/>

      <div class="form-file">
        <input :id="`__file__${field.attribute}`"
               @change="uploadFile"
               class="form-file-input"
               type="file"
               ref="file"/>
        <label :for="`__file__${field.attribute}`"
               class="form-file-btn btn btn-default btn-primary">
          Upload new file
        </label>
      </div>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import FileList from './file/FileList';

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: ['resourceName', 'resourceId', 'field'],
  data() {
    return {
      file: null
    };
  },
  watch: {
    file() {
      this.value = this.file;
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
        this.file = {
          file: file,
          file_url: reader.result,
          file_name: file.name
        };
      };
    },
    setInitialValue() {
      this.value = this.field.value || null;
    },
    fill(formData) {
      const collection = this.field.attribute;
      const value = this.value;

      formData.append(`__file__[${collection}]`, value.file, value.file_name);
    }
  },
  components: {
    FileList
  }
}
</script>
