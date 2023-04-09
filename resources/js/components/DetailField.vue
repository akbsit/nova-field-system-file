<template>
  <PanelItem
    :index="index"
    :field="field">
    <template v-slot:value>
      <FileItem :file="field.value"
                :field="field"
                className="nfsf_p-3 nfsf_h-40 nfsf_w-40 nfsf_rounded-xl"
                classNameImage="nfsf_rounded-xl"/>
    </template>
  </PanelItem>
</template>

<script>
import FileItem from './file/FileItem';

export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
  components: {
    FileItem
  }
}
</script>
