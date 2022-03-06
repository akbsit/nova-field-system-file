<template>
  <default-field :field="field">
    <template slot="field">
      <FileItem :file="file"
                className="mb-3 p-3"/>
      <FileButton :field="field"
                  :file="file"
                  @change="changeFile"/>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import FileButton from './file/FileButton';
import FileItem from './file/FileItem';

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
    changeFile(event) {
      this.file = event;
    },
    setInitialValue() {
      this.value = this.file = this.field.value || null;
    },
    fill(formData) {
      const value = this.value;
      if (!value.file) {
        return;
      }

      formData.append(`__file__[${this.field.attribute}]`, value.file, value.file_name);
    }
  },
  components: {
    FileButton,
    FileItem
  }
}
</script>
