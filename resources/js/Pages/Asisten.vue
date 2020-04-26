<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">

    <!-- Main Layout -->
    <div class="absolute z-10 bottom-0 flex h-48full w-4full rounded-tl-large bg-yellow-500 animation-enable"
        :class="[{ 'right-0': pageActive && !isMessageShown },
                { 'right-minFull': !pageActive || changePage || isMessageShown }]">
      <div class="w-120full flex-row">
        <div class="mx-auto mt-4 px-4 break-words text-green-800 font-merri-bold text-4xl text-center">
          {{ currentUser.nama }}
        </div>
        <div class="relative w-full h-full">
          <div class="absolute w-full h-full px-8 pt-8">
            <div class="bg-yellow-800 rounded-t-lg w-full h-full flex">
              <div class="w-full h-auto break-words pt-16 text-center text-yellow-200 font-merri text-2xl p-8">
                <span class="whitespace-pre-wrap">{{ currentUser.deskripsi }}</span>
              </div>
            </div>
          </div>
          <div class="absolute w-full h-16 px-16 pt-2">
            <div class="bg-yellow-700 rounded-lg w-full h-full flex">
              <div class="flex w-1/2min">
                <star-rating class="ml-auto mr-4"
                  style="width: 150px;" 
                  :increment="0.01" 
                  :fixed-points="2"
                  :read-only="true"
                  :show-rating="false"
                  :rating="ratingAsisten"
                  :star-size='30'/>
              </div>
              <div class="w-1 h-3/4 my-auto bg-yellow-500"/>
              <div class="flex w-1/2min mr-auto h-full pt-1 items-center font-overpass-bold text-2xl text-white ml-4">
                <span class="whitespace-pre-wrap">Rp. {{ gajiAsisten }}</span> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Menu -->
    <div class="absolute w-120 z-20 h-48full bottom-0 right-0"
        :class="[{ 'right-0': pageActive },
                { 'right-min20rem': !pageActive },
                { 'animation-enable': animate }]" @mouseover="isMenuShown = false">
      <div class="w-full h-full animation-enable overflow-y-auto"
          :class="[{ 'rounded-none': !changePage },
                  { 'rounded-tl-large': changePage || isMessageShown }]" ref="menu">
        <div class="w-full p-4 h-24 flex select-none animation-enable"
            :class="[{ 'bg-yellow-500 text-white': !changePage },
                    { 'bg-yellow-400 text-black': changePage }]">
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

        <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
            :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuPolling },
                    { 'bg-yellow-500 text-white': changePage && menuPolling }]"
            v-on:click='travel("polling")'>
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

        <div v-if="pelanggaranPriviledge.includes(currentUser.role_id) || pelanggaranPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuPelanggaran },
                      { 'bg-yellow-500 text-white': changePage && menuPelanggaran }]"
              v-on:click='travel("pelanggaran")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-radiation-alt">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Pelanggaran
            </span>
          </div>
        </div> 
      </div>
    </div>

    <!-- Profile Menu -->
    <div class="w-72 bg-gray-200 absolute top-0 mr-6 mt-4 h-40 rounded-lg flex-row"
        :class="[{ 'hidden': !isMenuShown },
                { 'visible': isMenuShown },
                { 'right-min20rem': !pageActive },
                { 'right-0': pageActive },
                { 'animation-enable': animate }]" @mouseover="isMenuShown = true" @mouseleave="isMenuShown = false">
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
    <div class="absolute top-0 w-120 flex"
        :class="[{ 'right-0': pageActive },
                { 'right-min20rem': !pageActive },
                { 'h-48': !isMenuShown },
                { 'h-36': isMenuShown },
                { 'animation-enable': animate }]" @mouseover="isMenuShown = true">
      <div class="w-auto m-auto h-full flex">
        <div class="w-24 h-full flex mr-4">
          <div class="flex w-24 h-24 m-auto rounded-full"
              :class="[{ 'bg-green-400': !isMenuShown },
                      { 'bg-green-600': isMenuShown }]">
            <img class="select-none w-20 h-20 m-auto rounded-full bg-white object-cover" :src="'/assets/'+currentUser.kode+'.jpg'" alt="daskom logo">
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

    <!-- Message Menu -->
    <div class="absolute left-0 h-full w-120full flex" @mouseover="isMenuShown = false">

      <!-- Dummy Message Animation -->
      <div class="absolute top-0 left-0 w-full pr-16 animation-enable"
          :class="[{ 'h-16full': isMessageShown },
                  { 'h-16': !isMessageShown },
                  { 'top-0': pageActive },
                  { 'top-minFull': !pageActive || changePage }]">
        <div class="w-full h-full flex rounded-br-large bg-green-600">
          <div class="w-16full h-full"/>
          <div class="w-12 h-10 mt-auto mb-3 z-40 cursor-pointer pointer-events-auto" v-on:click="openMessage">
            <div class="animation-enable" 
                :class="[{ 'unrotated ml-0': !isMessageShown }, { 'rotated ml-8': isMessageShown }]">
              <span class="animation-enable" 
                  :class="[{ 'text-white': !isMessageShown }, { 'text-black': isMessageShown }]">
                <img class="w-full h-10 ml-2 fas fa-arrow-circle-down">
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Message Layout -->
      <div class="absolute top-0 left-0 w-full z-30 animation-enable"
          :class="[{ 'h-16full pr-16': isMessageShown },
                  { 'h-16 pr-32': !isMessageShown },
                  { 'top-0': pageActive },
                  { 'top-minFull': !pageActive || changePage }]">
        <div class="bg-green-300 border-green-600 w-full h-full relative animation-enable"
          :class="[{ 'rounded-br-large border-r-4 border-b-4': isMessageShown },
                  { 'rounded-0 border-r-0 border-b-0': !isMessageShown },]">
          <div class="flex w-full h-full"
              :class="[{ 'visible': !isMessageShown },
                      { 'hidden': isMessageShown }]">
            <span v-if="unreadMessages > 0" class="m-auto font-monda-bold text-2xl tracking-wide">
              Ada 
              <span class="text-yellow-700">
                {{ unreadMessages }}
              </span> 
              pesan baru
            </span>
            <span v-else class="m-auto font-monda-bold text-2xl tracking-wide">
              Tidak ada pesan baru
            </span>
          </div>

          <div class="absolute w-full h-full" v-bar>
            <div class="flex-row w-full h-full"
                :class="[{ 'visible': isMessageShown },
                        { 'hidden': !isMessageShown }]">

              <div class="w-4full px-4 h-auto min-h-24 mb-16 my-4 flex relative"
                  v-for="message in userMessages" v-bind:key="message.id">
                <div class="flex pl-4 pr-4 pt-2 rounded-lg bg-gray-500 w-4full font-overpass-mono-bold text-2xl">
                  <div class="w-full h-full break-words">
                    {{ message.pesan }}
                    <div class="w-full h-8"/>
                  </div>
                </div>
                <div class="flex absolute pt-1 h-8 font-merri text-lg pl-4 pr-2 pb-1 left-0 ml-8 rounded-full bottom-min1rem bg-yellow-500 w-7/12">
                  <span class="w-10/12">
                    {{ message.nama }}
                  </span>
                  <div class="w-2/12 flex" v-if="!message.read">
                    <span class="w-auto px-4 py-1 font-overpass-bold text-sm rounded-full bg-red-500 ml-auto">
                      New !
                    </span>
                  </div>
                </div>
                <div class="absolute pt-1 h-8 font-merri text-lg px-4 right-0 mr-8 rounded-full bottom-min1rem bg-yellow-500 text-center w-2/12">
                  {{ message.kelas }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="absolute bottom-0 w-full h-full z-50"
        :class="[{ 'visible' : vidEnabled },
                { 'hidden' : !vidEnabled }]">
      <div class="bg-black w-full h-full">
        <div class="absolute w-full h-full text-white px-12 pt-2 text-justify font-monda-bold text-lg animation-enable flex"
            :class="[{ 'opacity-100' : textOn },
                    { 'opacity-0' : !textOn }]">
          <span class="w-auto h-auto m-auto">
            Terima kasih ya sudah menjadi salah satu bagian untuk berproses selama di telyu, terlebih di dunia seperlab-an. Gak kerasa ya akhirnya bisa sampe garis finish tanpa berkurangnya satu personil pun dari kita (walaupun ada jenuh dan bosennya hehe). Setelah perjalanan di daskom ini, semoga kalian, kita, bisa sukses di perjalanan selanjutnya. Jangan lupain perjalanan disini ya! Luv 17 ❤️ - by KUR
          </span>
        </div>

        <video id="secretVid" class="absolute w-full h-full" controls
            :class="[{ 'opacity-100' : !textOn },
                    { 'opacity-0' : textOn }]">
          <source src="/assets/daskomend.mp4" type="video/mp4">
          <source src="/assets/daskomend.ogg" type="video/ogg">
          Your browser does not support the video tag.
        </video> 
      </div>
    </div>
  </div>
