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

        <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
            :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuPraktikum },
                    { 'bg-yellow-500 text-white': changePage && menuPraktikum }]"
            v-on:click='travel("praktikum")'>
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-code">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Praktikum
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
            :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuListTp },
                    { 'bg-yellow-500 text-white': changePage && menuListTp }]"
            v-on:click='travel("listTp")'>
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-list-alt">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            List TP
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
            :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuHistory },
                    { 'bg-yellow-500 text-white': changePage && menuHistory }]"
            v-on:click='travel("history")'>
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-history">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            History
          </span>
        </div>

        <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
            :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuNilai },
                    { 'bg-yellow-500 text-white': changePage && menuNilai }]"
            v-on:click='travel("nilai")'>
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-clipboard-check">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Nilai
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

        <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
            :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuSetPraktikan },
                    { 'bg-yellow-500 text-white': changePage && menuSetPraktikan }]"
            v-on:click='travel("setpraktikan")'>
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-users">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Set Praktikan
          </span>
        </div>

        <!-- Role Based Menu -->
        <div v-if="kelasPriviledge.includes(currentUser.role_id) || kelasPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuKelas },
                      { 'bg-yellow-500 text-white': changePage && menuKelas }]"
              v-on:click='travel("kelas")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-chalkboard-teacher">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Kelas
            </span>
          </div>
        </div>

        <div v-if="soalPriviledge.includes(currentUser.role_id) || soalPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuSoal },
                      { 'bg-yellow-500 text-white': changePage && menuSoal }]"
              v-on:click='travel("soal")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-file-code">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Soal
            </span>
          </div>
        </div>
        
        <div v-if="plottingPriviledge.includes(currentUser.role_id) || plottingPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none animation-enable"
              :class="[{ 'bg-yellow-500 text-white': !changePage },
                      { 'bg-yellow-400 text-black': changePage }]">
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-calendar-alt">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Plotting
            </span>
          </div>
        </div>

        <div v-if="modulPriviledge.includes(currentUser.role_id) || modulPriviledge == 'all'">
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

        <div v-if="konfigurasiPriviledge.includes(currentUser.role_id) || konfigurasiPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuKonfigurasi },
                      { 'bg-yellow-500 text-white': changePage && menuKonfigurasi }]"
              v-on:click='travel("konfigurasi")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-cog">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Konfigurasi
            </span>
          </div>
        </div>

        <div v-if="tpPriviledge.includes(currentUser.role_id) || tpPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuTp },
                      { 'bg-yellow-500 text-white': changePage && menuTp }]"
              v-on:click='travel("tp")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-book-open">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Tugas Pendahuluan
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
                { 'h-36': isMenuShown }]" @mouseover="isMenuShown = true;">
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

    <!-- Plotting Layout -->
    <div class="relative top-0 h-full w-120full flex animation-enable"
        :class="[{ 'top-0': currentPage },
                { 'top-minFull': !currentPage }]"
        @mouseover="isMenuShown = false;">

      <div class="w-full h-full px-8 py-4">
        <div class="w-full h-full" v-bar>
          <div>
            <transition-group
                class="flex-wrap flex w-full h-auto" 
                name="plotting-list" tag="div">
              <div v-for="plotting in listAllJaga" v-bind:key="plotting.id" 
                  class="animation-enable relative w-1/3 h-24 flex py-2 px-4 bg"
                  @mouseover="openMoreMenu(plotting.id)" @mouseleave="closeMoreMenu(plotting.id)">
                <div class="w-full h-full flex">
                  <div class="w-2/5 h-full">
                    <div class="w-full h-full bg-gray-300 items-center flex rounded-l-large">
                      <div class="w-auto h-auto font-overpass-bold text-5xl pt-2 text-green-600 text-center m-auto">
                        {{ plotting.kode }}
                      </div>
                    </div>
                  </div>
                  <div class="w-3/5 h-full">
                    <div class="w-full h-full bg-gray-400 items-center flex rounded-r-large">
                      <div class="w-auto h-auto font-overpass-bold text-3xl text-green-600 text-center m-auto">
                        {{ plotting.kelas }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-full h-full absolute flex">
                  <div class="w-full h-full pb-4 pr-8 flex">
                    <div class="w-full h-full animation-enable-short cursor-pointer opacity-0 flex"
                        :class="'moreMenu-'+plotting.id"
                        v-on:click="formJaga = plotting">
                      <div class="w-3/4 h-full flex rounded-l-large bg-yellow-400">
                        <div class="w-auto h-auto font-overpass-bold text-3xl text-black-600 text-center m-auto">
                          {{ plotting.hari }}
                        </div>
                      </div>
                      <div class="w-1/4 h-full flex rounded-r-large bg-yellow-500">
                        <div class="w-auto h-auto font-overpass-bold text-3xl text-black-600 text-center m-auto">
                          {{ plotting.shift }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </transition-group>
          </div>
        </div>
      </div>

      <!-- Plotting Form -->
      <div class="absolute m-8 bottom-0 w-1/2 h-48 flex animation-enable"
          :class="[{ 'left-0': currentPage && plottingMenuShown },
                  { 'left-minFull': !currentPage || !plottingMenuShown },]">
        <div class="w-16full h-full flex bg-gray-400 rounded-l-lg animation-enable-short"
            :class="[{ 'opacity-100': formHovered || buttonHovered},
                    { 'opacity-25': !formHovered && !buttonHovered}]">
          <form id="jagaForm" class="w-full h-full flex-row"
              @mouseover="formHovered = true;" @mouseleave="formHovered = false;">
            <div class="w-full h-1/2 flex">
              <div class="w-full px-4 pt-2 pb-2 h-full flex-row">
                <div class="font-merri w-full flex text-left text-gray-700 text-lg h-1/3">
                  <span class="h-auto my-auto">
                    Asisten
                  </span>
                </div>
                <div class="w-full h-2/3">
                  <select v-model="formJaga.asisten_id" 
                        class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                    <option v-for="asisten in allAsisten" v-bind:key="asisten.id" :value="asisten.id">{{ asisten.kode }}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="w-full h-1/2 flex">
              <div class="w-full px-4 pb-4 h-full flex-row">
                <div class="font-merri w-full flex text-left text-gray-700 text-lg h-1/3">
                  <span class="h-auto my-auto">
                    Kelas
                  </span>
                </div>
                <div class="w-full h-2/3">
                  <select v-model="formJaga.kelas_id" 
                        class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                    <option v-for="kelas in allKelas" v-bind:key="kelas.id" :value="kelas.id">{{ kelas.kelas }}</option>
                  </select>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="w-16 h-full flex bg-gray-600 rounded-r-lg animation-enable-short"
            :class="[{ 'opacity-100': formHovered || buttonHovered },
                    { 'opacity-25': !formHovered && !buttonHovered }]"
            @mouseover="buttonHovered = true;" @mouseleave="buttonHovered = false;">
          <div class="w-full h-full flex-row">
            <div class="w-full h-1/2 flex">
              <span class="w-8 h-8 m-auto animation-enable-short text-gray-400 p-0 hover:p-1 cursor-pointer"
                  v-on:click="createJadwalJaga">
                <img class="w-full h-full fas fa-plus">
              </span>
            </div>
            <div class="w-full h-1/2 flex">
              <span class="w-8 h-8 m-auto animation-enable-short text-gray-400 p-0 hover:p-1 cursor-pointer"
                  v-on:click="deleteJadwalJaga">
                <img class="w-full h-full fas fa-trash">
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="w-1/2 absolute right-0 bottom-0 my-8 pl-8 h-48 animation-enable flex pointer-events-none"
          :class="[{ 'opacity-100': formHovered || buttonHovered || !plottingMenuShown },
                  { 'opacity-25': !formHovered && !buttonHovered && plottingMenuShown },
                  { 'w-1/2': plottingMenuShown },
                  { 'w-full': !plottingMenuShown }]">
        <div class="w-16 h-full flex">
          <div class="w-12 h-12 p-0 hover:p-1 mr-auto my-auto animation-enable-short pointer-events-auto"
              v-on:click="plottingMenuShown = !plottingMenuShown"
              @mouseover="formHovered = true;" @mouseleave="formHovered = false;">
            <span class="w-full h-full cursor-pointer text-white"
                :class="[{ 'visible': plottingMenuShown },
                        { 'hidden': !plottingMenuShown }]">
              <img class="w-full h-full fas fa-caret-left"/>
            </span>
            <span class="w-full h-full cursor-pointer text-white"
                :class="[{ 'visible': !plottingMenuShown },
                        { 'hidden': plottingMenuShown }]">
              <img class="w-full h-full fas fa-caret-right"/>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.plotting-list-enter, .plotting-list-leave-to{
  opacity: 0;
  transform: translateY(100%);
}
.plotting-list-leave-active {
  position: absolute;
}
</style>

