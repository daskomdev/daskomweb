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

        <div class="w-full p-4 h-24 flex select-none animation-enable"
            :class="[{ 'bg-yellow-500 text-white': !changePage },
                    { 'bg-yellow-400 text-black': changePage }]">
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

    <div class="absolute h-full w-120full flex-row animation-enable"
        :class="[{ 'bottom-minFull': !currentPage },
                { 'bottom-0': currentPage }]">
      <div class="w-full h-36 flex">
        <div class="w-full h-full p-4 flex">
          <div class="w-4full h-4full p-0 hover:p-1 cursor-pointer animation-enable-short m-auto flex"
              v-on:click="openQRCODEScanner()">
            <div class="w-full h-full bg-yellow-400 rounded-large flex">
              <div class="w-2/3 font-merri-bold bg-yellow-700 rounded-l-large text-white text-3xl tracking-widest h-full flex">
                <div class="w-auto h-auto m-auto">
                  <span>Scan QRCODE</span>
                </div>
              </div>
              <div class="w-1/3 rounded-r-large h-full flex">
                <span class="w-8 h-8 m-auto animation-enable-short text-gray-400">
                  <img class="w-full h-full fas fa-qrcode text-black">
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-full h-36full flex-row">
        <div class="w-full h-24 px-8 flex">
          <div class="w-1/2 h-full flex-row">
            <div class="font-merri w-full flex text-left text-yellow-400 text-2xl mb-2 h-1/3">
              <span class="h-auto my-auto">
                Kelas
              </span>
            </div>
            <div class="w-full h-1/2 tatkOption">
              <select v-model="chosenKelasID" :onchange="getCurrentKumpulTp()"
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
              <select v-model="chosenModulID" :onchange="getCurrentKumpulTp()"
                    class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">
                  {{ modul.judul }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="w-full h-24full px-8 flex">
          <div class="w-full h-full flex">
            <div v-if="chosenModulID === '' || chosenKelasID === ''"
                class="w-auto h-auto m-auto text-white font-overpass-bold text-3xl">
              <span>PILIH KELAS DAN MODUL DULU</span>
            </div>
            <div v-if="chosenModulID !== '' && chosenKelasID !== '' && listAllKumpulTP.length > 0" 
                class="w-full h-full flex">
              <div class="w-full h-full" 
                  v-bar>
                <transition-group name="listTp-list" tag="div">
                  <div v-for="kumpulTP in listAllKumpulTP" v-bind:key="kumpulTP.id" 
                      class="animation-enable w-full h-12 flex-row mb-4">
                    <div class="w-full h-10 flex">
                      <div class="w-2/3 h-full font-monda-bold text-green-200 text-2xl whitespace-pre-wrap break-words flex">
                        <span>{{ kumpulTP.nim }} [{{ kumpulTP.nama }}]</span>
                      </div>
                      <div class="w-1/3 h-auto my-auto font-overpass-bold text-green-200 text-lg flex">
                        <div class="w-auto h-full ml-auto">
                          <span>{{ kumpulTP.created_at }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="w-full h-2 py-1 flex bg-gray-300"/>
                  </div>
                </transition-group>
              </div>
            </div>
            <div v-if="chosenModulID !== '' && chosenKelasID !== '' && listAllKumpulTP.length === 0" 
                class="w-full h-full p-8 flex">
              <div class="w-auto h-auto m-auto font-monda-bold whitespace-pre-wrap break-words text-center text-4xl text-red-400">
                <span>BELUM ADA PRAKTIKAN YANG MENGUMPUL TP DI KELAS DAN MODUL INI</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="absolute rounded-lg w-16 h-16 bg-gray-300 m-8 p-3 cursor-pointer animation-enable z-50"
        :class="[{ 'bottom-0 right-0': showQrcodeScreen },
                { 'bottom-minFull right-minFull': !showQrcodeScreen }]"
        v-on:click="closeQRCODEScanner()">
      <svg class="w-full h-full" viewBox="0 0 24 24">
        <path fill="#38a169" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
      </svg>
    </div>

    <div class="absolute w-full h-full flex"
        :class="[{ 'visible': showQrcodeScreen },
                { 'invisible': !showQrcodeScreen }]">
      <qrcode-stream 
        class="w-full h-full"
        :camera="camera"
        @decode="onDecode" 
        @init="onInit">
        <div v-if="validationSuccess"
            class="w-full h-full p-8 bg-white opacity-90 flex">
          <div class="w-auto h-auto m-auto text-center"
              :class="[{ 'text-green-700': isSuccess },
                      { 'text-red-700': !isSuccess }]">
            <span class="font-monda-bold text-3xl whitespace-pre-wrap break-words">{{ message }}</span>
          </div>
        </div>

        <div v-if="validationFailure"
            class="w-full h-full bg-white opacity-90 flex">
          <div class="w-auto h-auto m-auto text-center text-black">
            <span class="font-monda-bold text-3xl">QRCODE tidak dapat dikenali</span>
            <br>
            <span class="font-overpass-mono text-xl">Silahkan Scan Ulang !</span>
          </div>
        </div>

        <div v-if="validationPending"
            class="w-full h-full bg-white opacity-90 flex">
          <div class="w-auto h-auto m-auto text-center text-black">
            <span class="font-monda-bold text-3xl">Memproses QRCODE ...</span>
            <br>
            <span class="font-overpass-mono text-xl">Harap Tunggu !</span>
          </div>
        </div>
      </qrcode-stream>
    </div>
  </div>
