<template>
  <panel-item :field="field">
    <FileItem slot="value"
              :file="field.value"
              className="p-3"/>
  </panel-item>
</template>

<script>
import FileItem from './file/FileItem';

export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],
  components: {
    FileItem
  }
}
</script>
