<template>
  <div class="main_container bg-green-900 w-full h-full overflow-hidden">

    <!-- Main Layout -->
    <div class="absolute my-auto h-full w-24full flex animation-enable"
        :class="[{ 'right-0': pageActive },
                { 'right-minFull': !pageActive }]" @mouseover="isMenuShown = false">
      <div class="rounded-l-large my-auto h-36full w-full bg-yellow-200">

      </div>
    </div>

    <!-- Main Menu -->
    <div class="absolute w-24full right-0 h-16 flex animation-enable"
        :class="[{ 'bottom-0': pageActive },
                { 'bottom-min4rem': !pageActive }]">
      <div class="m-auto h-full w-3/5 flex">

        <!-- Dummy For Animation -->
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <!------------------------->

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
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <div class="h-full animation-enable"
            :class="[{ 'w-1/11': !isPraktikum && !isNilai && !isTP },
                    { 'w-0': isPraktikum || isNilai || isTP }]"/>
        <!------------------------->

      </div>
    </div>

    <!-- Profile Menu -->
    <div class="absolute top-0 right-0 z-10 w-24full h-24 flex"
        :class="[{ 'visible': isMenuShown && pageActive },
                { 'hidden': !isMenuShown }]" @mouseleave="isMenuShown = false">
      <div class="m-auto h-full w-56 flex-row bg-gray-600 mt-2 rounded-lg">
        <div class="w-full h-2/3"/>
        <div class="w-full h-1/3 flex">
          <div class="rounded-bl-lg bg-gray-400 flex hover:bg-gray-500 w-1/2min h-full cursor-pointer">
            <img class="select-none p-2 h-full w-auto m-auto fas fa-user-edit">
          </div>
          <div class="w-1 h-full bg-gray-500"/>
          <div class="rounded-br-lg bg-gray-400 flex hover:bg-gray-500 w-1/2min h-full cursor-pointer" v-on:click="signOut">
            <img class="select-none p-2 h-full w-auto m-auto fas fa-sign-out-alt">
          </div>
        </div>
      </div>
    </div>

    <!-- Profile Layout -->
    <div class="absolute right-0 w-24full h-16 flex animation-enable"
        :class="[{ 'top-0': pageActive },
                { 'top-min4rem': !pageActive }]">
      <div class="m-auto h-12 mt-4 w-48 flex items-center font-monda-bold text-lg text-white">
        <span class="m-auto flex items-center z-10" @mouseover="isMenuShown = true">
          {{ currentUser.nim }}
          <div class="w-4"/>
          <img class="select-none w-8 h-8 fas fa-arrow-circle-down" style="color: white;">
        </span>
      </div>
    </div>

    <!-- Message Layout -->
    <div class="absolute z-10 bottom-0 w-full h-full bg-black animation-enable pointer-events-none"
        :class="[{ 'opacity-75': messageOpened },
                { 'opacity-0': !messageOpened }]"/>
    <div class="absolute z-10 w-full h-36 bg-gray-500 rounded-b-lg animation-enable"
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
    <span class="messageIcon z-20 absolute top-0 mt-6 ml-6 w-12 h-12 cursor-pointer animation-enable"
        :class="[{ 'left-min20rem': !pageActive || messageOpened },
                { 'left-0': pageActive && !messageOpened }]"
        v-on:click="messageOpened = true">
      <img class="iconGreenHover w-full h-full fas fa-envelope">
    </span>

    <!-- Message Menu (CLOSE) -->
    <span class="messageIcon z-20 absolute left-0 mt-20 ml-5 w-12 h-12 p-0 hover:p-12 cursor-pointer animation-enable"
        :class="[{ 'top-0': messageOpened },
                { 'top-min20rem': !messageOpened }]"
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
  ],

  data() {
    return {
      pageActive: false,
      isPraktikum: false,
      isTP: false,
      isNilai: false,
      isMenuShown: false,
      messageOpened: false,

      formMessageError: [],

      formMessage: {
        kode: '',
        pesan: '',
        nama_praktikan: this.currentUser.nama,
        kelas_id: this.currentUser.kelas_id,
      },
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

    openMessageMenu: function(){
      
    },

    showPraktikum: function(){
      this.isPraktikum = true;
      this.isTP = false;
      this.isNilai = false;
      $('.tpIcon , .nilaiIcon').removeClass('w-3/12');
      $('.tpIcon , .nilaiIcon').removeClass('youngYellowIcon');
      $('.tpIcon , .nilaiIcon').addClass('iconYellowHover');
      $('.tpIcon , .nilaiIcon').addClass('w-full');
      
      $('.praktikumIcon').removeClass('w-full');
      $('.praktikumIcon').removeClass('iconYellowHover');
      $('.praktikumIcon').addClass('youngYellowIcon');
      $('.praktikumIcon').addClass('w-3/12');
    },

    showNilai: function(){
      this.isPraktikum = false;
      this.isTP = false;
      this.isNilai = true;
      $('.praktikumIcon , .tpIcon').removeClass('w-3/12');
      $('.praktikumIcon , .tpIcon').removeClass('youngYellowIcon');
      $('.praktikumIcon , .tpIcon').addClass('iconYellowHover');
      $('.praktikumIcon , .tpIcon').addClass('w-full');
      
      $('.nilaiIcon').removeClass('w-full');
      $('.nilaiIcon').removeClass('iconYellowHover');
      $('.nilaiIcon').addClass('youngYellowIcon');
      $('.nilaiIcon').addClass('w-3/12');
    },

    showTP: function(){
      this.isPraktikum = false;
      this.isTP = true;
      this.isNilai = false;
      $('.praktikumIcon , .nilaiIcon').removeClass('w-3/12');
      $('.praktikumIcon , .nilaiIcon').removeClass('youngYellowIcon');
      $('.praktikumIcon , .nilaiIcon').addClass('iconYellowHover');
      $('.praktikumIcon , .nilaiIcon').addClass('w-full');
      
      $('.tpIcon').removeClass('iconYellowHover');
      $('.tpIcon').removeClass('w-full');
      $('.tpIcon').addClass('youngYellowIcon');
      $('.tpIcon').addClass('w-3/12');
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
        
        if(response.data.message == "success") {

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
          globe.formMessageError = error.response.data.errors
        }
      });
    }
  }
}
</script>
