<template>
  <div class="main_container w-full h-full overflow-hidden"> 

    <!-- Animation Part -->
    <!-- TODO: Do more here <14 June 02:09 PM> -->
    <div class="flex h-full w-full" ref="mainBg">
      <div class="font-merri m-auto text-white text-4xl" ref="welcomeText">
        Welcome To
      </div>
    </div>

    <!-- Background Dummy -->
    <div class="absolute bottom-0 w-full" 
        :class="[{ 'h-12': !active }, { 'h-full pt-4': active}, { 'animation-enable': animate}]" ref="bgDummy">
      <div class="flex flex-row bg-green-900 rounded-t-large h-full"
        :class="[{ 'mx-8': !active }, { 'mx-4': active}, { 'animation-enable': animate}]"/>
    </div>

    <!-- Main Menu Button -->
    <div class="absolute bottom-0 w-full" 
        :class="[{ 'h-20': !active }, { 'h-full pt-8': active}, { 'animation-enable': animate}]" ref="mainMenu">
      <div class="h-16 shadow-xl flex flex-row bg-green-300 rounded-full"
        :class="[{ 'mx-56': !active }, { 'mx-8': active}, { 'animation-enable': animate}]">
        <div @mouseover="openDaskom"
            @mouseleave="closeDaskom"
            :class="[{ 'w-56': hover }, { 'w-20': !hover}, { 'mx-56': !active }, { 'mx-8': active}, { 'animation-enable': animate}]"
            class="z-0 absolute left-0 bg-green-700 rounded-l-full h-16 cursor-pointer" v-on:click="travel('')">
          <img class="h-16 w-16 p-3 ml-2 select-none" src="/assets/daskom.svg" alt="daskom logo">
          <span class="flex absolute top-0 mt-3 ml-18 daskom-text font-monda-bold text-green-300 text-3xl select-none">Daskom</span>
        </div>
        <div class="flex flex-row self-center w-full mr-1 font-merri font-medium text-lg">
          <div class="flex-1"></div>
          <a class="flex m-3 self-center cursor-pointer select-none" v-on:click="travel('about')">About</a>
          <a class="flex m-3 self-center cursor-pointer select-none" v-on:click="travel('contact')">Contact</a>
          <div class="flex m-3 bg-green-700 text-white rounded-full py-2 px-4 cursor-pointer select-none" v-on:click="travel('login')">Login</div>
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
      hover: true,
      active: true,
      animate: false,
    };
  },

  mounted() {
    
    $('.daskom-text').each(function(){
      $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='daskom-text-letter inline-block'>$&</span>"));
    });

    this.$anime.set('.daskom-text-letter', {
      opacity: 0,
    })

    const globe = this;
    const text = this.$refs.welcomeText;
    const background = this.$refs.mainBg;
    const bgDummy = this.$refs.bgDummy;
    const mainMenu = this.$refs.mainMenu;

    if(this.comingFrom == ('about' || 'contact' || 'login')){
      
      this.animate = true;
      this.$anime.set(text, {
        opacity: 0,
      })

      this.$anime.set(background, {
        opacity: 0,
      })

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
       
      setTimeout(
        function() {
          globe.$anime.set('.daskom-text-letter', {
            opacity: 0,
          })
        }, 1000);
      this.active = false;

    } else {

      this.hover = false;
      this.active = false;
      this.$anime.set(background, {
        backgroundColor: '#000',
      })

      this
        .$anime
        .timeline({
          duration: 1500
        })
        .add({
          targets: text,
          translateY: [50,0],
          opacity: [0,1],
          easing: 'easeInSine',
        })
        .add({
          targets: text,
          translateY: [0,-50],
          opacity: [1,0],
          easing: 'easeInSine',
        }, '+=1000')
        .add({
          targets: background,
          backgroundColor: ['#000','#FFF'],
          opacity: [1,0],
          easing: 'easeInSine'
        }, '-=1000')
        .add({
          targets: bgDummy,
          translateY: [100,0],
          duration: 1500,
          easing: 'easeInSine'
        }, '+=100')
        .add({
          targets: mainMenu,
          translateY: [100,0],
          duration: 500,
          easing: 'easeInSine',
          begin: function(anim) {
            globe.animate = true;
          }
        }, '-=200');
    } 
  },

  methods: {
    
    travel: function(destination) {
      this.$inertia.replace('/'+destination, {
        preserveScroll: true,
      })
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