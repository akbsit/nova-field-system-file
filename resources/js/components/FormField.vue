<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="fullWidthContent"
  >
    <template #field>
      <FileItem
        :file="file"
        :field="field"
        :showDeleteButton="changeable()"
        :showFileName="true"
        @delete="deleteFile"
        className="nfsf_mb-3 nfsf_p-3 nfsf_h-40 nfsf_w-40 nfsf_rounded-xl"
        classNameImage="nfsf_rounded-xl"
      />
      <FileButton
        v-if="changeable()"
        :field="field"
        :file="file"
        @change="changeFile"
      />
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import FileButton from './file/FileButton';
import FileItem from './file/FileItem';
import { ACTION } from '../constants';

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: ['resourceName', 'resourceId', 'field'],
  data() {
    return {
      file: null,
      action: ACTION.CREATE
    };
  },
  watch: {
    file() {
      this.value = this.file;
    }
  },
  methods: {
    changeable() {
      return !this.field.self;
    },
    changeFile(event) {
      this.file = event;
      this.action = ACTION.UPDATE;
    },
    deleteFile() {
      this.file = null;
      this.action = ACTION.DELETE;
    },
    setInitialValue() {
      this.value = this.file = this.field.value || null;
    },
    fill(formData) {
      switch (this.action) {
        case ACTION.CREATE:
        case ACTION.UPDATE:
          const value = this.value;
          if (!value) {
            return;
          }

          if (!value.file) {
            return;
          }

          formData.append(`__file__[${this.field.attribute}]`, value.file, value.file_name);
          break;
        case ACTION.DELETE:
          formData.append(`__file__[${this.field.attribute}]`, null);
          break;
      }
    }
  },
  components: {
    FileButton,
    FileItem
  }
}
</script>
