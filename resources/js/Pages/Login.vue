<template>
  <div class="main_container w-full h-full overflow-hidden">

    <div class="h-full w-full fixed bg-gray-400"/>

    <!-- Login Part (PRAKTIKAN) -->
    <div class="fixed h-full" 
        style="background: rgb(203,213,224);
                background: linear-gradient(90deg, rgba(203,213,224,1) 0%, rgba(226,232,240,1) 20%, rgba(226,232,240,1) 100%);"
        :class="[{ 'w-0': !activeX },
                  { 'w-36full': activeX },
                  { 'bottom-minFull': !isPraktikan },
                  { 'bottom-0': isPraktikan },
                  { 'right-minFull': !isLogin },
                  { 'right-0': isLogin },
                  { 'animation-enable': animate }]">
      <div class="flex h-full">
        <form class="w-full max-w-sm m-auto">
          <span class="flex font-semibold font-overpass-mono-bold text-6xl text-teal-900"
                style="letter-spacing: 0.5rem">
            LOGIN
            <svg class="ml-4 self-start mt-4 w-12 h-12" viewBox="0 0 24 24">
                <path fill="#234e52" d="M19,22H5V20H19V22M16,18L13.2,7.74C14.72,7.07 15.41,5.31 14.74,3.79C14.08,2.27 12.31,1.58 10.79,2.25C9.27,2.91 8.58,4.68 9.25,6.2C9.55,6.89 10.1,7.44 10.79,7.74L8,18H16Z" />
            </svg>
          </span>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="inline-full-name">
                Nim
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formLoginPraktikan.nim" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="inline-full-name" type="text" placeholder="1102174055">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="inline-username">
                Password
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formLoginPraktikan.password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="inline-username" type="password" placeholder="******************">
            </div>
          </div>
          <div class="flex items-center">
            <div class="w-4/5"></div>
            <div class="w-1/5">
              <button v-on:click="loginPraktikan" class="flex w-full shadow bg-teal-500 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                <svg class="mx-auto fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <polygon id="Combined-Shape-Copy" points="16.1715729 9 10.1005051 2.92893219 11.5147186 1.51471863 20 10 19.2928932 10.7071068 11.5147186 18.4852814 10.1005051 17.0710678 16.1715729 11 -5.68434189e-14 11 -5.68434189e-14 9"></polygon>
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>              
    </div>

    <!-- Signup Part (PRAKTIKAN) -->
    <div class="overflow-y-auto fixed h-full" 
        style="background: rgb(203,213,224);
                background: linear-gradient(90deg, rgba(226,232,240,1) 0%, rgba(226,232,240,1) 80%, rgba(203,213,224,1) 100%);"
        :class="[{ 'w-0': !activeX },
                  { 'w-36full': activeX },
                  { 'bottom-minFull': !isPraktikan},
                  { 'bottom-0': isPraktikan },
                  { 'left-minFull': isLogin },
                  { 'left-0': !isLogin },
                  { 'animation-enable': animate }]">
      <div class="flex h-full">
        <form id="signupPraktikanForm" class="w-full max-w-sm m-auto">
          <span class="flex font-semibold font-overpass-mono-bold text-6xl text-teal-900"
                style="letter-spacing: 0.5rem">
            SIGNUP
            <svg class="ml-4 self-start mt-4 w-12 h-12" viewBox="0 0 24 24">
                <path fill="#234e52" d="M19,22H5V20H19V22M16,18L13.2,7.74C14.72,7.07 15.41,5.31 14.74,3.79C14.08,2.27 12.31,1.58 10.79,2.25C9.27,2.91 8.58,4.68 9.25,6.2C9.55,6.89 10.1,7.44 10.79,7.74L8,18H16Z" />
            </svg>
          </span>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Nama">
                Nama
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formPraktikan.nama" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Nama" type="text" placeholder="Sebut Saja Praktikan">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Email">
                Email
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formPraktikan.email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Email" type="email" placeholder="praktikan@gmail.com">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="NomorTelepon">
                Nomor Telepon
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formPraktikan.nomor_telepon" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="NomorTelepon" type="text" placeholder="62**********">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Alamat">
                Alamat
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formPraktikan.alamat" class="resize-y bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Alamat" type="text" placeholder="Asrama Telkom University">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Alamat">
                Kelas
              </label>
            </div>
            <select v-model="formPraktikan.kelas_id" class="block appearance-none w-2/3 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
              <option v-for="kelas in all_kelas" v-bind:key="kelas.id" :value="kelas.id">{{ kelas.kelas }}</option>
            </select>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Nim">
                Nim
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formPraktikan.nim" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Nim" type="text" placeholder="1102112011">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Password">
                Password
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formPraktikan.password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Password" type="password" placeholder="******************">
            </div>
          </div>
          <div class="flex items-center">
            <div class="w-4/5"></div>
            <div class="w-1/5">
              <button v-on:click="signupPraktikan" class="flex w-full shadow bg-teal-500 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                <svg class="mx-auto fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <polygon id="Combined-Shape-Copy" points="16.1715729 9 10.1005051 2.92893219 11.5147186 1.51471863 20 10 19.2928932 10.7071068 11.5147186 18.4852814 10.1005051 17.0710678 16.1715729 11 -5.68434189e-14 11 -5.68434189e-14 9"></polygon>
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>              
    </div>

    <!-- Login Part (ASISTEN) -->
    <div class="fixed right-0 h-full bg-yellow-300"
        style="background: rgb(203,213,224);
                background: linear-gradient(90deg, rgba(203,213,224,1) 0%, rgba(226,232,240,1) 20%, rgba(226,232,240,1) 100%);"
        :class="[{ 'w-0': !activeX },
                  { 'w-36full': activeX },
                  { 'top-0': !isPraktikan },
                  { 'top-minFull': isPraktikan },
                  { 'right-minFull': !isLogin },
                  { 'right-0': isLogin },
                  { 'animation-enable': animate }]">
      <div class="flex h-full">
        <form class="w-full max-w-sm m-auto">
          <span class="flex font-semibold font-overpass-mono-bold text-6xl text-teal-900"
                style="letter-spacing: 0.5rem">
            LOGIN
            <svg class="ml-4 self-start mt-4 w-12 h-12" viewBox="0 0 24 24">
              <path fill="#234e52" d="M19,22H5V20H19V22M17,10C15.58,10 14.26,10.77 13.55,12H13V7H16V5H13V2H11V5H8V7H11V12H10.45C9.35,10.09 6.9,9.43 5,10.54C3.07,11.64 2.42,14.09 3.5,16C4.24,17.24 5.57,18 7,18H17A4,4 0 0,0 21,14A4,4 0 0,0 17,10Z" />
            </svg>
          </span>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="inline-full-name">
                Kode
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formLoginAsisten.kode" class="uppercase bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="inline-full-name" type="text" placeholder="TES">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="inline-username">
                Password
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formLoginAsisten.password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="inline-username" type="password" placeholder="******************">
            </div>
          </div>
          <div class="flex items-center">
            <div class="w-4/5"></div>
            <div class="w-1/5">
              <button v-on:click="loginAsisten" class="flex w-full shadow bg-yellow-500 hover:bg-yellow-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                <svg class="mx-auto h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <polygon fill="#000000" id="Combined-Shape-Copy" points="16.1715729 9 10.1005051 2.92893219 11.5147186 1.51471863 20 10 19.2928932 10.7071068 11.5147186 18.4852814 10.1005051 17.0710678 16.1715729 11 -5.68434189e-14 11 -5.68434189e-14 9"></polygon>
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>              
    </div>

    <!-- Signup Part (ASISTEN) -->
    <div class="fixed right-0 h-full bg-yellow-300"
        style="background: rgb(203,213,224);
                background: linear-gradient(90deg, rgba(226,232,240,1) 0%, rgba(226,232,240,1) 80%, rgba(203,213,224,1) 100%);"
        :class="[{ 'w-0': !activeX },
                  { 'w-36full': activeX },
                  { 'top-0': !isPraktikan },
                  { 'top-minFull': isPraktikan },
                  { 'left-minFull': isLogin },
                  { 'left-0': !isLogin },
                  { 'animation-enable': animate }]">
      <div class="flex h-full">
        <form id="signupAsistenForm" class="w-full max-w-sm m-auto">
          <span class="flex font-semibold font-overpass-mono-bold text-6xl text-teal-900"
                style="letter-spacing: 0.5rem">
            SIGNUP
            <svg class="ml-4 self-start mt-4 w-12 h-12" viewBox="0 0 24 24">
              <path fill="#234e52" d="M19,22H5V20H19V22M17,10C15.58,10 14.26,10.77 13.55,12H13V7H16V5H13V2H11V5H8V7H11V12H10.45C9.35,10.09 6.9,9.43 5,10.54C3.07,11.64 2.42,14.09 3.5,16C4.24,17.24 5.57,18 7,18H17A4,4 0 0,0 21,14A4,4 0 0,0 17,10Z" />
            </svg>
          </span>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Nama">
                Nama
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formAsisten.nama" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Nama" type="text" placeholder="Sebut Saja Asisten">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Deskripsi">
                Deskripsi
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formAsisten.deskripsi" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Deskripsi" type="text" placeholder="Gitu aja">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Role">
                Role
              </label>
            </div>
            <select v-model="formAsisten.role_id" class="block appearance-none w-2/3 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
              <option v-for="role in roles" v-bind:key="role.id" :value="role.id">{{ role.role }}</option>
            </select>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Kode">
                Kode
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formAsisten.kode" class="uppercase bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Kode" type="text" placeholder="TES">
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-1/3">
              <label class="block text-gray-600 font-bold text-right mb-1 mb-0 pr-4" for="Password">
                Password
              </label>
            </div>
            <div class="w-2/3">
              <input v-model="formAsisten.password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" id="Password" type="password" placeholder="******************">
            </div>
          </div>
          <div class="flex items-center">
            <div class="w-4/5"></div>
            <div class="w-1/5">
              <button v-on:click="signupAsisten" class="flex w-full shadow bg-yellow-500 hover:bg-yellow-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                <svg class="mx-auto h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <polygon fill="#000000" id="Combined-Shape-Copy" points="16.1715729 9 10.1005051 2.92893219 11.5147186 1.51471863 20 10 19.2928932 10.7071068 11.5147186 18.4852814 10.1005051 17.0710678 16.1715729 11 -5.68434189e-14 11 -5.68434189e-14 9"></polygon>
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>              
    </div>

    <!-- Main Background -->
    <div class="h-full fixed top-0 bg-gray-400"
        :class="[{ 'w-full': !activeX },
                  { 'w-36': activeX },
                  { 'left-36full': !isLogin && activeX },
                  { 'right-0': !isLogin && !activeX },
                  { 'left-0': isLogin },
                  { 'animation-enable': animate }]"/>

    <!-- Background Dummy -->
    <div class="absolute bottom-0" 
        :class="[{ 'h-12': !activeY },
                  { 'h-full': activeY },
                  { 'pt-4': activeY && !loggedInState },
                  { 'animation-enable': animate },
                  { 'left-36full': !isLogin && activeX },
                  { 'right-0': !isLogin && !activeX },
                  { 'left-0': isLogin },
                  { 'w-full': !activeX }, 
                  { 'w-36': activeX }]" ref="bgDummy">
      <div class="flex flex-row bg-green-900 h-full"
        :class="[{ 'mx-8': !activeX && !activeY },
                  { 'rounded-t-large': !loggedInState },
                  { 'rounded-t-none': loggedInState }, 
                  { 'mx-4': (activeY || activeX) && !loggedInState },
                  { 'animation-enable': animate}]"/>
    </div>

    <!-- Signup Menu Activation -->
    <div class="absolute rounded-lg w-16 h-16 bottom-0 right-0 bg-green-700 m-8 p-3 border-b-6 hover:border-b-0 cursor-pointer border-green-900"
        ref="signupMenu" v-on:click="openSignupPage">
      <svg class="w-full h-full" viewBox="0 0 24 24">
          <path fill="#f6e05e" d="M15,14C12.33,14 7,15.33 7,18V20H23V18C23,15.33 17.67,14 15,14M6,10V7H4V10H1V12H4V15H6V12H9V10M15,12A4,4 0 0,0 19,8A4,4 0 0,0 15,4A4,4 0 0,0 11,8A4,4 0 0,0 15,12Z" />
      </svg>
    </div>

    <!-- Login Menu Activation -->
    <div class="absolute rounded-lg w-16 h-16 bottom-0 left-0 bg-green-700 m-8 p-3 border-b-6 hover:border-b-0 cursor-pointer border-green-900"
        ref="loginMenu" v-on:click="openLoginPage">
      <svg class="w-full h-full" viewBox="0 0 24 24">
        <path fill="#f6e05e" d="M19,21V19H15V17H19V15L22,18L19,21M10,4A4,4 0 0,1 14,8A4,4 0 0,1 10,12A4,4 0 0,1 6,8A4,4 0 0,1 10,4M10,14C11.15,14 12.25,14.12 13.24,14.34C12.46,15.35 12,16.62 12,18C12,18.7 12.12,19.37 12.34,20H2V18C2,15.79 5.58,14 10,14Z" />
      </svg>
    </div>

    <!-- Main Menu Button -->
    <div class="absolute bottom-0" 
        :class="[{ 'h-20': !activeY }, 
                  { 'h-full pt-8': activeY }, 
                  { 'animation-enable': animate},
                  { 'right-0': !isLogin && !activeX },
                  { 'left-36full': !isLogin && activeX },
                  { 'left-0': isLogin },
                  { 'w-full': !activeX },
                  { 'w-36': activeX }]" ref="mainMenu">
      <div class="h-16 shadow-xl flex flex-row bg-green-300 rounded-full" ref="mainMenu"
        :class="[{ 'mx-56': !activeX && !activeY }, 
                  { 'mx-8': activeY }, 
                  { 'mx-8': activeX }, 
                  { 'animation-enable': animate}]">
        <div :class="[{ 'mx-56 rounded-r-none': !activeX && !activeY },  
                      { 'mx-8': activeY }, 
                      { 'mx-8 rounded-r-full': activeX }, 
                      { 'animation-enable': animate }]"
            class="w-20 z-0 absolute left-0 bg-green-700 rounded-l-full h-16 cursor-pointer" v-on:click="travel('')">
          <img class="h-16 w-16 p-3 ml-2 select-none" src="/assets/daskom.svg" alt="daskom logo">
        </div>
        <div class="flex flex-row self-center mr-1 font-merri font-medium text-lg w-full"/>
      </div>
    </div>  
    
    <!-- Role Menu -->
    <div class="absolute left-0 flex-row h-24full w-36 mt-24"
        :class="[{ 'left-36full': !isLogin && activeX},
                  { 'right-0': !isLogin && !activeX},
                  { 'left-0': isLogin }, 
                  { 'animation-enable': animate}]" ref="roleMenu">
      <div class="flex absolute mx-4 py-8 h-1/2 w-2 animation-enable"
          :class="[{ 'top-0': isPraktikan }, 
                    { 'top-1/2': !isPraktikan },
                    { 'left-0': !isLogin },
                    { 'right-0 ': isLogin }, ]">
        <div class="bg-yellow-400 w-full h-full"
            :class="[{ 'rounded-l-full': isLogin },
                      { 'rounded-r-full': !isLogin }]"/>
      </div>
      <div class="flex w-full h-1/2">
        <div class="flex mx-auto h-full font-merri text-2xl text-yellow-400 font-medium" 
            style="transform: rotate(-90deg);
                    transform-origin: right left;" ref="menu1">
          <div class="m-auto select-none cursor-pointer hover:font-bold" 
                v-on:click="isPraktikan = true">Praktikan</div>
        </div>
      </div>
      <div class="flex w-full h-1/2">
        <div class="flex mx-auto h-full font-merri text-2xl text-yellow-400 font-medium" 
            style="transform: rotate(-90deg);
                    transform-origin: right left;" ref="menu2">
          <div class="m-auto select-none cursor-pointer hover:font-bold"
                v-on:click="isPraktikan = false">Asisten</div>
        </div>
      </div>
    </div> 
  </div>
