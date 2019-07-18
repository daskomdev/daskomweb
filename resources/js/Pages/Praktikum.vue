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

        <div class="w-full p-4 h-24 flex select-none animation-enable"
            :class="[{ 'bg-yellow-500 text-white': !changePage },
                    { 'bg-yellow-400 text-black': changePage }]">
          <div class="w-7/12 my-2 flex">
            <div class="w-4/6"/>
            <img class="select-none m-auto w-2/6 h-auto fas fa-code">
          </div>
          <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
            Praktikum
          </span>
        </div>

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

    <!-- Praktikum Layout -->
    <div class="relative h-full w-120full animation-enable"
        :class="[{ 'left-0': currentPage },
                { 'left-minFull': !currentPage }]"
        @mouseover="isMenuShown = false;">
      <div class="w-full h-full" v-bar>
        <div>
          <div class="w-full h-auto p-8">
            <div class="w-full h-24 flex">
              <div class="w-1/2 h-full flex-row">
                <div class="font-merri w-full flex text-left text-yellow-400 text-2xl mb-2 h-1/3">
                  <span class="h-auto my-auto">
                    Kelas
                  </span>
                </div>
                <div class="w-full h-1/2 tatkOption">
                  <select :onchange="getAllAsistenPraktikan()" v-model="chosenKelasID" 
                        class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                    <option v-for="kelas in allKelas" v-bind:key="kelas.id" :value="kelas.id">
                      {{ kelas.kelas }} [ {{ kelas.hari }} - Shift {{ kelas.shift }} ]
                    </option>
                  </select>
                </div>
              </div>
              <div class="w-1/2 pl-8 h-full flex-row">
                <div class="font-merri w-full flex text-left text-yellow-400 text-2xl mb-2 h-1/3">
                  <span class="h-auto my-auto">
                    Modul
                  </span>
                </div>
                <div class="w-full h-1/2 tatkOption">
                  <select v-model="chosenModulID"
                        class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                    <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">
                      {{ modul.judul }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="w-full h-auto mt-4 flex rounded-lg bg-gray-300">
              <div class="w-full h-auto flex"
                  v-if="listAllAsisten.length > 0 &&
                        listAllPraktikan.length > 0">
                <div class="w-1/3 h-auto flex-row">
                  <transition-group name="asisten-list" tag="div">
                    <div v-for="(asisten, index) in listAllAsisten" v-bind:key="asisten.id" 
                        class="animation-enable w-full flex-row"
                        :class="['h-'+ 12 * (praktikanComplete + (praktikanLeft-(index+1) >= 0 ? 1 : 0)),
                                { 'bg-gray-300 text-black': index % 2 == 0 },
                                { 'bg-gray-600 text-white': index % 2 != 0 },
                                { 'rounded-tl-lg': index == 0 },
                                { 'rounded-bl-lg': index+1 == listAllAsisten.length }]">
                      <div class="w-full h-1/2 flex">
                        <div class="mx-auto mt-auto font-overpass-bold pt-8 text-4xl">
                          {{ asisten.kode }}
                        </div>
                      </div>
                      <div class="w-full flex">
                        <div class="mx-auto mb-auto font-merri text-2xl">
                          {{ index }}
                        </div>
                      </div>
                    </div>
                  </transition-group>
                </div>

                <div class="w-2/3 h-auto flex-row">
                  <transition-group name="asisten-list" tag="div">
                    <div v-for="(praktikan, index) in listAllPraktikan" v-bind:key="praktikan.id" 
                        class="animation-enable w-full h-12 flex-row">
                      <div class="w-full h-full flex"
                        :class="[{ 'rounded-tr-lg': index == 0 },
                                { 'rounded-br-lg': index == listAllPraktikan.length-1 },
                                { 'bg-gray-600 text-white': 
                                    parseInt((praktikanLeft - (index / (praktikanComplete + 1)) > 0 ? index : index+(praktikanComplete - praktikanLeft)) / 
                                      (praktikanLeft - (index / (praktikanComplete + 1)) > 0 ? praktikanComplete+1 : praktikanComplete)) 
                                    % 2 == (praktikanLeft - (index / (praktikanComplete + 1)) > 0 ? 0 : (praktikanLeft % 2 == 1 && praktikanLeft < praktikanComplete || praktikanLeft == praktikanComplete ? 0 : 1)) }]">
                        <div class="m-auto font-monda text-2xl whitespace-pre-wrap">{{ praktikan.nim.substring(0,6) }}   {{ praktikan.nim.substring(6,10) }}</div>
                      </div>
                    </div>
                  </transition-group>
                </div>
              </div>
              <div class="w-auto m-auto h-24 items-center font-monda-bold text-2xl flex"
                  v-if="listAllPraktikan < 1">
                Tidak ada PRAKTIKAN di kelas ini
              </div>
              <div class="w-auto m-auto h-24 items-center font-merri-bold text-4xl flex"
                  v-if="listAllAsisten.length < 1 &&
                        listAllPraktikan.length < 1">
                &
              </div>
              <div class="w-auto m-auto h-24 items-center font-monda-bold text-2xl flex"
                  v-if="listAllAsisten < 1">
                Tidak ada ASISTEN di kelas ini
              </div>
            </div>

            <div class="w-full h-24 mt-4 flex">
              <div class="w-1/2 h-full flex py-4 px-8 hover:px-10 hover:py-5 animation-enable-short cursor-pointer"
                  v-on:click="shuffleEmAll()">
                <div class="w-full h-full flex font-monda-bold text-4xl bg-yellow-400 rounded-full">
                  <div class="w-auto h-auto m-auto">
                    SHUFFLE
                  </div>
                </div>
              </div>
              <div class="w-1/2 h-full flex py-4 px-8 hover:px-10 hover:py-5 animation-enable-short cursor-pointer">
                <div class="w-full h-full flex font-monda-bold text-4xl bg-yellow-400 rounded-full">
                  <div class="w-auto h-auto m-auto">
                    START
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.asisten-list-enter, .asisten-list-leave-to{
  opacity: 0;
  transform: translateY(100%);
}
.asisten-list-leave-active {
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
    'allKelas',
    'allModul',
  ],

  data() {
    return {
      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,

      formHovered: false,
      buttonHovered: false,

      menuProfil: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuSoal: false,
      menuKelas: false,
      menuModul: false,
      menuPlotting: false,

      listAllAsisten: [],
      listAllPraktikan: [],

      oldKelasID: '',
      chosenKelasID: '',
      chosenModulID: '',
      praktikanComplete: '',
      praktikanLeft: '',
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.$refs.menu.scrollTop = this.position;

    const globe = this;

    if(this.comingFrom == 'asisten' ||
        this.comingFrom == 'none' ||
        this.comingFrom == 'kelas'||
        this.comingFrom == 'soal'||
        this.comingFrom == 'plotting'||
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
      if($whereTo == "soal")
        this.menuSoal = $bool;
      if($whereTo == "listTp")
        this.menuListTp = $bool;
      if($whereTo == "history")
        this.menuHistory = $bool;
      if($whereTo == "polling")
        this.menuPolling = $bool;
      if($whereTo == "asisten")
        this.menuProfil = $bool;
      if($whereTo == "kelas")
        this.menuKelas = $bool;
      if($whereTo == "modul")
        this.menuModul = $bool;
      if($whereTo == "plotting")
        this.menuPlotting = $bool;
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=praktikum&position='+globe.$refs.menu.scrollTop);
        }, 501); 
    },

    shuffleEmAll: function(){

      const globe = this;
      if(this.chosenKelasID == ""){

        globe.$toasted.global.showError({
          message: "Pilih kelas terlebih dahulu"
        });
        return;
      }

      if(this.listAllAsisten == ""){

        globe.$toasted.global.showError({
          message: "Tidak terdapat asisten di kelas ini"
        });
        return;
      }

      if(this.listAllPraktikan == ""){

        globe.$toasted.global.showError({
          message: "Tidak terdapat praktikan di kelas ini"
        });
        return;
      }
      
      for (let i = this.listAllAsisten.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [this.listAllAsisten[i], this.listAllAsisten[j]] = [this.listAllAsisten[j], this.listAllAsisten[i]];
      }

      for (let i = this.listAllPraktikan.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [this.listAllPraktikan[i], this.listAllPraktikan[j]] = [this.listAllPraktikan[j], this.listAllPraktikan[i]];
      }
    },

    getAllAsistenPraktikan: function(){

      const globe = this;
      if(this.chosenKelasID == "" || this.chosenKelasID == this.oldKelasID)
        return;

      this.oldKelasID = this.chosenKelasID;

      this.$axios.post('/readDataKelas/'+this.chosenKelasID).then(response => {

        if(response.data.message == "success") {

          globe.listAllAsisten = response.data.all_asisten;
          globe.listAllPraktikan = response.data.all_praktikan;
          globe.praktikanLeft = response.data.all_praktikan.length % response.data.all_asisten.length;
          globe.praktikanComplete = parseInt(response.data.all_praktikan.length / response.data.all_asisten.length);
          
        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      }).catch(function (error) {
        if (error.response) {
          globe.$toasted.global.showError({
            message: error.response.data
          });
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
