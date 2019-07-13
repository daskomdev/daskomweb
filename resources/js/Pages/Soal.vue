<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">

    <!-- Main Menu -->
    <div class="absolute w-120 z-20 h-48full bottom-0 right-0 animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-min20rem': !pageActive }]" @mouseover="isMenuShown = false">
      <div class="w-full h-full animation-enable overflow-y-auto"
          :class="[{ 'rounded-none': changePage && menuProfil },
                  { 'rounded-tl-large': !changePage || !menuProfil }]" ref="menu">
        <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
            :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuProfil },
                    { 'bg-yellow-500 text-white': changePage && menuProfil }]"
            v-on:click="travel('asisten')">
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-address-card">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Profil
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-600 hover:text-white animation-enable">
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-code">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Praktikum
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none animation-enable"
            :class="[{ 'bg-yellow-500 text-white': !changePage },
                    { 'bg-yellow-400 text-black': changePage }]">
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-file-code">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Soal
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-600 hover:text-white animation-enable">
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-list-alt">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            List TP
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-600 hover:text-white animation-enable">
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-history">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            History
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-600 hover:text-white animation-enable">
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-chart-area">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Polling
          </span>
        </div>

        <!-- Role Based Menu -->
        <!-- TODO: Change Role Layout -->
        <div v-if="currentUser.role_id == 2">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuKelas },
                      { 'bg-yellow-500 text-white': changePage && menuKelas }]"
              v-on:click="travel('kelas')">
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-chalkboard-teacher">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Kelas
            </span>
          </div>

          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuModul },
                      { 'bg-yellow-500 text-white': changePage && menuModul }]"
              v-on:click='travel("modul")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-book">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Modul
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Profile Menu -->
    <div class="w-72 bg-gray-200 absolute top-0 mr-6 mt-4 h-40 rounded-lg flex-row animation-enable"
        :class="[{ 'hidden': !isMenuShown },
                { 'visible': isMenuShown },
                { 'right-min20rem': !pageActive },
                { 'right-0': pageActive }]" @mouseover="isMenuShown = true" @mouseleave="isMenuShown = false">
        <div class="w-full h-3/4"/>
        <div class="w-full h-1/4 flex">
          <div class="rounded-b-lg bg-gray-400 flex hover:bg-gray-500 w-full h-full cursor-pointer" v-on:click="signOut">
            <span class="m-auto font-monda-bold text-lg text-right w-full">
              Logout
            </span>
            <img class="select-none p-3 h-full w-auto mr-20 m-auto fas fa-sign-out-alt">
          </div>
        </div>
    </div>

    <!-- Assistant's Profile -->
    <div class="absolute top-0 w-120 flex animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-min20rem': !pageActive },
                { 'h-48': !isMenuShown },
                { 'h-36': isMenuShown }]" @mouseover="isMenuShown = true">
      <div class="w-auto m-auto h-full flex">
        <div class="w-24 h-full flex mr-4">
          <div class="flex w-24 h-24 m-auto rounded-full"
              :class="[{ 'bg-green-400': !isMenuShown },
                      { 'bg-green-600': isMenuShown }]">
            <img class="select-none w-20 h-20 m-auto rounded-full bg-white" src="/assets/daskom.svg" alt="daskom logo">
          </div>
        </div>
        <div class="w-auto h-full flex-row ml-4 cursor-default">
          <div class="h-3/5 w-full flex">
            <span class="select-none3 font-overpass-mono-bold text-5xl self-end text-left w-full -mb-2 uppercase tracking-widest"
                :class="[{ 'text-black': isMenuShown },
                        { 'text-white ': !isMenuShown }]">
              {{ currentUser.kode }}
            </span>
          </div>
          <div class="h-2/5 text-xl w-full text-left -mt-2">
            <span class="selec-none font-overpass-thin font-semibold capitalize"
                :class="[{ 'text-black': isMenuShown },
                        { 'text-white ': !isMenuShown }]">
              [ {{ userRole }} ]
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Soal Layout -->
    <div class="absolute py-8 pr-8 h-full w-120full flex animation-enable"
        :class="[{ 'left-0': currentPage },
                { 'left-minFull': !currentPage }]" @mouseover="isMenuShown = false">
      <div class="rounded-r-large bg-yellow-500 text-center font-monda-bold text-3xl w-full h-full flex-row">
        <div class="relative w-full h-16 flex">
          <div class="w-1/6 h-16 p-3 hover:bg-yellow-400 cursor-pointer"
              v-on:click='setActiveSoal("TP")'>
            TP
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-yellow-400 cursor-pointer"
              v-on:click='setActiveSoal("TA")'>
            TA
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-yellow-400 cursor-pointer"
              v-on:click='setActiveSoal("TK")'>
            TK
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-yellow-400 cursor-pointer"
              v-on:click='setActiveSoal("Jurnal")'>
            Jurnal
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-yellow-400 cursor-pointer"
              v-on:click='setActiveSoal("Mandiri")'>
            Mandiri
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-yellow-400 cursor-pointer rounded-tr-large"
              v-on:click='setActiveSoal("FITB")'>
            FITB
          </div>
          <div class="absolute pointer-events-none w-full h-16">
            <div class="absolute bottom-0 w-full flex h-1">
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-1/6': isTA },
                          { 'w-0': !isTA }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-2/6': isTK },
                          { 'w-0': !isTK }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-3/6': isJurnal },
                          { 'w-0': !isJurnal }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-4/6': isMandiri },
                          { 'w-0': !isMandiri }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-5/6': isFITB },
                          { 'w-0': !isFITB }]"/>
              <div class="w-1/6 px-4 h-full">
                <div class="w-full h-full rounded-full bg-black"/>
              </div>
            </div>
          </div>
        </div>

        <!-- Active Soal Layout -->
        <div class="w-full h-full pb-16">
          <div class="w-full h-full p-4">

          </div>
        </div>
      </div>   
    </div>
  </div>
