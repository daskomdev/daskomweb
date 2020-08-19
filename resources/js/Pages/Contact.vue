<template>
  <div class="main_container w-full h-full overflow-hidden" v-scroll="handleScroll">

    <!-- Main Background -->
    <div class="w-full h-full fixed top-0 bg-gray-400"/>

    <!-- Background Dummy -->
    <div class="fixed bottom-0 w-full"
        :class="[{ 'h-12': !active }, 
              { 'h-full pt-4': active && !scrolled}, 
              { 'h-full pt-0': active && scrolled}, 
              { 'animation-enable': animationEnable}]" ref="bgDummy">
      <div class="flex flex-row bg-green-900 h-full"
        :class="[{ 'mx-8 rounded-t-large': !active }, 
              { 'mx-4 rounded-t-large': active && !scrolled}, 
              { 'mx-0 rounded-t-none': active && scrolled}, 
              { 'animation-enable': animationEnable}]"/>
    </div>

    <!-- Contact Content    -->
    <div class="absolute top-0 main-content w-full h-full pt-24 z-10"
        :class="[{ 'px-8': !scrolled },
              { 'px-0': scrolled }, 
              { 'animation-enable': animationEnable }, 
              { 'opacity-0 mt-4': !pageActive }, 
              { 'opacity-100 mt-0': pageActive }]">
        <div class="w-full h-full p-8 flex">
          <div class="w-full h-full flex-row text-white">
            <div class="font-monda-bold text-2xl">
              Official Account (OA) Lab Daskom
            </div>

            <div class="pl-4 font-overpass-mono text-xl flex h-8">
              <span class="w-8 h-full">
                <img class="fab fa-line w-full h-full">
              </span>
              <div class="my-auto pl-4">
                OA LINE
              </div>
            </div>

            <div class="pl-4 mt-2 font-overpass-mono text-xl flex h-8">
              <span class="w-8 h-full">
                <img class="fab fa-instagram w-full h-full">
              </span>
              <div class="my-auto pl-4">
                telu.daskom
              </div>
            </div>

            <div class="font-monda-bold text-2xl mt-8">
              Muhammad Dimas [ DIM ]
            </div>

            <div class="pl-4 mt-2 font-overpass-mono text-xl flex h-8">
              <span class="w-8 h-full">
                <img class="fas fa-phone w-full h-full">
              </span>
              <div class="my-auto pl-4">
                081384385843
              </div>
            </div>

            <div class="font-monda-bold text-2xl mt-8">
              Iffat Ahmad Baihaki [ DOI ]
            </div>

            <div class="pl-4 mt-2 font-overpass-mono text-xl flex h-8">
              <span class="w-8 h-full">
                <img class="fas fa-phone w-full h-full">
              </span>
              <div class="my-auto pl-4">
                081243473761
              </div>
            </div>

            <div class="font-monda-bold text-2xl mt-8">
              Email Lab Daskom
            </div>

            <div class="pl-4 mt-2 font-overpass-mono text-xl flex h-8">
              <span class="w-8 h-full">
                <img class="fas fa-at w-full h-full">
              </span>
              <div class="my-auto pl-4">
                daskomlab@telkomuniversity.ac.id
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Main Menu Button -->
    <div class="fixed w-full z-20" 
        :class="[{ 'bottom-0 h-20': !active }, 
              { 'bottom-0 h-full pt-8': active && !scrolled && !animated}, 
              { 'bottom-0 h-full pt-0': active && scrolled && !animated}, 
              { 'top-0 h-auto pt-8': active && !scrolled && animated}, 
              { 'top-0 h-auto pt-0': active && scrolled && animated}, 
              { 'animation-enable': animationEnable}]" ref="mainMenu">
      <div class="h-16 shadow-xl flex flex-row bg-green-300"
        :class="[{ 'mx-56 rounded-full': !active }, 
              { 'mx-8 rounded-full': active && !scrolled}, 
              { 'mx-0 rounded-none': active && scrolled}, 
              { 'animation-enable': animationEnable}]">
        <div @mouseover="openDaskom"
            @mouseleave="closeDaskom"
            :class="[{ 'w-56': hover }, 
                  { 'w-20': !hover}, 
                  { 'mx-56 rounded-l-full': !active }, 
                  { 'mx-8 rounded-l-full': active && !scrolled}, 
                  { 'mx-0 rounded-l-none': active && scrolled}, 
                  { 'animation-enable': animationEnable}]"
            class="z-0 absolute left-0 bg-green-700 h-16 cursor-pointer" v-on:click="travel('')">
          <img class="h-16 w-16 p-3 ml-2 select-none" src="/assets/daskom.svg" alt="daskom logo">
          <span class="flex absolute top-0 mt-3 ml-18 daskom-text font-monda-bold text-green-300 text-3xl select-none">Daskom</span>
        </div>
        <div class="flex flex-row self-center w-full mr-1 font-merri font-medium text-lg">
          <div class="flex-1"></div>
          <a class="dynamic flex m-3 self-center cursor-pointer select-none" v-on:click="travel('about')">About</a>
          <a class="chosen flex m-3 self-center cursor-pointer select-none">Contact</a>
          <div class="button flex m-3 bg-green-700 text-white rounded-full py-2 px-4 cursor-pointer select-none" v-on:click="travel('login')">Login</div>
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
      hover: false,
      active: false,
      scrolled: false,
      animated: false,
      animationEnable: true,
      pageActive: false,
    };
  },

  mounted() {
  
    $('body').addClass('closed');
    $('.daskom-text').each(function(){
      $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='daskom-text-letter inline-block'>$&</span>"));
    });

    this.$anime.set('.daskom-text-letter', {
      opacity: 0,
    });

    const globe  = this;
    if(this.comingFrom === 'about'){

      this.animationEnable = false;
      this.active = true;
      this.animated = true;
      setTimeout(
        function() {
          globe.animationEnable = true;
          globe.pageActive = true;
        }, 100);

    } else {

      this.active = true;
      setTimeout(
        function() {
          globe.animated = true;
          globe.pageActive = true;
        }, 1000);
    }
    setTimeout(() => {
  
      $('body').removeClass('closed'); 
    }, 1010);
  },

  methods: {
    
    travel: function(destination) {
      const globe = this;
      $('body').addClass('closed');
      this.pageActive = false;
  
      setTimeout(() => {
        globe.$inertia.replace('/'+destination,{
          data: {
            'comingFrom': 'contact',
          }
        })
      }, 300);
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