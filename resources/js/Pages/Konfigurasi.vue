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

        <div v-if="allLaporanPriviledge.includes(currentUser.role_id) || allLaporanPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuAllLaporan },
                      { 'bg-yellow-500 text-white': changePage && menuAllLaporan }]"
              v-on:click='travel("allLaporan")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-file-medical-alt">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              All Laporan
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
          <div class="w-full p-4 h-24 flex select-none animation-enable"
              :class="[{ 'bg-yellow-500 text-white': !changePage },
                      { 'bg-yellow-400 text-black': changePage }]">
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

        <div v-if="jawabanPriviledge.includes(currentUser.role_id) || jawabanPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuJawaban },
                      { 'bg-yellow-500 text-white': changePage && menuJawaban }]"
              v-on:click='travel("jawaban")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-tasks">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Jawaban
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

        <div v-if="RankingPriviledge.includes(currentUser.role_id) || RankingPriviledge == 'all'">
          <div class="w-full p-4 h-24 flex select-none cursor-pointer hover:text-white animation-enable"
              :class="[{ 'bg-yellow-400 hover:bg-yellow-600': !changePage || !menuRanking },
                      { 'bg-yellow-500 text-white': changePage && menuRanking }]"
              v-on:click='travel("rating")'>
            <div class="w-7/12 my-2 flex">
              <div class="w-4/6"/>
              <img class="select-none m-auto w-2/6 h-auto fas fa-star">
            </div>
            <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
              Ranking Praktikan
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
            <img class="select-none w-20 h-20 m-auto rounded-full bg-white object-cover" :src="'/assets/'+currentUser.kode+'.jpg'" alt="daskom logo">
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

    <div class="absolute h-36full w-120full animation-enable"
        :class="[{ 'left-minFull': !currentPage },
                { 'left-0': currentPage }]">
      <div class="w-full h-full flex-row" v-bar>
        <div>
          <div class="w-full h-1/5 flex my-5">
            <div class="w-1/2 h-full flex">
              <div class="w-auto h-auto pt-5 my-auto ml-auto font-overpass-mono-bold text-3xl animation-enable-short"
                :class="[{ 'text-yellow-200': !formConfig.tp_activation },
                        { 'text-yellow-500': formConfig.tp_activation }]">
                <span>Tugas Pendahuluan</span>
              </div>
            </div>
            <div class="w-1/2 h-full flex ml-10 mt-2">
              <div class="w-auto h-auto my-auto">
                <toggle-button v-model="formConfig.tp_activation"
                  :value="formConfig.tp_activation"
                  :sync="true"
                  :labels="true"
                  :width="125"
                  :height="50"
                  :font-size="20"/>
              </div>
            </div>
          </div>
          <div class="w-full h-1/5 flex my-5">
            <div class="w-1/2 h-full flex">
              <div class="w-auto h-auto pt-5 my-auto ml-auto font-overpass-mono-bold text-3xl animation-enable-short"
                :class="[{ 'text-yellow-200': !formConfig.runmod_activation },
                        { 'text-yellow-500': formConfig.runmod_activation }]">
                <span>Running modul</span>
              </div>
            </div>
            <div class="w-1/2 h-full flex ml-10 mt-2">
              <div class="w-auto h-auto my-auto">
                <toggle-button v-model="formConfig.runmod_activation"
                  :value="formConfig.runmod_activation"
                  :sync="true"
                  :labels="true"
                  :width="125"
                  :height="50"
                  :font-size="20"/>
              </div>
            </div>
          </div>
          <div class="w-full h-1/5 flex my-5">
            <div class="w-1/2 h-full flex">
              <div class="w-auto h-auto pt-5 my-auto ml-auto font-overpass-mono-bold text-3xl animation-enable-short"
                :class="[{ 'text-yellow-200': !formConfig.registrationPraktikan_activation },
                        { 'text-yellow-500': formConfig.registrationPraktikan_activation }]">
                <span>Registrasi Praktikan</span>
              </div>
            </div>
            <div class="w-1/2 h-full flex ml-10 mt-2">
              <div class="w-auto h-auto my-auto">
                <toggle-button v-model="formConfig.registrationPraktikan_activation"
                  :value="formConfig.registrationPraktikan_activation"
                  :sync="true"
                  :labels="true"
                  :width="125"
                  :height="50"
                  :font-size="20"/>
              </div>
            </div>
          </div>
          <div v-if="softwarePriviledge.includes(currentUser.role_id) || softwarePriviledge == 'all'">
            <div class="w-full h-1/5 flex my-5">
              <div class="w-1/2 h-full flex">
                <div class="w-auto h-auto pt-5 my-auto ml-auto font-overpass-mono-bold text-3xl animation-enable-short"
                  :class="[{ 'text-yellow-200': !formConfig.registrationAsisten_activation },
                          { 'text-yellow-500': formConfig.registrationAsisten_activation }]">
                  <span>Registrasi Asisten</span>
                </div>
              </div>
              <div class="w-1/2 h-full flex ml-10 mt-2">
                <div class="w-auto h-auto my-auto">
                  <toggle-button v-model="formConfig.registrationAsisten_activation"
                    :value="formConfig.registrationAsisten_activation"
                    :sync="true"
                    :labels="true"
                    :width="125"
                    :height="50"
                    :font-size="20"/>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full h-1/5 flex my-5">
            <div class="w-1/2 h-full flex">
              <div class="w-auto h-auto pt-5 my-auto ml-auto font-overpass-mono-bold text-3xl animation-enable-short"
                :class="[{ 'text-yellow-200': !formConfig.tubes_activation },
                        { 'text-yellow-500': formConfig.tubes_activation }]">
                <span>Tugas Besar</span>
              </div>
            </div>
            <div class="w-1/2 h-full flex ml-10 mt-2">
              <div class="w-auto h-auto my-auto">
                <toggle-button v-model="formConfig.tubes_activation"
                  :value="formConfig.tubes_activation"
                  :sync="true"
                  :labels="true"
                  :width="125"
                  :height="50"
                  :font-size="20"/>
              </div>
            </div>
          </div>
        <div v-if="softwarePriviledge.includes(currentUser.role_id) || softwarePriviledge == 'all'">
          <div class="w-full h-1/5 flex my-5">
            <div class="w-1/2 h-full flex">
              <div class="w-auto h-auto pt-5 my-auto ml-auto font-overpass-mono-bold text-3xl animation-enable-short"
                :class="[{ 'text-yellow-200': !formConfig.polling_activation },
                        { 'text-yellow-500': formConfig.polling_activation }]">
                <span>Polling Semesteran</span>
              </div>
            </div>
            <div class="w-1/2 h-full flex ml-10 mt-2">
              <div class="w-auto h-auto my-auto">
                <toggle-button v-model="formConfig.polling_activation"
                  :value="formConfig.polling_activation"
                  :sync="true"
                  :labels="true"
                  :width="125"
                  :height="50"
                  :font-size="20"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>

    <div class="absolute bottom-0 h-36 w-120full p-3 animation-enable"
        :class="[{ 'left-minFull': !currentPage },
                { 'left-0': currentPage }]">
      <div class="w-full h-full flex">
        <div  v-if="softwarePriviledge.includes(currentUser.role_id) || softwarePriviledge == 'all'" class="w-1/2 h-full p-4">
          <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
              v-on:click="resetConfig()">
            <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-red-600">
              <div class="m-auto">
                Kembalikan Konfigurasi
              </div>
            </div>
          </div>
        </div>
          <div  v-else-if="konfigurasiPriviledge.includes(currentUser.role_id) || konfigurasiPriviledge == 'all'" class="w-1/2 h-full p-4">
            <div class="w-full h-full p-4">
              <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-red-600">
                <div class="m-auto">
                  Kontak Software untuk Reset
                </div>
              </div>
            </div>
          </div>
        <div class="w-1/2 h-full p-4">
          <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
              v-on:click="saveConfig()">
            <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-green-600">
              <div class="m-auto">
                Simpan Konfigurasi
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
    'position',
    'userRole',
    'currentConfig',
  ],

  data() {
    return {
      kelasPriviledge: [],
      plottingPriviledge: [1,2,4,5],
      modulPriviledge: [1,2,4,15,7],
      konfigurasiPriviledge: [1,2,4,18,7],
      tpPriviledge: [1,2,15,11,7],
      pelanggaranPriviledge: [1,2,4,5,6,18],
      RankingPriviledge: [1,2,4,5,8,16],
      softwarePriviledge: [1,2],
      allLaporanPriviledge: [1,2,4,5,6],
      jawabanPriviledge: [1,2,7,11,15],
      soalPriviledge: "all",

      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,

      formConfig: {

        runmod_activation: this.currentConfig === 'nope' ? false : this.currentConfig.runmod_activation,
        registrationPraktikan_activation: this.currentConfig === 'nope' ? false : this.currentConfig.registrationPraktikan_activation,
        registrationAsisten_activation: this.currentConfig === 'nope' ? false : this.currentConfig.registrationAsisten_activation,
        tp_activation: this.currentConfig === 'nope' ? false : this.currentConfig.tp_activation,
        tubes_activation: this.currentConfig === 'nope' ? false : this.currentConfig.tubes_activation,
        polling_activation: this.currentConfig === 'nope' ? false : this.currentConfig.polling_activation,
      },

      menuPraktikum: false,
      menuSoal: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuKelas: false,
      menuPlotting: false,
      menuModul: false,
      menuProfil: false,
      menuTp: false,
      menuNilai: false,
      menuSetPraktikan: false,
      menuPelanggaran: false,
      menuRanking: false,
      menuAllLaporan: false,
      menuJawaban: false,
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
        this.comingFrom === 'polling' ||
        this.comingFrom === 'tp' ||
        this.comingFrom === 'listTp' ||
        this.comingFrom === 'history'||
        this.comingFrom === 'nilai'||
        this.comingFrom === 'pelanggaran'||
        this.comingFrom === 'setpraktikan'||
        this.comingFrom === 'rating' ||
        this.comingFrom === 'allLaporan' ||
        this.comingFrom === 'jawaban'){

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
      if($whereTo === "tp")
        this.menuTp = $bool;
      if($whereTo === "nilai")
        this.menuNilai = $bool;
      if($whereTo === "setpraktikan")
        this.menuSetPraktikan = $bool;
      if($whereTo === "pelanggaran")
        this.menuPelanggaran = $bool;
      if($whereTo === "rating")
        this.menuRanking = $bool;
      if($whereTo === "allLaporan")
        this.menuAllLaporan = $bool;
      if($whereTo === "jawaban")
        this.menuJawaban = $bool;
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=konfigurasi&position='+globe.$refs.menu.scrollTop);
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

    resetConfig: function(){

      this.formConfig.registrationAsisten_activation = this.currentConfig === 'nope' ? false : this.currentConfig.registrationAsisten_activation;
      this.formConfig.runmod_activation = this.currentConfig === 'nope' ? false : this.currentConfig.runmod_activation;
      this.formConfig.registrationPraktikan_activation = this.currentConfig === 'nope' ? false : this.currentConfig.registrationPraktikan_activation;
      this.formConfig.tp_activation = this.currentConfig === 'nope' ? false : this.currentConfig.tp_activation;
      this.formConfig.tubes_activation = this.currentConfig === 'nope' ? false : this.currentConfig.tubes_activation;
      this.formConfig.polling_activation = this.currentConfig === 'nope' ? false : this.currentConfig.polling_activation;
    },

    saveConfig: function(){

      const globe = this;
      globe.$axios.post('/saveConfiguration', globe.formConfig).then(response => {

        if(response.data.message === "success") {

          this.currentConfig.runmod_activation = this.formConfig.runmod_activation;
          this.currentConfig.registrationPraktikan_activation = this.formConfig.registrationPraktikan_activation;
          this.currentConfig.registrationAsisten_activation = this.formConfig.registrationAsisten_activation;
          this.currentConfig.tp_activation = this.formConfig.tp_activation;
          this.currentConfig.tubes_activation = this.formConfig.tubes_activation;
          this.currentConfig.polling_activation = this.formConfig.polling_activation;

          globe.$toasted.global.showSuccess({
            message: "New configuration saved"
          });

        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
    }
  }
}
</script>