</template>
<style>
  .rotated {
    transform: rotate(180deg);
  }

  .unrotated {
    transform: rotate(0deg);
  }
</style>

<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
    'messages',
    'userRole',
  ],

  data() {
    return {
      kelasPriviledge: [],
      plottingPriviledge: [1,2,4,5],
      modulPriviledge: [1,2,4,15,7],
      konfigurasiPriviledge: [1,2,4,18,7],
      tpPriviledge: [1,2,15,11,7],
      pelanggaranPriviledge: [1,2,4,5,6,18],
      soalPriviledge: "all",

      asisten17: [
        'FAI',
        'SAT',
        'RIF',
        'DIV',
        'BDT',
        'CHN',
        'CYN',
        'SRG',
        'PAN',
        'KUR',
        'LUD',
        'PRO',
        'HRD',
        'EZA',
        'REY',
        'HOL',
        'CAD',
        'RKI',
        'SAS',
        'FIA',
        'CHA',
        'CDY',
      ],

      pageActive: false,
      isMenuShown: false,
      isMessageShown: false,
      animate: true,
      userMessages: this.messages,
      changePage: false,

      textOn: false,
      vidEnabled: false,

      gajiAsisten: 0,
      ratingAsisten: 0,

      menuPraktikum: false,
      menuSoal: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuKelas: false,
      menuPlotting: false,
      menuModul: false,
      menuKonfigurasi: false,
      menuTp: false,
      menuNilai: false,
      menuSetPraktikan: false,
      menuPelanggaran: false,
    }
  },

  computed: {
    
    unreadMessages: function () {

      var i = 0;

      if(this.isEmpty(this.userMessages)){
        return 0;
      }

      this.userMessages.forEach(function(element) {
        if(!element.read)
          i++
      });
      return i;
    }
  },

  mounted() {

    $('body').addClass('closed');

    const globe = this;

    if(this.comingFrom === 'login' ||
        this.comingFrom === 'none'){

      setTimeout(
        function() {
          globe.pageActive = true;
        }, 10); 
    } else if(this.comingFrom === 'kelas' ||
              this.comingFrom === 'soal'  ||
              this.comingFrom === 'modul'||
              this.comingFrom === 'plotting'||
              this.comingFrom === 'praktikum' ||
              this.comingFrom === 'konfigurasi' ||
              this.comingFrom === 'tp'||
              this.comingFrom === 'polling' ||
              this.comingFrom === 'listTp' ||
              this.comingFrom === 'history' ||
              this.comingFrom === 'nilai' ||
              this.comingFrom === 'pelanggaran' ||
              this.comingFrom === 'setpraktikan'){

      this.animate = false;
      this.pageActive = true;
      this.changePage = true;
      this.setCurrentMenu(this.comingFrom, true);
      setTimeout(
        function() {
          globe.changePage = false;
          globe.setCurrentMenu(globe.comingFrom, false);
          globe.animate = true;
        }, 10); 
    }

    globe.$axios.get('/getProfilAsisten/'+globe.currentUser.id).then(response => {

      if(response.data.message === "success") {
        globe.ratingAsisten = response.data.ratingAsisten;
        globe.gajiAsisten = response.data.gajiAsisten;

      } else {
        globe.$toasted.global.showError({
          message: response.data.message
        });
      }
    });

    if(globe.asisten17.includes(globe.currentUser.kode) && 
        (globe.getCookie("video") != "done")) {
      globe.vidEnabled = true;
      globe.textOn = true;

      var vid = document.getElementById("secretVid");
      vid.onended = function() {
        globe.vidEnabled = false;
        globe.setCookie("video", "done", 365);
      };

      setTimeout(
          function() {
            globe.textOn = false;
            vid.play(); 
          }, 8000);
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
      if($whereTo === "konfigurasi")
        this.menuKonfigurasi = $bool;
      if($whereTo === "tp")
        this.menuTp = $bool;
      if($whereTo === "nilai")
        this.menuNilai = $bool;
      if($whereTo === "setpraktikan")
        this.menuSetPraktikan = $bool;
      if($whereTo === "Pelanggaran")
        this.menuPelanggaran = $bool;
    },

    travel: function($whereTo){
      const globe = this;
      this.setCurrentMenu($whereTo, true);
      this.changePage = true;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=asisten&position='+globe.$refs.menu.scrollTop);
        }, 501); 
    },

    setCookie: function(name, value, days){
      
      var expires = "";
      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days*24*60*60*1000));
          expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    },

    getCookie: function(name){
      
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for(var i=0;i < ca.length;i++) {
          var c = ca[i];
          while (c.charAt(0)==' ') c = c.substring(1,c.length);
          if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
    },

    openMessage: function(){

      this.$axios.post('/readPesan').then(response => {
        //Do nothing 
      }).catch(function (error) {
        if (error.response) {
          globe.$toasted.global.showError({
            message: error.response.data.errors
          });
        }
      });

      this.isMessageShown = !this.isMessageShown
    },

    isEmpty: function (obj) {
      for(var key in obj) {
          if(obj.hasOwnProperty(key))
              return false;
      }
      return true;
    },

    signOut: function(){

      const globe = this;
      this.pageActive = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/logoutAsisten')
        }, 1010); 
    }
  }
}
</script>