</template>

<style>

</style>

<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
    'position',
    'userRole',
  ],

  data() {
    return {
      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,

      isTA: false,
      isTK: false,
      isJurnal: false,
      isMandiri: false,
      isFITB: false,

      menuProfil: false,
      menuPraktikum: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuKelas: false,
      menuModul: false,
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.$refs.menu.scrollTop = this.position;

    const globe = this;

    if(this.comingFrom == 'asisten' ||
        this.comingFrom == 'none' ||
        this.comingFrom == 'kelas' ||
        this.comingFrom == 'modul'){

      setTimeout(
        function() {
          globe.currentPage = true;
        }, 10); 
    }
  },

  methods: {
    setCurrentMenu: function($whereTo, $bool){

      if($whereTo == "praktikum")
        this.menuPraktikum = $bool;
      if($whereTo == "asisten")
        this.menuProfil = $bool;
      if($whereTo == "listTp")
        this.menuListTp = $bool;
      if($whereTo == "history")
        this.menuHistory = $bool;
      if($whereTo == "polling")
        this.menuPolling = $bool;
      if($whereTo == "kelas")
        this.menuKelas = $bool;
      if($whereTo == "modul")
        this.menuModul = $bool;
    },

    setActiveSoal: function($soalMenu){
      if($soalMenu == "TA"){
        this.isTA = true;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = false;
      } else if($soalMenu == "TK"){
        this.isTA = false;
        this.isTK = true;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = false;
      } else if($soalMenu == "Jurnal"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = true;
        this.isMandiri = false;
        this.isFITB = false;
      } else if($soalMenu == "Mandiri"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = true;
        this.isFITB = false;
      } else if($soalMenu == "FITB"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = true;
      } else if($soalMenu == "TP"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = false;
      }
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=soal&position='+globe.$refs.menu.scrollTop);
        }, 501); 
    },

    signOut: function(){

      const globe = this;
      this.pageActive = false;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/logoutAsisten')
        }, 1010); 
    }
  }
}
</script>
