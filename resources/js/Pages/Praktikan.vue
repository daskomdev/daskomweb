<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">

    <!-- Main Layout -->
    <div class="absolute my-auto z-40 h-full pointer-events-none flex animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-minFull': !pageActive },
                  { 'w-24full': !openWide },
                  { 'w-full': openWide }]" @mouseover="isMenuShown = false">
      <div class="my-auto flex w-full pointer-events-none animation-enable"
          :class="[{ 'h-36full': !openWide },
                  { 'h-4full': openWide }]">
        <div class="h-full w-12 flex pointer-events-auto">
          <div class="w-8 h-8 m-auto">
            <span class="w-full h-full cursor-pointer"
                :class="[{ 'visible': !openWide },
                        { 'hidden': openWide }]"
                v-on:click="openWide = true;">
              <img class="w-full h-full fas fa-caret-left text-white">
            </span>
            <span class="w-full h-full cursor-pointer"
                :class="[{ 'visible': openWide },
                        { 'hidden': !openWide }]"
                v-on:click="openWide = false;">
              <img class="w-full h-full fas fa-caret-right text-white">
            </span>
          </div>
        </div>
        <div class="rounded-l-large h-full w-12full bg-yellow-200 pointer-events-auto overflow-y-auto">
          <div v-if="isProfil">
            <div class="h-auto w-full flex">
              <div class="ml-6 mt-6 flex-row w-auto h-auto whitespace-pre-wrap font-monda-bold text-5xl">
                <span>{{ currentUser.nama }}</span>
                <span class="font-merri-italic text-4xl mt-2"> ({{ currentUser.email }})</span>
              </div>
            </div>
            <div class="h-auto w-full flex-row pb-4">
              <div class="h-1/3 w-full flex"> 
                <div class="w-auto h-auto ml-16 mt-8">
                  <span class="font-overpass text-3xl">Kelas : </span>
                  <span class="whitespace-pre-wrap font-overpass-bold text-3xl"> {{ currentUser.kelas }}</span>
                </div>
              </div>
              <div class="h-1/3 w-full flex">
                <div class="w-auto h-auto ml-16 mt-4">
                  <span class="font-overpass text-3xl">Nomor Telepon : </span>
                  <span class="whitespace-pre-wrap font-overpass-bold text-3xl"> {{ currentUser.nomor_telepon }}</span>
                </div>
              </div>
              <div class="h-1/3 w-full flex">
                <div class="w-auto h-auto ml-16 mt-4">
                  <span class="font-overpass text-3xl">Alamat : </span>
                  <span class="whitespace-pre-wrap font-overpass-bold text-3xl"> {{ currentUser.alamat }}</span>
                </div>
              </div>
            </div>
          </div>

          <div v-if="isTP" class="w-full h-full flex">
            <div v-if="soalTP.length === 0" 
                class="w-full h-full flex">
              <div class="font-monda-bold h-auto w-auto m-auto text-center text-5xl">
                Tidak ada <br> Tugas Pendahuluan saat ini <br>
                <span class="text-xl">Silahkan cek kembali setelah ada pengumuman di OA</span>
              </div>
            </div>

            <div class="h-full w-full flex-row relative"
                v-if="soalTP.length > 0">
              <div class="w-full flex absolute top-0 rounded-tl-large animation-enable"
                  :class="[{ 'bg-green-400 h-12': soalOpened },
                          { 'bg-green-100 h-12full': !soalOpened }]">
                <div class="w-full h-full relative flex">
                  <div class="h-auto w-full select-none absolute bottom-0 flex pb-1 mx-auto font-overpass-mono-bold text-2xl animation-enable"
                      :class="[{ 'text-yellow-100 cursor-pointer': soalOpened },
                              { 'text-black': !soalOpened }]"
                      v-on:click="soalOpened = false">
                    <span class="m-auto">PEMBAHASAN</span> 
                  </div>
                </div>
              </div>
              <div class="w-full flex absolute bottom-0 rounded-bl-large animation-enable"
                  :class="[{ 'bg-green-100 h-12full': soalOpened },
                          { 'bg-green-400 h-12': !soalOpened }]">
                <div class="w-full h-full relative flex-row">
                  <div class="h-16 w-full select-none absolute top-0 flex pt-1 font-overpass-mono-bold text-2xl animation-enable"
                      :class="[{ 'text-yellow-100 cursor-pointer': !soalOpened },
                              { 'text-black': soalOpened }]"
                      v-on:click="soalOpened = true">
                    <span class="my-auto mx-4">SOAL</span>
                  </div>
                  <div class="w-full h-16full flex">
                    <div class="w-full h-full">
                      // TODO: add the soal list layout just like the praktikum
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="isPraktikum" class="w-full h-full flex">

            <!-- Praktikum not EXIST -->
            <div v-if="current_praktikum.status === '' || 
                      current_praktikum.status === 777" 
                class="w-full h-full flex">
              <div class="font-monda-bold h-auto w-auto m-auto text-center text-5xl">
                Tidak ada <br> Praktikum saat ini
              </div>
            </div>

            <!-- On Praktikum Initialization -->
            <div v-if="current_praktikum.status === 0"
                class="w-full h-full flex-row">
              <div class="w-full h-24full flex">
                <div class="font-overpass text-3xl m-auto px-16">
                  <span>Bersiap untuk praktikum modul <br><span class="font-merri-bold text-5xl"> {{ current_modul.judul }} </span></span>
                </div>
              </div>
              <div v-if="programmingQuote !== 'nothing'" class="w-full h-24 flex">
                <div class="font-overpass-mono-thin text-sm m-auto flex">
                  <div class="w-3/4 h-full flex m-auto text-center">" {{ programmingQuote }} " [by {{ quoteAuthor }}]</div>
                </div>
              </div>
            </div>

            <!-- Soal TA already started by Praktikum PJ -->
            <div v-if="current_praktikum.status === 1"
                class="w-full h-full flex">
              <div class="w-1/4 h-full flex-row overflow-y-hidden">
                <div class="w-full h-2/3 flex bg-yellow-700 px-2 overflow-x-hidden rounded-tl-large overflow-y-auto">
                  <div class="h-auto text-white w-auto m-auto text-center font-monda-bold text-3xl">
                    Modul <br> <span class="font-merri">{{ current_modul.judul }}</span>
                  </div>
                </div>
                <div class="w-full h-1/3 flex bg-yellow-600 rounded-bl-large">
                  <div class="h-auto text-white text-center w-auto m-auto font-monda-bold text-2xl">
                    TES <br> AWAL
                  </div>
                </div>
              </div>
              <div class="w-3/4 h-full flex">
                <div class="w-full h-full overflow-y-auto">
                  <div class="w-full h-auto flex-row">
                    <div v-for="(soal, index) in soalTA" v-bind:key="soal.id" 
                        class="w-full flex-row h-auto">
                      <div class="w-full h-auto flex my-10">
                        <div class="h-full w-12 flex font-merri-bold text-xl">
                          <div class="m-auto w-auto h-auto">{{ index+1 }}</div>
                        </div>
                        <div class="h-12 px-1 w-4">
                          <div class="h-full w-full bg-gray-900"/>
                        </div>
                        <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-2xl">
                          <span>{{ soal.pertanyaan }}</span>
                        </div>
                      </div>
                      <div v-for="(jawaban, i) in jawabanTA[index]" v-bind:key="i"
                          class="w-full h-auto flex-row">
                        <div class="w-full px-8 my-2 h-auto cursor-pointer flex">
                          <div class="w-full bg-green-200 hover:bg-green-300 px-4 py-2 rounded-large font-overpass-bold break-words whitespace-pre-wrap text-xl"
                              :class="'jawaban-'+index+i"
                              v-on:click="chooseJawaban('TA', jawaban, soal.id, index, i)">
                            <span>{{ jawaban }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Soal Jurnal already started by Praktikum PJ -->
            <div v-if="current_praktikum.status === 2"
                class="w-full h-full flex">
              <div class="w-1/4 h-full flex-row overflow-y-hidden">
                <div class="w-full h-2/3 flex bg-yellow-700 px-2 overflow-x-hidden rounded-tl-large overflow-y-auto">
                  <div class="h-auto text-white w-auto m-auto text-center font-monda-bold text-3xl">
                    Modul <br> <span class="font-merri">{{ current_modul.judul }}</span>
                  </div>
                </div>
                <div class="w-full h-1/3 flex-row bg-yellow-600 rounded-bl-large">
                  <div class="h-1/2 text-white flex text-center w-auto m-auto font-monda-bold text-2xl">
                    <div class="m-auto">
                      JURNAL
                    </div>
                  </div>
                  <div class="h-1/2 w-full flex"
                      v-if="modulShown">
                    <div class="h-full w-full flex p-4 hover:p-5 cursor-pointer animation-enable-short"
                        v-on:click="modulShown = false">
                      <div class="h-full w-full flex font-overpass-mono-bold text-xl bg-gray-300 rounded-large text-center m-auto">
                        <div class="m-auto">
                          Lihat Soal
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="h-1/2 w-full flex"
                      v-if="!modulShown">
                    <div class="h-full w-full flex p-4 hover:p-5 cursor-pointer animation-enable-short"
                        v-on:click="modulShown = true">
                      <div class="h-full w-full flex font-overpass-mono-bold text-xl bg-gray-300 rounded-large text-center m-auto">
                        <div class="m-auto">
                          Lihat Modul
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-3/4 h-full flex" 
                  v-if="!modulShown">
                <div class="w-full h-full overflow-y-auto">
                  <div class="w-full h-auto flex-row">
                    <div v-for="(soal, index) in soalFitb" v-bind:key="soal.id" 
                        class="w-full flex-row h-auto">
                      <div class="w-full h-auto flex my-10">
                        <div class="h-full w-12 flex font-merri-bold text-xl">
                          <div class="m-auto w-auto h-auto">{{ index+1 }}</div>
                        </div>
                        <div class="h-12 px-1 w-4">
                          <div class="h-full w-full bg-gray-900"/>
                        </div>
                        <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-2xl">
                          <span>{{ soal.soal }}</span>
                        </div>
                      </div>
                      <div class="w-full h-auto flex px-5">
                        <textarea v-model="jawabanFitb[index].jawaban" cols="30" rows="10"
                              class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                              type="text" placeholder="Ketik jawabanmu disini ..."/>
                      </div>
                    </div>
                    <div v-for="(soal, index) in soalJurnal" v-bind:key="soal.id" 
                        class="w-full flex-row h-auto">
                      <div class="w-full h-auto flex my-10">
                        <div class="h-full w-12 flex font-merri-bold text-xl">
                          <div class="m-auto w-auto h-auto">{{ soalFitb.length+(index+1) }}</div>
                        </div>
                        <div class="h-12 px-1 w-4">
                          <div class="h-full w-full bg-gray-900"/>
                        </div>
                        <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-2xl">
                          <span>{{ soal.soal }}</span>
                        </div>
                      </div>
                      <div class="w-full h-auto flex px-5">
                        <textarea v-model="jawabanJurnal[index].jawaban" cols="30" rows="10"
                              class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                              type="text" placeholder="Ketik jawabanmu disini ..."/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-3/4 h-full flex" 
                  v-if="modulShown">
                <div class="w-full h-full font-overpass text-xl whitespace-pre-wrap p-4 text-justify break-words overflow-y-auto">
                  <span>{{ current_modul.isi }}</span>
                </div>
              </div>
            </div>

            <!-- Soal Mandiri already started by Praktikum PJ -->
            <div v-if="current_praktikum.status === 3"
                class="w-full h-full flex">
              <div class="w-1/4 h-full flex-row overflow-y-hidden">
                <div class="w-full h-2/3 flex bg-yellow-700 px-2 overflow-x-hidden rounded-tl-large overflow-y-auto">
                  <div class="h-auto text-white w-auto m-auto text-center font-monda-bold text-3xl">
                    Modul <br> <span class="font-merri">{{ current_modul.judul }}</span>
                  </div>
                </div>
                <div class="w-full h-1/3 flex bg-yellow-600 rounded-bl-large">
                  <div class="h-auto text-white text-center w-auto m-auto font-monda-bold text-2xl">
                    MANDIRI
                  </div>
                </div>
              </div>
              <div class="w-3/4 h-full flex">
                <div class="w-full h-full overflow-y-auto">
                  <div class="w-full h-auto flex-row">
                    <div v-for="(soal, index) in soalMandiri" v-bind:key="soal.id" 
                        class="w-full flex-row h-auto">
                      <div class="w-full h-auto flex my-10">
                        <div class="h-full w-12 flex font-merri-bold text-xl">
                          <div class="m-auto w-auto h-auto">{{ index+1 }}</div>
                        </div>
                        <div class="h-12 px-1 w-4">
                          <div class="h-full w-full bg-gray-900"/>
                        </div>
                        <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-2xl">
                          <span>{{ soal.soal }}</span>
                        </div>
                      </div>
                      <div class="w-full h-auto flex px-5">
                        <textarea v-model="jawabanMandiri[index].jawaban" cols="30" rows="10"
                              class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                              type="text" placeholder="Ketik jawabanmu disini ..."/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Soal TK already started by Praktikum PJ -->
            <div v-if="current_praktikum.status === 4"
                class="w-full h-full flex">
              <div class="w-1/4 h-full flex-row overflow-y-hidden">
                <div class="w-full h-2/3 flex bg-yellow-700 px-2 overflow-x-hidden rounded-tl-large overflow-y-auto">
                  <div class="h-auto text-white w-auto m-auto text-center font-monda-bold text-3xl">
                    Modul <br> <span class="font-merri">{{ current_modul.judul }}</span>
                  </div>
                </div>
                <div class="w-full h-1/3 flex bg-yellow-600 rounded-bl-large">
                  <div class="h-auto text-white text-center w-auto m-auto font-monda-bold text-2xl">
                    TES <br> AKHIR
                  </div>
                </div>
              </div>
              <div class="w-3/4 h-full flex">
                <div class="w-full h-full overflow-y-auto">
                  <div class="w-full h-auto flex-row">
                    <div v-for="(soal, index) in soalTK" v-bind:key="soal.id" 
                        class="w-full flex-row h-auto">
                      <div class="w-full h-auto flex my-10">
                        <div class="h-full w-12 flex font-merri-bold text-xl">
                          <div class="m-auto w-auto h-auto">{{ index+1 }}</div>
                        </div>
                        <div class="h-12 px-1 w-4">
                          <div class="h-full w-full bg-gray-900"/>
                        </div>
                        <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-2xl">
                          <span>{{ soal.pertanyaan }}</span>
                        </div>
                      </div>
                      <div v-for="(jawaban, i) in jawabanTK[index]" v-bind:key="i"
                          class="w-full h-auto flex-row">
                        <div class="w-full px-8 my-2 h-auto cursor-pointer flex">
                          <div class="w-full bg-green-200 hover:bg-green-300 px-4 py-2 rounded-large font-overpass-bold break-words whitespace-pre-wrap text-xl"
                              :class="'jawaban-'+index+i"
                              v-on:click="chooseJawaban('TK', jawaban, soal.id, index, i)">
                            <span>{{ jawaban }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- All Praktikum Proses have done -->
            <!-- Show laporan praktikan's layout -->
            <div v-if="current_praktikum.status === 5"
                class="w-full h-full flex">
              <div class="w-full h-full flex-row overflow-y-auto overflow-x-hidden">
                <div class="w-full h-24 flex mt-4">
                  <div class="w-1/2 h-full flex">
                    <select v-model="laporanPraktikan.asisten_id" 
                          class="block font-monda-bold text-4xl appearance-none w-2/3 ml-auto mr-2 my-auto h-3/4 bg-gray-600 border border-gray-600 text-white py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-500 focus:border-teal-500" id="grid-state">
                      <option value="" disabled selected>Pilih Asisten Jaga</option>
                      <option v-for="asisten in allAsisten" v-bind:key="asisten.id" :value="asisten.id">{{ asisten.kode }} [{{ asisten.nama }}]</option>
                    </select>
                  </div>
                  <div class="w-1/2 h-full flex">
                    <star-rating class="mr-auto ml-2 my-auto"
                      style="width: 250px;" 
                      v-model="laporanPraktikan.rating_asisten"
                      :increment="0.01" 
                      :fixed-points="2"
                      :show-rating="false"
                      :star-size='50'/>
                  </div>
                </div>
                <div class="w-3/4 h-2 bg-black m-auto mt-4 rounded-full"/>
                <div class="w-full h-auto flex mt-4">
                  <div class="w-auto h-auto m-auto font-overpass-bold text-3xl text-center break-words">
                    Bagaimana menurutmu <br> praktikum saat ini ?
                  </div>
                </div>
                <div class="w-full h-auto flex mt-2">
                  <star-rating class="m-auto"
                    style="width: 250px;" 
                    v-model="laporanPraktikan.rating_praktikum"
                    :increment="0.01" 
                    :fixed-points="2"
                    :show-rating="false"
                    :star-size='50'/>
                </div>
                <div class="w-full h-auto flex mt-4">
                  <textarea v-model="laporanPraktikan.pesan" cols="30" rows="5" 
                        class="font-overpass-mono-bold mx-16 text-2xl bg-gray-600 appearance-none border-2 border-gray-300 rounded w-full h-full py-2 px-4 text-white leading-tight focus:outline-none focus:bg-gray-700 focus:border-teal-500" 
                        type="text" placeholder="Ketikkan feedback mengenai praktikum / asisten saat ini ..."/>
                </div>
                <div class="w-full h-24 flex mt-4 mb-8">
                  <div class="w-1/2 h-full mx-auto p-4 hover:p-5 cursor-pointer animation-enable-short"
                      v-on:click="finishPraktikum()">
                    <div class="w-full h-full flex rounded-full font-overpass-bold text-xl text-white flex pt-1 bg-green-600">
                      <div class="m-auto">
                        SELESAI
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Menu -->
    <div class="absolute w-24full right-0 h-16 flex animation-enable"
        :class="[{ 'bottom-0': pageActive },
                { 'bottom-min4rem': !pageActive }]">
      <div class="m-auto h-full w-3/5 flex">

        <!-- Dummy For Animation -->
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <!------------------------->

        <div class="h-full flex animation-enable pointer-events-none"
            :class="[{ 'w-1/11': !isProfil },
                    { 'w-9/11': isProfil }]"
            v-on:click="showProfil">
          <div class="h-full flex animation-enable pointer-events-none"
              :class="[{ 'w-full': !isProfil },
                      { 'w-1/2': isProfil }]">
            <div class="h-full animation-enable pointer-events-none"
              :class="[{ 'w-0': !isProfil },
                      { 'w-9/12': isProfil }]"/>
            <img class="profilIcon w-full iconYellowHover select-none cursor-pointer pointer-events-auto self-center h-8 fas fa-address-card animation-enable">
          </div>
          <span class="self-center text-left font-monda-bold text-lg text-white animation-enable-short"
              :class="[{ 'w-0 opacity-0 tracking-tighter': !isProfil },
                      { 'w-1/2 opacity-100 tracking-widest': isProfil }]">
            Profil
          </span>
        </div>

        <div class="h-full flex animation-enable pointer-events-none"
            :class="[{ 'w-1/11': !isPraktikum },
                    { 'w-9/11': isPraktikum }]"
            v-on:click="showPraktikum">
          <div class="h-full flex animation-enable pointer-events-none"
              :class="[{ 'w-full': !isPraktikum },
                      { 'w-1/2': isPraktikum }]">
            <div class="h-full animation-enable pointer-events-none"
              :class="[{ 'w-0': !isPraktikum },
                      { 'w-9/12': isPraktikum }]"/>
            <img class="praktikumIcon w-full iconYellowHover select-none cursor-pointer pointer-events-auto self-center h-8 fas fa-code animation-enable">
          </div>
          <span class="self-center text-left font-monda-bold text-lg text-white animation-enable-short"
              :class="[{ 'w-0 opacity-0 tracking-tighter': !isPraktikum },
                      { 'w-1/2 opacity-100 tracking-widest': isPraktikum }]">
            Praktikum
          </span>
        </div>
        
        <div class="h-full flex animation-enable pointer-events-none"
            :class="[{ 'w-1/11': !isTP },
                    { 'w-9/11': isTP }]"
            v-on:click="showTP">
          <div class="h-full flex animation-enable pointer-events-none"
              :class="[{ 'w-full': !isTP },
                      { 'w-1/2': isTP }]">
            <div class="h-full animation-enable pointer-events-none"
              :class="[{ 'w-0': !isTP },
                      { 'w-9/12': isTP }]"/>
            <img class="tpIcon w-full iconYellowHover select-none cursor-pointer pointer-events-auto self-center h-8 fas fa-file-code animation-enable">
          </div>
          <span class="self-center text-left font-monda-bold text-lg text-white animation-enable-short"
              :class="[{ 'w-0 opacity-0 tracking-tighter': !isTP },
                      { 'w-1/2 opacity-100 tracking-widest': isTP }]">
            Tugas Pendahuluan
          </span>
        </div>

        <div class="h-full flex animation-enable pointer-events-none"
            :class="[{ 'w-1/11': !isNilai },
                    { 'w-9/11': isNilai }]"
            v-on:click="showNilai">
          <div class="h-full flex animation-enable pointer-events-none"
              :class="[{ 'w-full': !isNilai },
                      { 'w-1/2': isNilai }]">
            <div class="h-full animation-enable pointer-events-none"
              :class="[{ 'w-0': !isNilai },
                      { 'w-9/12': isNilai }]"/>
            <img class="nilaiIcon w-full iconYellowHover select-none cursor-pointer pointer-events-auto self-center h-8 fas fa-chart-area animation-enable">
          </div>
          <span class="self-center text-left font-monda-bold text-lg text-white animation-enable-short"
              :class="[{ 'w-0 opacity-0 tracking-tighter': !isNilai },
                      { 'w-1/2 opacity-100 tracking-widest': isNilai }]">
            Nilai
          </span>
        </div>

        <!-- Dummy For Animation -->
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP && !isProfil },
                    { 'w-0': isPraktikum || isNilai || isTP || isProfil }]"/>
        <!------------------------->

      </div>
    </div>

    <!-- Profile Menu -->
    <div class="absolute top-0 right-0 z-40 w-24full h-24 flex"
        :class="[{ 'visible': isMenuShown && pageActive },
                { 'hidden': !isMenuShown }]" @mouseleave="isMenuShown = false">
      <div class="m-auto h-full w-56 flex-row bg-gray-600 mt-2 rounded-lg">
        <div class="w-full h-2/3"/>
        <div class="w-full h-1/3 flex">
          <div class="rounded-b-lg bg-gray-400 flex hover:bg-gray-500 w-full h-full cursor-pointer" v-on:click="signOut">
            <span class="m-auto font-monda-bold text-sm text-right w-full">
              Logout
            </span>
            <img class="select-none p-2 h-full w-auto mr-16 m-auto fas fa-sign-out-alt">
          </div>
        </div>
      </div>
    </div>

    <!-- Profile Layout -->
    <div class="absolute right-0 w-24full h-16 flex animation-enable"
        :class="[{ 'top-0': pageActive },
                { 'top-min4rem': !pageActive },
                { 'z-40': !openWide },
                { 'z-0': openWide }]">
      <div class="m-auto h-12 mt-4 w-48 flex items-center font-monda-bold text-lg text-white">
        <span class="m-auto flex items-center z-10" @mouseover="isMenuShown = true">
          {{ currentUser.nim }}
          <div class="w-4"/>
          <img class="select-none w-8 h-8 fas fa-arrow-circle-down" style="color: white;">
        </span>
      </div>
    </div>

    <!-- Message Layout -->
    <div class="absolute z-50 bottom-0 w-full h-full bg-black animation-enable pointer-events-none"
        :class="[{ 'opacity-75': messageOpened },
                { 'opacity-0': !messageOpened }]"/>
    <div class="absolute z-50 w-full h-36 bg-gray-500 rounded-b-lg animation-enable"
        :class="[{ 'top-0': messageOpened },
                { ' top-min20rem': !messageOpened }]">
      <form id="messageForm" class="w-full h-full pl-24 flex">
        <div class="w-2/12 h-full flex-row py-4">
          <span class="font-merri w-full text-left text-lg h-1/4">
            Kode Asisten
          </span>
          <div class="w-full h-3/4">
            <input v-model="formMessage.kode" 
                  class="font-overpass-mono-bold uppercase text-5xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                  id="Kode" type="text" placeholder="FAI">
          </div>
        </div>
        <div class="w-9/12 h-full flex-row py-4 pl-4">
          <span class="font-merri w-full text-left text-lg h-1/4">
            Pesan Kepada 
            <span class="uppercase">
              [ {{ formMessage.kode }} ]
            </span>
          </span>
          <div class="w-full h-3/4">
            <textarea v-model="formMessage.pesan" cols="30" rows="10" 
                  class="font-overpass-mono-bold text-2xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                  id="Kode" type="text" placeholder="just for a test"/>
          </div>
        </div>
        <div class="w-1/12 h-full">
          <span class="w-full h-full cursor-pointer" v-on:click="sendMessage">
            <img class="w-full h-full mt-4 p-8 fas fa-paper-plane" style="color: black;">
          </span>
        </div>
      </form>
    </div>

    <!-- Message Menu (OPEN) -->
    <span class="messageIcon absolute top-0 mt-6 ml-6 w-12 h-12 cursor-pointer animation-enable"
        :class="[{ 'left-min20rem': !pageActive || messageOpened },
                { 'left-0': pageActive && !messageOpened },
                { 'z-50': !openWide },
                { 'z-0': openWide }]"
        v-on:click="messageOpened = true">
      <img class="iconGreenHover w-full h-full fas fa-envelope">
    </span>

    <!-- Message Menu (CLOSE) -->
    <span class="messageIcon absolute left-0 mt-20 ml-5 w-12 h-12 p-0 hover:p-1 cursor-pointer animation-enable"
        :class="[{ 'top-0': messageOpened },
                { 'top-min20rem': !messageOpened },
                { 'z-50': !openWide },
                { 'z-0': openWide }]"
        v-on:click="messageOpened = false">
      <img class="w-full h-full fas fa-window-close" style="color: black;">
    </span>
  </div>