<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
    'position',
    'userRole',
    'allJaga',
    'allKelas',
    'allAsisten',
  ],

  data() {
    return {
      kelasPriviledge: [],
      plottingPriviledge: [1,2,4,5],
      modulPriviledge: [1,2,4,15,7],
      konfigurasiPriviledge: [1,2,4,18,7],
      tpPriviledge: [1,2,15,11,7],
      soalPriviledge: "all",

      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,

      formHovered: false,
      buttonHovered: false,
      plottingMenuShown: true,

      menuProfil: false,
      menuPraktikum: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuSoal: false,
      menuKelas: false,
      menuModul: false,
      menuKonfigurasi: false,
      menuTp: false,
      menuNilai: false,
      menuSetPraktikan: false,

      listAllJaga: this.allJaga === null ? [] : this.allJaga,

      formJaga: {
        id: '',
        asisten_id: '',
        kelas_id: '',
      },
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.$refs.menu.scrollTop = this.position;

    const globe = this;

    if(this.comingFrom === 'asisten' ||
        this.comingFrom === 'none' ||
        this.comingFrom === 'kelas'||
        this.comingFrom === 'soal'||
        this.comingFrom === 'praktikum' ||
        this.comingFrom === 'modul' ||
        this.comingFrom === 'konfigurasi' ||
        this.comingFrom === 'tp' ||
        this.comingFrom === 'listTp' ||
        this.comingFrom === 'history'||
        this.comingFrom === 'nilai'||
        this.comingFrom === 'setpraktikan'){

      setTimeout(
        function() {
          globe.currentPage = true;
        }, 10); 
    }
  },

  methods: {

    setCurrentMenu: function($whereTo, $bool){

      if($whereTo === "praktikum")
        this.menuPraktikum = $bool;
      if($whereTo === "soal")
        this.menuSoal = $bool;
      if($whereTo === "listTp")
        this.menuListTp = $bool;
      if($whereTo === "history")
        this.menuHistory = $bool;
      if($whereTo === "polling")
        this.menuPolling = $bool;
      if($whereTo === "asisten")
        this.menuProfil = $bool;
      if($whereTo === "kelas")
        this.menuKelas = $bool;
      if($whereTo === "modul")
        this.menuModul = $bool;
      if($whereTo === "konfigurasi")
        this.menuKonfigurasi = $bool;
      if($whereTo === "tp")
        this.menuTp = $bool;
      if($whereTo === "nilai")
        this.menuNilai = $bool;
      if($whereTo === "setpraktikan")
        this.menuSetPraktikan = $bool;
    },

    openMoreMenu: function($id){

      $(".moreMenu-"+$id).removeClass("opacity-0");
      $(".moreMenu-"+$id).addClass("opacity-100");
    },

    closeMoreMenu: function($id){

      $(".moreMenu-"+$id).addClass("opacity-0");
      $(".moreMenu-"+$id).removeClass("opacity-100");
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=plotting&position='+globe.$refs.menu.scrollTop);
        }, 501); 
    },

    deleteJadwalJaga: function(){

      const globe = this;

      if(this.formJaga.asisten_id === null || this.formJaga.kelas_id === null){
        globe.$toasted.global.showError({
          message: "Pilih asisten & kelas terlebih dahulu"
        });
      }

      this.$axios.post('/deleteJadwalJaga', this.formJaga).then(response => {

        if(response.data.message === "success") {

          globe.$toasted.global.showSuccess({
            message: "Jadwal Jaga berhasil dihapus"
          });

          var i;
          for(i=0; i<globe.listAllJaga.length; i++){
            if(globe.listAllJaga[i].asisten_id === this.formJaga.asisten_id &&
                globe.listAllJaga[i].kelas_id === this.formJaga.kelas_id){
              break;
            }
          }
          globe.listAllJaga.splice(i, 1);
        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      }).catch(function (error) {
        if (error.response) {
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          if(error.response.data.errors != null){
            if(error.response.data.errors.hari != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.hari[0]
              });
            if(error.response.data.errors.shift != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.shift[0]
              });
            if(error.response.data.errors.asisten_id != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.asisten_id[0]
              });
          }
        }
      });
    },

    createJadwalJaga: function(){

      const globe = this;
      this.$axios.post('/createJadwalJaga', this.formJaga).then(response => {

        if(response.data.message === "success") {

          $("#jagaForm")[0].reset();
          globe.$toasted.global.showSuccess({
            message: "Jadwal Jaga berhasil ditambahkan"
          });

          var kode;
          globe.allAsisten.forEach(element => {
            if(element.id === globe.formJaga.asisten_id)
              kode = element.kode;
          });

          var kelas, hari, shift;
          globe.allKelas.forEach(element => {
            if(element.id === globe.formJaga.kelas_id){
              kelas = element.kelas;
              hari = element.hari;
              shift = element.shift;
            }
          })

          globe.listAllJaga.push({
            id: response.data.id,
            kelas_id: globe.formJaga.kelas_id,
            asisten_id: globe.formJaga.asisten_id,
            kode: kode,
            kelas: kelas,
            hari: hari,
            shift: shift,
          })
        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      }).catch(function (error) {
        if (error.response) {
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          if(error.response.data.errors != null){
            if(error.response.data.errors.hari != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.hari[0]
              });
            if(error.response.data.errors.shift != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.shift[0]
              });
            if(error.response.data.errors.asisten_id != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.asisten_id[0]
              });
          }
        }
      });
    },

    signOut: function(){

      const globe = this;
      this.pageActive = false;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/logoutAsisten')
        }, 1010); 
    },
  }
}
</script>