</template>

<script>
export default {
  props: [
    'comingFrom',
    'all_kelas',
    'roles',
  ],
  data() {
    return {
      activeX: false,
      activeY: false,
      isPraktikan: true,
      animate: true,
      isLogin: true,
      loggedInState: false,

      errors: {},

      formPraktikan: {
        nama: '',
        nim: '',
        password: '',
        kelas_id: '',
        alamat: '',
        nomor_telepon: '',
        email: '',
      },
      
      formAsisten: {
        nama: '',
        kode: '',
        password: '',
        role_id: '',
        deskripsi: '',
      },

      formLoginAsisten: {
        kode: '',
        password: '',
      },

      formLoginPraktikan: {
        nim: '',
        password: '',
      },

      hostname: "http://localhost:3000"
    };
  },

  mounted() {
    
    $('body').addClass('closed');
    const globe = this;

    this.animate = false;
    this.$anime.set(this.$refs.roleMenu, {
      opacity: 0,
    })
    this.$anime.set(this.$refs.signupMenu, {
      translateY: 100,
    })
    this.$anime.set(this.$refs.loginMenu, {
      translateY: 100,
    })

    if(this.comingFrom === 'about' ||
        this.comingFrom === 'contact'){
      
      this.animate = false;
      this.activeY = true;
      setTimeout(
        function() {
          globe.animate = true;
          globe.activeX = true;
        }, 10);

    } else if(this.comingFrom === 'asisten' ||
              this.comingFrom === 'praktikan'){

      this.activeX = false;
      this.activeY = true;
      this.loggedInState = true;

      this.$anime.set(globe.$refs.mainMenu, {
        translateY: -100,
      })

      setTimeout(
        function() {
          globe.animate = true;
          globe.activeX = true;
          globe.loggedInState = false;

          globe
            .$anime
            .timeline({
              duration: 200
            })
            .add({
              targets: globe.$refs.mainMenu,
              translateY: 0,
              easing: 'easeInSine'
            })
        }, 10);

    } else {

      setTimeout(
        function() {
          globe.animate = true;
          globe.activeX = true;
        }, 10);

      setTimeout(
        function() {
          globe.activeY = true;
        }, 250);
    } 

    setTimeout(
      function() {
        
        globe
          .$anime
          .timeline({
            duration: 300
          })
          .add({
            targets: globe.$refs.signupMenu,
            translateY: [100,0],
            easing: 'easeInSine'
          })
          .add({
            targets: globe.$refs.roleMenu,
            opacity: [0,1],
            easing: 'easeInSine'
          }, '-=200');

        globe.$anime.set(globe.$refs.menu1, {
          rotate: '-90deg',
        })

        globe.$anime.set(globe.$refs.menu2, {
          rotate: '-90deg',
        })
      }, 1010);
  },
  
  methods: {

    loginAsisten: function() {

      const globe = this;

      this.$axios.post('/loginAsisten', this.formLoginAsisten).then(response => {
        
        if(response.data.message === "Login Failed"){
          globe.$toasted.global.showError({
            message: "Login gagal, kode atau password salah"
          });
        } else {
          //Login Success
          globe.startLoggedInAnim("asisten");
        }
      }).catch(function (error) {
        if (error.response) {
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          globe.errors = error.response.data.errors
        }
      });
    },

    loginPraktikan: function() {

      const globe = this;

      this.$axios.post('/loginPraktikan', this.formLoginPraktikan).then(response => {
        
        if(response.data.message === "Login Failed"){
          globe.$toasted.global.showError({
            message: "Login gagal, nim atau password salah"
          });
        } else {
          //Login Success
          globe.startLoggedInAnim("praktikan");
        }
      }).catch(function (error) {
        if (error.response) {
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          globe.errors = error.response.data.errors
        }
      });
    },

    signupAsisten: function(){

      const globe = this;

      this.$axios.post('/signupAsisten', this.formAsisten).then(response => {
        globe.$toasted.global.showSuccess({
          message: "Registrasi berhasil, silahkan login"
        });
        $("#signupAsistenForm")[0].reset();
        globe.openLoginPage();
      }).catch(function (error) {
        if (error.response) {
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          globe.errors = error.response.data.errors
        }
      });
    },

    signupPraktikan: function(){

      const globe = this;

      this.$axios.post('/signupPraktikan', this.formPraktikan).then(response => {
        globe.$toasted.global.showSuccess({
          message: "Registrasi berhasil, silahkan login"
        });
        $("#signupPraktikanForm")[0].reset();
        globe.openLoginPage();
      }).catch(function (error) {
        if (error.response) {
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          globe.errors = error.response.data.errors
        }
      });
    },

    startLoggedInAnim: function(whereTo) {
      const globe = this;
      this
        .$anime
        .timeline({
          duration: 200
        })
        .add({
          targets: globe.$refs.signupMenu,
          translateY: [0,100],
          easing: 'easeInSine',
          complete: function(anim){
            globe.animate = true;
            globe.activeX = false;
            globe.loggedInState = true;

            setTimeout(
              function() {
                globe.$inertia.replace('/'+whereTo, {
                  data: {
                    'comingFrom': 'login',
                  }
                })
              }, 1100);
          }
        })
        .add({
          targets: globe.$refs.roleMenu,
          opacity: [1,0],
          easing: 'easeInSine'
        }, '-=200')
        .add({
          targets: globe.$refs.mainMenu,
          translateY: -100,
          easing: 'easeInSine'
        })
    },
    
    openLoginPage: function(event){

      const globe = this;
      this
        .$anime
        .timeline({
          duration: 200
        })
        .add({
          targets: this.$refs.loginMenu,
          translateY: [0,100],
          easing: 'easeInSine',
          complete: function(anim){
            globe.animate = true;
            globe.isLogin = true;

            globe.$anime({
              duration: 200,
              targets: globe.$refs.signupMenu,
              translateY: [100,0],
              easing: 'easeInSine'
            })

            globe.$anime.set(globe.$refs.menu1, {
              rotate: '-90deg',
            })

            globe.$anime.set(globe.$refs.menu2, {
              rotate: '-90deg',
            })
          }
        })
    },
    
    openSignupPage: function(event){

      const globe = this;
      this
        .$anime
        .timeline({
          duration: 200
        })
        .add({
          targets: this.$refs.signupMenu,
          translateY: [0,100],
          easing: 'easeInSine',
          complete: function(anim){
            globe.animate = true;
            globe.isLogin = false;

            globe.$anime({
              duration: 200,
              targets: globe.$refs.loginMenu,
              translateY: [100,0],
              easing: 'easeInSine'
            })

            globe.$anime.set(globe.$refs.menu1, {
              rotate: '90deg',
            })

            globe.$anime.set(globe.$refs.menu2, {
              rotate: '90deg',
            })
          }
        })
    },

    travel: function(destination) {

      const roleMenu = this.$refs.roleMenu;
      const signupMenu = this.$refs.signupMenu;
      const loginMenu = this.$refs.loginMenu;
      const globe = this;
  
      this
        .$anime
        .timeline({
          duration: 200
        })
        .add({
          targets: this.isLogin ? signupMenu : loginMenu,
          translateY: [0,100],
          easing: 'easeInSine'
        })
        .add({
          targets: roleMenu,
          opacity: [1,0],
          easing: 'easeInSine',
          complete: function(anim) {
            setTimeout(
              function() {
                globe.animate = true;
                globe.activeY = false;
              }, 10);

            setTimeout(
              function() {
                globe.activeX = false;
              }, 250);

            setTimeout(
              function() {
                globe.$inertia.replace('/'+destination, {
                  preserveScroll: true,
                  data: {
                    'comingFrom': 'login',
                  }
                })
              }, 1010); 
          }
        });
    },
  }
}
</script>