</template>
<style>
.youngYellowIcon {
  color: #faf089;
}

.iconGreenHover {
  color: #c6f6d5;
}

.iconGreenHover:hover {
  color: #48bb78;
}

.iconYellowHover {
  color: #d69e2e;
}

.iconYellowHover:hover{
  color: #faf089;
}
</style>

<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
    'allAsisten',
  ],

  data() {
    return {
      pageActive: false,
      isPraktikum: false,
      isTP: false,
      isNilai: false,
      isProfil: false,
      isMenuShown: false,
      messageOpened: false,
      openWide: false,
      modulShown: false,

      current_praktikum: {
        kelas_id: '',
        modul_id: '',
        asisten_id: '',
        status: '',
      },

      current_modul: {
        judul: '',
        deskripsi: '',
        isi: '',
      },

      soalOpened: true,

      formMessage: {
        kode: '',
        pesan: '',
        praktikan_id: this.currentUser.id,
        kelas_id: this.currentUser.kelas_id,
      },

      programmingQuote: 'nothing',
      quoteAuthor: '',

      soalTA: [],
      soalTK: [],
      soalTPEssay: [],
      soalTPProgram: [],
      soalMandiri: [],
      soalJurnal: [],
      soalFitb: [],

      jawabanTA: [],
      jawabanTK: [],

      chosenJawaban: [],
      jawabanPraktikan: {
        soal_id: '',
        jawaban: '',
      },

      jawabanFitb: [],
      jawabanJurnal: [],
      jawabanMandiri: [],
      jawabanTP: [],

      laporanPraktikan: {
        pesan: '',
        rating_asisten: 0,
        rating_praktikum: 0,
        asisten_id: '',
        praktikan_id: '',
        modul_id: '',
      },
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.showProfil();

    const globe = this;
    if(this.comingFrom === 'login'||
        this.comingFrom === 'none' ){

      setTimeout(
        function() {
          globe.pageActive = true;
        }, 10); 
    }

    globe.$axios.post('/checkPraktikum').then(response => {

      if(response.data.message === "success") {

        if(response.data.current_praktikum != null){

          //There is currently active praktikum
          globe.setCurrentPraktikumState(response.data.current_praktikum, false);
        }

      } else {
        globe.$toasted.global.showError({
          message: response.data.message
        });
      }
    });

    globe.$axios.get('/getSoalTP').then(response => {

      if(response.data.message === "success") {

        if(response.data.all_soalEssay !== null){

          globe.soalTPEssay = response.data.all_soalEssay;
          for (let index = 0; index < globe.soalTPEssay.length; index++) {
            const soal = globe.soalTPEssay[index];
            globe.jawabanTP.push({
              soal_id: soal.id,
              modul_id: soal.modul_id,
              praktikan_id: globe.currentUser.id,
              jawaban: '',
            });
          }
        }
        if(response.data.all_soalProgram !== null){

          globe.soalTPProgram = response.data.all_soalProgram;
          for (let index = 0; index < globe.soalTPProgram.length; index++) {
            const soal = globe.soalTPProgram[index];
            globe.jawabanTP.push({
              soal_id: soal.id,
              modul_id: soal.modul_id,
              praktikan_id: globe.currentUser.id,
              jawaban: '',
            });
          }
        }

      } else {
        globe.$toasted.global.showError({
          message: response.data.message
        });
      }
    }); 

    Echo.channel(`daskom_database_praktikum.${globe.currentUser.kelas_id}`)
        .listen('praktikumStatusUpdated', (data) => {
      globe.setCurrentPraktikumState(data.current_praktikum, true);
    });
  },

  beforeDestroy() {

    Echo.leave(`daskom_database_praktikum.${globe.currentUser.kelas_id}`);
  },

  methods: {

    shuffleArr: function($arr){

      for (let i = $arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [$arr[i], $arr[j]] = [$arr[j], $arr[i]];
      }

      return $arr;
    },
    
    finishPraktikum: function(){

      const globe = this;
      if(this.laporanPraktikan.asisten_id === ''){
        globe.$toasted.global.showError({
          message: 'Pilih asisten yang mengajar anda terlebih dahulu <br> (dibagian paling atas samping kiri rating)'
        });
        return;
      }

      if(this.laporanPraktikan.pesan === ''){
        globe.$toasted.global.showError({
          message: 'Masukkan pesan untuk praktikum / asisten terlebih dahulu'
        });
        return;
      }

      if(this.laporanPraktikan.rating_asisten === 0){
        globe.$toasted.global.showError({
          message: 'Beri rating untuk asisten terlebih dahulu'
        });
        return;
      }

      if(this.laporanPraktikan.rating_praktikum === 0){
        globe.$toasted.global.showError({
          message: 'Beri rating untuk praktikum terlebih dahulu'
        });
        return;
      }

      globe.laporanPraktikan.praktikan_id = this.currentUser.id;
      globe.laporanPraktikan.modul_id = this.current_praktikum.modul_id;
      globe.$axios.post('/sendLaporan', globe.laporanPraktikan).then(response => {

        if(response.data.message === "success") {
          globe.current_praktikum.status = 777;
          globe.$toasted.global.showSuccess({
            message: "Praktikum telah selesai :)"
          });
        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
    },

    setCurrentPraktikumState: function(current_praktikum, isRealtime){

      const globe = this;
      globe.current_praktikum.asisten_id = current_praktikum.asisten_id;
      globe.current_praktikum.modul_id = current_praktikum.modul_id;
      globe.current_praktikum.kelas_id = current_praktikum.kelas_id;
      globe.current_praktikum.status = current_praktikum.status;

      // Check if the praktikan is in the kelas runnning the praktikum
      if(globe.current_praktikum.kelas_id === this.currentUser.kelas_id){

        //  Initialization of the praktikum
        globe.$axios.post('/getModul/'+globe.current_praktikum.modul_id).then(response => {

          if(response.data.message === "success") {

            if(response.data.modul !== null){

              //There is currently active praktikum
              globe.current_modul.judul = response.data.modul.judul;
              globe.current_modul.deskripsi = response.data.modul.deskripsi;
              globe.current_modul.isi = response.data.modul.isi;

              // http://quotes.stormconsultancy.co.uk/random.json 
              // (API for random programming quote)
              if(globe.current_praktikum.status === 0)
                globe.$axios.get('http://quotes.stormconsultancy.co.uk/random.json').then(response => {
                  globe.programmingQuote = response.data.quote;
                  globe.quoteAuthor = response.data.author;
                }); 
            }

          } else {
            globe.$toasted.global.showError({
              message: response.data.message
            });
          }
        });       

        switch (globe.current_praktikum.status) {

          case 0:

            // DO nothing as the initialization just begin
            // Added for escaping the default scenario
            break;

          case 1:
            
            // Start Opening TA and grab all SOAL from it
            // (get RANDOMIZED soal from soal__tas)
            globe.$axios.get('/getSoalTA/'+globe.current_praktikum.modul_id).then(response => {

              if(response.data.message === "success") {

                if(response.data.all_soal !== null){

                  globe.soalTA = response.data.all_soal;
                  globe.soalTA.forEach(soal => {
                    var all_jawaban = [];
                    all_jawaban.push(soal.jawaban_benar);
                    all_jawaban.push(soal.jawaban_salah1);
                    all_jawaban.push(soal.jawaban_salah2);
                    all_jawaban.push(soal.jawaban_salah3);

                    //randomizing all the "jawaban" for each soal
                    all_jawaban = globe.shuffleArr(all_jawaban);

                    globe.chosenJawaban.push({
                      modul_id: globe.current_praktikum.modul_id,
                      praktikan_id: globe.currentUser.id,
                      soal_id: soal.id,
                      jawaban: '',
                    });
                      
                    globe.jawabanTA.push(all_jawaban);
                  });
                }

              } else {
                globe.$toasted.global.showError({
                  message: response.data.message
                });
              }
            }); 
            break;

          case 2:

            // Realtime connection make changes to status 2
            // Meaning we should send jawaban in status 1 (Soal TA)
            if(isRealtime){
              
              globe.$axios.post('/sendJawabanTA', globe.chosenJawaban).then(response => {

                if(response.data.message === "success") {
                  // Do nothing as all of jawaban successfully saved to the DB
                  
                } else {
                  globe.$toasted.global.showError({
                    message: response.data.message
                  });
                }
              }); 
            }
            
            // Start opening Jurnal Section and get all SOAL from
            // get soal from soal__jurnals and soal__fitbs
            globe.$axios.get('/getSoalJURNAL').then(response => {

              if(response.data.message === "success") {

                if(response.data.all_soal !== null){

                  globe.soalJurnal = response.data.all_soal;
                  for (let index = 0; index < globe.soalJurnal.length; index++) {
                    const soal = globe.soalJurnal[index];
                    globe.jawabanJurnal.push({
                      soal_id: soal.id,
                      modul_id: soal.modul_id,
                      praktikan_id: globe.currentUser.id,
                      jawaban: '',
                    });
                  }
                }

              } else {
                globe.$toasted.global.showError({
                  message: response.data.message
                });
              }
            }); 
            globe.$axios.get('/getSoalFITB').then(response => {

              if(response.data.message === "success") {

                if(response.data.all_soal !== null){

                  globe.soalFitb = response.data.all_soal;
                  for (let index = 0; index < globe.soalFitb.length; index++) {
                    const soal = globe.soalFitb[index];
                    globe.jawabanFitb.push({
                      soal_id: soal.id,
                      modul_id: soal.modul_id,
                      praktikan_id: globe.currentUser.id,
                      jawaban: '',
                    });
                  }
                }

              } else {
                globe.$toasted.global.showError({
                  message: response.data.message
                });
              }
            });
            break;

          case 3:
            
            // Realtime connection make changes to status 3
            // Meaning we should send jawaban in status 2 (Soal Jurnal and Soal FITB)
            if(isRealtime){
              
              globe.$axios.post('/sendJawabanJurnal', globe.jawabanJurnal).then(response => {

                if(response.data.message === "success") {
                  // Do nothing as all of jawaban successfully saved to the DB
                  
                } else {
                  globe.$toasted.global.showError({
                    message: response.data.message
                  });
                }
              }); 

              globe.$axios.post('/sendJawabanFitb', globe.jawabanFitb).then(response => {

                if(response.data.message === "success") {
                  // Do nothing as all of jawaban successfully saved to the DB
                  
                } else {
                  globe.$toasted.global.showError({
                    message: response.data.message
                  });
                }
              }); 
            }

            // Start opening Mandiri Section and get all SOAL from
            // get soal from soal__mandiris
            globe.$axios.get('/getSoalMANDIRI/'+globe.current_praktikum.modul_id).then(response => {

              if(response.data.message === "success") {

                if(response.data.all_soal !== null){

                  globe.soalMandiri = response.data.all_soal;
                  for (let index = 0; index < globe.soalMandiri.length; index++) {
                    const soal = globe.soalMandiri[index];
                    globe.jawabanMandiri.push({
                      soal_id: soal.id,
                      modul_id: soal.modul_id,
                      praktikan_id: globe.currentUser.id,
                      jawaban: '',
                    });
                  }
                }

              } else {
                globe.$toasted.global.showError({
                  message: response.data.message
                });
              }
            }); 
            break;

          case 4:
            
            // Realtime connection make changes to status 4
            // Meaning we should send jawaban in status 3 (Soal Mandiri)
            if(isRealtime){
              
              globe.$axios.post('/sendJawabanMandiri', globe.jawabanMandiri).then(response => {

                if(response.data.message === "success") {
                  // Do nothing as all of jawaban successfully saved to the DB
                  
                } else {
                  globe.$toasted.global.showError({
                    message: response.data.message
                  });
                }
              }); 
            }

            // Start Opening TK and grab all SOAL from it
            // (get RANDOMIZED soal from soal__tks)
            globe.$axios.get('/getSoalTK/'+globe.current_praktikum.modul_id).then(response => {

              if(response.data.message === "success") {

                if(response.data.all_soal !== null){

                  globe.soalTK = response.data.all_soal;
                  globe.chosenJawaban = [];
                  globe.soalTK.forEach(soal => {
                    var all_jawaban = [];
                    all_jawaban.push(soal.jawaban_benar);
                    all_jawaban.push(soal.jawaban_salah1);
                    all_jawaban.push(soal.jawaban_salah2);
                    all_jawaban.push(soal.jawaban_salah3);

                    //randomizing all the "jawaban" for each soal
                    all_jawaban = globe.shuffleArr(all_jawaban);

                    globe.chosenJawaban.push({
                      modul_id: globe.current_praktikum.modul_id,
                      praktikan_id: globe.currentUser.id,
                      soal_id: soal.id,
                      jawaban: '',
                    });
                      
                    globe.jawabanTK.push(all_jawaban);
                  });
                }

              } else {
                globe.$toasted.global.showError({
                  message: response.data.message
                });
              }
            }); 
            break;

          case 5: 

            // Realtime connection make changes to status 5
            // Meaning we should send jawaban in status 4 (Soal TK)
            if(isRealtime){
               
              globe.$axios.post('/sendJawabanTK', globe.chosenJawaban).then(response => {

                if(response.data.message === "success") {
                  // Do nothing as all of jawaban successfully saved to the DB
                  
                } else {
                  globe.$toasted.global.showError({
                    message: response.data.message
                  });
                }
              }); 
            }

            // Check if laporan Praktikan already exists
            globe.$axios.post('/getLaporan/'+globe.currentUser.id+'/'+globe.current_praktikum.modul_id).then(response => {

              if(response.data.message === "done") {
                
                // Change status to 777 if the praktikan already fill in the laporan form
                globe.current_praktikum.status = 777;
              }

              //else just run it as usual
            }); 
            break;

          default:

            // Ignore other case and cast the status to 777
            globe.current_praktikum.status = 777;
            break;
        }
      }
    },

    chooseJawaban: function($soalType, $jawaban, $soalId, $soalIndex, $jawabanIndex){
      
      const globe = this;

      if($soalType === "TA"){
        for (let index = 0; index < this.chosenJawaban.length; index++) {
          if(this.chosenJawaban[index].soal_id === $soalId){
            if(this.chosenJawaban[index].jawaban !== ''){
              for (let i = 0; i < this.jawabanTA[index].length; i++) {
                if(this.jawabanTA[index][i] === this.chosenJawaban[index].jawaban){
                  $('.jawaban-'+index+i).addClass('bg-green-200 hover:bg-green-300');
                  $('.jawaban-'+index+i).removeClass('bg-green-500 text-white');
                }
              }
            }

            this.chosenJawaban[index].jawaban = $jawaban;
          }
        }
      } else if($soalType === "TK") {
        for (let index = 0; index < this.chosenJawaban.length; index++) {
          if(this.chosenJawaban[index].soal_id === $soalId){
            if(this.chosenJawaban[index].jawaban !== ''){
              for (let i = 0; i < this.jawabanTK[index].length; i++) {
                if(this.jawabanTK[index][i] === this.chosenJawaban[index].jawaban){
                  $('.jawaban-'+index+i).addClass('bg-green-200 hover:bg-green-300');
                  $('.jawaban-'+index+i).removeClass('bg-green-500 text-white');
                }
              }
            }

            this.chosenJawaban[index].jawaban = $jawaban;
          }
        }
      }

      $('.jawaban-'+$soalIndex+$jawabanIndex).removeClass('bg-green-200 hover:bg-green-300');
      $('.jawaban-'+$soalIndex+$jawabanIndex).addClass('bg-green-500 text-white');
    },  

    showPraktikum: function(){
      this.isPraktikum = true;
      this.isTP = false;
      this.isNilai = false;
      this.isProfil = false;
      $('.tpIcon , .nilaiIcon , .profilIcon').removeClass('w-3/12');
      $('.tpIcon , .nilaiIcon , .profilIcon').removeClass('youngYellowIcon');
      $('.tpIcon , .nilaiIcon , .profilIcon').addClass('iconYellowHover');
      $('.tpIcon , .nilaiIcon , .profilIcon').addClass('w-full');
      
      $('.praktikumIcon').removeClass('w-full');
      $('.praktikumIcon').removeClass('iconYellowHover');
      $('.praktikumIcon').addClass('youngYellowIcon');
      $('.praktikumIcon').addClass('w-3/12');
    },

    showNilai: function(){
      this.isPraktikum = false;
      this.isTP = false;
      this.isNilai = true;
      this.isProfil = false;
      $('.praktikumIcon , .tpIcon , .profilIcon').removeClass('w-3/12');
      $('.praktikumIcon , .tpIcon , .profilIcon').removeClass('youngYellowIcon');
      $('.praktikumIcon , .tpIcon , .profilIcon').addClass('iconYellowHover');
      $('.praktikumIcon , .tpIcon , .profilIcon').addClass('w-full');
      
      $('.nilaiIcon').removeClass('w-full');
      $('.nilaiIcon').removeClass('iconYellowHover');
      $('.nilaiIcon').addClass('youngYellowIcon');
      $('.nilaiIcon').addClass('w-3/12');
    },

    showTP: function(){
      this.isPraktikum = false;
      this.isTP = true;
      this.isNilai = false;
      this.isProfil = false;
      $('.praktikumIcon , .nilaiIcon , .profilIcon').removeClass('w-3/12');
      $('.praktikumIcon , .nilaiIcon , .profilIcon').removeClass('youngYellowIcon');
      $('.praktikumIcon , .nilaiIcon , .profilIcon').addClass('iconYellowHover');
      $('.praktikumIcon , .nilaiIcon , .profilIcon').addClass('w-full');
      
      $('.tpIcon').removeClass('iconYellowHover');
      $('.tpIcon').removeClass('w-full');
      $('.tpIcon').addClass('youngYellowIcon');
      $('.tpIcon').addClass('w-3/12');
    },

    showProfil: function(){
      this.isPraktikum = false;
      this.isTP = false;
      this.isNilai = false;
      this.isProfil = true;
      $('.praktikumIcon , .nilaiIcon , .tpIcon').removeClass('w-3/12');
      $('.praktikumIcon , .nilaiIcon , .tpIcon').removeClass('youngYellowIcon');
      $('.praktikumIcon , .nilaiIcon , .tpIcon').addClass('iconYellowHover');
      $('.praktikumIcon , .nilaiIcon , .tpIcon').addClass('w-full');
      
      $('.profilIcon').removeClass('iconYellowHover');
      $('.profilIcon').removeClass('w-full');
      $('.profilIcon').addClass('youngYellowIcon');
      $('.profilIcon').addClass('w-3/12');
    },

    signOut: function() {

      const globe = this;
      this.pageActive = false;
      this.isMenuShown = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/logoutPraktikan')
        }, 1010); 
    },

    sendMessage: function(){

      const globe = this;
      this.$axios.post('/sendPesan', this.formMessage).then(response => {
        
        if(response.data.message === "success") {

          globe.$toasted.global.showSuccess({
            message: "Pesan berhasil terkirim"
          });
          globe.messageOpened = false;

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
            if(error.response.data.errors.kode != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.kode[0]
              });
            if(error.response.data.errors.pesan != null)
              globe.$toasted.global.showError({
                message: error.response.data.errors.pesan[0]
              });
          } 
        }
      });
    }
  }
}
</script>
