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
            v-on:click="travel('praktikum')">
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
                { 'h-36': isMenuShown }]" @mouseover="isMenuShown = true">
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

    <!-- Soal Layout -->
    <div class="absolute py-8 pr-8 h-full w-120full flex animation-enable"
        :class="[{ 'left-0': currentPage },
                { 'left-minFull': !currentPage }]" @mouseover="isMenuShown = false">
      <div class="rounded-r-large relative bg-green-400 text-center font-monda-bold text-3xl w-full h-full flex-row">
        <div class="relative w-full h-16 flex">
          <div class="w-1/6 h-16 p-3 hover:bg-green-200 cursor-pointer"
              v-on:click='setActiveSoal("TP")'>
            TP
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-green-200 cursor-pointer"
              v-on:click='setActiveSoal("TA")'>
            TA
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-green-200 cursor-pointer"
              v-on:click='setActiveSoal("TK")'>
            TK
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-green-200 cursor-pointer"
              v-on:click='setActiveSoal("Jurnal")'>
            Jurnal
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-green-200 cursor-pointer"
              v-on:click='setActiveSoal("Mandiri")'>
            Mandiri
          </div>
          <div class="w-1/6 h-16 p-3 hover:bg-green-200 cursor-pointer rounded-tr-large"
              v-on:click='setActiveSoal("FITB")'>
            FITB
          </div>
          <div class="absolute pointer-events-none w-full h-16">
            <div class="absolute bottom-0 w-full flex h-1">
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-1/6': isTA },
                          { 'w-0': !isTA }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-2/6': isTK },
                          { 'w-0': !isTK }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-3/6': isJurnal },
                          { 'w-0': !isJurnal }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-4/6': isMandiri },
                          { 'w-0': !isMandiri }]"/>
              <div class="h-full animation-enable-medium"
                  :class="[{ 'w-5/6': isFITB },
                          { 'w-0': !isFITB }]"/>
              <div class="w-1/6 px-4 h-full">
                <div class="w-full h-full rounded-full bg-black" ref="chosenMenu"/>
              </div>
            </div>
          </div>
        </div>

        <!-- Active List Soal Layout -->
        <div class="w-full h-full pb-16">
          <div class="w-full h-full" v-bar>
            <div class="px-8 pt-4">
              <div v-if="!isTA && !isTK && !isJurnal && !isMandiri && !isFITB" class="w-full h-full flex-row">
                <transition-group name="soal-list" tag="div">
                  <div v-for="soal in listAllTP" v-bind:key="soal.id"
                      class="animation-enable w-full h-48 mb-4">
                    <div class="w-full h-full flex rounded-lg bg-yellow-200">
                      <div class="w-2/5 h-full flex-row">
                        <div class="w-full h-2/3 flex rounded-tl-lg font-merri-bold text-2xl bg-yellow-400">
                          <div class="w-auto h-auto m-auto">
                            {{ soal.judul }}
                          </div>
                        </div>
                        <div class="w-full h-1/3 flex font-overpass-mono-bold text-xl rounded-bl-lg bg-yellow-300">
                          <div class="w-auto h-auto m-auto">
                            <span v-if="soal.isEssay">
                              Essay
                            </span>
                            <span v-if="soal.isProgram">
                              Program
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="w-3/5 h-full flex">
                        <div class="w-16full h-full flex">
                          <div class="w-full h-full overflow-y-auto break-words whitespace-pre-wrap p-4 text-left font-overpass-bold text-xl">
                            <span>{{ soal.soal }}</span>  
                          </div>
                        </div>
                        <div class="w-16 bg-gray-400 rounded-r-lg h-full flex-row">
                          <div class="w-full h-1/2 flex">
                            <span class="w-full h-full p-3 hover:p-4 cursor-pointer animation-enable-short"
                                v-on:click="deleteSoal(soal.id)">
                              <img class="w-full h-full p-1 fas fa-trash">
                            </span>
                          </div>
                          <div class="w-full h-1/2 flex">
                            <span class="w-full h-full p-3 visible hover:p-4 cursor-pointer animation-enable-short"
                                :class="'editOpenTP-'+soal.id"
                                v-on:click="editSoal(soal, true)">
                              <img class="w-full h-full p-1 fas fa-pen">
                            </span>
                            <span class="w-full h-full hidden p-3 hover:p-4 cursor-pointer animation-enable-short"
                                :class="'editCloseTP-'+soal.id"
                                v-on:click="editSoal(soal, false)">
                              <img class="w-full h-full p-1 fas fa-times">
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </transition-group>
              </div>
              <div v-if="isTA || isTK" class="w-full h-full">
                <div v-if="isTA" class="w-full h-full flex-row">
                  <transition-group name="soal-list" tag="div">
                    <div v-for="soal in listAllTA" v-bind:key="soal.id"
                        class="animation-enable w-full h-64 mb-4">
                      <div class="w-full h-full flex rounded-lg bg-yellow-200">
                        <div class="w-1/2 h-full flex-row">
                          <div class="w-full h-1/3 flex rounded-tl-lg font-merri-bold text-xl bg-yellow-400">
                            <div class="w-auto h-auto m-auto">
                              {{ soal.judul }}
                            </div>
                          </div>
                          <div class="w-full h-2/3 flex font-overpass-mono-bold text-xl rounded-bl-lg bg-yellow-300 overflow-y-auto">
                            <div class="w-auto h-auto text-left p-4 break-words whitespace-pre-wrap m-auto">
                              <span>{{ soal.pertanyaan }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="w-1/2 h-full flex">
                          <div class="w-full h-full flex-row overflow-y-auto overflow-x-hidden p-4 text-left font-overpass-bold text-xl">
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-green-500 rounded-lg">
                              <span>{{ soal.jawaban_benar }}</span>
                            </div>
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-red-500 rounded-lg">
                              <span>{{ soal.jawaban_salah1 }}</span>
                            </div>
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-red-500 rounded-lg">
                              <span>{{ soal.jawaban_salah2 }}</span>
                            </div>
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-red-500 rounded-lg">
                              <span>{{ soal.jawaban_salah3 }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="w-16 bg-gray-400 rounded-r-lg h-full flex-row">
                          <div class="w-full h-1/2 flex">
                            <span class="w-full h-full p-3 hover:p-4 cursor-pointer animation-enable-short"
                                v-on:click="deleteSoal(soal.id)">
                              <img class="w-full h-full p-1 fas fa-trash">
                            </span>
                          </div>
                          <div class="w-full h-1/2 flex">
                            <span class="w-full h-full p-3 visible hover:p-4 cursor-pointer animation-enable-short"
                                :class="'editOpenTA-'+soal.id"
                                v-on:click="editSoal(soal, true)">
                              <img class="w-full h-full p-1 fas fa-pen">
                            </span>
                            <span class="w-full h-full hidden p-3 hover:p-4 cursor-pointer animation-enable-short"
                                :class="'editCloseTA-'+soal.id"
                                v-on:click="editSoal(soal, false)">
                              <img class="w-full h-full p-1 fas fa-times">
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </transition-group>
                </div>
                <div v-if="isTK" class="w-full h-full flex-row">
                  <transition-group name="soal-list" tag="div">
                    <div v-for="soal in listAllTK" v-bind:key="soal.id"
                        class="animation-enable w-full h-64 mb-4">
                      <div class="w-full h-full flex rounded-lg bg-yellow-200">
                        <div class="w-1/2 h-full flex-row">
                          <div class="w-full h-1/3 flex rounded-tl-lg font-merri-bold text-xl bg-yellow-400">
                            <div class="w-auto h-auto m-auto">
                              {{ soal.judul }}
                            </div>
                          </div>
                          <div class="w-full h-2/3 flex font-overpass-mono-bold text-xl rounded-bl-lg bg-yellow-300 overflow-y-auto">
                            <div class="w-auto h-auto text-left p-4 break-words whitespace-pre-wrap m-auto">
                              <span>{{ soal.pertanyaan }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="w-1/2 h-full flex">
                          <div class="w-full h-full flex-row overflow-y-auto p-4 text-left font-overpass-bold text-xl">
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-green-500 rounded-lg">
                              <span>{{ soal.jawaban_benar }}</span>
                            </div>
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-red-500 rounded-lg">
                              <span>{{ soal.jawaban_salah1 }}</span>
                            </div>
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-red-500 rounded-lg">
                              <span>{{ soal.jawaban_salah2 }}</span>
                            </div>
                            <div class="w-full h-auto break-words whitespace-pre-wrap mb-4 p-4 bg-red-500 rounded-lg">
                              <span>{{ soal.jawaban_salah3 }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="w-16 bg-gray-400 rounded-r-lg h-full flex-row">
                          <div class="w-full h-1/2 flex">
                            <span class="w-full h-full p-3 hover:p-4 cursor-pointer animation-enable-short"
                                v-on:click="deleteSoal(soal.id)">
                              <img class="w-full h-full p-1 fas fa-trash">
                            </span>
                          </div>
                          <div class="w-full h-1/2 flex">
                            <span class="w-full h-full p-3 visible hover:p-4 cursor-pointer animation-enable-short"
                                :class="'editOpenTK-'+soal.id"
                                v-on:click="editSoal(soal, true)">
                              <img class="w-full h-full p-1 fas fa-pen">
                            </span>
                            <span class="w-full h-full hidden p-3 hover:p-4 cursor-pointer animation-enable-short"
                                :class="'editCloseTK-'+soal.id"
                                v-on:click="editSoal(soal, false)">
                              <img class="w-full h-full p-1 fas fa-times">
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </transition-group>
                </div>
              </div>
              <div v-if="isJurnal || isMandiri || isFITB" class="w-full h-full">
                <div v-if="isJurnal" class="w-full h-full flex-row">
                  <transition-group name="soal-list" tag="div">
                    <div v-for="soal in listAllJurnal" v-bind:key="soal.id"
                        class="animation-enable w-full h-120 mb-4">
                      <div class="w-full h-full flex rounded-lg bg-yellow-200">
                        <div class="w-1/3 h-full flex-row">
                          <div class="w-full h-full flex rounded-l-lg font-merri-bold text-3xl bg-yellow-400">
                            <div class="w-auto h-auto m-auto">
                              {{ soal.judul }}
                            </div>
                          </div>
                        </div>
                        <div class="w-2/3 h-full flex">
                          <div class="w-16full h-full flex">
                            <div class="w-full h-full break-words whitespace-pre-wrap flex-row overflow-y-auto p-4 text-left font-overpass-bold text-2xl">
                              <span>{{ soal.soal }}</span>
                            </div>
                          </div>
                          <div class="w-16 bg-gray-400 rounded-r-lg h-full flex-row">
                            <div class="w-full h-1/2 flex">
                              <span class="w-full h-full p-3 hover:p-4 cursor-pointer animation-enable-short"
                                  v-on:click="deleteSoal(soal.id)">
                                <img class="w-full h-full p-1 fas fa-trash">
                              </span>
                            </div>
                            <div class="w-full h-1/2 flex">
                              <span class="w-full h-full p-3 visible hover:p-4 cursor-pointer animation-enable-short"
                                  :class="'editOpenJurnal-'+soal.id"
                                  v-on:click="editSoal(soal, true)">
                                <img class="w-full h-full p-1 fas fa-pen">
                              </span>
                              <span class="w-full h-full hidden p-3 hover:p-4 cursor-pointer animation-enable-short"
                                  :class="'editCloseJurnal-'+soal.id"
                                  v-on:click="editSoal(soal, false)">
                                <img class="w-full h-full p-1 fas fa-times">
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </transition-group>
                </div>
                <div v-if="isMandiri" class="w-full h-full flex-row">
                  <transition-group name="soal-list" tag="div">
                    <div v-for="soal in listAllMandiri" v-bind:key="soal.id"
                        class="animation-enable w-full h-120 mb-4">
                      <div class="w-full h-full flex rounded-lg bg-yellow-200">
                        <div class="w-1/3 h-full flex-row">
                          <div class="w-full h-full flex rounded-l-lg font-merri-bold text-3xl bg-yellow-400">
                            <div class="w-auto h-auto m-auto">
                              {{ soal.judul }}
                            </div>
                          </div>
                        </div>
                        <div class="w-2/3 h-full flex">
                          <div class="w-16full h-full flex">
                            <div class="w-full h-full break-words whitespace-pre-wrap flex-row overflow-y-auto p-4 text-left font-overpass-bold text-2xl">
                              <span>{{ soal.soal }}</span>
                            </div>
                          </div>
                          <div class="w-16 bg-gray-400 rounded-r-lg h-full flex-row">
                            <div class="w-full h-1/2 flex">
                              <span class="w-full h-full p-3 hover:p-4 cursor-pointer animation-enable-short"
                                  v-on:click="deleteSoal(soal.id)">
                                <img class="w-full h-full p-1 fas fa-trash">
                              </span>
                            </div>
                            <div class="w-full h-1/2 flex">
                              <span class="w-full h-full p-3 visible hover:p-4 cursor-pointer animation-enable-short"
                                  :class="'editOpenMandiri-'+soal.id"
                                  v-on:click="editSoal(soal, true)">
                                <img class="w-full h-full p-1 fas fa-pen">
                              </span>
                              <span class="w-full h-full hidden p-3 hover:p-4 cursor-pointer animation-enable-short"
                                  :class="'editCloseMandiri-'+soal.id"
                                  v-on:click="editSoal(soal, false)">
                                <img class="w-full h-full p-1 fas fa-times">
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </transition-group>
                </div>
                <div v-if="isFITB" class="w-full h-full flex-row">
                  <transition-group name="soal-list" tag="div">
                    <div v-for="soal in listAllFITB" v-bind:key="soal.id"
                        class="animation-enable w-full h-120 mb-4">
                      <div class="w-full h-full flex rounded-lg bg-yellow-200">
                        <div class="w-1/3 h-full flex-row">
                          <div class="w-full h-full flex rounded-l-lg font-merri-bold text-3xl bg-yellow-400">
                            <div class="w-auto h-auto m-auto">
                              {{ soal.judul }}
                            </div>
                          </div>
                        </div>
                        <div class="w-2/3 h-full flex">
                          <div class="w-16full h-full flex">
                            <div class="w-full h-full break-words whitespace-pre-wrap flex-row overflow-y-auto p-4 text-left font-overpass-bold text-2xl">
                              <span>{{ soal.soal }}</span>
                            </div>
                          </div>
                          <div class="w-16 bg-gray-400 rounded-r-lg h-full flex-row">
                            <div class="w-full h-1/2 flex">
                              <span class="w-full h-full p-3 hover:p-4 cursor-pointer animation-enable-short"
                                  v-on:click="deleteSoal(soal.id)">
                                <img class="w-full h-full p-1 fas fa-trash">
                              </span>
                            </div>
                            <div class="w-full h-1/2 flex">
                              <span class="w-full h-full p-3 visible hover:p-4 cursor-pointer animation-enable-short"
                                  :class="'editOpenFITB-'+soal.id"
                                  v-on:click="editSoal(soal, true)">
                                <img class="w-full h-full p-1 fas fa-pen">
                              </span>
                              <span class="w-full h-full hidden p-3 hover:p-4 cursor-pointer animation-enable-short"
                                  :class="'editCloseFITB-'+soal.id"
                                  v-on:click="editSoal(soal, false)">
                                <img class="w-full h-full p-1 fas fa-times">
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </transition-group>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Menu Layout -->
        <div class="absolute bottom-0 w-full h-120 pb-8 flex pointer-events-none">
          <div class="absolute w-4full pb-8 h-full flex animation-enable pointer-events-auto"
              :class="[{ 'left-0': soalMenuShown },
                      { 'left-minFull': !soalMenuShown }]">
            <div class="w-16full h-full bg-gray-400">
              <form id="tatkForm" 
                  class="w-full h-full p-4 flex"
                  :class="[{ 'visible': isTA || isTK },
                          { 'hidden': !isTA && !isTK }]">
                <div class="w-1/2 h-full flex-row">
                  <div class="w-full h-2/5">
                    <div class="w-full px-2 h-full flex-row">
                      <div class="font-merri w-full flex text-left text-gray-700 text-lg h-1/3">
                        <span class="h-auto my-auto">
                          Modul
                        </span>
                      </div>
                      <div class="w-full h-2/3 tatkOption">
                        <select v-model="formTATK.modul_id" 
                              class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                          <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">{{ modul.judul }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="w-full h-3/5">
                    <div class="w-full px-2 h-full flex-row">
                      <div class="font-merri w-full flex text-left text-gray-700 text-lg h-1/4">
                        <span class="h-auto my-auto">
                          Pertanyaan
                        </span>
                      </div>
                      <div class="w-full h-3/4">
                        <textarea v-model="formTATK.pertanyaan" cols="30" rows="10"
                              class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                              id="Pertanyaan" type="text" placeholder="Siapakah penemu bahasa C ?"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-1/2 h-full">
                  <div class="w-full h-full flex-row overflow-y-auto">
                    <div class="w-full h-40 p-2 mb-2">
                      <div class="w-full h-full">
                        <div class="font-merri w-full text-teal-600 flex text-left text-lg h-1/5">
                          <span class="h-auto my-auto">
                            Jawaban Benar
                          </span>
                        </div>
                        <div class="w-full h-4/5">
                          <textarea v-model="formTATK.jawaban_benar" cols="30" rows="10"
                                class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                                id="Pertanyaan" type="text" placeholder="Dennis Ritchie"/>
                        </div>
                      </div>
                    </div>
                    <div class="w-full h-40 p-2 mb-2">
                      <div class="w-full h-full">
                        <div class="font-merri w-full flex text-left text-red-600 text-lg h-1/5">
                          <span class="h-auto my-auto">
                            Jawaban Salah
                          </span>
                        </div>
                        <div class="w-full h-4/5">
                          <textarea v-model="formTATK.jawaban_salah1" cols="30" rows="10"
                                class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                                id="Pertanyaan" type="text" placeholder="Steve Wozniak"/>
                        </div>
                      </div>
                    </div>
                    <div class="w-full h-40 p-2 mb-2">
                      <div class="w-full h-full">
                        <div class="font-merri w-full flex text-left text-red-600 text-lg h-1/5">
                          <span class="h-auto my-auto">
                            Jawaban Salah
                          </span>
                        </div>
                        <div class="w-full h-4/5">
                          <textarea v-model="formTATK.jawaban_salah2" cols="30" rows="10"
                                class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                                id="Pertanyaan" type="text" placeholder="Muhammad Fakhri"/>
                        </div>
                      </div>
                    </div>
                    <div class="w-full h-40 p-2">
                      <div class="w-full h-full">
                        <div class="font-merri w-full flex text-left text-red-600 text-lg h-1/5">
                          <span class="h-auto my-auto">
                            Jawaban Salah
                          </span>
                        </div>
                        <div class="w-full h-4/5">
                          <textarea v-model="formTATK.jawaban_salah3" cols="30" rows="10"
                                class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                                id="Pertanyaan" type="text" placeholder="Linus Torvalds"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

              <form id="tpForm" 
                  class="w-full h-full p-4 flex"
                  :class="[{ 'visible': !isTA && !isTK && !isJurnal && !isMandiri && !isFITB },
                          { 'hidden': isTA || isTK || isJurnal || isMandiri || isFITB }]">
                <div class="w-1/3 h-full flex-row">
                  <div class="w-full h-1/2">
                    <div class="w-full px-2 h-full flex-row">
                      <div class="font-merri w-full flex text-left text-gray-700 text-lg h-1/3">
                        <span class="h-auto my-auto">
                          Modul
                        </span>
                      </div>
                      <div class="w-full h-2/3 tpOption">
                        <select v-model="formTP.modul_id" 
                              class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                          <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">{{ modul.judul }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="w-full h-1/2">
                    <div class="w-full px-2 h-full flex-row">
                      <div class="font-merri w-full flex text-left text-gray-700 text-lg h-1/3">
                        <span class="h-auto my-auto">
                          Jenis Soal
                        </span>
                      </div>
                      <div class="w-full h-2/3 jenisSoalOption">
                        <select v-model="formTP.jenisSoal" 
                              class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                          <option value="essay">Essay</option>
                          <option value="program">Program</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-2/3 h-full">
                  <div class="w-full h-full flex">
                    <div class="w-full px-2 h-full flex-row">
                      <div class="font-merri w-full flex text-left text-gray-700 text-lg h-8">
                        <span class="h-auto my-auto">
                          Pertanyaan
                        </span>
                      </div>
                      <div class="w-full h-4full flex">
                        <textarea v-model="formTP.soal" cols="30" rows="10"
                              class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                              id="Pertanyaan" type="text" placeholder="Siapakah penemu bahasa C ?"/>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

              <form id="jmfitbForm" 
                  class="w-full h-full p-4 flex-row"
                  :class="[{ 'visible': isJurnal || isMandiri || isFITB },
                          { 'hidden': !isJurnal && !isMandiri && !isFITB }]">
                <div class="w-full h-1/3 flex-row">
                  <div class="w-full h-full">
                    <div class="w-full px-2 h-full flex-row">
                      <div class="font-merri w-full flex text-left text-gray-700 text-lg h-1/3">
                        <span class="h-auto my-auto">
                          Modul
                        </span>
                      </div>
                      <div class="w-full h-2/3 jmfitbOption">
                        <select v-model="formJMFITB.modul_id" 
                              class="block font-monda-bold text-3xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="grid-state">
                          <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">{{ modul.judul }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-full h-2/3">
                  <div class="w-full h-full flex">
                    <div class="w-full px-2 h-full flex-row">
                      <div class="font-merri w-full flex text-left text-gray-700 text-lg h-8">
                        <span class="h-auto my-auto">
                          Pertanyaan
                        </span>
                      </div>
                      <div class="w-full h-4full flex">
                        <textarea v-model="formJMFITB.soal" cols="30" rows="10"
                              class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                              id="Pertanyaan" type="text" placeholder="Siapakah penemu bahasa C ?"/>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="w-16 h-full flex-row rounded-r-large bg-gray-600">
              <div class="w-16 h-full text-white m-auto p-5 hover:p-6 cursor-pointer animation-enable-short"
                  :class="[{ 'hidden': editing },
                          { 'visible': !editing }]"
                  v-on:click="createSoal">
                <span class="w-full h-full flex">
                  <img class="w-full h-full fas fa-plus">
                </span>
              </div>
              <div class="w-16 h-full text-white m-auto p-5 hover:p-6 cursor-pointer animation-enable-short"
                  :class="[{ 'hidden': !editing },
                          { 'visible': editing }]"
                  v-on:click="updateSoal">
                <span class="w-full h-full flex">
                  <img class="w-full h-full fas fa-check">
                </span>
              </div>
            </div>
          </div>
          <div class="absolute right-0 h-full pb-8 animation-enable flex pointer-events-none"
              :class="[{ 'w-8': soalMenuShown },
                      { 'w-full': !soalMenuShown }]">
            <div class="w-8 h-full flex text-gray-700 animation-enable pointer-events-none">
              <div class="w-8 h-full m-auto p-1 hover:p-2 cursor-pointer animation-enable-short pointer-events-auto"
                  v-on:click="soalMenuShown = !soalMenuShown">
                <span class="w-full h-full"
                      :class="[{ 'visible': soalMenuShown },
                              { 'hidden': !soalMenuShown }]">
                  <img class="w-full h-full p-1 fas fa-caret-left">
                </span>
                <span class="w-full h-full"
                      :class="[{ 'visible': !soalMenuShown },
                              { 'hidden': soalMenuShown }]">
                  <img class="w-full h-full p-1 fas fa-caret-right">
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>   
    </div>
  </div>
