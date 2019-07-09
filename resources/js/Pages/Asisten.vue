<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">

    <!-- Main Menu -->
    <div class="absolute rounded-tl-large w-120 h-36full bottom-0 flex-row overflow-y-auto animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-min20rem': !pageActive }]">
      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-500">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-code">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          Praktikum
        </span>
      </div>

      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-500">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-file-code">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          Soal
        </span>
      </div>

      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-500">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-list-alt">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          List TP
        </span>
      </div>

      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-500">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-history">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          History
        </span>
      </div>

      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-500">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-chart-area">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          Polling
        </span>
      </div>

      <div class="w-full p-4 h-24 flex select-none cursor-pointer bg-yellow-400 hover:bg-yellow-500">
        <div class="w-7/12 my-2 flex">
          <div class="w-4/6"/>
          <img class="select-none m-auto w-2/6 h-auto fas fa-envelope-open">
        </div>
        <span class="ml-6 font-merri-bold font-medium w-full text-start self-center text-xl">
          Pesan
        </span>
      </div>
      <div v-if="currentUser.role_id == 2">

      </div>
    </div>

    <!-- Profile Menu -->
    <div class="w-72 bg-gray-200 absolute top-0 mr-6 mt-3 h-40 rounded-lg flex-row animation-enable"
        :class="[{ 'hidden': !isMenuShown },
                { 'visible': isMenuShown },
                { 'right-min20rem': !pageActive },
                { 'right-0': pageActive }]" @mouseover="isMenuShown = true" @mouseleave="isMenuShown = false">
        <div class="w-full h-3/4"/>
        <div class="w-full h-1/4 flex">
          <div class="rounded-bl-lg bg-gray-400 flex hover:bg-gray-500 w-1/2min h-full cursor-pointer">
            <img class="select-none p-3 h-full w-auto m-auto fas fa-user-edit">
          </div>
          <div class="w-1 h-full bg-gray-500"/>
          <div class="rounded-br-lg bg-gray-400 flex hover:bg-gray-500 w-1/2min h-full cursor-pointer" v-on:click="signOut">
            <img class="select-none p-3 h-full w-auto m-auto fas fa-sign-out-alt">
          </div>
        </div>
    </div>

    <!-- Assistant's Profile -->
    <div class="absolute top-0 w-120 h-36 flex animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-min20rem': !pageActive }]" @mouseover="isMenuShown = true" @mouseleave="isMenuShown = false">
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

    <!-- Main Layout -->
    <div class="absolute left-0 h-full w-120full flex">

      <!-- Main Profile -->
      <div class="w-full h-full text-center animation-enable"
          :class="[{ 'opacity-100': pageActive },
                  { 'opacity-0': !pageActive }]">
        <div class="mt-6"/>
        <span class="font-monda-bold text-6xl tracking-normal leading-tight">
          {{ currentUser.nama }}
        </span>
        <div class="w-full px-12 my-4">
          <div class="w-full h-1 bg-gray-100"/>
        </div>
        <div class="w-full px-12 text-left font-overpass font-medium text-3xl">
          {{ currentUser.deskripsi }}
        </div>
      </div>

      <!-- Gaji Layout -->
      <div class="w-full h-16 animation-enable absolute flex"
          :class="[{ 'bottom-0': pageActive },
                  { 'bottom-min20rem': !pageActive }]">
        <div class="w-3/4 h-full rounded-t-large m-auto bg-gray-200">
          <!-- TODO: put all the gaji algorithm here -->
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
    'userRole'
  ],

  data() {
    return {
      pageActive: false,
      isMenuShown: false,
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
