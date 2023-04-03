<template>
  <FileItem :file="field.value"
            :field="field"
            className="nfsf_mb-3 nfsf_mt-3 nfsf_p-3 nfsf_h-24"/>
</template>

<script>
import FileItem from './file/FileItem';

export default {
  props: ['resourceName', 'field'],
  components: {
    FileItem
  }
}
</script>
