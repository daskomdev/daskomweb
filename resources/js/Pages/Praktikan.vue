<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">

    <!-- Main Layout -->
    <div class="absolute right-0 my-auto h-full w-24full flex">
      <div class="rounded-l-large my-auto h-24full w-full bg-yellow-200">

      </div>
    </div>

  </div>
</template>
<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
  ],

  data() {
    return {
      pageActive: false,
    }
  },
}
</script>
