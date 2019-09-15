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
          <div class="w-full p-4 h-24 flex select-none animation-enable"
              :class="[{ 'bg-yellow-500 text-white': !changePage },
                      { 'bg-yellow-400 text-black': changePage }]">
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

    <!-- Modul Layout -->
    <div class="relative left-0 h-full w-120full"
        @mouseover="isMenuShown = false;">

      <!-- Modul Menu -->
      <div class="absolute z-20 w-full h-120 animation-enable pointer-events-none"
          :class="[{ 'top-0': modulMenuShown || openedMenu },
                  { 'top-min20rem': !modulMenuShown && !openedMenu },
                  { 'top-min18rem': !modulMenuShown && openedMenu },
                  { 'left-0': currentPage },
                  { 'left-minFull': !currentPage }]">
        <div class="w-full h-full relative p-8 pointer-events-none">
          <form id="modulForm" class="pointer-events-auto relative flex w-full h-full bg-gray-400 rounded-lg">
            <div class="h-full w-1/3">
              <div class="w-full py-2 px-5 h-1/4 flex-row">
                <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
                  Judul
                </span>
                <div class="w-full h-3/4">
                  <input v-model="formModul.judul"
                        class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                        id="Kelas" type="text" placeholder="Pengenalan Bahasa C">
                </div>
              </div>
              <div class="w-full py-2 px-5 h-1/2 flex-row">
                <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
                  Deskripsi
                </span>
                <div class="w-full h-3/4">
                  <textarea v-model="formModul.deskripsi" cols="30" rows="10" 
                        class="font-overpass-bold text-lg bg-gray-200 resize-none appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                        id="Kelas" type="text" 
                        placeholder='Modul ini menjelaskan apa itu bahasa C dan cara menggunakannya'/>
                </div>
              </div>
              <div class="w-full py-2 px-5 h-1/4 flex">
                <div class="w-1/2 h-full flex">
                  <div class="w-auto h-auto my-auto ml-auto font-merri text-lg text-gray-700">
                    <span>isEnglish</span>
                  </div>
                </div>
                <div class="w-1/2 h-full flex">
                  <div class="w-auto h-auto m-auto">
                    <toggle-button
                      v-model="formModul.isEnglish"
                      :value="formModul.isEnglish"
                      :sync="true"
                      :labels="true"
                      :width="100"
                      :height="30"
                      :font-size="15"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="h-full w-2/3">
              <div class="w-full px-5 h-full flex-row pt-2 pb-4">
                <span class="font-merri w-full text-left text-gray-700 text-lg h-4">
                  Isi
                </span>
                <div class="w-full h-5/4 h-4full">
                  <textarea v-model="formModul.isi" cols="30" rows="10"
                        class="font-overpass-mono-bold text-base bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                        id="Kelas" type="text" placeholder="EL-41-05"/>
                </div>
              </div>
            </div>
            <div class="absolute bottom-0 right-0 mr-4 mb-4 w-12 h-12 p-0 hover:p-1 animation-enable-short">
              <span class="w-full h-full cursor-pointer"
                  :class="[{ 'visible': !editing },
                          { 'hidden': editing }]"
                  v-on:click="createModul">
                <img class="w-full p-3 h-full bg-gray-700 text-white rounded-full fas fa-plus">
              </span>
              <span class="w-full h-full cursor-pointer"
                  :class="[{ 'visible': editing },
                          { 'hidden': !editing }]"
                  v-on:click="updateModul">
                <img class="w-full p-3 h-full bg-gray-700 text-white rounded-full fas fa-check">
              </span>
            </div>
          </form>
          <div class="absolute bottom-0 w-full h-8 pr-16 flex">
            <div class="w-8 h-8 text-white m-auto">
              <span class="w-full h-full flex cursor-pointer pointer-events-auto"
                    :class="[{ 'visible': modulMenuShown },
                            { 'hidden': !modulMenuShown }]"
                    v-on:click="modulMenuShown = false">
                <img class="w-full h-full fas fa-caret-up">
              </span>
              <span class="w-full h-full flex cursor-pointer pointer-events-auto"
                    :class="[{ 'visible': !modulMenuShown },
                            { 'hidden': modulMenuShown }]"
                    v-on:click="modulMenuShown = true">
                <img class="w-full h-full fas fa-caret-down">
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- List All Modul -->
      <div class="absolute w-full h-full animation-enable"
          :class="[{ 'bottom-minFull': !currentPage },
                  { 'bottom-0': currentPage }]" v-bar>
        <div>
          <div class="w-full animation-enable"
              :class="[{ 'h-120': modulMenuShown },
                      { 'h-0': !modulMenuShown }]"/>
          <div class="w-full h-8"/>
          <transition-group name="modul-list" tag="div">
            <div v-for="modul in listAllModul" v-bind:key="modul.id" 
                class="animation-enable w-full h-48 flex mb-8"
                :class="'modul-'+modul.id">

              <div class="w-4full absolute flex-row animation-enable"
                  :class="[{ 'h-4full pb-8 pt-40': moreOpened },
                          { 'h-0 pb-0 pt-0': !moreOpened }]">
                <div class="w-full h-full bg-gray-200 rounded-br-lg flex overflow-y-auto">
                  <span class="w-full h-full px-8 pt-8 whitespace-pre-line break-words pb-8 text-2xl font-overpass-bold text-justify">
                    {{ modul.isi }}
                  </span>
                </div>
              </div>

              <div class="w-24full z-10 h-48 flex-row bg-gray-500">
                <div class="w-full flex h-1/4">
                  <div class="w-auto font-merri-bold text-xl text-center h-full flex rounded-br-lg bg-gray-300">
                    <span class="my-auto px-8">
                      {{ modul.judul }} {{ modul.isEnglish ? '(English)' : '(Indonesia)' }}
                    </span>
                  </div>
                </div>
                <div class="w-full h-3/4 flex">
                  <div class="w-full h-full text-center break-words flex m-auto overflow-y-auto">
                    <span class="m-auto flex w-auto p-4 relative font-overpass-bold text-2xl">
                      <span class="text-3xl font-overpass-bold">"</span>
                      <span class="my-auto mx-2">
                        {{ modul.deskripsi }}
                      </span>
                      <span class="text-3xl font-overpass-bold">"</span>
                    </span>
                  </div>
                </div>
              </div>

              <div class="w-24 z-10 h-48 flex-row pr-8">
                <div class="w-full h-1/2 p-2 rounded-tr-lg bg-gray-500">
                  <span class="w-full h-full visible cursor-pointer hover:p-1 p-0 flex animation-enable-short"
                      :class="[{ 'opacity-100 pointer-events-auto': !moreOpened },
                              { 'opacity-0 pointer-events-none': moreOpened },
                              'editOpen-'+modul.id]"
                      v-on:click="editModul(modul, true)">
                    <img class="w-full h-full rounded-lg p-3 bg-yellow-400 fas fa-pen">
                  </span>
                  <span class="w-full h-full hidden cursor-pointer hover:p-1 p-0 flex animation-enable-short"
                      :class="[{ 'opacity-100 pointer-events-auto': !moreOpened },
                              { 'opacity-0 pointer-events-none': moreOpened },
                              'editClose-'+modul.id]"
                      v-on:click="editModul(modul, false)">
                    <img class="w-full h-full rounded-lg p-3 bg-yellow-400 fas fa-times">
                  </span>
                </div>

                <!-- Open this only when needed :v -->
                <!-- <div class="w-full h-1/3 p-2 bg-gray-500">
                  <span class="w-full h-full cursor-pointer hover:p-1 p-0 flex animation-enable-short"
                      :class="[{ 'opacity-100 pointer-events-auto': !moreOpened },
                              { 'opacity-0 pointer-events-none': moreOpened }]"
                      v-on:click="deleteModul(modul.id)">
                    <img class="w-full h-full rounded-lg p-3 bg-yellow-400 fas fa-trash">
                  </span>
                </div> -->

                <div class="w-full h-1/2 p-2 rounded-br-lg bg-gray-500">
                  <span class="w-full visible h-full cursor-pointer hover:p-1 p-0 flex animation-enable-short"
                      :class="'moreOpen-'+modul.id"
                      v-on:click="showMore(modul.id, true)">
                    <img class="w-full h-full rounded-lg p-3 bg-yellow-400 fas fa-caret-down">
                  </span>
                  <span class="w-full hidden h-full cursor-pointer hover:p-1 p-0 flex animation-enable-short"
                      :class="'moreClose-'+modul.id"
                      v-on:click="showMore(modul.id, false)">
                    <img class="w-full h-full rounded-lg p-3 bg-yellow-400 fas fa-caret-up">
                  </span>
                </div>
              </div>
            </div>
          </transition-group>
          <div class="w-full h-8"/>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.modul-list-enter, .modul-list-leave-to{
  opacity: 0;
  transform: translateX(-100%);
}
.modul-list-leave-active {
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

      openedMenu: true,
      modulMenuShown: true,
      moreOpened: false,
      editing: false,

      menuProfil: false,
      menuPraktikum: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuSoal: false,
      menuKelas: false,
      menuPlotting: false,
      menuKonfigurasi: false,
      menuTp: false,
      menuNilai: false,
      menuSetPraktikan: false,

      listAllModul: this.allModul === null ? [] : this.allModul,

      formModul: {
        id: '',
        oldJudul: '',
        judul: '',
        deskripsi: '',
        isi: '',
        isEnglish: false,
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
        this.comingFrom === 'praktikum'||
        this.comingFrom === 'plotting' ||
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
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=modul&position='+globe.$refs.menu.scrollTop);
        }, 501); 
    },

    editModul: function($modul, $editing){
      
      const globe = this;
      this.editing = $editing;

      if($editing){

        if(globe.formModul.id != null){
          
          $(".editClose-"+globe.formModul.id).removeClass("visible");
          $(".editClose-"+globe.formModul.id).addClass("hidden");
          $(".editOpen-"+globe.formModul.id).removeClass("hidden");
          $(".editOpen-"+globe.formModul.id).addClass("visible");
        }

        $(".editOpen-"+$modul.id).removeClass("visible");
        $(".editOpen-"+$modul.id).addClass("hidden");
        $(".editClose-"+$modul.id).removeClass("hidden");
        $(".editClose-"+$modul.id).addClass("visible");

        globe.formModul.id = $modul.id;
        globe.formModul.oldJudul = $modul.judul;
        globe.formModul.judul = $modul.judul;
        globe.formModul.deskripsi = $modul.deskripsi;
        globe.formModul.isi = $modul.isi;
        globe.formModul.isEnglish = $modul.isEnglish;
      } else {

        $(".editClose-"+$modul.id).removeClass("visible");
        $(".editClose-"+$modul.id).addClass("hidden");
        $(".editOpen-"+$modul.id).removeClass("hidden");
        $(".editOpen-"+$modul.id).addClass("visible");

        globe.formModul.id = "";
        globe.formModul.oldJudul = "";
        globe.formModul.judul = "";
        globe.formModul.deskripsi = "";
        globe.formModul.isi = "";
        globe.formModul.isEnglish = false;
      }
    },

    updateModul: function(){

      const globe = this;

      this.$axios.post('/updateModul', this.formModul).then(response => {

        if(response.data.message === "success") {

          globe.editing = false;
          $(".editClose-"+globe.formModul.id).removeClass("visible");
          $(".editClose-"+globe.formModul.id).addClass("hidden");
          $(".editOpen-"+globe.formModul.id).removeClass("hidden");
          $(".editOpen-"+globe.formModul.id).addClass("visible");

          globe.$toasted.global.showSuccess({
            message: "Modul berhasil diperbaharui"
          });
          
          for(var i=0; i<globe.listAllModul.length; i++){
            if(globe.listAllModul[i].id === globe.formModul.id){
              globe.listAllModul[i] = response.data.modul;
              break;
            }
          }

          globe.formModul.id = "";
          globe.formModul.oldJudul = "";
          globe.formModul.judul = "";
          globe.formModul.deskripsi = "";
          globe.formModul.isi = "";
          globe.formModul.isEnglish = false;
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
            if(error.response.data.errors.judul != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.judul[0]
              });
            if(error.response.data.errors.deskripsi != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.deskripsi[0]
              });
            if(error.response.data.errors.isi != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.isi[0]
              });
          }
        }
      });
    },

    showMore: function($id, $open){
      
      const globe = this;

      if($open){
        this.modulMenuShown = false;
        this.openedMenu = false;
        $(".moreOpen-"+$id).removeClass("visible");
        $(".moreOpen-"+$id).addClass("hidden");
        $(".moreClose-"+$id).removeClass("hidden");
        $(".moreClose-"+$id).addClass("visible");
        $(".modul-"+$id).removeClass("h-48");
        $(".modul-"+$id).addClass("h-auto");

        var i;
        for(i=0; i<globe.listAllModul.length; i++)
          if(globe.listAllModul[i].id === $id)
            break;

        globe.listAllModul.splice(0, i);
        globe.listAllModul.splice(1, globe.listAllModul.length-1);

        setTimeout(() => {
          
          globe.moreOpened = true;
        }, 1000);

      } else {

        this.moreOpened = false;

        setTimeout(() => {
          
          globe.$axios.post('/readModul').then(response => {
            globe.listAllModul = response.data;
          })

          globe.modulMenuShown = true;
          globe.openedMenu = true;
          $(".moreClose-"+$id).removeClass("visible");
          $(".moreClose-"+$id).addClass("hidden");
          $(".moreOpen-"+$id).removeClass("hidden");
          $(".moreOpen-"+$id).addClass("visible");
          $(".modul-"+$id).removeClass("h-auto");
          $(".modul-"+$id).addClass("h-48");
        }, 500);
      }
    },

    deleteModul: function($id){

      const globe = this;
      this.$axios.post('/deleteModul/'+$id).then(response => {

        if(response.data.message === "success") {

          globe.$toasted.global.showSuccess({
            message: "Modul berhasil dihapus"
          });

          var i;
          for(i=0; i<globe.listAllModul.length; i++){
            if(globe.listAllModul[i].id === $id){
              break;
            }
          }
          globe.listAllModul.splice(i, 1);
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
            if(error.response.data.errors.judul != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.judul[0]
              });
            if(error.response.data.errors.deskripsi != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.deskripsi[0]
              });
            if(error.response.data.errors.isi != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.isi[0]
              });
          }
        }
      });
    },

    createModul: function(){
      
      const globe = this;
      this.$axios.post('/createModul', this.formModul).then(response => {

        if(response.data.message === "success") {

          $("#modulForm")[0].reset();
          globe.$toasted.global.showSuccess({
            message: "Modul berhasil ditambahkan"
          });
          globe.listAllModul.push({
            id: response.data.id,
            judul: globe.formModul.judul,
            deskripsi: globe.formModul.deskripsi,
            isi: globe.formModul.isi,
            isEnglish: globe.formModul.isEnglish,
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
            if(error.response.data.errors.judul != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.judul[0]
              });
            if(error.response.data.errors.deskripsi != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.deskripsi[0]
              });
            if(error.response.data.errors.isi != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.isi[0]
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