</template>

<style>
.soal-list-enter, .soal-list-leave-to{
  opacity: 0;
  transform: translateX(-100%);
}
.soal-list-leave-active {
  position: absolute;
}
</style>

<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
    'position',
    'allModul',
    'userRole',

    'allTP',
    'allTA',
    'allTK',
    'allJurnal',
    'allMandiri',
    'allFITB',
  ],

  data() {
    return {
      pageActive: true,
      isMenuShown: false,
      changePage: false,
      currentPage: false,

      openedMenu: true,
      soalMenuShown: true,
      editing: false,
      currentSoal: "",

      listAllTP: this.allTP === null ? [] : this.allTP,
      listAllTA: this.allTA === null ? [] : this.allTA,
      listAllTK: this.allTK === null ? [] : this.allTK,
      listAllJurnal: this.allJurnal === null ? [] : this.allJurnal,
      listAllMandiri: this.allMandiri === null ? [] : this.allMandiri,
      listAllFITB: this.allFITB === null ? [] : this.allFITB,

      isTA: false,
      isTK: false,
      isJurnal: false,
      isMandiri: false,
      isFITB: false,

      menuProfil: false,
      menuPraktikum: false,
      menuListTp: false,
      menuHistory: false,
      menuPolling: false,
      menuKelas: false,
      menuModul: false,
      menuPlotting: false,
      menuKonfigurasi: false,
      menuTp: false,

      // Form for TA and TK
      formTATK: {
        id: '',
        oldModul_id: '',
        modul_id: '',
        oldPertanyaan: '',
        pertanyaan: '',
        jawaban_benar: '',
        jawaban_salah1: '',
        jawaban_salah2: '',
        jawaban_salah3: '',
      },

      // Form for Jurnal Mandiri and FITB
      formJMFITB: {
        id: '',
        oldSoal: '',
        soal: '',
        oldModul_id: '',
        modul_id: '',
      },

      // Form for Tugas Pendahuluan and FITB
      formTP: {
        id: '',
        jenisSoal: '',
        oldModul_id: '',
        modul_id: '',
        oldSoal: '',
        soal: '',
        isEssay: '',
        isProgram: '',
      },
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.$refs.menu.scrollTop = this.position;

    const globe = this;

    if(this.comingFrom === 'asisten' ||
        this.comingFrom === 'none' ||
        this.comingFrom === 'kelas' ||
        this.comingFrom === 'modul'||
        this.comingFrom === 'plotting' ||
        this.comingFrom === 'praktikum' ||
        this.comingFrom === 'konfigurasi' ||
        this.comingFrom === 'tp'){

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
      if($whereTo === "asisten")
        this.menuProfil = $bool;
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
    },

    deleteSoal: function($id){

      const globe = this;
      if(!this.isTA &&
          !this.isTK &&
          !this.isFITB &&
          !this.isJurnal &&
          !this.isMandiri){

        this.$axios.post('/deleteTP/'+$id).then(response => {

          if(response.data.message === "success") {

            globe.$toasted.global.showSuccess({
              message: "Soal TP berhasil dihapus"
            });

            var i;
            for(i=0; i<globe.listAllTP.length; i++){
              if(globe.listAllTP[i].id === $id){
                break;
              }
            }
            globe.listAllTP.splice(i, 1);
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
              if(error.response.data.errors.isEssay != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.isEssay[0]
                });
              if(error.response.data.errors.isProgram != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.isProgram[0]
                });
            }
          }
        });
      }
    },

    editSoal: function($soal, $editing){

      const globe = this;
      this.editing = $editing;
      this.currentSoal = $soal;

      if($editing){

        if(!this.isTA &&
            !this.isTK &&
            !this.isFITB &&
            !this.isJurnal &&
            !this.isMandiri){

          if($soal.isEssay)
            $("div.jenisSoalOption select").val("essay");
          
          if($soal.isProgram)
            $("div.jenisSoalOption select").val("program");

          if(globe.formTP.id != null){
            
            $(".editCloseTP-"+globe.formTP.id).removeClass("visible");
            $(".editCloseTP-"+globe.formTP.id).addClass("hidden");
            $(".editOpenTP-"+globe.formTP.id).removeClass("hidden");
            $(".editOpenTP-"+globe.formTP.id).addClass("visible");
          }

          $(".editOpenTP-"+$soal.id).removeClass("visible");
          $(".editOpenTP-"+$soal.id).addClass("hidden");
          $(".editCloseTP-"+$soal.id).removeClass("hidden");
          $(".editCloseTP-"+$soal.id).addClass("visible");

          globe.formTP.id = $soal.id;

          if($soal.isEssay)
            globe.formTP.jenisSoal = "essay";
          if($soal.isProgram)
            globe.formTP.jenisSoal = "program";

          globe.formTP.oldModul_id = $soal.modul_id;
          globe.formTP.modul_id = $soal.modul_id;
          globe.formTP.oldSoal = $soal.soal;
          globe.formTP.soal = $soal.soal;
          globe.formTP.isEssay = $soal.isEssay;
          globe.formTP.isProgram = $soal.isProgram;
        } else if(this.isTA){

          if(globe.formTATK.id != null){
            
            $(".editCloseTA-"+globe.formTATK.id).removeClass("visible");
            $(".editCloseTA-"+globe.formTATK.id).addClass("hidden");
            $(".editOpenTA-"+globe.formTATK.id).removeClass("hidden");
            $(".editOpenTA-"+globe.formTATK.id).addClass("visible");
          }

          $(".editOpenTA-"+$soal.id).removeClass("visible");
          $(".editOpenTA-"+$soal.id).addClass("hidden");
          $(".editCloseTA-"+$soal.id).removeClass("hidden");
          $(".editCloseTA-"+$soal.id).addClass("visible");

          globe.formTATK.id = $soal.id;
          globe.formTATK.oldModul_id = $soal.modul_id;
          globe.formTATK.modul_id = $soal.modul_id;
          globe.formTATK.oldPertanyaan = $soal.pertanyaan;
          globe.formTATK.pertanyaan = $soal.pertanyaan;
          globe.formTATK.jawaban_benar = $soal.jawaban_benar;
          globe.formTATK.jawaban_salah1 = $soal.jawaban_salah1;
          globe.formTATK.jawaban_salah2 = $soal.jawaban_salah2;
          globe.formTATK.jawaban_salah3 = $soal.jawaban_salah3;
        } else if(this.isTK){

          if(globe.formTATK.id != null){
            
            $(".editCloseTK-"+globe.formTATK.id).removeClass("visible");
            $(".editCloseTK-"+globe.formTATK.id).addClass("hidden");
            $(".editOpenTK-"+globe.formTATK.id).removeClass("hidden");
            $(".editOpenTK-"+globe.formTATK.id).addClass("visible");
          }

          $(".editOpenTK-"+$soal.id).removeClass("visible");
          $(".editOpenTK-"+$soal.id).addClass("hidden");
          $(".editCloseTK-"+$soal.id).removeClass("hidden");
          $(".editCloseTK-"+$soal.id).addClass("visible");

          globe.formTATK.id = $soal.id;
          globe.formTATK.oldModul_id = $soal.modul_id;
          globe.formTATK.modul_id = $soal.modul_id;
          globe.formTATK.oldPertanyaan = $soal.pertanyaan;
          globe.formTATK.pertanyaan = $soal.pertanyaan;
          globe.formTATK.jawaban_benar = $soal.jawaban_benar;
          globe.formTATK.jawaban_salah1 = $soal.jawaban_salah1;
          globe.formTATK.jawaban_salah2 = $soal.jawaban_salah2;
          globe.formTATK.jawaban_salah3 = $soal.jawaban_salah3;
        } else if(this.isJurnal){

          if(globe.formJMFITB.id != null){
            
            $(".editCloseJurnal-"+globe.formJMFITB.id).removeClass("visible");
            $(".editCloseJurnal-"+globe.formJMFITB.id).addClass("hidden");
            $(".editOpenJurnal-"+globe.formJMFITB.id).removeClass("hidden");
            $(".editOpenJurnal-"+globe.formJMFITB.id).addClass("visible");
          }

          $(".editOpenJurnal-"+$soal.id).removeClass("visible");
          $(".editOpenJurnal-"+$soal.id).addClass("hidden");
          $(".editCloseJurnal-"+$soal.id).removeClass("hidden");
          $(".editCloseJurnal-"+$soal.id).addClass("visible");

          globe.formJMFITB.id = $soal.id;
          globe.formJMFITB.oldModul_id = $soal.modul_id;
          globe.formJMFITB.modul_id = $soal.modul_id;
          globe.formJMFITB.oldSoal = $soal.soal;
          globe.formJMFITB.soal = $soal.soal;
        } else if(this.isMandiri){

          if(globe.formJMFITB.id != null){
            
            $(".editCloseMandiri-"+globe.formJMFITB.id).removeClass("visible");
            $(".editCloseMandiri-"+globe.formJMFITB.id).addClass("hidden");
            $(".editOpenMandiri-"+globe.formJMFITB.id).removeClass("hidden");
            $(".editOpenMandiri-"+globe.formJMFITB.id).addClass("visible");
          }

          $(".editOpenMandiri-"+$soal.id).removeClass("visible");
          $(".editOpenMandiri-"+$soal.id).addClass("hidden");
          $(".editCloseMandiri-"+$soal.id).removeClass("hidden");
          $(".editCloseMandiri-"+$soal.id).addClass("visible");

          globe.formJMFITB.id = $soal.id;
          globe.formJMFITB.oldModul_id = $soal.modul_id;
          globe.formJMFITB.modul_id = $soal.modul_id;
          globe.formJMFITB.oldSoal = $soal.soal;
          globe.formJMFITB.soal = $soal.soal;
        } else if(this.isFITB){

          if(globe.formJMFITB.id != null){
            
            $(".editCloseFITB-"+globe.formJMFITB.id).removeClass("visible");
            $(".editCloseFITB-"+globe.formJMFITB.id).addClass("hidden");
            $(".editOpenFITB-"+globe.formJMFITB.id).removeClass("hidden");
            $(".editOpenFITB-"+globe.formJMFITB.id).addClass("visible");
          }

          $(".editOpenFITB-"+$soal.id).removeClass("visible");
          $(".editOpenFITB-"+$soal.id).addClass("hidden");
          $(".editCloseFITB-"+$soal.id).removeClass("hidden");
          $(".editCloseFITB-"+$soal.id).addClass("visible");

          globe.formJMFITB.id = $soal.id;
          globe.formJMFITB.oldModul_id = $soal.modul_id;
          globe.formJMFITB.modul_id = $soal.modul_id;
          globe.formJMFITB.oldSoal = $soal.soal;
          globe.formJMFITB.soal = $soal.soal;
        }
      } else {

        if(!this.isTA &&
            !this.isTK &&
            !this.isFITB &&
            !this.isJurnal &&
            !this.isMandiri){
        
          $(".editCloseTP-"+$soal.id).removeClass("visible");
          $(".editCloseTP-"+$soal.id).addClass("hidden");
          $(".editOpenTP-"+$soal.id).removeClass("hidden");
          $(".editOpenTP-"+$soal.id).addClass("visible");

          $("div.jenisSoalOption select").val("");
          globe.formTP.id = "";
          globe.formTP.jenisSoal = "";
          globe.formTP.oldModul_id = "";
          globe.formTP.modul_id = "";
          globe.formTP.oldSoal = "";
          globe.formTP.soal = "";
          globe.formTP.isEssay = "";
          globe.formTP.isProgram = "";
        } else if(this.isTA){
        
          $(".editCloseTA-"+$soal.id).removeClass("visible");
          $(".editCloseTA-"+$soal.id).addClass("hidden");
          $(".editOpenTA-"+$soal.id).removeClass("hidden");
          $(".editOpenTA-"+$soal.id).addClass("visible");

          globe.formTATK.id = "";
          globe.formTATK.oldModul_id = "";
          globe.formTATK.modul_id = "";
          globe.formTATK.oldPertanyaan = "";
          globe.formTATK.pertanyaan = "";
          globe.formTATK.jawaban_benar = "";
          globe.formTATK.jawaban_salah1 = "";
          globe.formTATK.jawaban_salah2 = "";
          globe.formTATK.jawaban_salah3 = "";
        } else if(this.isTK){
        
          $(".editCloseTK-"+$soal.id).removeClass("visible");
          $(".editCloseTK-"+$soal.id).addClass("hidden");
          $(".editOpenTK-"+$soal.id).removeClass("hidden");
          $(".editOpenTK-"+$soal.id).addClass("visible");

          globe.formTATK.id = "";
          globe.formTATK.oldModul_id = "";
          globe.formTATK.modul_id = "";
          globe.formTATK.oldPertanyaan = "";
          globe.formTATK.pertanyaan = "";
          globe.formTATK.jawaban_benar = "";
          globe.formTATK.jawaban_salah1 = "";
          globe.formTATK.jawaban_salah2 = "";
          globe.formTATK.jawaban_salah3 = "";
        } else if(this.isJurnal){
        
          $(".editCloseJurnal-"+$soal.id).removeClass("visible");
          $(".editCloseJurnal-"+$soal.id).addClass("hidden");
          $(".editOpenJurnal-"+$soal.id).removeClass("hidden");
          $(".editOpenJurnal-"+$soal.id).addClass("visible");

          globe.formJMFITB.id = "";
          globe.formJMFITB.oldModul_id = "";
          globe.formJMFITB.modul_id = "";
          globe.formJMFITB.oldSoal = "";
          globe.formJMFITB.soal = "";
        } else if(this.isMandiri){
        
          $(".editCloseMandiri-"+$soal.id).removeClass("visible");
          $(".editCloseMandiri-"+$soal.id).addClass("hidden");
          $(".editOpenMandiri-"+$soal.id).removeClass("hidden");
          $(".editOpenMandiri-"+$soal.id).addClass("visible");

          globe.formJMFITB.id = "";
          globe.formJMFITB.oldModul_id = "";
          globe.formJMFITB.modul_id = "";
          globe.formJMFITB.oldSoal = "";
          globe.formJMFITB.soal = "";
        } else if(this.isFITB){
        
          $(".editCloseFITB-"+$soal.id).removeClass("visible");
          $(".editCloseFITB-"+$soal.id).addClass("hidden");
          $(".editOpenFITB-"+$soal.id).removeClass("hidden");
          $(".editOpenFITB-"+$soal.id).addClass("visible");

          globe.formJMFITB.id = "";
          globe.formJMFITB.oldModul_id = "";
          globe.formJMFITB.modul_id = "";
          globe.formJMFITB.oldSoal = "";
          globe.formJMFITB.soal = "";
        }
      }
    },

    createSoal: function(){

      const globe = this;
      if(!this.isTA &&
          !this.isTK &&
          !this.isFITB &&
          !this.isJurnal &&
          !this.isMandiri){

        if(this.formTP.jenisSoal === "essay"){
          this.formTP.isEssay = true;
          this.formTP.isProgram = false;
        } else if(this.formTP.jenisSoal === "program"){
          this.formTP.isEssay = false;
          this.formTP.isProgram = true;
        }

        this.$axios.post('/createTP', this.formTP).then(response => {

          if(response.data.message === "success") {

            $("#tpForm")[0].reset();
            globe.$toasted.global.showSuccess({
              message: "Soal TP berhasil ditambahkan"
            });
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === globe.formTP.modul_id)
                judul = element.judul;
            });
            globe.listAllTP.push({
              id: response.data.id,
              judul: judul,
              modul_id: globe.formTP.modul_id,
              soal: globe.formTP.soal,
              isEssay: globe.formTP.isEssay,
              isProgram: globe.formTP.isProgram,
            })
            globe.formTP.modul_id = "";
            globe.formTP.jenisSoal = "";
            globe.formTP.soal = "";
            globe.formTP.isEssay = "";
            globe.formTP.isProgram = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
              if(error.response.data.errors.isEssay != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.isEssay[0]
                });
              if(error.response.data.errors.isProgram != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.isProgram[0]
                });
            }
          }
        });
      } else if(this.isTA) {
          
        this.$axios.post('/createTA', this.formTATK).then(response => {

          if(response.data.message === "success") {

            $("#tatkForm")[0].reset();
            globe.$toasted.global.showSuccess({
              message: "Soal TA berhasil ditambahkan"
            });
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === globe.formTATK.modul_id)
                judul = element.judul;
            });
            globe.listAllTA.push({
              id: response.data.id,
              judul: judul,
              modul_id: globe.formTATK.modul_id,
              pertanyaan: globe.formTATK.pertanyaan,
              jawaban_benar: globe.formTATK.jawaban_benar,
              jawaban_salah1: globe.formTATK.jawaban_salah1,
              jawaban_salah2: globe.formTATK.jawaban_salah2,
              jawaban_salah3: globe.formTATK.jawaban_salah3,
            })
            globe.formTATK.modul_id = "";
            globe.formTATK.pertanyaan = "";
            globe.formTATK.jawaban_benar = "";
            globe.formTATK.jawaban_salah1 = "";
            globe.formTATK.jawaban_salah2 = "";
            globe.formTATK.jawaban_salah3 = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.pertanyaan != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.pertanyaan[0]
                });
              if(error.response.data.errors.jawaban_benar != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_benar[0]
                });
              if(error.response.data.errors.jawaban_salah1 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah1[0]
                });
              if(error.response.data.errors.jawaban_salah2 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah2[0]
                });
              if(error.response.data.errors.jawaban_salah3 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah3[0]
                });
            }
          }
        });
      } else if(this.isTK) {
          
        this.$axios.post('/createTK', this.formTATK).then(response => {

          if(response.data.message === "success") {

            $("#tatkForm")[0].reset();
            globe.$toasted.global.showSuccess({
              message: "Soal TK berhasil ditambahkan"
            });
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === globe.formTATK.modul_id)
                judul = element.judul;
            });
            globe.listAllTK.push({
              id: response.data.id,
              judul: judul,
              modul_id: globe.formTATK.modul_id,
              pertanyaan: globe.formTATK.pertanyaan,
              jawaban_benar: globe.formTATK.jawaban_benar,
              jawaban_salah1: globe.formTATK.jawaban_salah1,
              jawaban_salah2: globe.formTATK.jawaban_salah2,
              jawaban_salah3: globe.formTATK.jawaban_salah3,
            })
            globe.formTATK.modul_id = "";
            globe.formTATK.pertanyaan = "";
            globe.formTATK.jawaban_benar = "";
            globe.formTATK.jawaban_salah1 = "";
            globe.formTATK.jawaban_salah2 = "";
            globe.formTATK.jawaban_salah3 = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.pertanyaan != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.pertanyaan[0]
                });
              if(error.response.data.errors.jawaban_benar != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_benar[0]
                });
              if(error.response.data.errors.jawaban_salah1 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah1[0]
                });
              if(error.response.data.errors.jawaban_salah2 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah2[0]
                });
              if(error.response.data.errors.jawaban_salah3 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah3[0]
                });
            }
          }
        });
      } else if(this.isJurnal) {
          
        this.$axios.post('/createJurnal', this.formJMFITB).then(response => {

          if(response.data.message === "success") {

            $("#jmfitbForm")[0].reset();
            globe.$toasted.global.showSuccess({
              message: "Soal Jurnal berhasil ditambahkan"
            });
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === globe.formJMFITB.modul_id)
                judul = element.judul;
            });
            globe.listAllJurnal.push({
              id: response.data.id,
              judul: judul,
              modul_id: globe.formJMFITB.modul_id,
              soal: globe.formJMFITB.soal,
            })
            globe.formJMFITB.modul_id = "";
            globe.formJMFITB.soal = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
            }
          }
        });
      } else if(this.isMandiri) {
          
        this.$axios.post('/createMandiri', this.formJMFITB).then(response => {

          if(response.data.message === "success") {

            $("#jmfitbForm")[0].reset();
            globe.$toasted.global.showSuccess({
              message: "Soal Jurnal berhasil ditambahkan"
            });
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === globe.formJMFITB.modul_id)
                judul = element.judul;
            });
            globe.listAllMandiri.push({
              id: response.data.id,
              judul: judul,
              modul_id: globe.formJMFITB.modul_id,
              soal: globe.formJMFITB.soal,
            })
            globe.formJMFITB.modul_id = "";
            globe.formJMFITB.soal = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
            }
          }
        });
      } else if(this.isFITB) {
          
        this.$axios.post('/createFitb', this.formJMFITB).then(response => {

          if(response.data.message === "success") {

            $("#jmfitbForm")[0].reset();
            globe.$toasted.global.showSuccess({
              message: "Soal Jurnal berhasil ditambahkan"
            });
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === globe.formJMFITB.modul_id)
                judul = element.judul;
            });
            globe.listAllFITB.push({
              id: response.data.id,
              judul: judul,
              modul_id: globe.formJMFITB.modul_id,
              soal: globe.formJMFITB.soal,
            })
            globe.formJMFITB.modul_id = "";
            globe.formJMFITB.soal = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
            }
          }
        });
      }
    },

    updateSoal: function(){

      const globe = this;

      if(!this.isTA &&
          !this.isTK &&
          !this.isFITB &&
          !this.isJurnal &&
          !this.isMandiri){

        this.$axios.post('/updateTP', this.formTP).then(response => {

          if(response.data.message === "success") {

            globe.editing = false;
            $(".editCloseTP-"+globe.formTP.id).removeClass("visible");
            $(".editCloseTP-"+globe.formTP.id).addClass("hidden");
            $(".editOpenTP-"+globe.formTP.id).removeClass("hidden");
            $(".editOpenTP-"+globe.formTP.id).addClass("visible");

            globe.$toasted.global.showSuccess({
              message: "Soal TP berhasil diperbaharui"
            });

            var judul;
            globe.allModul.forEach(element => {
              if(element.id === response.data.soal.modul_id)
                judul = element.judul;
            });

            for(var i=0; i<globe.listAllTP.length; i++)
              if(globe.listAllTP[i].id === globe.formTP.id){
                globe.listAllTP[i] = response.data.soal;
                globe.listAllTP[i].judul = judul;
                break;
              }

            globe.formTP.id = "";
            globe.formTP.jenisSoal = "";
            globe.formTP.oldModul_id = "";
            globe.formTP.modul_id = "";
            globe.formTP.oldSoal = "";
            globe.formTP.soal = "";
            globe.formTP.isEssay = "";
            globe.formTP.isProgram = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
              if(error.response.data.errors.isEssay != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.isEssay[0]
                });
              if(error.response.data.errors.isProgram != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.isProgram[0]
                });
            }
          }
        });
      } else if(this.isTA){

        this.$axios.post('/updateTA', this.formTATK).then(response => {

          if(response.data.message === "success") {

            $("#tatkForm")[0].reset();
            globe.editing = false;
            $(".editCloseTA-"+globe.formTATK.id).removeClass("visible");
            $(".editCloseTA-"+globe.formTATK.id).addClass("hidden");
            $(".editOpenTA-"+globe.formTATK.id).removeClass("hidden");
            $(".editOpenTA-"+globe.formTATK.id).addClass("visible");

            globe.$toasted.global.showSuccess({
              message: "Soal TA berhasil diperbaharui"
            });
            
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === response.data.soal.modul_id)
                judul = element.judul;
            });

            for(var i=0; i<globe.listAllTA.length; i++){
              if(globe.listAllTA[i].id === globe.formTATK.id){
                globe.listAllTA[i] = response.data.soal;
                globe.listAllTA[i].judul = judul;
                break;
              }
            }

            globe.formTATK.modul_id = "";
            globe.formTATK.pertanyaan = "";
            globe.formTATK.jawaban_benar = "";
            globe.formTATK.jawaban_salah1 = "";
            globe.formTATK.jawaban_salah2 = "";
            globe.formTATK.jawaban_salah3 = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.pertanyaan != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.pertanyaan[0]
                });
              if(error.response.data.errors.jawaban_benar != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_benar[0]
                });
              if(error.response.data.errors.jawaban_salah1 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah1[0]
                });
              if(error.response.data.errors.jawaban_salah2 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah2[0]
                });
              if(error.response.data.errors.jawaban_salah3 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah3[0]
                });
            }
          }
        });
      } else if(this.isTK){

        this.$axios.post('/updateTK', this.formTATK).then(response => {

          if(response.data.message === "success") {

            $("#tatkForm")[0].reset();
            globe.editing = false;
            $(".editCloseTK-"+globe.formTATK.id).removeClass("visible");
            $(".editCloseTK-"+globe.formTATK.id).addClass("hidden");
            $(".editOpenTK-"+globe.formTATK.id).removeClass("hidden");
            $(".editOpenTK-"+globe.formTATK.id).addClass("visible");

            globe.$toasted.global.showSuccess({
              message: "Soal TK berhasil diperbaharui"
            });
            
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === response.data.soal.modul_id)
                judul = element.judul;
            });

            for(var i=0; i<globe.listAllTK.length; i++){
              if(globe.listAllTK[i].id === globe.formTATK.id){
                globe.listAllTK[i] = response.data.soal;
                globe.listAllTK[i].judul = judul;
                break;
              }
            }

            globe.formTATK.modul_id = "";
            globe.formTATK.pertanyaan = "";
            globe.formTATK.jawaban_benar = "";
            globe.formTATK.jawaban_salah1 = "";
            globe.formTATK.jawaban_salah2 = "";
            globe.formTATK.jawaban_salah3 = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.pertanyaan != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.pertanyaan[0]
                });
              if(error.response.data.errors.jawaban_benar != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_benar[0]
                });
              if(error.response.data.errors.jawaban_salah1 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah1[0]
                });
              if(error.response.data.errors.jawaban_salah2 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah2[0]
                });
              if(error.response.data.errors.jawaban_salah3 != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.jawaban_salah3[0]
                });
            }
          }
        });
      } else if(this.isJurnal){

        this.$axios.post('/updateJurnal', this.formJMFITB).then(response => {

          if(response.data.message === "success") {

            $("#jmfitbForm")[0].reset();
            globe.editing = false;
            $(".editCloseJurnal-"+globe.formJMFITB.id).removeClass("visible");
            $(".editCloseJurnal-"+globe.formJMFITB.id).addClass("hidden");
            $(".editOpenJurnal-"+globe.formJMFITB.id).removeClass("hidden");
            $(".editOpenJurnal-"+globe.formJMFITB.id).addClass("visible");

            globe.$toasted.global.showSuccess({
              message: "Soal Jurnal berhasil diperbaharui"
            });
            
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === response.data.soal.modul_id)
                judul = element.judul;
            });
            
            for(var i=0; i<globe.listAllJurnal.length; i++){
              if(globe.listAllJurnal[i].id === globe.formJMFITB.id){
                globe.listAllJurnal[i] = response.data.soal;
                globe.listAllJurnal[i].judul = judul;
                break;
              }
            }

            globe.formJMFITB.modul_id = "";
            globe.formJMFITB.soal = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
            }
          }
        });
      } else if(this.isMandiri){

        this.$axios.post('/updateMandiri', this.formJMFITB).then(response => {

          if(response.data.message === "success") {

            $("#jmfitbForm")[0].reset();
            globe.editing = false;
            $(".editCloseMandiri-"+globe.formJMFITB.id).removeClass("visible");
            $(".editCloseMandiri-"+globe.formJMFITB.id).addClass("hidden");
            $(".editOpenMandiri-"+globe.formJMFITB.id).removeClass("hidden");
            $(".editOpenMandiri-"+globe.formJMFITB.id).addClass("visible");

            globe.$toasted.global.showSuccess({
              message: "Soal Mandiri berhasil diperbaharui"
            });
            
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === response.data.soal.modul_id)
                judul = element.judul;
            });
            
            for(var i=0; i<globe.listAllMandiri.length; i++){
              if(globe.listAllMandiri[i].id === globe.formJMFITB.id){
                globe.listAllMandiri[i] = response.data.soal;
                globe.listAllMandiri[i].judul = judul;
                break;
              }
            }

            globe.formJMFITB.modul_id = "";
            globe.formJMFITB.soal = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
            }
          }
        });
      } else if(this.isFITB){

        this.$axios.post('/updateFitb', this.formJMFITB).then(response => {

          if(response.data.message === "success") {

            $("#jmfitbForm")[0].reset();
            globe.editing = false;
            $(".editCloseFITB-"+globe.formJMFITB.id).removeClass("visible");
            $(".editCloseFITB-"+globe.formJMFITB.id).addClass("hidden");
            $(".editOpenFITB-"+globe.formJMFITB.id).removeClass("hidden");
            $(".editOpenFITB-"+globe.formJMFITB.id).addClass("visible");

            globe.$toasted.global.showSuccess({
              message: "Soal Fill In The Blank berhasil diperbaharui"
            });
            
            var judul;
            globe.allModul.forEach(element => {
              if(element.id === response.data.soal.modul_id)
                judul = element.judul;
            });
            
            for(var i=0; i<globe.listAllFITB.length; i++){
              if(globe.listAllFITB[i].id === globe.formJMFITB.id){
                globe.listAllFITB[i] = response.data.soal;
                globe.listAllFITB[i].judul = judul;
                break;
              }
            }

            globe.formJMFITB.modul_id = "";
            globe.formJMFITB.soal = "";
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
              if(error.response.data.errors.modul_id != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.modul_id[0]
                });
              if(error.response.data.errors.soal != null)
                globe.$toasted.global.showError({
                  message: error.response.data.errors.soal[0]
                });
            }
          }
        });
      }
    },

    setActiveSoal: function($soalMenu){

      this.editSoal(this.currentSoal, false);

      if($soalMenu === "TA"){
        this.isTA = true;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = false;
      } else if($soalMenu === "TK"){
        this.isTA = false;
        this.isTK = true;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = false;
      } else if($soalMenu === "Jurnal"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = true;
        this.isMandiri = false;
        this.isFITB = false;
      } else if($soalMenu === "Mandiri"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = true;
        this.isFITB = false;
      } else if($soalMenu === "FITB"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = true;
      } else if($soalMenu === "TP"){
        this.isTA = false;
        this.isTK = false;
        this.isJurnal = false;
        this.isMandiri = false;
        this.isFITB = false;
      }
    },

    travel: function($whereTo){

      this.setCurrentMenu($whereTo, true);
      this.changePage = true;

      const globe = this;
      this.currentPage = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/'+ $whereTo +'?comingFrom=soal&position='+globe.$refs.menu.scrollTop);
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
    }
  }
}
</script>
