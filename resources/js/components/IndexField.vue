<template>
  <FileItem :file="field.value"
            :field="field"
            className="nfsf_p-1.5 nfsf_h-20 nfsf_w-20 nfsf_rounded-full nfsf_m-auto"
            classNameImage="nfsf_h-20 nfsf_w-20 nfsf_rounded-full nfsf_inline-block"/>
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
