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

        <!-- Role Based Menu -->
        <div v-if="kelasPriviledge.includes(currentUser.role_id)">
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

        <div v-if="soalPriviledge.includes(currentUser.role_id)">
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

        <div v-if="plottingPriviledge.includes(currentUser.role_id)">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuPlotting },
                      { 'bg-yellow-500 text-white': changePage && menuPlotting }]"
              v-on:click='travel("plotting")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-calendar-alt">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Plotting
            </span>
          </div>
        </div>

        <div v-if="modulPriviledge.includes(currentUser.role_id)">
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

        <div v-if="konfigurasiPriviledge.includes(currentUser.role_id)">
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
        
        <div v-if="tpPriviledge.includes(currentUser.role_id)">
          <div class="w-full p-4 h-24 flex select-none animation-enable"
              :class="[{ 'bg-yellow-500 text-white': !changePage },
                      { 'bg-yellow-400 text-black': changePage }]">
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
            <span class="select-none font-overpass-mono-bold text-5xl self-end text-left w-full -mb-2 uppercase tracking-widest"
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

    <div class="absolute w-120full h-full flex-row animation-enable"
        :class="[{ 'left-minFull': !currentPage },
                { 'left-0': currentPage }]">
      <div class="w-full h-full flex">
        <div class="w-full h-full" v-bar>
          <div>
            <transition-group name="tp-list" tag="div">
              <div v-for="(tp, index) in listAllTP" v-bind:key="tp.id" 
                  class="animation-enable w-full h-48 flex p-6">
                <div class="w-full h-full flex">
                  <div class="w-1/3 h-full rounded-l-lg bg-yellow-700 flex-row">
                    <div class="w-full h-2/3 whitespace-pre-wrap font-monda-bold text-2xl p-2 text-white break-words flex">
                      <div class="w-full h-full" v-bar>
                        <div>
                          <span>{{ tp.judul }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="w-full h-1/3 flex">
                      <div class="w-auto h-auto m-auto"
                          v-on:click="setActive(index)">
                        <toggle-button
                          v-model="tp.isActive"
                          :value="tp.isActive"
                          :sync="true"
                          :labels="true"
                          :width="100"
                          :height="30"
                          :font-size="15"/>
                      </div>
                    </div>
                  </div>
                  <div class="w-2/3 h-full bg-green-300 rounded-r-lg flex overflow-y-auto">
                    <div class="w-full h-full flex font-overpass text-xl p-2 whitespace-pre-wrap break-words">
                      <span>{{ tp.pembahasan }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </transition-group>
            <div class="w-full h-48 mb-8"/>
          </div>
        </div>
      </div>
      <div class="w-full h-48 p-6 z-20 absolute bottom-0 left-0 flex">
        <form id="tpForm" class="pointer-events-auto relative flex w-full h-full bg-gray-400 rounded-lg">
          <div class="h-full w-full">
            <div class="w-full py-2 px-5 h-full flex-row">
              <span class="font-merri w-full text-left text-gray-700 text-lg h-4">
                Modul
              </span>
              <div class="w-full h-4full">
                <select v-model="formTP.modul_id"
                      class="block font-monda-bold text-xl whitespace-pre-wrap break-words appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                  <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">
                    <span>{{ modul.judul }}</span>
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="absolute bottom-0 right-0 mr-4 mb-4 w-12 h-12 p-0 hover:p-1 animation-enable-short">
            <span class="w-full h-full cursor-pointer"
                v-on:click="createTP()">
              <img class="w-full p-3 h-full bg-gray-700 text-white rounded-full fas fa-plus">
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style>
.tp-list-enter, .tp-list-leave-to{
  opacity: 0;
  transform: translateX(-100%);
}
.tp-list-leave-active {
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
    'allTP',
    'allModul',
  ],

  data() {
    return {
      kelasPriviledge: [],
      plottingPriviledge: [1,2,4,5],
      modulPriviledge: [1,2,4,15,7],
      konfigurasiPriviledge: [1,2,4,18,7],
      tpPriviledge: [1,2,15,11,7],
      soalPriviledge: [1,2,15,11,7],

      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,

      listAllTP: this.allTP === 'nope' ? [] : this.allTP,

      formTP: {
        modul_id: '',
        pembahasan: 'abaikan ini',
      },
      processing: false,

      menuPraktikum: false,
      menuSoal: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuKelas: false,
      menuPlotting: false,
      menuModul: false,
      menuProfil: false,
      menuKonfigurasi: false,
      menuNilai: false,
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.$refs.menu.scrollTop = this.position;

    const globe = this;

    if(this.comingFrom === 'asisten' ||
        this.comingFrom === 'none' ||
        this.comingFrom === 'soal'||
        this.comingFrom === 'modul'||
        this.comingFrom === 'praktikum' ||
        this.comingFrom === 'plotting' ||
        this.comingFrom === 'kelas' ||
        this.comingFrom === 'konfigurasi' ||
        this.comingFrom === 'listTp' ||
        this.comingFrom === 'history'||
        this.comingFrom === 'nilai'){

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
      if($whereTo === "kelas")
        this.menuKelas = $bool;
      if($whereTo === "modul")
        this.menuModul = $bool;
      if($whereTo === "plotting")
        this.menuPlotting = $bool;
      if($whereTo === "asisten")
        this.menuProfil = $bool;
      if($whereTo === "konfigurasi")
        this.menuKonfigurasi = $bool;
      if($whereTo === "nilai")
        this.menuNilai = $bool;
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=tp&position='+globe.$refs.menu.scrollTop);
        }, 501); 
    },

    setActive: function(index){
      const globe = this;
      if(!this.processing)
        this.processing = true;
      else {
        this.processing = false;
        if(this.listAllTP[index].isActive === false){
          this.listAllTP.forEach(element => {
            if(element.id !== this.listAllTP[index].id)
              if(this.listAllTP[index].isEnglish === element.isEnglish)
                element.isActive = false;
          });
          this.$axios.post('/activateTP/'+this.listAllTP[index].modul_id).then(response => {
            if(response.data.message === "success") {

              globe.$toasted.global.showSuccess({
                message: "Pembahasan TP berhasil diaktifkan"
              });
            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          })
        } else
          this.$axios.post('/deactivateTP/'+this.listAllTP[index].modul_id).then(response => {
            if(response.data.message === "success") {

              globe.$toasted.global.showSuccess({
                message: "Pembahasan TP berhasil dinonaktifkan"
              });
            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          })
      }
    },

    createTP: function(){

      const globe = this;
      this.$axios.post('/addPembahasanTP', this.formTP).then(response => {

        if(response.data.message === "success") {

          $("#tpForm")[0].reset();

          var judul;
          for (let index = 0; index < globe.allModul.length; index++) {
            const element = globe.allModul[index];
            if(element.id === globe.formTP.modul_id){
              judul = element.judul;
              break;
            }
          }

          for (let index = 0; index < globe.listAllTP.length; index++) {
            const element = globe.listAllTP[index];
            if(element.modul_id === globe.formTP.modul_id){
              element.pembahasan = globe.formTP.pembahasan;
              globe.$toasted.global.showSuccess({
                message: 'Pembahasan TP modul "'+ element.judul +'"<br>berhasil diperbaharui'
              });
              return;
            }
          }

          globe.listAllTP.push({
            id: response.data.id,
            modul_id: globe.formTP.modul_id,
            judul: judul,
            pembahasan: globe.formTP.pembahasan,
            isActive: false,
          })

          globe.$toasted.global.showSuccess({
            message: "Pembahasan TP berhasil ditambahkan"
          });
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
            if(error.response.data.errors.modul_id != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.modul_id[0]
              });
            if(error.response.data.errors.pembahasan != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.pembahasan[0]
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
