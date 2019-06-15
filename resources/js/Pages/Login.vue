<template>
  <div class="main_container w-full h-full overflow-hidden">

    <!-- Background Dummy -->
    <div class="absolute bottom-0" 
        :class="[{ 'h-12': !activeY }, 
                  { 'h-full pt-4': activeY }, 
                  { 'animation-enable': animate }, 
                  { 'w-full': !activeX }, 
                  { 'w-36': activeX }]" ref="bgDummy">
      <div class="flex flex-row bg-green-900 rounded-t-large h-full"
        :class="[{ 'mx-8': !activeX }, 
                  { 'mx-4': activeX }, 
                  { 'animation-enable': animate}]"/>
    </div>

    <!-- Main Menu Button -->
    <div class="absolute bottom-0" 
        :class="[{ 'h-20': !activeY }, 
                  { 'h-full pt-8': activeY }, 
                  { 'animation-enable': animate},
                  { 'w-full': !activeX },
                  { 'w-36': activeX }]" ref="mainMenu">
      <div class="h-16 shadow-xl flex flex-row bg-green-300 rounded-full"
        :class="[{ 'mx-56': !activeX }, 
                  { 'mx-8': activeX }, 
                  { 'animation-enable': animate}]">
        <div :class="[{ 'mx-56 rounded-r-none': !activeX }, 
                      { 'mx-8 rounded-r-full': activeX }, 
                      { 'animation-enable': animate }]"
            class="w-20 z-0 absolute left-0 bg-green-700 rounded-l-full h-16 cursor-pointer" v-on:click="travel('')">
          <img class="h-16 w-16 p-3 ml-2 select-none" src="/assets/daskom.svg" alt="daskom logo">
        </div>
        <div class="flex flex-row self-center mr-1 font-merri font-medium text-lg w-full">
          <div class="flex-1"></div>
          <a class="menu1 dynamic m-3 self-center cursor-pointer select-none">About</a>
          <a class="menu2 dynamic m-3 self-center cursor-pointer select-none">Contact</a>
          <div class="menu3 button m-3 bg-green-700 text-white rounded-full py-2 px-4 cursor-pointer select-none">Login</div>
        </div>
      </div>
    </div>   
  </div>
</template>

<script>
export default {
  props: ['comingFrom'],
  data() {
    return {
      activeX: false,
      activeY: false,
      animate: true,
    };
  },

  mounted() {
    
    $('body').addClass('closed');

    if(this.comingFrom == 'about' ||
        this.comingFrom == 'contact' ||
        this.comingFrom == 'login'){
      
      

    } else {

      $(".menu1, .menu2, .menu3").hide();
      const globe = this;
      setTimeout(
        function() {
          globe.activeX = true;
        }, 10);

      setTimeout(
        function() {
          globe.activeY = true;
        }, 250);
    } 
  },
  
  methods: {
  
    travel: function(destination) {
      this.$inertia.replace('/'+destination, {
        preserveScroll: true,
        data: {
          'comingFrom': 'login',
        }
      })
    },
  }
}
</script>
