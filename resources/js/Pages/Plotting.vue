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
        <div class="w-full h-auto flex items-center justify-between mb-3 mt-2 px-4 font-overpass-bold text-gray-200 text-lg">
          <span class="flex items-center cursor-default">
            <span>
              <img class="fas fa-sort">
              SORT BY : 
            </span>
            <span v-on:click="sortByShift" class="text-center ml-3 py-1 px-2 rounded-lg cursor-pointer animation-enable-short"
                  :class="[{'bg-yellow-600 text-gray-900' : sortedByShift === true}]">SHIFT</span>
            <span v-on:click="sortByKelas" class="text-center ml-3 py-1 px-2 rounded-lg cursor-pointer animation-enable-short"
                  :class="[{'bg-yellow-600 text-gray-900' : sortedByKelas === true}]">KELAS</span>
          </span>
          
          <span @click="openPopup" 
                class="text-center py-1 px-2 rounded-lg animation-enable-short cursor-default"
                :class="[{'cursor-pointer bg-red-600 hover:bg-red-700 active:bg-red-800' : this.listAllJaga.length > 0},
                         {'bg-red-800' : this.listAllJaga.length === 0}]">
            <img class="fas fa-trash">
              RESET ALL
          </span>
        </div>
        <div class="w-full h-16full" v-bar>
          <div>
            <transition-group
                class="flex-wrap flex w-full h-auto" 
                name="plotting-list" tag="div">
             <div v-for="kelas in sortedAllKelas" v-bind:key="kelas.id"
                      class="flex flex-col w-1/4 py-3 px-4 text-xl text-gray-900">
                <div class="rounded-lg overflow-hidden shadow-3xl">
                    <div v-on:click="formJaga.kelas_id = kelas.id; plottingMenuShown = true; formHovered = true" 
                        class="flex justify-center bg-yellow-700 font-overpass-bold cursor-pointer transform hover:scale-105 hover:z-10 active:bg-yellow-600 active:scale-100 animation-enable-short">
                      {{kelas.kelas}}
                    </div>
                    <div class="flex justify-center bg-yellow-500 font-overpass-bold">
                      {{kelas.hari}}-{{kelas.shift}}
                    </div>
                    <div class="flex flex-wrap">
                      <div v-for="plotting in listAllJaga.filter( function(item){return (item.kelas === kelas.kelas);} )" v-bind:key="plotting.id"
                            v-on:click="plotChoosen(plotting.asisten_id, plotting.kelas_id)"
                            class="flex justify-center flex-grow w-1/2 cursor-pointer bg-gray-200 font-overpass text-gray-900 transform hover:scale-105 hover:z-10 active:bg-gray-500 active:scale-100 animation-enable-short"
                            :class="[{' bg-pink-500' : (plotting.asisten_id === formJaga.asisten_id && plotting.kelas_id === formJaga.kelas_id) || (plotting.asisten_id === formJaga.asisten_id && formJaga.kelas_id === '')},
                                     {'nth-bg-gray-600 nth-text-gray-100' : plotting.asisten_id !== formJaga.asisten_id || plotting.kelas_id !== formJaga.kelas_id && formJaga.kelas_id !== ''}]">
                            {{plotting.kode}}
                      </div>
                    </div>
                </div>
              </div>
            </transition-group>
          </div>
        </div>
      </div>

      <!-- Plotting Form -->
      <div class="absolute m-8 bottom-0 w-1/5 h-48 flex animation-enable"
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
                        class="block font-monda-bold text-xl  w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                    <option value="">---</option>
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
                        class="block font-monda-bold text-xl w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                    <option value="">---</option>
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

      <div class="w-4/5 absolute right-0 bottom-0 my-8 pl-8 h-48 animation-enable flex pointer-events-none"
          :class="[{ 'opacity-100': formHovered || buttonHovered || !plottingMenuShown },
                  { 'opacity-25': !formHovered && !buttonHovered && plottingMenuShown },
                  { 'w-4/5': plottingMenuShown },
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
              <img class="w-full h-full fas fa-caret-right animate-bounce-x shadow-3xl"/>
            </span>
          </div>
        </div>
      </div>

      <!-- POPUP LAYOUT -->
      <div class="popup w-full h-full absolute bg-black animation-enable"
            :class="[{'opacity-0' : !popupShown},
                     {'opacity-75' : popupShown}]"></div>
      <div class="popup absolute w-1/3 h-1/3 flex flex-col justify-center text-center animation-enable-short bg-yellow-600 border-gray-300 border-16 font-overpass-bold text-xl rounded-xl shadow-inner-xl"
            :class="[{'bottom-1/2 left-1/2 opacity-0 transform scale-0' : !popupShown},
                     {'inset-center opacity-100 transform scale-100' : popupShown}]">
        <div class="absolute right-1/2 -top-15% transform translate-x-1/2 px-5 py-2 text-2xl font-black bg-yellow-600 border-2 border-gray-900 border-solid shadow-2xl">
          RESET
        </div>
        <div>APA KAMU YAKIN INGIN RESET SEMUA PLOTTINGAN?</div>
        <div class="flex justify-evenly mt-8">
          <div @click="resetJadwal" class="cursor-pointer p-2 bg-green-600 rounded-lg shadow-md hover:bg-green-700 active:bg-green-800 animation-enable-short">BENER KOK!</div>
          <div @click="closePopup" class="cursor-pointer p-2 bg-red-600  rounded-lg shadow-md hover:bg-red-700 active:bg-red-800 animation-enable-short">HAMPIR AJA :')</div>
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
  .nth-bg-gray-600:nth-child(4n-0), .nth-bg-gray-600:nth-child(4n-1){
    --bg-opacity: 1 !important;
    background-color: #718096 !important;
    background-color: rgba(113, 128, 150, var(--bg-opacity)) !important;
  }
  .nth-text-gray-100:nth-child(4n-0), .nth-text-gray-100:nth-child(4n-1){
    --text-opacity: 1 !important;
    color: #f7fafc !important;
    color: rgba(247, 250, 252, var(--text-opacity)) !important;
  }

  .nth-bg-gray-600:nth-child(4n-0):active, .nth-bg-gray-600:nth-child(4n-1):active{
    --bg-opacity: 1 !important;
    background-color: #a0aec0 !important;
    background-color: rgba(160, 174, 192, var(--bg-opacity)) !important;
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
      pelanggaranPriviledge: [1,2,4,5,6,18],
      RankingPriviledge: [1,2,4,5,8,16],
      allLaporanPriviledge: [1,2,4,5,6],
      jawabanPriviledge: [1,2,7,11,15],
      soalPriviledge: "all",

      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,

      formHovered: false,
      buttonHovered: false,
      plottingMenuShown: false,
      popupShown: false,

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
      menuPelanggaran: false,
      menuRanking: false,
      menuAllLaporan: false,
      menuJawaban: false,

      hari: ["SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU", "TOT"],

      listAllJaga: this.allJaga === null ? [] : this.allJaga,

      sortedByKelas : false,
      sortedByShift : true,
      sortedAllKelas: [],

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
        this.comingFrom === 'polling' ||
        this.comingFrom === 'konfigurasi' ||
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
    };

    for (let index = 0; index < this.hari.length; index++) {
      var tempSortedKelas = [];
      tempSortedKelas = this.allKelas.filter(function (item) {
        return item.hari === globe.hari[index];
      }).sort( function(a, b){ return a.shift - b.shift } );

      this.sortedAllKelas = this.sortedAllKelas.concat(tempSortedKelas);
    };

    $(".popup").addClass("-z-10");
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
      if($whereTo === "pelanggaran")
        this.menuPelanggaran = $bool;
      if($whereTo === "rating")
        this.menuRanking = $bool;
      if($whereTo === "allLaporan")
        this.menuAllLaporan = $bool;
      if($whereTo === "jawaban")
        this.menuJawaban = $bool;
    },

    openPopup: function(){

      if (this.listAllJaga.length > 0) {
        this.popupShown = true;
        setTimeout(
          function() {
            $(".popup").removeClass("-z-10");
          }, 100);   
      }
    },

    closePopup: function(){
      
      this.popupShown = false;
      setTimeout(
        function() {
          $(".popup").addClass("-z-10");
        }, 500); 
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

    plotChoosen: function ($asisten_id, $kelas_id) {
      if (this.formJaga.asisten_id !== $asisten_id) {
        this.formJaga.asisten_id = $asisten_id;
        this.formJaga.kelas_id = $kelas_id;
        this.plottingMenuShown = true;
        this.formHovered = true;
      } 
      else {
        this.formJaga.asisten_id = '';
        this.formJaga.asisten_id = '';
        this.plottingMenuShown = false;
        this.formHovered = false;  
      }
    },

    sortByKelas: function () {
      if (!this.sortedByKelas) {
        this.sortedAllKelas = [];
        this.sortedAllKelas = this.allKelas.sort(function(a, b){
                                let x = a.kelas.toLowerCase();
                                let y = b.kelas.toLowerCase();
                                if (x < y) {return -1;}
                                if (x > y) {return 1;}
                                return 0;
                              });
        this.sortedByKelas = true;
        this.sortedByShift = false;
      }
    },

    sortByShift: function () {

      const globe = this;

      if (!this.sortedByShift) {
        this.sortedAllKelas = [];
        for (let index = 0; index < this.hari.length; index++) {
          var tempSortedKelas = [];
          tempSortedKelas = this.allKelas.filter(function (item) {
            return item.hari === globe.hari[index];
          }).sort( function(a, b){ return a.shift - b.shift } );
  
          this.sortedAllKelas = this.sortedAllKelas.concat(tempSortedKelas);
        };
  
        this.sortedByKelas = false;
        this.sortedByShift = true;
      }
    },

    resetJadwal: function(){
      const globe = this;
      this.$axios.post('/resetJadwalJaga').then(response => {
        
        if(response.data.message === "success") {
          
          globe.$toasted.global.showSuccess({
            message: "Jadwal Jaga berhasil reset"
          });

          globe.listAllJaga = [];
          globe.closePopup();
          
          this.formJaga.asisten_id = '';
          this.formJaga.kelas_id = '';
          this.plottingMenuShown = false;
        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      })

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
          
          this.formJaga.asisten_id = '';
          this.formJaga.kelas_id = '';
          this.plottingMenuShown = false;
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
          });

          setTimeout(
            function() {
              globe.formJaga.asisten_id = '';
            }, 500
          ); 
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
