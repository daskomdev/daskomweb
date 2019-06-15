<template>
  <div class="flex h-full w-full mainBg" ref="mainBg">
    <header>
      <inertia-link href="/">Home</inertia-link>
      <inertia-link href="/about">About</inertia-link>
      <inertia-link href="/contact">Contact</inertia-link>
    </header>

    <div class="font-merri m-auto text-white text-4xl" ref="welcomeText">
      Welcome To
    </div>
    
    for inputting all the props 
    <slot/>
  </div>
</template>

<script>
export default {
}
</script>
