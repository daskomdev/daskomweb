<template>
  <div class="main_container w-full h-full overflow-hidden" v-scroll="handleScroll">

    <!-- Background Dummy -->
    <div class="fixed bottom-0 w-full animation-enable"
        :class="[{ 'h-12': !active }, 
              { 'h-full pt-4': active && !scrolled}, 
              { 'h-full pt-0': active && scrolled}]" ref="bgDummy">
      <div class="flex flex-row bg-green-900 h-full animation-enable"
        :class="[{ 'mx-8 rounded-t-large': !active }, 
              { 'mx-4 rounded-t-large': active && !scrolled}, 
              { 'mx-0 rounded-t-none': active && scrolled}]"/>
    </div>

    <!-- About Content    -->
    <div class="absolute flex top-0 main-content w-full h-full pt-24 px-8">
      <div class="w-full h-full m-5">
         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et quam pellentesque, vehicula velit porta, scelerisque purus. Donec tempor ultrices facilisis. In commodo auctor lectus vitae finibus. Aliquam fermentum nisl quis iaculis ultrices. Maecenas sagittis nibh id molestie aliquet. Vestibulum et semper metus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur euismod ex sit amet urna iaculis, aliquam lobortis nisi posuere. Nunc auctor porta tortor. Mauris ante mauris, vulputate et egestas sit amet, fringilla id dui.

Pellentesque varius sem sit amet metus consectetur, blandit euismod nunc mollis. Nulla viverra egestas tortor. Donec volutpat auctor orci. Aliquam maximus venenatis leo, sed vestibulum magna aliquam at. Mauris velit nunc, congue eget augue ac, porta finibus odio. Quisque fringilla eget lectus a scelerisque. Sed nec mi nec elit blandit finibus ut vel felis. Maecenas a maximus leo, pulvinar venenatis risus. In hac habitasse platea dictumst. Donec iaculis pharetra leo, vel pulvinar lacus mattis ut. Mauris facilisis nunc odio, in pulvinar justo eleifend porta. Sed quis fringilla orci, ut malesuada est. Sed vestibulum nibh nec suscipit commodo.

Curabitur eget convallis orci, ac elementum quam. Pellentesque rhoncus cursus odio, non elementum nisl viverra eget. Mauris mattis rhoncus lacinia. Mauris scelerisque ligula ac orci condimentum cursus. Ut nulla arcu, sollicitudin ac posuere sed, volutpat id sem. Vivamus at urna mi. Proin feugiat, diam in fermentum semper, leo odio dignissim felis, ac interdum justo diam et justo. Nulla varius augue non eros blandit congue. Vivamus erat massa, consequat pellentesque faucibus eget, blandit quis eros. Nunc dictum faucibus neque ut aliquet. Vestibulum interdum rhoncus aliquam. 
      </div>
    </div>

    <!-- Main Menu Button -->
    <div class="fixed w-full bottom-0 animation-enable" 
        :class="[{ 'h-20': !active }, 
              { 'h-full pt-8': active && !scrolled}, 
              { 'h-full pt-0': active && scrolled}]" ref="mainMenu">
      <div class="h-16 shadow-xl flex flex-row bg-green-300 animation-enable"
        :class="[{ 'mx-56 rounded-full': !active }, 
              { 'mx-8 rounded-full': active && !scrolled}, 
              { 'mx-0 rounded-none': active && scrolled}]">
        <div @mouseover="openDaskom"
            @mouseleave="closeDaskom"
            :class="[{ 'w-56': hover }, 
                  { 'w-20': !hover}, 
                  { 'mx-56 rounded-l-full': !active }, 
                  { 'mx-8 rounded-l-full': active && !scrolled}, 
                  { 'mx-0 rounded-l-none': active && scrolled}]"
            class="z-0 absolute left-0 bg-green-700 h-16 cursor-pointer animation-enable" v-on:click="travel('')">
          <img class="h-16 w-16 p-3 ml-2 select-none" src="/assets/daskom.svg" alt="daskom logo">
          <span class="flex absolute top-0 mt-3 ml-18 daskom-text font-monda-bold text-green-300 text-3xl select-none">Daskom</span>
        </div>
        <div class="flex flex-row self-center w-full mr-1 font-merri font-medium text-lg">
          <div class="flex-1"></div>
          <a class="chosen flex m-3 self-center cursor-pointer select-none">About</a>
          <a class="flex m-3 self-center cursor-pointer select-none" v-on:click="travel('contact')">Contact</a>
          <div class="flex m-3 bg-green-700 text-white rounded-full py-2 px-4 cursor-pointer select-none" v-on:click="travel('login')">Login</div>
        </div>
      </div>
    </div> 
  </div>
</template>

<script>
export default {
  data() {
    return {
      hover: false,
      active: false,
      scrolled: false,
    };
  },

  mounted() {

    this.active = true;
  
    $('.daskom-text').each(function(){
      $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='daskom-text-letter inline-block'>$&</span>"));
    });

    this.$anime.set('.daskom-text-letter', {
      opacity: 0,
    });
  },

  methods: {
    
    travel: function(destination) {
      this.$inertia.replace('/'+destination,{
        data: {
          'comingFrom': 'about',
        }
      })
    },
    
    handleScroll: function (evt, el) {
      window.scrollY > 5 ? this.scrolled = true : this.scrolled = false;
    },

    openDaskom: function(event){
      if(!this.hover){

        this.hover = true;
        this.$anime
        .timeline({
          duration: 200
        }).add({
          targets: '.daskom-text-letter',
          scale: [0.3,1],
          opacity: [0,1],
          easing: "easeOutExpo",
          delay: function(el, i) {
            return 70 * (i+1)
          }
        });
      }
    },

    closeDaskom: function(event){
      const text = this.$refs.daskomText;
      if(this.hover){

        this.hover = false;
        this.$anime
        .timeline({
          duration: 200
        }).add({
          targets: '.daskom-text-letter',
          scale: [1,0.3],
          opacity: [1,0],
          easing: "easeOutExpo",
          delay: function(el, i, l) {
            return 70 * (l-(i+1))
          }
        });
      }
    }
  }
}
</script> 