</template>

<style>
.listTp-list-enter, .listTp-list-leave-to{
  opacity: 0;
  transform: translateX(-100%);
}
.listTp-list-leave-active {
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
    'allModul',
    'allKelas',
  ],

  computed: {
    validationPending () {
      return this.isValid === undefined
        && this.camera === 'off'
    },

    validationSuccess () {
      return this.isValid === true
    },

    validationFailure () {
      return this.isValid === false
    }
  },

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
      showQrcodeScreen: false,

      menuPraktikum: false,
      menuSoal: false,
      menuKonfigurasi: false,
      menuHistory: false,
      menuPolling: false,
      menuKelas: false,
      menuPlotting: false,
      menuModul: false,
      menuProfil: false,
      menuTp: false,
      menuNilai: false,

      chosenKelasID: '',
      chosenModulID: '',
      currentKelasID: '',
      currentModulID: '',

      listAllKumpulTP: [],

      isValid: undefined,
      isSuccess: false,
      camera: 'off',
      decodedQrcode: '',
      message: '',
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
        this.comingFrom === 'tp' ||
        this.comingFrom === 'konfigurasi' ||
        this.comingFrom === 'history' ||
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
      if($whereTo === "konfigurasi")
        this.menuKonfigurasi = $bool;
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
      if($whereTo === "tp")
        this.menuTp = $bool;
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
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=listTp&position='+globe.$refs.menu.scrollTop);
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
    },

    openQRCODEScanner: function(){

      this.pageActive = false;
      this.currentPage = false;
      this.showQrcodeScreen = true;
      this.turnCameraOn();
    },

    closeQRCODEScanner: function(){

      this.pageActive = true;
      this.currentPage = true;
      this.showQrcodeScreen = false;
      this.turnCameraOff();
    },
    
    onInit (promise) {
      promise
        .catch(console.error)
        .then(this.resetValidationState)
    },

    getCurrentKumpulTp: function(){

      const globe = this;
      if(this.chosenKelasID === '' || this.chosenModulID === '')
        return;

      if(this.currentKelasID === this.chosenKelasID && this.currentModulID === this.chosenModulID)
        return;

      this.currentKelasID = this.chosenKelasID;
      this.currentModulID = this.chosenModulID;
      globe.$axios.post('/getKumpulTp/'+this.chosenKelasID+"/"+this.chosenModulID).then(response => {

        if(response.data.message === "success"){

          this.listAllKumpulTP = response.data.allKumpulTP;
        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
    },

    resetValidationState () {
      this.isValid = undefined
    },

    async onDecode (content) {
      this.turnCameraOff();
      
      const globe = this;

      try {
        var bytes  = CryptoJS.AES.decrypt(content, 'daskom_aja');
        var decryptedData = bytes.toString(CryptoJS.enc.Utf8);
        this.decodedQrcode = JSON.parse(decryptedData); 
      } catch (e) {
        console.log("error");
      }

      setTimeout(() => {
          
        if(this.decodedQrcode === ''){
          this.isValid = false;
          setTimeout(() => {
              
            this.turnCameraOn();
            return;
          }, 2500);

        } else {

          this.isValid = true;
  
          globe.$axios.post('/kumpulTp', this.decodedQrcode).then(response => {

            if(response.data.success === "yes")
              this.isSuccess = true;
            else
              this.isSuccess = false;
              
            this.message = response.data.message; 

            setTimeout(() => {
                
              this.turnCameraOn();
            }, 2500);
          });
        }
      }, 1500);
    },

    turnCameraOn () {
      this.camera = 'auto'
    },

    turnCameraOff () {
      this.camera = 'off'
    },

    timeout (ms) {
      return new Promise(resolve => {
        window.setTimeout(resolve, ms)
      })
    }
  }
}
</script>
