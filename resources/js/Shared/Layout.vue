<template>
  <div class="flex h-full w-full bg-black">
    <!-- <header>
      <inertia-link href="/">Home</inertia-link>
      <inertia-link href="/about">About</inertia-link>
      <inertia-link href="/contact">Contact</inertia-link>
    </header> -->

    <div class="font-merri m-auto text-white text-4xl" ref="welcomeText">
      Welcome To
    </div>
    
    <!-- for inputting all the props 
    <slot/> -->
  </div>
</template>

<script>
export default {
  mounted() {
    const targets = this.$refs.welcomeText;
    this
      .$anime
      .timeline()
      .add({
        targets,
        translateX: 250,
        easing: 'easeOutExpo',
      });
      /* ... etc ... */
  },
}
</script>
