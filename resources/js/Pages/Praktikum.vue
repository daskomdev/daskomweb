<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">
    
    <!-- Sound Part -->
    <div id="sound"></div>

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
        <div v-if="currentUser.role_id === 2">
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
    <div class="relative h-full w-120full relative animation-enable"
        :class="[{ 'left-0': currentPage },
                { 'left-minFull': !currentPage }]"
        @mouseover="isMenuShown = false;">

      <div v-if="statusPraktikum === 5 ||
                 statusPraktikum === 6"
          class="w-full h-24full flex-row absolute bottom-0 pointer-events-none">
        <div class="w-full h-36full flex pointer-events-auto">
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
              class="w-3/4 h-36full px-5 m-auto flex-row">
            <div class="w-full h-1/4 flex">
              <div class="w-1/4 h-full flex">
                <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                  JAGA
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
            <div class="w-full h-1/4 flex">
              <div class="w-1/4 h-full flex">
                <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                  IZIN
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
            <div class="w-full h-1/4 flex">
              <div class="w-1/4 h-full flex">
                <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                  SAKIT
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
            <div class="w-full h-1/4 flex">
              <div class="w-1/4 h-full flex">
                <div class="ml-auto my-auto mr-4 font-monda-bold text-2xl text-white">
                  ALFA
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
          </div>
          <div v-if="statusPraktikum === 6"  
              class="w-1/4 py-4 px-5 h-24full m-auto flex-row">
            <span class="font-merri w-full text-left text-white text-lg h-1/4">
              Laporan
            </span>
            <div class="w-full h-3/4">
              <textarea v-model="formLaporanPj.laporan" cols="30" rows="10"
                    class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    id="Laporan" type="text" placeholder="Asisten FAI jaga 2 kelompok"/>
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
                 statusPraktikum === 4" 
          class="w-full h-24full flex-row absolute bottom-0 pointer-events-none">
        <div class="w-full h-1/2 flex">
          <div class="w-auto text-white h-auto mx-auto mt-auto pt-24 text-center">
            <span class="font-overpass-bold text-3xl text-center"
                :class="[{ 'visible': statusPraktikum === 0 },
                        { 'hidden': statusPraktikum != 0 }]">
              PRAKTIKUM DASKOM<br>
              (Klik START untuk memulai TA)
            </span> 
            <span class="font-overpass-bold text-9xl " 
                :class="[{ 'visible': statusPraktikum === 1 },
                        { 'hidden': statusPraktikum != 1 }]">
              TA
            </span> 
            <span class="font-overpass-bold text-9xl " 
                :class="[{ 'visible': statusPraktikum === 2 },
                        { 'hidden': statusPraktikum != 2 }]">
              JURNAL
            </span> 
            <span class="font-overpass-bold text-9xl " 
                :class="[{ 'visible': statusPraktikum === 3 },
                        { 'hidden': statusPraktikum != 3 }]">
              MANDIRI
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
        <div class="w-1/2 h-full flex-row">
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

      <div class="w-full h-24full absolute animation-enable pt-4 z-20"
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
              <div class="w-1/2 h-full flex py-4 px-8 hover:px-10 hover:py-5 animation-enable-short cursor-pointer"
                  v-on:click="shuffleEmAll()">
                <div class="w-full h-full flex font-monda-bold text-4xl bg-yellow-400 rounded-full">
                  <div class="w-auto select-none h-auto m-auto">
                    SHUFFLE
                  </div>
                </div>
              </div>
              <div class="w-1/2 h-full flex py-4 px-8 hover:px-10 hover:py-5 animation-enable-short cursor-pointer"
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
      pairingList: [],

      shuffledListAllAsisten: [],
      shuffledListAllPraktikan: [],

      praktikumStart: false,
      countdownStarted: false,
      firstTimeCounting: true,
      bigLeaveQuestionShown: false,
      bigNextQuestionShown: false,
      bigRatingQuestionShown: false,
      soundPlayed: false,

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
      // 2: Go To Jurnal Section
      // 3: Go To Mandiri Section
      // 4: Go To TK section
      // 5: Open The Laporan Praktikan 
      //    (Tell them to rate the assistant and the prakikum)
      // 6: Open The Laporan PJ and write down the condition of the praktikum
      //    (Only shows "DONE" button for ending the praktikum)
      //    (Dont forget to add data to history_jaga table)
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
      MANDIRItiming: moment().startOf('day').add(20, 'minutes'),
      TKtiming: moment().startOf('day').add(10, 'minutes'),
      countDown: moment().startOf('day').add(10, 'minutes'), //(TIME IN MILLIS) // Default: Based on TAtiming
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

    const globe = this;

    if(this.comingFrom === 'asisten' ||
        this.comingFrom === 'none' ||
        this.comingFrom === 'kelas'||
        this.comingFrom === 'soal'||
        this.comingFrom === 'plotting'||
        this.comingFrom === 'modul'){

      setTimeout(
        function() {
          globe.currentPage = true;
        }, 10); 
    }

    globe.$axios.post('/checkPraktikum').then(response => {

      if(response.data.message === "success") {

        if(response.data.current_praktikum != null){

          //There is currently active praktikum
          globe.formCurrentPraktikum.asisten_id = response.data.current_praktikum.asisten_id;
          globe.formCurrentPraktikum.kelas_id = response.data.current_praktikum.kelas_id;
          globe.formCurrentPraktikum.modul_id = response.data.current_praktikum.modul_id;
          globe.statusPraktikum = response.data.current_praktikum.status;
          globe.chosenKelasID = response.data.current_praktikum.kelas_id;
          globe.chosenModulID = response.data.current_praktikum.modul_id;
          globe.getAllAsistenPraktikan();
          globe.praktikumStart = true;

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

          if(globe.formHistoryJaga.allasisten_kode != ''){
            var tempArr = globe.formHistoryJaga.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Pastikan ada kode asisten diantara tanda "-"'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryJaga.allasisten_kode.split("-"));
          }

          if(globe.formHistoryIzin_Izin.allasisten_kode != ''){
            var tempArr = globe.formHistoryIzin_Izin.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Pastikan ada kode asisten diantara tanda "-"'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryIzin_Izin.allasisten_kode.split("-"));
          }

          if(globe.formHistoryIzin_Sakit.allasisten_kode != ''){
            var tempArr = globe.formHistoryIzin_Sakit.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Pastikan ada kode asisten diantara tanda "-"'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryIzin_Sakit.allasisten_kode.split("-"));
          }

          if(globe.formHistoryIzin_Alfa.allasisten_kode != ''){
            var tempArr = globe.formHistoryIzin_Alfa.allasisten_kode.split("-");
            for (let index = 0; index < tempArr.length; index++) {
              const data = tempArr[index];
              if(data === ""){
                globe.$toasted.global.showError({
                  message: 'Pastikan ada kode asisten diantara tanda "-"'
                });
                return;
              }
            }
            sumAllAsisten_kode.push(globe.formHistoryIzin_Alfa.allasisten_kode.split("-"));
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

                                if(response.data.message === "success") {
                                  //Do nothing
                                  

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
      globe.statusPraktikum++;

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
          globe.countDown = globe.JURNALtiming;
          break;
        case 3:
          globe.countDown = globe.MANDIRItiming;
          break;
        case 4:
          globe.countDown = globe.TKtiming;
          break;
        case 6:
          globe.praktikumStart = false;
          globe.statusPraktikum = 0;
          break;
      }
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

        } else {
          globe.$axios.post('/stopPraktikum');
          globe.$axios.post('/deleteHistory/jaga', globe.formHistoryJaga).then(response => {

            if(response.data.message === "success") {
                //DO NOTHING (it runs as we expected)

            } else {
              globe.$toasted.global.showError({
                message: response.data.message
              });
            }
          });
          this.$axios.post('/deleteLaporanPJ/'+this.formLaporanPj.id).then(response => {

            globe.countDown = globe.TAtiming;
            globe.firstTimeCounting = true;
            globe.praktikumStart = false;
            globe.soundPlayed = false;
            globe.statusPraktikum = 0;
          });
        }
      } else { 
        globe.bigLeaveQuestionShown = false;
        globe.$axios.post('/stopPraktikum');
        globe.$axios.post('/deleteHistory/jaga', globe.formHistoryJaga).then(response => {

          if(response.data.message === "success") {
              //DO NOTHING (it runs as we expected)

          } else {
            globe.$toasted.global.showError({
              message: response.data.message
            });
          }
        });
        this.$axios.post('/deleteLaporanPJ/'+this.formLaporanPj.id).then(response => {

          globe.countDown = globe.TAtiming;
          globe.firstTimeCounting = true;
          globe.praktikumStart = false;
          globe.soundPlayed = false;
          globe.statusPraktikum = 0;
        });
      }
    },

    startCountdown: function(){

      this.countdownStarted = true;
      const globe = this;
      
      if(this.statusPraktikum === 0){
        
        this.statusPraktikum = 1;
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
          globe.formLaporanPj.laporan = "empty";
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
                //DO NOTHING (it runs as we expected)

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
