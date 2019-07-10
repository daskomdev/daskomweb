<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">

    <!-- Main Layout -->
    <div class="absolute bottom-0 flex h-48full w-4full rounded-tl-large bg-yellow-500 animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-minFull': !pageActive }]">

    </div>

    <!-- Main Menu -->
    <div class="absolute w-120 h-48full bottom-0 flex-row overflow-y-auto animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-min20rem': !pageActive }]" @mouseover="isMenuShown = false">
      <div class="w-full p-4 h-24 flex select-none bg-yellow-500 text-white">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-address-card">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          Profil
        </span>
      </div>

      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-600 hover:text-white animation-enable">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-code">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          Praktikum
        </span>
      </div>

      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-600 hover:text-white animation-enable">
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
      <div v-if="currentUser.role_id == 2">

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

    <!-- Message Layout -->
    <div class="absolute left-0 h-full w-120full flex" @mouseover="isMenuShown = false">

      <!-- Dummy Message Animation -->
      <div class="absolute top-0 left-0 w-full pr-16 animation-enable"
          :class="[{ 'h-48full': isMessageShown },
                  { 'h-16': !isMessageShown },
                  { 'top-0': pageActive },
                  { 'top-minFull': !pageActive }]">
        <div class="w-full h-full flex rounded-br-large bg-green-600">
          <div class="w-11/12 h-full"/>
          <div class="w-1/12 h-10 mt-auto mb-3 z-10 cursor-pointer" v-on:click="isMessageShown = !isMessageShown">
            <div class="animation-enable" 
                :class="[{ 'unrotated ml-0': !isMessageShown }, { 'rotated ml-8': isMessageShown }]">
              <span class="animation-enable" 
                  :class="[{ 'text-white': !isMessageShown }, { 'text-black': isMessageShown }]">
                <img class="w-full h-10 ml-2 fas fa-arrow-circle-down">
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Message Menu -->
      <div class="absolute top-0 left-0 w-full pointer-events-none animation-enable"
          :class="[{ 'h-48full pr-16': isMessageShown },
                  { 'h-16 pr-32': !isMessageShown },
                  { 'top-0': pageActive },
                  { 'top-minFull': !pageActive }]">
        <div class="bg-green-300 border-green-600 w-full h-full flex animation-enable"
          :class="[{ 'rounded-br-large border-r-4 border-b-4': isMessageShown },
                  { 'rounded-0 border-r-0 border-b-0': !isMessageShown },]">
          <span v-if="newMessage > 0" class="m-auto">Ada {{ newMessage }} pesan baru</span>
          <span v-else class="m-auto font-monda-bold text-2xl tracking-wide">Tidak ada pesan baru</span>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  .rotated {
    transform: rotate(180deg);
  }

  .unrotated {
    transform: rotate(0deg);
  }
</style>

<script>
export default {
  props: [
    'comingFrom',
    'currentUser',
    'messages',
    'userRole',
  ],

  data() {
    return {
      pageActive: false,
      isMenuShown: false,
      newMessage: "",
      isMessageShown: false,
    }
  },

  mounted() {

    $('body').addClass('closed');

    const globe = this;
    if(this.comingFrom == 'login'){

      setTimeout(
        function() {
          globe.pageActive = true;
        }, 10); 
    }
  },

  methods: {

    signOut: function(){

      const globe = this;
      this.pageActive = false;
      setTimeout(
        function() {
          globe.$inertia.replace('/logoutAsisten')
        }, 1010); 
    }
  }
}
</script>
