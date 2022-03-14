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

        <div class="w-full p-4 h-24 flex select-none animation-enable"
            :class="[{ 'bg-yellow-500 text-white': !changePage },
                    { 'bg-yellow-400 text-black': changePage }]">
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

    <div class="absolute w-120full h-full flex animation-enable"
        :class="[{ 'left-minFull': !currentPage || nilaiShown },
                { 'left-0': currentPage && !nilaiShown }]">
      <div v-if="listAllLaporan.length > 0" 
          class="w-full h-full" v-bar>
        <div>
          <transition-group name="laporan-list" tag="div">
            <div v-for="(laporan, index) in listAllLaporan" v-bind:key="laporan.id" 
                class="animation-enable w-full h-120 flex">
              <div class="w-full h-full px-6 flex-row mt-2 pb-4">
                <div class="w-full h-12 flex">
                  <div class="align-middle w-auto h-auto my-auto break-words font-monda-bold text-2xl text-yellow-400 flex flex-wrap content-center">
                    <div>{{ laporan.nim }} [{{ laporan.nama }}]</div>
                    <div :class="[{ 'mx-1 my-auto px-2 pt-1 pb-0 bg-purple-500 text-white text-sm font-semibold rounded-full shadow-md hover:bg-purple-700 hover:text-white ring-4' : laporan.shift==1 },
                    { 'mx-1 my-auto px-2 pt-1 pb-0 bg-blue-500 text-blue-200 text-sm font-semibold rounded-full shadow-md hover:bg-blue-700 hover:text-blue-200 ring-4' : laporan.shift==2},
                    { 'mx-1 my-auto px-2 pt-1 pb-0 bg-pink-500 text-pink-200 text-sm font-semibold rounded-full shadow-md hover:bg-pink-700 hover:text-pink-200 ring-4' : laporan.shift==3},
                    { 'mx-1 my-auto px-2 pt-1 pb-0 bg-yellow-500 text-yellow-900 text-sm font-semibold rounded-full shadow-md hover:bg-yellow-700 hover:text-yellow-200 ring-4' : laporan.shift==4},
                    { 'mx-1 my-auto px-2 pt-1 pb-0 bg-gray-500 text-gray-900 text-sm font-semibold rounded-full shadow-md hover:bg-gray-700 hover:text-gray-200 ring-4' : laporan.shift==5}]">
                      <span>{{ laporan.kelas }} {{ laporan.hari }} {{ laporan.shift }}</span>
                      <span>[{{ new Date(laporan.created_at).toLocaleString('id') }}]</span>
                    </div>
                  </div>
                </div>
                <div class="w-full h-24full flex relative bg-gray-500 rounded-lg">
                  <div class="w-1/4 h-full p-4 overflow-y-auto flex-row">
                    <div class="w-full h-1/2 flex">
                      <div class="w-auto h-auto m-auto font-monda-bold text-lg">
                        <span>Asisten :</span>
                        <star-rating 
                          style="width: 150px;" 
                          :increment="0.01" 
                          :fixed-points="2"
                          :read-only="true"
                          :show-rating="false"
                          :rating="laporan.rating_asisten"
                          :star-size='30'/>
                      </div>
                    </div>
                    <div class="w-full h-1/2 flex">
                      <div class="w-auto h-auto m-auto font-monda-bold text-lg">
                        <span>Praktikum :</span>
                        <star-rating 
                          style="width: 150px;" 
                          :increment="0.01" 
                          :fixed-points="2"
                          :read-only="true"
                          :show-rating="false"
                          :rating="laporan.rating_praktikum"
                          :star-size='30'/>
                      </div>
                    </div>
                  </div>
                  <div class="w-3/4 h-full p-4 bg-gray-200 rounded-r-lg overflow-y-auto flex">
                    <div class="w-full h-full whitespace-pre-wrap break-words font-overpass text-2xl text-black">
                      <span class="font-monda-bold text-3xl">Pesan :</span>
                      <br>
                      <span>{{ laporan.pesan }}</span>
                      <div class="w-full h-12 flex"/>
                    </div>
                  </div>
                  <div class="absolute bottom-0 p-0 hover:p-1 animation-enable-short cursor-pointer flex font-monda-bold text-xl right-0 m-4 w-auto h-12"
                      v-on:click="showNilaiPage(laporan.praktikan_id, laporan.modul_id, laporan.kelas_id, index)">
                    <div :class="[{'w-full h-full p-2 bg-green-300 text-green-800 rounded-lg': laporan.nilaiExists },
                                  {'w-full h-full p-2 bg-red-500 text-white rounded-lg': !laporan.nilaiExists }]">
                      <span v-if="laporan.nilaiExists">Lihat Nilai</span>
                      <span v-if="!laporan.nilaiExists">Nilai Sekarang</span>
                    </div>
                  </div>
                </div>
                <div class="w-full h-12 flex px-8">
                  <div class="w-full h-full flex rounded-b-lg"
                    :class="[{ 'bg-green-300': laporan.nilaiExists },
                            { 'bg-red-500': !laporan.nilaiExists }]">
                    <div class="w-auto h-auto m-auto font-overpass-bold whitespace-pre-wrap break-words text-2xl"
                      :class="[{ 'text-green-700': laporan.nilaiExists },
                              { 'text-white': !laporan.nilaiExists }]">
                      <span v-if="laporan.nilaiExists">Nilai sudah dimasukkan</span>
                      <span v-if="!laporan.nilaiExists">Nilai belum dimasukkan !!!</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </transition-group>
        </div>
      </div>
      <div v-if="listAllLaporan.length === 0"
          class="w-full h-full flex">
        <div class="w-auto h-auto m-auto font-monda-bold text-5xl text-white">
          <span>Tidak ada feedback praktikan saat ini :(</span>
        </div>
      </div>
    </div>
    <div class="absolute w-120full pt-8 px-8 h-full flex animation-enable"
        :class="[{ 'bottom-minFull': !nilaiShown },
                { 'bottom-0': nilaiShown }]">
      <div class="w-full h-full bg-white rounded-t-lg flex-row p-2">
        <div class="w-full h-4 flex">
          <div class="w-auto h-auto m-auto text-black font-overpass-bold">
            <span>{{ chosenPraktikanNIM }} - {{ chosenPraktikanNAMA }}</span>
          </div>
        </div>
        <div class="w-full h-20 flex">
          <div class="w-1/7 h-full flex-row p-2"
              v-on:click="showJawaban('Tp')">
            <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
              TP
            </span>
            <div class="w-full h-3/4">
              <input v-model="formNilai.tp"
                    class="font-overpass-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    type="number" step="0.01" min="0" max="100" placeholder="100">
            </div>
          </div>
          <div class="w-1/7 h-full flex-row p-2">
            <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
              TA
            </span>
            <div class="w-full h-3/4">
              <input v-model="formNilai.ta"
                    class="font-overpass-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    type="number" step="0.01" min="0" max="100" placeholder="100">
            </div>
          </div>
          <div class="w-1/7 h-full flex-row p-2">
            <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
              TK
            </span>
            <div class="w-full h-3/4">
              <input v-model="formNilai.tk"
                    class="font-overpass-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    type="number" step="0.01" min="0" max="100" placeholder="100">
            </div>
          </div>
          <div class="w-1/7 h-full flex-row p-2"
              v-on:click="showJawaban('Jurnal')">
            <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
              Jurnal
            </span>
            <div class="w-full h-3/4">
              <input v-model="formNilai.jurnal"
                    class="font-overpass-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    type="number" step="0.01" min="0" max="400" placeholder="400">
            </div>
          </div>
          <div class="w-1/7 h-full flex-row p-2"
              v-on:click="showJawaban('Skill')">
            <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
              Skill
            </span>
            <div class="w-full h-3/4">
              <input v-model="formNilai.skill"
                    class="font-overpass-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    type="number" step="0.01" min="0" max="100" placeholder="100">
            </div>
          </div>
          <div class="w-1/7 h-full flex-row p-2">
            <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
              Diskon
            </span>
            <div class="w-full h-3/4">
              <input v-model="formNilai.diskon"
                    class="font-overpass-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    type="number" step="0.01" min="0" max="800" placeholder="800">
            </div>
          </div>
          <div class="w-1/7 h-full flex-row p-2">
            <span class="font-merri w-full text-left text-gray-700 text-lg h-1/4">
              Total
            </span>
            <div class="w-full h-3/4">
              <input v-model="formNilai.total"
                    class="font-overpass-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    type="number" step="0.01" min="0" max="100" placeholder="100">
            </div>
          </div>
        </div>
        <div class="w-full h-36full flex">
          <div class="w-full h-full p-8 flex"
              :class="[{ 'visible': showingJawaban === '' },
                      { 'hidden': showingJawaban !== '' }]">
            <div class="w-auto h-auto m-auto whitespace-pre-wrap text-center break-words flex font-overpass-bold text-3xl">
              <span>Silahkan pilih salah satu nilai untuk melihat jawaban praktikan</span>
            </div>
          </div>
          <div class="w-full h-full p-8 flex"
              :class="[{ 'visible': showingJawaban === 'Tp' },
                      { 'hidden': showingJawaban !== 'Tp' }]">
            <div v-if="allJawabanTp !== 'nope'" 
                class="w-full h-full" v-bar>
              <div>
                <div class="w-full h-auto flex-row">
                  <div v-for="(jawaban, index) in allJawabanTp" v-bind:key="jawaban.id" 
                      class="w-full flex-row h-auto">
                    <div class="w-full h-auto flex my-10">
                      <div class="h-full w-12 flex font-merri-bold text-xl">
                        <div class="m-auto w-auto h-auto">{{ index+1 }}</div>
                      </div>
                      <div class="h-12 px-1 w-4">
                        <div class="h-full w-full bg-gray-900"/>
                      </div>
                      <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-2xl">
                        <span>{{ jawaban.soal }}</span>
                      </div>
                    </div>
                    <div class="w-full h-auto flex px-5">
                      <textarea v-model="allJawabanTp[index].jawaban" cols="30" rows="10"
                            class="font-overpass-mono-bold resize-none text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                            type="text" disabled/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="allJawabanTp === 'nope'" 
                class="w-full h-full flex">
              <div class="w-auto h-auto m-auto font-overpass-bold text-3xl whitespace-pre-wrap break-words">
                <span>Praktikan ini tidak mengumpulkan TP</span>
              </div>
            </div>
          </div>
          <div class="w-full h-full p-8 flex"
              :class="[{ 'visible': showingJawaban === 'Jurnal' },
                      { 'hidden': showingJawaban !== 'Jurnal' }]">
            <div class="w-full h-full" v-bar>
              <div>
                <div class="w-full h-auto flex-row">
                  <div v-for="(jawaban, index) in allJawabanJurnal" v-bind:key="jawaban.id" 
                      class="w-full flex-row h-auto">
                    <div class="w-full h-auto flex my-10">
                      <div class="h-full w-12 flex font-merri-bold text-xl">
                        <div class="m-auto w-auto h-auto">{{ index+1 }}</div>
                      </div>
                      <div class="h-12 px-1 w-4">
                        <div class="h-full w-full bg-gray-900"/>
                      </div>
                      <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-2xl">
                        <span>{{ jawaban.soal }}</span>
                      </div>
                    </div>
                    <div class="w-full h-auto flex px-5">
                      <textarea v-model="allJawabanJurnal[index].jawaban" cols="30" rows="10"
                            class="font-overpass-mono-bold resize-none text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                            type="text" disabled/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full h-full p-8 flex"
              :class="[{ 'visible': showingJawaban === 'Skill' },
                      { 'hidden': showingJawaban !== 'Skill' }]">
            <div class="w-auto h-auto m-auto font-monda-bold text-3xl">
              <span>Silahkan beri rating untuk praktikan ini :</span>
              <star-rating class="mx-auto"
                style="width: 250px;" 
                v-model="formNilai.rating"
                :increment="0.01" 
                :fixed-points="2"
                :show-rating="false"
                :star-size='50'/>
            </div>
          </div>
        </div>
        <div class="w-full h-12 flex">
          <div class="w-1/4 h-full p-0 hover:p-1 cursor-pointer animation-enable-short flex"
              v-on:click="nilaiShown = false">
            <div class="w-full h-full bg-green-600 rounded-lg flex">
              <div class="w-auto h-auto m-auto font-monda-bold text-white text-2xl">
                <span>Kembali</span>
              </div>
            </div>
          </div>
          <div class="w-4 h-full"/>
          <div class="w-full h-full p-0 hover:p-1 cursor-pointer animation-enable-short flex"
              v-on:click="inputNilai()">
            <div class="w-full h-full bg-green-600 rounded-lg flex">
              <div class="w-auto h-auto m-auto font-monda-bold text-white text-2xl">
                <span>Input Nilai</span>
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
    'allLaporan',
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
      allLaporanPriviledge: [1,2,4,5,6],
      soalPriviledge: "all",

      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,
      nilaiShown: false,

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
      menuKonfigurasi: false,
      menuSetPraktikan: false,
      menuPelanggaran: false,
      menuRanking: false,
      menuAllLaporan: false,

      listAllLaporan: this.allLaporan,
      showingJawaban: '',

      allJawabanTp: [],
      allJawabanJurnal: [],

      chosenModulID: '',
      chosenKelasID: '',
      chosenPraktikanID: '',
      chosenIndex: '',

      chosenPraktikanNIM: '',
      chosenPraktikanNAMA: '',

      formNilai: {
        tp: '',
        ta: '',
        tk: '',
        jurnal: '',
        skill: '',
        diskon: '',
        total: 0,
        rating: 0,
        modul_id: '',
        asisten_id: '',
        kelas_id: '',
        praktikan_id: '',
      },
    }
  },

  watch: {
    'formNilai.tp': function(val) {
      if (val) {
      
        this.formNilai.total = 
          (Number.isNaN(parseFloat(this.formNilai.tp)) ? 0 : parseFloat(this.formNilai.tp) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.ta)) ? 0 : parseFloat(this.formNilai.ta) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.jurnal)) ? 0 : parseFloat(this.formNilai.jurnal) / 10) +
          (Number.isNaN(parseFloat(this.formNilai.tk)) ? 0 : parseFloat(this.formNilai.tk) * parseFloat(20/100)) +
          (Number.isNaN(parseFloat(this.formNilai.skill)) ? 0 : parseFloat(this.formNilai.skill) * parseFloat(10/100)) -
          (Number.isNaN(parseFloat(this.formNilai.diskon)) ? 0 : parseFloat(this.formNilai.diskon) * parseFloat(10/100))
      }
    },

    'formNilai.ta': function(val) {
      if (val) {
      
        this.formNilai.total = 
          (Number.isNaN(parseFloat(this.formNilai.tp)) ? 0 : parseFloat(this.formNilai.tp) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.ta)) ? 0 : parseFloat(this.formNilai.ta) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.jurnal)) ? 0 : parseFloat(this.formNilai.jurnal) / 10) +
          (Number.isNaN(parseFloat(this.formNilai.tk)) ? 0 : parseFloat(this.formNilai.tk) * parseFloat(20/100)) +
          (Number.isNaN(parseFloat(this.formNilai.skill)) ? 0 : parseFloat(this.formNilai.skill) * parseFloat(10/100)) -
          (Number.isNaN(parseFloat(this.formNilai.diskon)) ? 0 : parseFloat(this.formNilai.diskon) * parseFloat(10/100))
      }
    },

    'formNilai.tk': function(val) {
      if (val) {
      
        this.formNilai.total = 
          (Number.isNaN(parseFloat(this.formNilai.tp)) ? 0 : parseFloat(this.formNilai.tp) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.ta)) ? 0 : parseFloat(this.formNilai.ta) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.jurnal)) ? 0 : parseFloat(this.formNilai.jurnal) / 10) +
          (Number.isNaN(parseFloat(this.formNilai.tk)) ? 0 : parseFloat(this.formNilai.tk) * parseFloat(20/100)) +
          (Number.isNaN(parseFloat(this.formNilai.skill)) ? 0 : parseFloat(this.formNilai.skill) * parseFloat(10/100)) -
          (Number.isNaN(parseFloat(this.formNilai.diskon)) ? 0 : parseFloat(this.formNilai.diskon) * parseFloat(10/100))
      }
    },

    'formNilai.jurnal': function(val) {
      if (val) {
      
        this.formNilai.total = 
          (Number.isNaN(parseFloat(this.formNilai.tp)) ? 0 : parseFloat(this.formNilai.tp) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.ta)) ? 0 : parseFloat(this.formNilai.ta) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.jurnal)) ? 0 : parseFloat(this.formNilai.jurnal) / 10) +
          (Number.isNaN(parseFloat(this.formNilai.tk)) ? 0 : parseFloat(this.formNilai.tk) * parseFloat(20/100)) +
          (Number.isNaN(parseFloat(this.formNilai.skill)) ? 0 : parseFloat(this.formNilai.skill) * parseFloat(10/100)) -
          (Number.isNaN(parseFloat(this.formNilai.diskon)) ? 0 : parseFloat(this.formNilai.diskon) * parseFloat(10/100))
      }
    },

    'formNilai.skill': function(val) {
      if (val) {
      
        this.formNilai.total = 
          (Number.isNaN(parseFloat(this.formNilai.tp)) ? 0 : parseFloat(this.formNilai.tp) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.ta)) ? 0 : parseFloat(this.formNilai.ta) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.jurnal)) ? 0 : parseFloat(this.formNilai.jurnal) / 10) +
          (Number.isNaN(parseFloat(this.formNilai.tk)) ? 0 : parseFloat(this.formNilai.tk) * parseFloat(20/100)) +
          (Number.isNaN(parseFloat(this.formNilai.skill)) ? 0 : parseFloat(this.formNilai.skill) * parseFloat(10/100)) -
          (Number.isNaN(parseFloat(this.formNilai.diskon)) ? 0 : parseFloat(this.formNilai.diskon) * parseFloat(10/100))
      }
    },

    'formNilai.diskon': function(val) {
      if (val) {
      
        this.formNilai.total = 
          (Number.isNaN(parseFloat(this.formNilai.tp)) ? 0 : parseFloat(this.formNilai.tp) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.ta)) ? 0 : parseFloat(this.formNilai.ta) * parseFloat(15/100)) +
          (Number.isNaN(parseFloat(this.formNilai.jurnal)) ? 0 : parseFloat(this.formNilai.jurnal) / 10) +
          (Number.isNaN(parseFloat(this.formNilai.tk)) ? 0 : parseFloat(this.formNilai.tk) * parseFloat(20/100)) +
          (Number.isNaN(parseFloat(this.formNilai.skill)) ? 0 : parseFloat(this.formNilai.skill) * parseFloat(10/100)) -
          (Number.isNaN(parseFloat(this.formNilai.diskon)) ? 0 : parseFloat(this.formNilai.diskon) * parseFloat(10/100))
      }
    },
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
        this.comingFrom === 'konfigurasi'||
        this.comingFrom === 'pelanggaran'||
        this.comingFrom === 'setpraktikan'||
        this.comingFrom === 'rating' ||
        this.comingFrom === 'allLaporan'){

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
      if($whereTo === "konfigurasi")
        this.menuKonfigurasi = $bool;
      if($whereTo === "setpraktikan")
        this.menuSetPraktikan = $bool;
      if($whereTo === "pelanggaran")
        this.menuPelanggaran = $bool;
      if($whereTo === "rating")
        this.menuRanking = $bool;
      if($whereTo === "allLaporan")
        this.menuAllLaporan = $bool;
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      this.nilaiShown = false;
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

    showJawaban: function($type) {

      const globe = this;
      this.showingJawaban = $type;
    },

    showNilaiPage: function($praktikan_id, $modul_id, $kelas_id, $index){
      
      const globe = this;

      this.chosenPraktikanNIM = this.listAllLaporan[$index].nim;
      this.chosenPraktikanNAMA = this.listAllLaporan[$index].nama;

      this.chosenModulID = $modul_id;
      this.chosenKelasID = $kelas_id;
      this.chosenPraktikanID = $praktikan_id;
      this.chosenIndex = $index;

      this.nilaiShown = true;

      if(this.listAllLaporan[$index].nilaiExists === true){

        globe.$axios.post('/getCurrentNilai/'+$praktikan_id+"/"+$modul_id).then(response => {

          if(response.data.message === "success"){

            this.formNilai.ta = response.data.nilai.ta;
            this.formNilai.tk = response.data.nilai.tk;
            this.formNilai.tp = response.data.nilai.tp;
            this.formNilai.skill = response.data.nilai.skill;
            this.formNilai.jurnal = response.data.nilai.jurnal;
            this.formNilai.diskon = response.data.nilai.diskon;
            this.formNilai.rating = response.data.nilai.rating;
          } else {
            globe.$toasted.global.showError({
              message: response.data.message
            });
          }
        });

      } else {

        if($modul_id === 1) {

          this.formNilai.tp = 100;
          this.formNilai.skill = 100;
        }

        globe.$axios.post('/createFormNilai/'+$praktikan_id+"/"+$modul_id).then(response => {

          if(response.data.message === "success"){

            this.formNilai.ta = response.data.nilaiTa;
            this.formNilai.tk = response.data.nilaiTk;
          } else {
            globe.$toasted.global.showError({
              message: response.data.message
            });
          }
        });
      }
      
      globe.$axios.post('/getAllJawaban/'+$praktikan_id+"/"+$modul_id).then(response => {

        if(response.data.message === "success"){

          globe.allJawabanTp = response.data.allJawabanTp;
          globe.allJawabanJurnal = response.data.allJawabanJurnal;
        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
    },

    inputNilai: function(){

      const globe = this;

      if(this.formNilai.tp === '') {
        globe.$toasted.global.showError({
          message: "Input nilai TP terlebih dahulu"
        });
        return;
      }

      if(this.formNilai.jurnal === '') {
        globe.$toasted.global.showError({
          message: "Input nilai Jurnal terlebih dahulu"
        });
        return;
      }

      if(this.formNilai.skill === '') {
        globe.$toasted.global.showError({
          message: "Input skill terlebih dahulu"
        });
        return;
      }

      if(this.formNilai.rating === 0) {
        globe.$toasted.global.showError({
          message: "Input rating terlebih dahulu dengan mengklik nilai skill"
        });
        return;
      }

      if(this.formNilai.diskon === '') {
        globe.$toasted.global.showError({
          message: "Input diskon terlebih dahulu <br> Inputkan 0 jika tidak ada diskon"
        });
        return;
      }

      globe.formNilai.modul_id = globe.chosenModulID;
      globe.formNilai.kelas_id = globe.chosenKelasID;
      globe.formNilai.praktikan_id = globe.chosenPraktikanID;
      globe.formNilai.asisten_id = globe.currentUser.id;
      globe.$axios.post('/inputNilai', this.formNilai).then(response => {

        if(response.data.message === "success"){

          globe.formNilai.tp = '';
          globe.formNilai.jurnal = '';
          globe.formNilai.skill = '';
          globe.formNilai.rating = 0;
          globe.formNilai.diskon = '';
          globe.formNilai.modul_id = '';
          globe.formNilai.kelas_id = '';
          globe.formNilai.praktikan_id = '';
          globe.listAllLaporan[globe.chosenIndex].nilaiExists = true;
          globe.nilaiShown = false;
          globe.$toasted.global.showSuccess({
            message: "Nilai berhasil di input"
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
