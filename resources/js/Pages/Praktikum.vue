<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">
    
    <!-- Sound Part -->
    <div id="sound"></div>

    <!-- Main Menu -->
    <div :class="[{ 'hidden' : !menuDisabled },
                  { 'visible' : menuDisabled }]">
      <div class="absolute w-120 z-20 h-48full bottom-0 right-0 animation-enable"
          :class="[{ 'right-0': pageActive },
                  { 'right-min20rem': !pageActive }]" @mouseover="isMenuShown = false">
        <div class="w-full h-full animation-enable overflow-y-auto"
            :class="[{ 'rounded-none': changePage && menuProfil },
                    { 'rounded-tl-large': !changePage || !menuProfil }]" ref="menu">

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

          <div class="w-full p-4 h-24 flex select-none animation-enable"
              :class="[{ 'bg-yellow-500 text-white': !changePage },
                      { 'bg-yellow-400 text-black': changePage }]">
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

          <div class="w-full p-4 h-24 flex select-none animation-enable"
              :class="[{ 'bg-yellow-500 text-white': !changePage },
                      { 'bg-yellow-400 text-black': changePage }]">
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

          <div v-if="soalPriviledge.includes(currentUser.role_id)">
            <div class="w-full p-4 h-24 flex select-none animation-enable"
                :class="[{ 'bg-yellow-500 text-white': !changePage },
                        { 'bg-yellow-400 text-black': changePage }]">
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

          <div v-if="modulPriviledge.includes(currentUser.role_id)">
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

          <div v-if="konfigurasiPriviledge.includes(currentUser.role_id)">
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
    </div>
    <div  :class="[{ 'hidden' : menuDisabled },
                  { 'visible' : !menuDisabled }]">
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

    <!-- Praktikum Layout (No praktikum exist || "i am the PJ") -->
    <div class="relative h-full w-120full relative animation-enable"
        :class="[{ 'left-0': currentPage},
                { 'left-minFull': !currentPage}]"
        @mouseover="isMenuShown = false;">

      <div class="w-full h-full flex"
          v-if="isForbidden">
        <div class="m-auto w-auto h-auto text-center">
          <span class="font-monda-bold whitespace-pre-wrap break-words text-3xl text-white">Ada praktikum yang sedang berlangsung<br>(liat menu lain aja)</span>
        </div>
      </div>

      <div class="w-full h-full flex"
          v-if="!isForbidden">
        <div v-if="statusPraktikum === 5 ||
                  statusPraktikum === 6"
            class="w-full h-24full flex-row absolute bottom-0 pointer-events-none">
          <div class="w-full h-36full flex pointer-events-auto px-10">
            <div v-if="statusPraktikum === 5"  
                class="w-full h-full flex-row">
              <div class="w-full h-full flex">
                <div
                    class="font-overpass-bold text-4xl text-white text-center m-auto">
                  PRAKTIKUM SELESAI <br>
                  Terimakasih atas kehadirannya <br>
                  (Silahkan rating asisten dan praktikumnya  😄 )
                </div>
              </div>
            </div>
            <div v-if="statusPraktikum === 6" 
                class="w-3/4 h-24full px-5 m-auto flex-row">
              <div class="w-full h-1/5 flex">
                <div class="w-1/4 h-full flex">
                  <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                    Asisten JAGA
                  </div>
                </div>
                <div class="w-3/4 h-full py-2 flex">
                  <div class="w-full h-full">
                    <input v-model="formHistoryJaga.allasisten_kode"
                          class="font-overpass-mono-bold uppercase text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                          id="kode" type="text" placeholder='Pisahkan dengan tanda "-" untuk penulisan'>
                  </div>
                </div>
              </div>
              <div class="w-full h-1/5 flex">
                <div class="w-1/4 h-full flex">
                  <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                    Asisten IZIN
                  </div>
                </div>
                <div class="w-3/4 h-full py-2 flex">
                  <div class="w-full h-full">
                    <input v-model="formHistoryIzin_Izin.allasisten_kode"
                          class="font-overpass-mono-bold uppercase text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                          id="kode" type="text" placeholder='Pisahkan dengan tanda "-" untuk penulisan'>
                  </div>
                </div>
              </div>
              <div class="w-full h-1/5 flex">
                <div class="w-1/4 h-full flex">
                  <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                    Asisten SAKIT
                  </div>
                </div>
                <div class="w-3/4 h-full py-2 flex">
                  <div class="w-full h-full">
                    <input v-model="formHistoryIzin_Sakit.allasisten_kode"
                          class="font-overpass-mono-bold uppercase text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                          id="kode" type="text" placeholder='Pisahkan dengan tanda "-" untuk penulisan'>
                  </div>
                </div>
              </div>
              <div class="w-full h-1/5 flex">
                <div class="w-1/4 h-full flex">
                  <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                    Asisten ALFA
                  </div>
                </div>
                <div class="w-3/4 h-full py-2 flex">
                  <div class="w-full h-full">
                    <input v-model="formHistoryIzin_Alfa.allasisten_kode"
                          class="font-overpass-mono-bold uppercase text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                          id="kode" type="text" placeholder='Pisahkan dengan tanda "-" untuk penulisan'>
                  </div>
                </div>
              </div>
              <div class="w-full h-1/5 flex">
                <div class="w-1/4 h-full flex">
                  <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                    Praktikan ALFA
                  </div>
                </div>
                <div class="w-3/4 h-full py-2 flex">
                  <div class="w-full h-full">
                    <input v-model="formPraktikan_Alfa.allpraktikan_nim"
                          class="font-overpass-mono-bold uppercase text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                          id="kode" type="text" placeholder='Pisahkan dengan tanda "-" untuk penulisan'>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="statusPraktikum === 6"  
                class="w-1/4 pb-10 px-5 h-24full m-auto flex-row">
              <span class="font-merri w-full text-left text-white text-lg h-1/4">
                Laporan
               <p>(Waktu selesai praktikum tertulis otomatis)</p>
              </span>
              <div class="w-full h-full">
                <textarea v-model="formLaporanPj.laporan" cols="30" rows="10"
                      class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                      id="Laporan" type="text" placeholder="Ex: Asisten FAI jaga 2 kelompok, ingat cantumkan tanggal"/>
              </div>
            </div>
          </div>
          <div class="w-1/3 h-full m-auto flex p-4 hover:p-5 animation-enable-short cursor-pointer pointer-events-auto"
              v-on:click="goToNextSection(false)">
            <div class="w-full h-16 bg-gray-300 flex font-merri-bold text-2xl items-center rounded-full">
              <div class="w-auto select-none h-full m-auto items-center flex">
                NEXT
              </div>
            </div>
          </div>
        </div>

        <div v-if="statusPraktikum === 0 ||
                  statusPraktikum === 1 ||
                  statusPraktikum === 2 ||
                  statusPraktikum === 3 ||
                  statusPraktikum === 4 ||
                  statusPraktikum === 123" 
            class="w-full h-24full flex-row absolute bottom-0 pointer-events-none">
          <div class="w-full h-1/2 flex">
            <div class="w-auto text-white h-auto mx-auto mt-auto pt-24 text-center">
              <span class="font-overpass-bold text-3xl text-center"
                  v-if="!isRunmod"
                  :class="[{ 'visible': statusPraktikum === 0 },
                          { 'hidden': statusPraktikum != 0 }]">
                PRAKTIKUM DASKOM<br>
                (Klik START untuk memulai TA)
              </span> 
              <span class="font-overpass-bold text-3xl text-center"
                  v-if="isRunmod"
                  :class="[{ 'visible': statusPraktikum === 0 },
                          { 'hidden': statusPraktikum != 0 }]">
                PRAKTIKUM DASKOM<br>
                (Klik START untuk memulai JURNAL)
              </span> 
              <span class="font-overpass-bold text-9xl " 
                  :class="[{ 'visible': statusPraktikum === 1 },
                          { 'hidden': statusPraktikum != 1 }]">
                TA
              </span> 
              <span class="font-overpass-bold text-9xl " 
                  :class="[{ 'visible': statusPraktikum === 2 || statusPraktikum === 123 },
                          { 'hidden': statusPraktikum != 2 && statusPraktikum != 123 }]">
                PRESENTASI
              </span> 
              <span class="font-overpass-bold text-9xl " 
                  :class="[{ 'visible': statusPraktikum === 3 },
                          { 'hidden': statusPraktikum != 3 }]">
                JURNAL
              </span> 
              <span class="font-overpass-bold text-9xl " 
                  :class="[{ 'visible': statusPraktikum === 4 },
                          { 'hidden': statusPraktikum != 4 }]">
                TK
              </span> 
            </div>
          </div>
          <div class="w-full h-1/2 flex-row">
            <div class="w-full h-1/3 flex">
              <div class="w-3/4 bg-yellow-400 rounded-large font-monda-bold text-6xl h-full items-center m-auto flex">
                <div class="w-auto h-auto text-green-600 pt-1 m-auto">
                  {{ time }}
                </div>
              </div>
            </div>
            <div class="w-full h-24 flex">
              <div class="w-3/4 h-full m-auto flex">
                <div class="w-full h-full flex">
                  <div class="h-full flex p-4 hover:p-5 animation-enable-short cursor-pointer pointer-events-auto"
                      :class="[{ 'w-1/2': statusPraktikum === 0 },
                              { 'w-1/3': statusPraktikum !== 0 }]"
                      v-on:click="rollbackPraktikum(false)">
                    <div class="w-full h-full bg-gray-300 flex font-merri-bold text-2xl items-center rounded-full">
                      <div class="w-auto select-none h-full m-auto items-center flex">
                        ROLLBACK
                      </div>
                    </div>
                  </div>
                  <div class="h-full flex p-4 hover:p-5 animation-enable-short cursor-pointer pointer-events-auto"
                      :class="[{ 'hidden': countdownStarted },
                              { 'visible': !countdownStarted },
                              { 'w-1/2': statusPraktikum === 0 },
                              { 'w-1/3': statusPraktikum !== 0 }]"
                      v-on:click="startCountdown()">
                    <div class="w-full h-full bg-gray-300 flex font-merri-bold text-2xl items-center rounded-full">
                      <div class="w-auto select-none h-full m-auto items-center flex">
                        START
                      </div>
                    </div>
                  </div>
                  <div class="h-full flex p-4 hover:p-5 animation-enable-short cursor-pointer pointer-events-auto"
                      :class="[{ 'hidden': !countdownStarted },
                              { 'visible': countdownStarted },
                              { 'w-1/2': statusPraktikum === 0 },
                              { 'w-1/3': statusPraktikum !== 0 }]"
                      v-on:click="pauseCountdown()">
                    <div class="w-full h-full bg-gray-300 flex font-merri-bold text-2xl items-center rounded-full">
                      <div class="w-auto select-none h-full m-auto items-center flex">
                        PAUSE
                      </div>
                    </div>
                  </div>
                  <div class="w-1/3 h-full flex p-4 hover:p-5 animation-enable-short cursor-pointer pointer-events-auto"
                      :class="[{ 'hidden': statusPraktikum === 0 },
                              { 'visible': statusPraktikum !== 0 }]"
                      v-on:click="goToNextSection(false)">
                    <div class="w-full h-full bg-gray-300 flex font-merri-bold text-2xl items-center rounded-full">
                      <div class="w-auto select-none h-full m-auto items-center flex">
                        NEXT
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  

        <div class="w-full h-24 px-8 mt-8 flex z-20">
          <div class="h-full flex-row"
              :class="[{ 'w-1/2': !isRunmod },
                        { 'w-full': isRunmod }]">
            <div class="font-merri w-full flex text-left text-yellow-400 text-2xl mb-2 h-1/3">
              <span class="h-auto my-auto">
                Kelas
              </span>
            </div>
            <div class="w-full h-1/2 tatkOption">
              <select :onchange="getAllAsistenPraktikan()" v-model="chosenKelasID" 
                    class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state"
                    :class="[{ 'pointer-events-none': praktikumStart },
                            { 'pointer-events-auto': !praktikumStart }]">
                <option v-for="kelas in allKelas" v-bind:key="kelas.id" :value="kelas.id">
                  {{ kelas.kelas }} [ {{ kelas.hari.toUpperCase() }} - Shift {{ kelas.shift }} ]
                </option>
              </select>
            </div>
          </div>
          <div v-if="!isRunmod" 
              class="w-1/2 pl-8 h-full flex-row">
            <div class="font-merri w-full flex text-left text-yellow-400 text-2xl mb-2 h-1/3">
              <span class="h-auto my-auto">
                Modul
              </span>
            </div>
            <div class="w-full h-1/2 tatkOption">
              <select v-model="chosenModulID"
                    class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state"
                    :class="[{ 'pointer-events-none': praktikumStart },
                            { 'pointer-events-auto': !praktikumStart }]">
                <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">
                  {{ modul.judul }}
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-full h-36full absolute animation-enable z-20"
            :class="[{ 'bottom-0': !praktikumStart },
                    { 'bottom-minFull': praktikumStart }]">
          <div class="w-16full bg-green-500 rounded-t-lg mx-auto h-full" v-bar>
            <div class="p-8">
              <div class="w-full h-auto flex rounded-lg bg-gray-300">
                <div class="w-full h-auto flex"
                    v-if="listAllAsisten.length > 0 &&
                          listAllPraktikan.length > 0">
                  <div class="w-1/3 h-auto flex-row">
                    <transition-group name="asisten-list" tag="div">
                      <div v-for="(asisten, index) in listAllAsisten" v-bind:key="asisten.id" 
                          class="animation-enable w-full flex-row"
                          :class="['h-'+ 12 * (praktikanComplete + (praktikanLeft-(index+1) >= 0 ? 1 : 0)),
                                  { 'bg-gray-300 text-black': index % 2 === 0 },
                                  { 'bg-gray-600 text-white': index % 2 != 0 },
                                  { 'rounded-tl-lg': index === 0 },
                                  { 'rounded-bl-lg': index+1 === listAllAsisten.length }]">
                        <div class="w-full h-2/3 flex">
                          <div class="mx-auto mt-auto font-overpass-bold text-4xl">
                            {{ asisten.kode }}
                          </div>
                        </div>
                        <div class="w-full -mt-4 flex">
                          <div class="mx-auto mb-auto font-merri text-2xl">
                            {{ index + 1 }}
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
                          :class="[{ 'rounded-tr-lg': index === 0 },
                                  { 'rounded-br-lg': index === listAllPraktikan.length-1 },
                                  { 'bg-gray-600 text-white': 
                                      parseInt((praktikanLeft - (index / (praktikanComplete + 1)) > 0 ? index : index+(praktikanComplete - praktikanLeft)) / 
                                        (praktikanLeft - (index / (praktikanComplete + 1)) > 0 ? praktikanComplete+1 : praktikanComplete)) 
                                      % 2 === (praktikanLeft - (index / (praktikanComplete + 1)) > 0 ? 0 : (praktikanLeft % 2 === 1 && praktikanLeft < praktikanComplete || praktikanLeft === praktikanComplete ? 0 : 1)) }]">
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

              <div class="w-full h-24 mt-4 mb-8 flex">
                <div class="w-1/3 h-full flex py-4 px-8 hover:px-10 hover:py-5 animation-enable-short cursor-pointer"
                    :class="[{ 'hidden' : spaceToggled },
                            { 'visible' : !spaceToggled }]"
                    v-on:click="shuffleEmAll()">
                  <div class="w-full h-full flex font-monda-bold text-4xl bg-yellow-400 rounded-full">
                    <div class="w-auto select-none h-auto m-auto">
                      SHUFFLE
                    </div>
                  </div>
                </div>
                <div class="w-1/3 h-full flex py-4 px-8 hover:px-10 hover:py-5 animation-enable-short cursor-pointer"
                    v-on:click="showBigView()">
                  <div class="w-full h-full flex font-monda-bold text-4xl bg-yellow-400 rounded-full">
                    <div class="w-auto select-none h-auto m-auto">
                      VIEW
                    </div>
                  </div>
                </div>
                <div class="w-1/3 h-full flex py-4 px-8 hover:px-10 hover:py-5 animation-enable-short cursor-pointer"
                    v-on:click="startThePracticum()">
                  <div class="w-full h-full flex font-monda-bold text-4xl bg-yellow-400 rounded-full">
                    <div class="w-auto select-none h-auto m-auto">
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

    <div class="w-full h-full flex absolute bg-black opacity-90 z-30 top-0"
        :class="[{ 'hidden': !bigLeaveQuestionShown },
                { 'visible': bigLeaveQuestionShown }]">
      <div class="w-3/4 h-60 flex-row m-auto items-end z-40">
        <div class="w-full h-1/2 font-monda-bold text-center items-end flex text-3xl text-white">
          <div class="mx-auto">
            Apakah anda yakin ? (Any changes can't be revert back) <br>
            Are you sure ? (Semua perubahan tidak bisa dikembalikkan)  
          </div>
        </div>
        <div class="w-full h-1/2 flex">
          <div class="w-1/2 h-full p-4">
            <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
                v-on:click="bigLeaveQuestionShown = false">
              <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-red-600">
                <div class="m-auto">
                  NOPE (lanjutkan praktikumnya)
                </div>
              </div>
            </div>
          </div>
          <div class="w-1/2 h-full p-4">
            <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
                v-on:click="rollbackPraktikum(true)">
              <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-green-600">
                <div class="m-auto">
                  YEAH (get me out)
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="w-full h-full flex absolute bg-black opacity-90 z-30 top-0"
        :class="[{ 'hidden': !bigNextQuestionShown },
                { 'visible': bigNextQuestionShown }]">
      <div class="w-3/4 h-60 flex-row m-auto items-end z-40">
        <div class="w-full h-1/2 font-monda-bold text-center items-end flex text-3xl text-white">
          <div class="mx-auto">
            Waktu belum selesai !!! <br>
            Apakah ingin tetap lanjut ?  
          </div>
        </div>
        <div class="w-full h-1/2 flex">
          <div class="w-1/2 h-full p-4">
            <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
                v-on:click="bigNextQuestionShown = false">
              <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-red-600">
                <div class="m-auto">
                  NOPE (Salah pencet)
                </div>
              </div>
            </div>
          </div>
          <div class="w-1/2 h-full p-4">
            <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
                v-on:click="goToNextSection(true)">
              <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-green-600">
                <div class="m-auto">
                  YEAH (Lanjut ke bagian berikutnya)
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="w-full h-full flex absolute bg-black opacity-97 z-30 top-0"
        :class="[{ 'hidden': !bigviewShown },
                { 'visible': bigviewShown }]">
      <div class="w-24 h-4full flex-row"
          :class="[{ 'visible' : praktikanBanned.length > 0 || asistenBanned.length > 0 },
                  { 'hidden' : praktikanBanned.length == 0 && asistenBanned.length == 0 }]">
        <div v-for="praktikan in praktikanBanned" v-bind:key="praktikan.nim"
            class="w-full h-8 py-1 px-2 flex">
          <div class="w-full h-full flex rounded-sm bg-gray-400 text-black text-xl font-overpass-mono-bold">
            <span class="m-auto">{{ praktikan.nim }}</span>
          </div>
        </div>
        <div v-for="asisten in asistenBanned" v-bind:key="asisten.kode"
            class="w-full h-8 py-1 px-2 flex">
          <div class="w-full h-full flex rounded-sm bg-yellow-400 text-black text-xl font-overpass-mono-bold">
            <span class="m-auto">{{ asisten.kode }}</span>
          </div>
        </div>
      </div>
      <div class="h-4full flex-row"
          :class="[{ 'w-24full' : praktikanBanned.length > 0 || asistenBanned.length > 0 },
                  { 'w-4full' : praktikanBanned.length == 0 && asistenBanned.length == 0 }]">
        <div class="w-full h-16 flex">
          <div class="w-full h-full flex">
            <div class="w-1/3 h-full flex py-2 px-8 hover:px-10 hover:py-3 animation-enable-short cursor-pointer"
                v-on:click="bigviewShown = false">
              <div class="w-full h-full flex font-monda-bold text-lg bg-yellow-400 rounded-lg">
                <div class="w-auto select-none h-auto m-auto">
                  CLOSE
                </div>
              </div>
            </div>
            <div class="w-1/3 h-full flex py-2 px-8 hover:px-10 hover:py-3 animation-enable-short cursor-pointer"
                :class="[{ 'hidden' : spaceToggled },
                        { 'visible' : !spaceToggled }]"
                v-on:click="shuffleEmAll()">
              <div class="w-full h-full flex font-monda-bold text-lg bg-yellow-400 rounded-lg">
                <div class="w-auto select-none h-auto m-auto">
                  SHUFFLE
                </div>
              </div>
            </div>
            <div class="w-1/3 h-full flex py-2 px-8 hover:px-10 hover:py-3 animation-enable-short cursor-pointer"
                v-on:click="console.log('nop')">
              <div class="w-full h-full flex font-monda-bold text-lg bg-yellow-400 rounded-lg">
                <div class="w-auto select-none h-auto m-auto">
                  SAVE
                </div>
              </div>
            </div>
          </div> 
        </div>
        <div class="w-full h-16full flex-row pt-4 px-4">
          <div v-for="(plotrow, row) in plots" v-bind:key="row"
                class="w-full flex"
                :style="'height: ' + (100/plots.length) + '%; '">
            <div v-for="(space, col) in plotrow" v-bind:key="col"
                  class="h-full flex p-1 hover:p-2 animation-enable-short"
                  :class="'space-' + row + '-' + col"
                  :style="'width: ' + (100/plots[row].length) + '%; '"
                  v-on:click="toggleSpace(space)">

              <!--------------------------->
              <!-- PLOTTING POSITION     -->
              <!--------------------------->
              <!-- 0   -> empty space                                        -->
              <!-- 1,2 -> practicant space (different number for grouping)   -->
              <!-- 3   -> asisstant space                                    -->
              <!-- 4   -> info pj space                                      -->
              <!-- 5   -> backup space                                       -->
              <!-- 6   -> info practicum space                               -->
              <!-- 7   -> projector space                                    -->
              <div class="w-full h-full flex rounded-sm text-black text-xl font-overpass-mono-bold"
                  :class="[{ 'opacity-0' : space.substring(0,1) == 0 },
                            { 'bg-red-600 cursor-pointer' : space.substring(0,1) == 1 },
                            { 'bg-blue-600 cursor-pointer' : space.substring(0,1) == 2 },
                            { 'bg-yellow-600 cursor-pointer' : space.substring(0,1) == 3 },
                            { 'bg-yellow-700' : space.substring(0,1) == 4 },
                            { 'bg-green-700' : space.substring(0,1) == 5 },
                            { 'bg-yellow-900' : space.substring(0,1) == 6 },
                            { 'bg-orange-700' : space.substring(0,1) == 7 },]">

                <div class="w-auto h-auto m-auto"
                    :class="[{ 'visible': space.substring(0,1) == 3 },
                              { 'hidden': space.substring(0,1) != 3 },]">
                  <span :id="'asisten-' + space">{{ listAllAsisten[parseInt(space.substring(1,3))] == undefined ? "" : listAllAsisten[parseInt(space.substring(1,3))].kode }}</span>              
                </div>

                <div class="w-auto h-auto m-auto"
                    :class="[{ 'visible': space.substring(0,1) == 1 || space.substring(0,1) == 2 },
                              { 'hidden': space.substring(0,1) != 1 && space.substring(0,1) != 2 },]">
                  <span :id="'praktikan-' + space">{{ listAllPraktikan[((parseInt(space.substring(1,3)) * 3) + parseInt(space.substring(3,4))) - 1] == undefined ? "" : listAllPraktikan[((parseInt(space.substring(1,3)) * 3) + parseInt(space.substring(3,4))) - 1].nim.substring(6,10) }}</span>
                </div>

              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>

    <div class="w-full h-full flex absolute bg-black opacity-90 z-30 top-0"
        :class="[{ 'hidden': !bigRatingQuestionShown },
                { 'visible': bigRatingQuestionShown }]">
      <div class="w-3/4 h-60 flex-row m-auto items-end z-40">
        <div class="w-full h-1/2 font-monda-bold text-center items-end flex text-3xl text-white">
          <div class="mx-auto">
            Apakah semua praktikan sudah rating ? <br>
            Jika sudah yakin maka klik "YEAH" 
          </div>
        </div>
        <div class="w-full h-1/2 flex">
          <div class="w-1/2 h-full p-4">
            <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
                v-on:click="bigRatingQuestionShown = false">
              <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-red-600">
                <div class="m-auto">
                  NOPE (Salah pencet)
                </div>
              </div>
            </div>
          </div>
          <div class="w-1/2 h-full p-4">
            <div class="w-full h-full p-4 cursor-pointer hover:p-5 animation-enable-short"
                v-on:click="goToNextSection(true)">
              <div class="w-full h-full font-overpass-bold text-xl text-white flex pt-1 rounded-full bg-green-600">
                <div class="m-auto">
                  YEAH (Lanjut ke bagian berikutnya)
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
import moment from 'moment';
export default {
  props: [
    'comingFrom',
    'currentUser',
    'position',
    'userRole',
    'allKelas',
    'allModul',
    'isRunmod',
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

      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,
      isForbidden: false,

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
      menuKonfigurasi: false,
      menuTp: false,
      menuNilai: false,
      menuSetPraktikan: false,
      menuPelanggaran : false,
      menuDisabled : false,

      listAllAsisten: [],
      listAllPraktikan: [],

      shuffledListAllAsisten: [],
      shuffledListAllPraktikan: [],

      praktikumStart: false,
      countdownStarted: false,
      firstTimeCounting: true,
      bigLeaveQuestionShown: false,
      bigNextQuestionShown: false,
      bigRatingQuestionShown: false,
      soundPlayed: false,

      bigviewShown: false,

      /***************************/
      /* PLOTTING POSITION
      /***************************/
      // 0   -> empty space
      // 1,2 -> practicant space (different number for grouping)
      // 3   -> asisstant space
      // 4   -> info pj space
      // 5   -> backup space
      // 6   -> info practicum space
      // 7   -> projector space

      /* plots[*].substring(0,1) == "Space for State"                       */
      /* plots[*].substring(1,3) == "Space for Grouping"                    */
      /* plots[*].substring(3,4) == "Space for practicant person per group" */
      plots:[
        ['0000','0000','0000','0000','0000','7000','7000','7000','0000','0000','0000','0000','0000'],
        ['1001','2012','2011','5000','0000','0000','0000','0000','0000','5000','2021','2022','1031'],

        // TODO: uncomment this to add Practicum and PJ info
        // ['3000','0000','3020','0000','0000','0000','0000','0000','0000','0000','3020','0000','3030'],
        // ['1002','1003','2013','0000','0000','0000','0000','0000','0000','0000','2023','1033','1032'],
        
        ['3000','0000','3010','0000','0000','0000','0000','0000','0000','0000','3020','0000','3030'],
        ['1002','1003','2013','0000','0000','0000','0000','0000','0000','0000','2023','1033','1032'],
        ['0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000'],
        ['0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000'],
        ['2041','1051','1052','0000','2131','2132','1061','2072','2071','0000','2081','2082','1093'],
        ['3040','0000','3050','0000','0000','3130','3060','3070','0000','0000','3080','0000','3090'],
        ['2042','2043','1053','0000','0000','1063','1062','2073','0000','0000','2083','1091','1092'],
        ['0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000'],
        ['0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000','0000'],
        ['2101','2102','2103','0000','0000','1111','1112','1113','0000','0000','2121','2122','2123'],
        ['0000','3100','0000','0000','0000','0000','3110','0000','0000','0000','0000','3120','0000'],
      ],

      asistenBanned: [],
      praktikanBanned: [],
      praktikanGroups: [],
      spaceToggled: false,

      oldKelasID: '',
      chosenKelasID: '', 
      chosenModulID: '',
      praktikanLeft: '',
      praktikanComplete: '',

      /****************************/
      /*  JENIS STATUS (7 Steps)  */
      /****************************/
      // 0: Just started (First default initialization)
      // 1: Begin TA countdown
      // 2: Go To Mandiri (presentasi) Section  //changed since 2018 in charge (developAND)
      // 3: Go To Jurnal Section
      // 4: Go To TK section
      // 5: Open The Laporan Praktikan 
      //    (Tell them to rate the assistant and the prakikum)
      // 6: Open The Laporan PJ and write down the condition of the praktikum
      //    (Only shows "DONE" button for ending the praktikum)
      //    (Dont forget to add data to history_jaga table)
      // 123: Special Case (RunMod Start)
      statusPraktikum: 0,

      formPraktikum: {
        kelas_id: '',
        modul_id: '',
        pj_id: '',
        laporan_id: '',
      },

      formHistoryJaga: {
        allasisten_kode: '',
        hari: '',
        shift: '',
        pj: '',
        asisten_id: '',
      },

      formHistoryIzin_Izin: {
        allasisten_kode: '',
        hari: '',
        shift: '',
        status: 1,
        modul_id: '',
      },

      formHistoryIzin_Sakit: {
        allasisten_kode: '',
        hari: '',
        shift: '',
        status: 2,
        modul_id: '',
      },

      formHistoryIzin_Alfa: {
        allasisten_kode: '',
        hari: '',
        shift: '',
        status: 3,
        modul_id: '',
      },

      formPraktikan_Alfa: {
        allpraktikan_nim: '',
        modul_id: '',
      },

      formCurrentPraktikum: {
        asisten_id: '', //Current Asisten ID (Assuming he/she is the PJ)
        kelas_id: '',
        modul_id: '',
      },

      formLaporanPj: {
        id: '',
        allasisten_id: '',
        hari: '',
        shift: '',
        laporan: '',
        modul_id: '',
      },

      // ***************************************************** //
      // CHANGE THIS PRAKTIKUM TIMING BASED ON YOUR OWN SYSTEM //
      // ***************************************************** //
      TAtiming: moment().startOf('day').add(10, 'minutes'),
      JURNALtiming: moment().startOf('day').add(80, 'minutes'),
      RUNMODtiming: moment().startOf('day').add(40, 'minutes'),
      MANDIRItiming: moment().startOf('day').add(20, 'minutes'),
      TKtiming: moment().startOf('day').add(10, 'minutes'),
      countDown: this.isRunmod ? moment().startOf('day').add(40, 'minutes') : moment().startOf('day').add(10, 'minutes'), //(TIME IN MILLIS) // Default: Based on TAtiming\
      today: moment().format(),
    }
  },

  computed: {
    time: function(){
      return this.countDown.format('HH : mm : ss');
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.$refs.menu.scrollTop = this.position;

    if(this.isRunmod)
      this.chosenModulID = 1;
    const globe = this;

    if(this.comingFrom === 'asisten' ||
        this.comingFrom === 'none' ||
        this.comingFrom === 'kelas'||
        this.comingFrom === 'soal'||
        this.comingFrom === 'plotting'||
        this.comingFrom === 'modul' ||
        this.comingFrom === 'konfigurasi'||
        this.comingFrom === 'tp' ||
        this.comingFrom === 'polling' ||
        this.comingFrom === 'listTp' ||
        this.comingFrom === 'history'||
        this.comingFrom === 'nilai'||
        this.comingFrom === 'pelanggaran'||
        this.comingFrom === 'setpraktikan'){

      setTimeout(
        function() {
          globe.currentPage = true;
        }, 10); 
    }

    globe.$axios.post('/checkPraktikum').then(response => {

      if(response.data.message === "success") {

        if(response.data.current_praktikum != null){

          if(response.data.current_praktikum.asisten_id !== globe.currentUser.id){
            globe.isForbidden = true;
            return;
          }

          //There is currently active praktikum
          globe.formCurrentPraktikum.asisten_id = response.data.current_praktikum.asisten_id;
          globe.formCurrentPraktikum.kelas_id = response.data.current_praktikum.kelas_id;
          globe.formCurrentPraktikum.modul_id = response.data.current_praktikum.modul_id;
          globe.statusPraktikum = response.data.current_praktikum.status;
          globe.chosenKelasID = response.data.current_praktikum.kelas_id;
          globe.chosenModulID = response.data.current_praktikum.modul_id;
          globe.formPraktikum.kelas_id = this.chosenKelasID;
          globe.formPraktikum.modul_id = this.chosenModulID;
          globe.formLaporanPj.laporan ="Tanggal: "+moment().format('ll') +"          Mulai: "+ moment().format('LT') + "Selesai: .....";
          globe.getAllAsistenPraktikan();
          globe.praktikumStart = true;
          globe.menuDisabled = true;

          //(If status Praktikum === 1, means all the layout condition still on its default state)
          switch (globe.statusPraktikum) {
            case 2:
              globe.countDown = globe.MANDIRItiming;
              break;
            case 3:
              globe.countDown = globe.JURNALtiming;
              break;
            case 4:
              globe.countDown = globe.TKtiming;
              break;
            case 123:
              globe.countDown = globe.RUNMODtiming;
              break;
          }

          globe.$axios.post('/currentLaporanPJ').then(response => {

            if(response.data.message === "success") {
              
              globe.formLaporanPj.id = response.data.latestLaporanID;

            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          });

          globe.$axios.post('/latestPJHistory/jaga').then(response => {

            if(response.data.message === "success") {
              
              globe.formHistoryJaga.hari = response.data.latestPJHistory.hari;
              globe.formHistoryJaga.shift = response.data.latestPJHistory.shift;
              globe.formHistoryJaga.pj = response.data.latestPJHistory.pj;
              globe.formHistoryJaga.asisten_id = response.data.latestPJHistory.asisten_id;
              globe.formHistoryJaga.modul_id = globe.chosenModulID;

            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          });
        }

      } else {
        globe.$toasted.global.showError({
          message: response.data.message
        });
      }
    });
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
      if($whereTo === "pelanggaran")
        this.menuPelanggaran = $bool;
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

    playSound: function(filename){

      var mp3Source = '<source src="/assets/' + filename + '.mp3" type="audio/mpeg">';
      var oggSource = '<source src="/assets/' + filename + '.ogg" type="audio/ogg">';
      var embedSource = '<embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3">';
      document.getElementById("sound").innerHTML='<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>';
    },

    countDownTimer: function() {

      const globe = this;
      setInterval(() => {
        if(globe.countdownStarted && !globe.countDown.isSame(moment().startOf('day')))
          globe.countDown = moment(globe.countDown.subtract(1, 'seconds'))
        else if(globe.countdownStarted && globe.countDown.isSame(moment().startOf('day')) && !globe.soundPlayed){

          globe.playSound("completeSound");
          globe.soundPlayed = true;
        } else
          globe.countdownStarted = false; 
      }, 1000);
    },

    goToNextSection: function($force){

      const globe = this;
      if(!$force){

        if(!globe.countDown.isSame(moment().startOf('day')) && 
            globe.statusPraktikum !== 5 &&
            globe.statusPraktikum !== 6){
          globe.bigNextQuestionShown = true;
          return;
        }

        if(globe.statusPraktikum === 5){
          globe.bigRatingQuestionShown = true;
          return;
        }

        if(globe.statusPraktikum === 6){

          var sumAllAsisten_kode = [];

          if(globe.formHistoryJaga.allasisten_kode !== ''){
            var tempArr = globe.formHistoryJaga.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Tidak perlu tanda "-" pada awal dan akhir isian'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryJaga.allasisten_kode.split("-"));
          }

          if(globe.formHistoryIzin_Izin.allasisten_kode !== ''){
            var tempArr = globe.formHistoryIzin_Izin.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Tidak perlu tanda "-" pada awal dan akhir isian'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryIzin_Izin.allasisten_kode.split("-"));
          }

          if(globe.formHistoryIzin_Sakit.allasisten_kode !== ''){
            var tempArr = globe.formHistoryIzin_Sakit.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Tidak perlu tanda "-" pada awal dan akhir isian'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryIzin_Sakit.allasisten_kode.split("-"));
          }

          if(globe.formHistoryIzin_Alfa.allasisten_kode !== ''){
            var tempArr = globe.formHistoryIzin_Alfa.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Tidak perlu tanda "-" pada awal dan akhir isian'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryIzin_Alfa.allasisten_kode.split("-"));
          }

          var sumAllPraktikan_Alfa = [];
          if(globe.formPraktikan_Alfa.allpraktikan_nim !== ''){
            var tempArr = globe.formPraktikan_Alfa.allpraktikan_nim.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Tidak perlu tanda "-" pada awal dan akhir isian'
                });
                return;
              }
            }
            sumAllPraktikan_Alfa.push(globe.formPraktikan_Alfa.allpraktikan_nim.split("-"));
          }

          sumAllAsisten_kode = [].concat.apply([], sumAllAsisten_kode); // Flatten array of arrays
          sumAllAsisten_kode = sumAllAsisten_kode.map(function(x){ return x.toUpperCase() }) // Convert all string to uppercase
                    
          let findDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) != index); // Checking for duplicates
          if(findDuplicates(sumAllAsisten_kode).length > 0){
            globe.$toasted.global.showError({
              message: "Satu asisten tidak boleh berada dalam kolom yang berbeda"
            });
            return;
          }

          if(sumAllAsisten_kode.length === 0){
            globe.$toasted.global.showError({
              message: "Isi data terlebih dahulu"
            });
            return;
          }

          if(sumAllPraktikan_Alfa.length === 0 && globe.formPraktikan_Alfa.allpraktikan_nim !== "*"){
            globe.$toasted.global.showError({
              message: "Ketikkan '*' pada praktikan alfa <br> jika tidak ada praktikan yang alfa"
            });
            return;
          } else if(globe.formPraktikan_Alfa.allpraktikan_nim !== "*"){

            for (let index = 0; index < sumAllPraktikan_Alfa.length; index++) {
              const praktikan = sumAllPraktikan_Alfa[index];

              var isExist = false;
              globe.listAllPraktikan.forEach(allPraktikan => {
                if(allPraktikan.nim == praktikan)
                  isExist = true;
              });

              if(!isExist){
                globe.$toasted.global.showError({
                  message: 'Praktikan dengan nim "'+ praktikan +'" tidak ada dalam kelas ini'
                });
                return;
              }
            }
          }

          if(sumAllAsisten_kode.includes(globe.currentUser.kode)){
            globe.$toasted.global.showError({
              message: "Asisten PJ tidak perlu ditulis disini"
            });
            return;
          }

          var listAllAsistenKode = [];
          globe.listAllAsisten.forEach(asisten => {
            if(asisten.kode != globe.currentUser.kode)
              listAllAsistenKode.push(asisten.kode);
          });

          let diff_FromList = sumAllAsisten_kode.filter(x => !listAllAsistenKode.includes(x));
          let diff_FromSum = listAllAsistenKode.filter(x => !sumAllAsisten_kode.includes(x));

          for (let index = 0; index < diff_FromList.length; index++) {
            const element = diff_FromList[index];

            if(sumAllAsisten_kode.includes(element)){
              globe.$toasted.global.showError({
                message: "Asisten "+diff_FromList+" tidak ada dalam praktikum ini"
              });
              return;
            }
          }

          for (let index = 0; index < diff_FromSum.length; index++) {
            const element = diff_FromSum[index];
            if(listAllAsistenKode.includes(element)){
              globe.$toasted.global.showError({
                message: "Asisten "+diff_FromSum+" belum dimasukkan"
              });
              return;
            }
          }

          globe.allKelas.forEach(kelas => {
            if (kelas.id === globe.chosenKelasID)  {
              globe.formHistoryJaga.hari = kelas.hari;
              globe.formHistoryJaga.shift = kelas.shift;
              globe.formHistoryIzin_Izin.hari = kelas.hari;
              globe.formHistoryIzin_Izin.shift = kelas.shift;
              globe.formHistoryIzin_Sakit.hari = kelas.hari;
              globe.formHistoryIzin_Sakit.shift = kelas.shift;
              globe.formHistoryIzin_Alfa.hari = kelas.hari;
              globe.formHistoryIzin_Alfa.shift = kelas.shift;
            }
          });

          globe.formHistoryJaga.pj = 0;
          globe.formHistoryJaga.asisten_id = null;
          globe.formHistoryJaga.modul_id = globe.chosenModulID;
          globe.formHistoryIzin_Izin.modul_id = globe.chosenModulID;
          globe.formHistoryIzin_Sakit.modul_id = globe.chosenModulID;
          globe.formHistoryIzin_Alfa.modul_id = globe.chosenModulID;
          
          globe.$axios.post('/makeHistory/jaga', globe.formHistoryJaga).then(response => {

            if(response.data.message === "success") {

              globe.$axios.post('/makeHistory/izin', globe.formHistoryIzin_Izin).then(response => {

                if(response.data.message === "success") {

                  globe.$axios.post('/makeHistory/izin', globe.formHistoryIzin_Sakit).then(response => {

                    if(response.data.message === "success") {

                      globe.$axios.post('/makeHistory/izin', globe.formHistoryIzin_Alfa).then(response => {

                        if(response.data.message === "success") {
                          
                          if(globe.formPraktikan_Alfa.allpraktikan_nim !== '*'){
                           
                            globe.formPraktikan_Alfa.modul_id = globe.chosenModulID;
                            globe.$axios.post('/deletePraktikanAlfa', globe.formPraktikan_Alfa).then(response => {

                              if(response.data.message === "success") {
                                // Do nothing as its working as it supposed to be

                              } else {
                                globe.$toasted.global.showError({
                                  message: response.data.message
                                });
                              }
                            });
                          }

                          globe.$axios.post('/updateLaporanPJ', globe.formLaporanPj).then(response => {

                            if(response.data.message === "success") {

                              globe.formPraktikum.pj_id = globe.currentUser.id;
                              globe.formPraktikum.laporan_id = globe.formLaporanPj.id;
                              globe.$axios.post('/createPraktikum', globe.formPraktikum).then(response => {

                                if(response.data.message === "success") {

                                  globe.$toasted.global.showSuccess({
                                    message: "Praktikum berhasil tersimpan"
                                  });

                                } else {
                                  globe.$toasted.global.showError({
                                    message: response.data.message
                                  });
                                }
                              });
                              globe.$axios.post('/stopPraktikum').then(response => {

                                globe.praktikumStart = false;
                                globe.statusPraktikum = 0;
                                globe.menuDisabled = false;          
                              });

                            } else {
                              globe.$toasted.global.showError({
                                message: response.data.message
                              });
                            }
                          });

                        } else {
                          globe.$toasted.global.showError({
                            message: response.data.message
                          });
                        }
                      });

                    } else {
                      globe.$toasted.global.showError({
                        message: response.data.message
                      });
                    }
                  });

                } else {
                  globe.$toasted.global.showError({
                    message: response.data.message
                  });
                }
              });

            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          });
        }
      }

      globe.bigNextQuestionShown = false;
      globe.bigRatingQuestionShown = false;
      globe.soundPlayed = false;
      globe.countdownStarted = false;

      if(globe.statusPraktikum !== 123)
        globe.statusPraktikum++;
      else 
        globe.statusPraktikum = 5;

      globe.$axios.post('/continuePraktikum/'+globe.statusPraktikum).then(response => {

        if(response.data.message === "success") {
            //DO NOTHING (it runs as we expected)

        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });

      //(If status Praktikum === 1, means all the layout condition still on its default state)
      switch (globe.statusPraktikum) {
        case 2:
          globe.countDown = globe.MANDIRItiming;
          break;
        case 3:
          globe.countDown = globe.JURNALtiming;
          break;
        case 4:
          globe.countDown = globe.TKtiming;
          break;
        case 123:
          globe.countDown = globe.RUNMODtiming;
          break;
      }
    },

    showBigView: function(){

      const globe = this;
      if(this.chosenKelasID === ""){

        globe.$toasted.global.showError({
          message: "Pilih kelas terlebih dahulu"
        });
        return;
      }

      if(this.listAllAsisten.length < 1){

        globe.$toasted.global.showError({
          message: "Tidak terdapat asisten di kelas ini"
        });
        return;
      }

      if(this.listAllPraktikan.length < 1){

        globe.$toasted.global.showError({
          message: "Tidak terdapat praktikan di kelas ini"
        });
        return;
      }

      this.bigviewShown = true;
    },

    shuffleEmAll: function(){

      const globe = this;
      if(this.chosenKelasID === ""){

        globe.$toasted.global.showError({
          message: "Pilih kelas terlebih dahulu"
        });
        return;
      }

      if(this.listAllAsisten.length < 1){

        globe.$toasted.global.showError({
          message: "Tidak terdapat asisten di kelas ini"
        });
        return;
      }

      if(this.listAllPraktikan.length < 1){

        globe.$toasted.global.showError({
          message: "Tidak terdapat praktikan di kelas ini"
        });
        return;
      }

      this.shuffledListAllAsisten = this.shuffleArr(this.listAllAsisten);
      this.shuffledListAllPraktikan = this.shuffleArr(this.listAllPraktikan);

      this.listAllAsisten = this.shuffledListAllAsisten;
      this.listAllPraktikan = this.shuffledListAllPraktikan;

      //little bit hacky but works :v
      this.isMenuShown = true;
      this.isMenuShown = false;
    },

    rollbackPraktikum: function($force){

      const globe = this;

      if(!$force){
        if(!globe.firstTimeCounting){
          globe.bigLeaveQuestionShown = true;
          return;
        }
      } else  
        globe.bigLeaveQuestionShown = false;

      globe.countdownStarted = false;
      globe.bigNextQuestionShown = false;
      globe.bigRatingQuestionShown = false;
      
      if(!globe.isRunmod)
        globe.countDown = globe.TAtiming;
      else 
        globe.countDown = globe.RUNMODtiming;

      globe.firstTimeCounting = true;
      globe.praktikumStart = false;
      globe.soundPlayed = false;
      globe.statusPraktikum = 0;
      globe.menuDisabled = false;
      globe.$axios.post('/stopPraktikum');
      globe.$axios.post('/deleteLaporanPJ/'+globe.formLaporanPj.id);
      globe.$axios.post('/deleteHistory/jaga', globe.formHistoryJaga).then(response => {

        if(response.data.message === "success") {
            //DO NOTHING (it runs as we expected)

        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
    },

    startCountdown: function(){

      this.countdownStarted = true;
      const globe = this;
      
      if(this.statusPraktikum === 0){
        
        if(!globe.isRunmod)
          this.statusPraktikum = 1;
        else
          this.statusPraktikum = 123;
        globe.$axios.post('/continuePraktikum/'+globe.statusPraktikum).then(response => {

          if(response.data.message === "success") {
              //DO NOTHING (it runs as we expected)

          } else {
            globe.$toasted.global.showError({
              message: response.data.message
            });
          }
        });
      }

      if(this.firstTimeCounting){
        this.countDownTimer(); // THIS IS FOR STARTING THE COUNTDOWN
        this.firstTimeCounting = false;
      }
    },

    pauseCountdown: function(){

      this.countdownStarted = false;
    },

    startThePracticum: function(){

      const globe = this;

      globe.$axios.post('/checkPraktikum').then(response => {
        if(response.data.message === "success") {
          if(response.data.current_praktikum != null){
            if(response.data.current_praktikum.asisten_id !== globe.currentUser.id){
              globe.isForbidden = true;
              return;
            }
          }
        } else {
        
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
      
      if(this.chosenKelasID === ""){

        globe.$toasted.global.showError({
          message: "Pilih kelas terlebih dahulu"
        });
        return;
      }

      if(this.listAllAsisten.length < 1){

        globe.$toasted.global.showError({
          message: "Tidak terdapat asisten di kelas ini"
        });
        return;
      }

      if(this.listAllPraktikan.length < 1){

        globe.$toasted.global.showError({
          message: "Tidak terdapat praktikan di kelas ini"
        });
        return;
      }

      if(this.chosenModulID === ''){

        globe.$toasted.global.showError({
          message: "Pilih modul terlebih dahulu"
        });
        return;
      }

      var isKodeExist = false;
      globe.listAllAsisten.forEach(element => {
        if(element.kode === globe.currentUser.kode)
          isKodeExist = true;
      });

      if(!isKodeExist){

        globe.$toasted.global.showError({
          message: "Anda tidak ada dalam praktikum kelas ini<br>Hanya asisten dalam praktikum ini yang bisa mengaktivasinya"
        });
        return;
      }

      this.formPraktikum.kelas_id = this.chosenKelasID;
      this.formPraktikum.modul_id = this.chosenModulID;
      this.$axios.post('/cekPraktikum', this.formPraktikum).then(response => {

        if(response.data.message === "success") {

          globe.allKelas.forEach(kelas => {
            if (kelas.id === globe.chosenKelasID)  {
              globe.formLaporanPj.hari = kelas.hari;
              globe.formLaporanPj.shift = kelas.shift;
            }
          });
          globe.formLaporanPj.laporan ="Tanggal: "+moment().format('ll') +"          Mulai: ..... Selesai: "+ moment().format('LT');
          globe.formLaporanPj.allasisten_id = "";
          for (let index = 0; index < globe.listAllAsisten.length; index++) {
            const element = globe.listAllAsisten[index];
            globe.formLaporanPj.allasisten_id += element.id;
            if (index != globe.listAllAsisten.length-1) 
              globe.formLaporanPj.allasisten_id += "-";
          }
          globe.formLaporanPj.modul_id = this.chosenModulID;
          
          globe.$axios.post('/createLaporanPJ', globe.formLaporanPj).then(response => {

            if(response.data.message === "success") {

              globe.formLaporanPj.id = response.data.id;
              globe.praktikumStart = true;

            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          });

          globe.formCurrentPraktikum.kelas_id = globe.chosenKelasID;
          globe.formCurrentPraktikum.modul_id = globe.chosenModulID;
          globe.formCurrentPraktikum.asisten_id = globe.currentUser.id;
          globe.$axios.post('/startPraktikum', globe.formCurrentPraktikum).then(response => {

            if(response.data.message === "success") {
              globe.menuDisabled = true;

            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          });

          globe.allKelas.forEach(kelas => {
            if (kelas.id === globe.chosenKelasID)  {
              globe.formHistoryJaga.hari = kelas.hari;
              globe.formHistoryJaga.shift = kelas.shift;
            }
          });
          globe.formHistoryJaga.pj = 1;
          globe.formHistoryJaga.asisten_id = globe.currentUser.id;
          globe.formHistoryJaga.modul_id = globe.chosenModulID;
          globe.$axios.post('/makeHistory/jaga', globe.formHistoryJaga).then(response => {

            if(response.data.message === "success") {
                //DO NOTHING (it runs as we expected)

            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          });

        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
    },

    shuffleArr: function($arr){

      for (let i = $arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [$arr[i], $arr[j]] = [$arr[j], $arr[i]];
      }

      return $arr;
    },

    toggleSpace: function($spaceString){

      const globe = this;
      globe.spaceToggled = true;

      if(parseInt($spaceString.substring(0,1)) == 3) {

        /********************/
        /* Toggling Asisten */
        /********************/

        let kodeAsisten = document.getElementById('asisten-' + $spaceString).innerHTML

        // Banning the current clicked asisten space (if exist)
        if(kodeAsisten != ''){

          globe.asistenBanned.push({
            kode: kodeAsisten
          })

          document.getElementById('asisten-' + $spaceString).innerHTML = "";
        } else if(globe.asistenBanned.length > 0) {
          
          // Un Banning random asisten to current clicked space (if there any)

          let randomedId = Math.floor(Math.random() * globe.asistenBanned.length)

          document.getElementById('asisten-' + $spaceString).innerHTML = globe.asistenBanned[randomedId].kode;

          globe.asistenBanned.splice(randomedId, 1);
        }

      } else if(parseInt($spaceString.substring(0,1)) == 1 || parseInt($spaceString.substring(0,1)) == 2) {

        /**********************/
        /* Toggling Praktikan */
        /**********************/

        let nimPraktikan = document.getElementById('praktikan-' + $spaceString).innerHTML

        // Banning the current clicked praktikan space (if exist)
        if(nimPraktikan != ''){
          
          globe.praktikanBanned.push({
            nim: nimPraktikan
          })

          document.getElementById('praktikan-' + $spaceString).innerHTML="";
        } else if(globe.praktikanBanned.length > 0) {
          
          // Un Banning random praktikan to current clicked space (if there any)

          let randomedId = Math.floor(Math.random() * globe.praktikanBanned.length)

          document.getElementById('praktikan-' + $spaceString).innerHTML = globe.praktikanBanned[randomedId].nim;

          globe.praktikanBanned.splice(randomedId, 1);
        }
      }
    },

    getAllAsistenPraktikan: function(){

      const globe = this;
      if(this.chosenKelasID === "" || this.chosenKelasID === this.oldKelasID)
        return;

      this.oldKelasID = this.chosenKelasID;

      this.$axios.post('/readDataKelas/'+this.chosenKelasID).then(response => {

        if(response.data.message === "success") {

          globe.listAllAsisten = response.data.all_asisten;
          globe.listAllPraktikan = response.data.all_praktikan;
          globe.praktikanLeft = response.data.all_praktikan.length % response.data.all_asisten.length;
          globe.praktikanComplete = parseInt(response.data.all_praktikan.length / response.data.all_asisten.length);
          
          // Set praktikanGroups array size to match with listAllAsisten.length
          for( var i=0; i<globe.listAllAsisten.length; i++ ) {
            globe.praktikanGroups.push([]);
          }

          // Group every praktikan inside praktikanGroups
          for( var i=0; i<globe.listAllAsisten.length; i++ )
            for ( var j=0; j<globe.listAllPraktikan.length; j++ )
              if(globe.praktikanGroups[i].length < 3)
                globe.praktikanGroups[i].push({
                  nim: globe.listAllPraktikan[(3*i) + j].nim
                })
              else
                continue;
          
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
function printTanggal(){
n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
return document.getElementById("tanggal").innerHTML = d + "/" + m + "/" + y;
}


</script>
