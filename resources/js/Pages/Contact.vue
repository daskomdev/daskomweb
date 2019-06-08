<template>
  <layout>
    <div>
      Holla {{ foo }}
    </div>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  props: ['foo'],
  components: {
    Layout,
  },
}
</script> 