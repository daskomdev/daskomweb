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
          <div class="w-full p-4 h-24 flex select-none animation-enable"
              :class="[{ 'bg-yellow-500 text-white': !changePage },
                      { 'bg-yellow-400 text-black': changePage }]">
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

    <!-- Kelas Layout -->
    <div class="relative left-0 h-full w-120full"
        @mouseover="isMenuShown = false;">

      <!-- List All Kelas -->
      <div class="absolute w-full h-full animation-enable"
          :class="[{ 'left-minFull': !currentPage },
                  { 'left-0': currentPage }]" v-bar>
        <div>
          <div class="w-full h-8"/>
          <transition-group name="kelas-list" tag="div">
            <div v-for="kelas in listAllKelas" v-bind:key="kelas.id" 
                class="animation-enable-short pr-8 hover:pr-4 opacity-75 cursor-pointer z-50 w-full h-16 flex text-center my-4 font-merri-bold text-3xl text-yellow-400"
                :class="'kelas-'+kelas.id"
                v-on:click="kelas != chosenKelas ? changeForm(kelas): resetForm(kelas)">
              <div class="w-3/6 h-full uppercase py-2 bg-green-700">
                {{ kelas.kelas }}
              </div>
              <div class="w-1/6 h-full uppercase py-2 bg-green-600">
                {{ kelas.hari }}
              </div>
              <div class="w-1/6 h-full py-1 bg-green-500 rounded-r-full text-yellow-300">
                {{ kelas.shift }}
              </div>
            </div>
          </transition-group>
          <div class="w-full h-8"/>
        </div>
      </div>

      <!-- Kelas Menu -->
      <div class="relative pointer-events-none w-full h-full flex animation-enable-short"
          :class="[{ 'opacity-25': !kelasMenuShown && !buttonHovered },
                  { 'opacity-100': kelasMenuShown || buttonHovered }]"
          @mouseover="changeForm(chosenKelas)" @mouseleave="changeForm(chosenKelas)">
        <div class="absolute px-8 w-full h-40 mb-4 flex animation-enable"
            :class="[{ 'bottom-min20rem': !currentPage },
                    { 'bottom-0': currentPage }]">
          <div class="w-full h-full flex">
            <div class="w-3/12 h-full"/>
            <div class="w-6/12 h-full pointer-events-auto" @mouseover="kelasMenuShown = true;" @mouseleave="kelasMenuShown = false">
              <div class="w-full h-full flex bg-gray-600 rounded-lg">
                <form id="kelasForm" class="w-full h-20 flex" ref="form">
                  <div class="w-3/6 py-2 px-4 h-full flex-row">
                    <span class="font-merri w-full text-left text-white text-lg h-1/4">
                      Kelas
                    </span>
                    <div class="w-full h-3/4">
                      <input v-model="formKelas.kelas"
                            class="font-overpass-mono-bold uppercase text-2xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                            id="Kelas" type="text" placeholder="EL-41-05">
                    </div>
                  </div>
                  <div class="w-2/6 py-2 px-1 h-full flex-row">
                    <span class="font-merri w-full text-left text-white text-lg h-1/4">
                      Hari
                    </span>
                    <div class="w-full h-3/4">
                      <input v-model="formKelas.hari"
                            class="font-overpass-mono-bold uppercase text-2xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                            id="Hari" type="text" placeholder="Senin">
                    </div>
                  </div>
                  <div class="w-1/6 py-2 px-4 h-full flex-row">
                    <span class="font-merri w-full text-left text-white text-lg h-1/4">
                      Shift
                    </span>
                    <div class="w-full h-3/4">
                      <input v-model="formKelas.shift"
                            class="font-overpass-mono-bold uppercase text-2xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                            id="Shift" type="text" placeholder="4">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="w-3/12 h-full"/>
          </div>
        </div>
        <div class="absolute px-8 w-full h-20 mb-4 flex animation-enable"
            :class="[{ 'bottom-min20rem': !currentPage },
                    { 'bottom-0': currentPage }]">
          <div class="w-full h-full flex">
            <div class="w-3/12 h-full"/>
            <div class="w-2/12 h-full p-4 hover:p-5 animation-enable-short cursor-pointer"
                @mouseover="kelasMenuShown = true; buttonHovered = true" 
                @mouseleave="buttonHovered = false; kelasMenuShown = false"
                v-on:click="createKelas">
              <div class="w-full h-full z-10 pointer-events-auto flex bg-gray-200 rounded-full">
                <div class="w-1/3 h-full flex">
                  <span class="ml-4 m-auto flex w-6 h-6">
                    <img class="w-full h-full fas fa-plus">
                  </span>
                </div>
                <div class="w-2/3 h-full flex font-monda-bold text-lg items-center ml-2">
                  Create
                </div>
              </div>
            </div>
            <div class="w-2/12 h-full z-10 pointer-events-auto p-4 hover:p-5 animation-enable-short cursor-pointer"
                @mouseover="kelasMenuShown = true; buttonHovered = true" 
                @mouseleave="buttonHovered = false; kelasMenuShown = false"
                v-on:click="deleteKelas">
              <div class="w-full h-full flex bg-gray-200 rounded-full">
                <div class="w-1/3 h-full flex">
                  <span class="ml-4 m-auto flex w-6 h-6">
                    <img class="w-full h-full fas fa-trash">
                  </span>
                </div>
                <div class="w-2/3 h-full flex font-monda-bold text-lg items-center ml-2">
                  Delete
                </div>
              </div>
            </div>
            <div class="w-2/12 h-full z-10 pointer-events-auto p-4 hover:p-5 animation-enable-short cursor-pointer"
                @mouseover="kelasMenuShown = true; buttonHovered = true" 
                @mouseleave="buttonHovered = false; kelasMenuShown = false"
                v-on:click="updateKelas">
              <div class="w-full h-full flex bg-gray-200 rounded-full">
                <div class="w-1/3 h-full flex">
                  <span class="ml-4 m-auto flex w-6 h-6">
                    <img class="w-full h-full fas fa-pen">
                  </span>
                </div>
                <div class="w-2/3 h-full flex font-monda-bold text-lg items-center ml-2">
                  Update
                </div>
              </div>
            </div>
            <div class="w-3/12 h-full"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.kelas-list-enter, .kelas-list-leave-to{
  opacity: 0;
  transform: translateX(-500px);
}
.kelas-list-move {
  transition: transform 1s;
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
      kelasMenuShown: false,
      buttonHovered: false,
      changePage: false,
      currentPage: false,

      menuProfil: false,
      menuPraktikum: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuSoal: false,
      menuModul: false,
      menuPlotting: false,
      menuKonfigurasi: false,
      menuTp: false,
      menuNilai: false,
      menuSetPraktikan: false,

      listAllKelas: this.allKelas === null ? [] : this.allKelas,

      formKelas: {
        id: '',
        oldKelas: '',
        kelas: '',
        hari: '',
        shift: '',
      },

      chosenKelas: {
        id: '',
        kelas: '',
        hari: '',
        shift: '',
      },
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
        this.comingFrom === 'konfigurasi' ||
        this.comingFrom === 'tp' ||
        this.comingFrom === 'polling' ||
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
      if($whereTo === "modul")
        this.menuModul = $bool;
      if($whereTo === "plotting")
        this.menuPlotting = $bool;
      if($whereTo === 'konfigurasi')
        this.menuKonfigurasi = $bool;
      if($whereTo === 'tp')
        this.menuTp = $bool;
      if($whereTo === 'nilai')
        this.menuNilai = $bool;
      if($whereTo === "setpraktikan")
        this.menuSetPraktikan = $bool;
    },

    resetForm: function($kelas){
      $('.kelas-'+this.chosenKelas.id).removeClass('opacity-100 pr-4');
      $('.kelas-'+this.chosenKelas.id).addClass('opacity-75 pr-8 hover:pr-4');

      this.formKelas.id = "";
      this.formKelas.oldKelas = "";
      this.formKelas.kelas = "";
      this.formKelas.hari = "";
      this.formKelas.shift = "";

      $("#kelasForm")[0].reset();
    },

    changeForm: function($kelas) {

      if(this.chosenKelas != $kelas){
        
        if(this.chosenKelas.id != null){
          $('.kelas-'+this.chosenKelas.id).removeClass('opacity-100 pr-4');
          $('.kelas-'+this.chosenKelas.id).addClass('opacity-75 pr-8 hover:pr-4');
        }
        $('.kelas-'+$kelas.id).removeClass('opacity-75 pr-8 hover:pr-4');
        $('.kelas-'+$kelas.id).addClass('opacity-100 pr-4');
        this.chosenKelas = $kelas;

        this.formKelas.oldKelas = $kelas.kelas;
        this.formKelas.kelas = $kelas.kelas;
        this.formKelas.hari = $kelas.hari;
        this.formKelas.id = $kelas.id;
        this.formKelas.shift = $kelas.shift.toString();

        document.getElementById("Kelas").value = this.chosenKelas.kelas;
        document.getElementById("Hari").value = this.chosenKelas.hari;
        document.getElementById("Shift").value = this.chosenKelas.shift;
      }

      if(this.chosenKelas.kelas === this.formKelas.kelas &&
          this.chosenKelas.hari === this.formKelas.hari &&
          this.chosenKelas.shift === this.formKelas.shift){

        this.formKelas.oldKelas = $kelas.kelas;
        this.formKelas.kelas = $kelas.kelas;
        this.formKelas.hari = $kelas.hari;
        this.formKelas.id = $kelas.id;
        this.formKelas.shift = $kelas.shift.toString();

        document.getElementById("Kelas").value = this.chosenKelas.kelas;
        document.getElementById("Hari").value = this.chosenKelas.hari;
        document.getElementById("Shift").value = this.chosenKelas.shift;
      }
    }, 

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=kelas&position='+globe.$refs.menu.scrollTop);
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

    updateKelas: function(){

      const globe = this;
      this.$axios.post('/updateKelas', this.formKelas).then(response => {
        
        console.log(response.data)
        if(response.data.message === "success") {

          globe.$toasted.global.showSuccess({
            message: "Kelas berhasil diperbaharui"
          });

          for(var i=0; i<globe.listAllKelas.length; i++){
            if(globe.listAllKelas[i].id === globe.formKelas.id){
              globe.listAllKelas[i] = response.data.kelas;
              break;
            }
          }

          globe.formKelas.id = "";
          globe.formKelas.oldKelas = "";
          globe.formKelas.kelas = "";
          globe.formKelas.hari = "";
          globe.formKelas.shift = "";

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
            if(error.response.data.errors.kelas != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.kelas[0]
              });
            if(error.response.data.errors.hari != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.hari[0]
              });
            if(error.response.data.errors.shift != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.shift[0]
              });
          }
        }
      });
    },

    deleteKelas: function(){

      const globe = this;

      if(this.chosenKelas.id != null){
        $('.kelas-'+this.chosenKelas.id).removeClass('opacity-100 pr-4');
        $('.kelas-'+this.chosenKelas.id).addClass('opacity-75 pr-8 hover:pr-4');
      } else {

        globe.$toasted.global.showError({
          message: "Pilih salah satu kelas yang ingin di hapus terlebih dahulu"
        });
        return;
      }
      this.$axios.post('/deleteKelas', this.formKelas).then(response => {
        
        if(response.data.message === "success") {

          globe.$toasted.global.showSuccess({
            message: "Kelas berhasil dihapus"
          });

          var i;
          for(i=0; i<globe.listAllKelas.length; i++){
            if(globe.listAllKelas[i].id === globe.formKelas.id){
              break;
            }
          }
          globe.listAllKelas.splice(i, 1);
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
            if(error.response.data.errors.kelas != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.kelas[0]
              });
            if(error.response.data.errors.hari != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.hari[0]
              });
            if(error.response.data.errors.shift != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.shift[0]
              });
          }
        }
      });
    },

    createKelas: function(){

      const globe = this;
      var notError = true;
      for(var i=0; i<this.listAllKelas.length; i++){
        if(this.listAllKelas[i].hari === globe.formKelas.hari &&
          this.listAllKelas[i].shift === globe.formKelas.shift) {

          globe.$toasted.global.showError({
            message: "Terdapat kelas "+ this.listAllKelas[i].kelas.toUpperCase() +" pada hari "+ globe.formKelas.hari +" shift "+ globe.formKelas.shift
          });
          notError = false;
          break;
        }
      }

      if(notError){
        this.$axios.post('/createKelas', this.formKelas).then(response => {
          
          if(response.data.message === "success") {

            globe.$toasted.global.showSuccess({
              message: "Kelas berhasil ditambahkan"
            });
            globe.listAllKelas.push({
              id: response.data.id,
              kelas: globe.formKelas.kelas,
              hari: globe.formKelas.hari,
              shift: globe.formKelas.shift,
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
              if(error.response.data.errors.kelas != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.kelas[0]
                });
              if(error.response.data.errors.hari != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.hari[0]
                });
              if(error.response.data.errors.shift != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.shift[0]
                });
            }
          }
        });
      }
    }
  }
}
</script>
