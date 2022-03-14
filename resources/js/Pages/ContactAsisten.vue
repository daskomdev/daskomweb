<template>
  <div class="main_container bg-green-900 w-full h-full overflow-y-scroll">

      <!-- Navbar -->
      <section class="py-1 px-5 bg-green-700 w-full fixed">
        <div class="py-3 px-2 flex justify-between items-center">
          <div>
            <span class="bg-yellow-600 text-yellow-200 font-overpass text-xl rounded-xl pt-3 pb-2 px-3 hover:bg-yellow-700 hover:text-yellow-100 hover:duration-300 duration-300">{{user.nim}}</span>
          </div>
          <div>
            <span class="font-overpass text-3xl text-yellow-400 rounded-lg hover:text-yellow-500 cursor-pointer duration-300 hover:duration-300 hover:scale-105"
            v-on:click='travel("praktikan")'>
            <img class="p-1 fas fa-home fa-lg"></span>
          </div>
        </div>
      </section>

      <!-- Assistant List -->
      <section class="pt-5 py-20 mt-18">
        <div class="flex justify-center flex-wrap">
          <div v-for="asisten in allAsisten" :key="asisten.id">
            <div class="flex justify-center flex-wrap">
              <div class="p-8 bg-yellow-500 flex text-yellow-900 rounded-xl w-96 h-full mx-8 mt-8">

                <div class="mr-2">
                  <img class="select-none w-36 lg:h-36 h-auto m-auto rounded-full bg-white object-cover border-green-900 border-4 cursor-pointer"
                  :src="'/assets/' + asisten.kode + '.jpg'"
                  @error="$event.target.src='assets/logo.png'">
                </div>

                <div class="ml-2 w-72 h-auto">
                  <div>
                    <span class="font-overpass text-2xl font-bold">{{asisten.kode}}</span>
                  </div>
                  <div class="border-b-2 border-yellow-800">
                    <span class="font-overpass text-md">{{asisten.nama}}</span>
                  </div>

                  <div class="flex pt-5">
                    <div class="mr-2">
                      <img class="fas fa-phone w-6 h-6">
                    </div>
                    <div class="text-lg">
                      <span v-if="asisten.nomor_telepon==NULL || asisten.nomor_telepon=='' ||asisten.nomor_telepon=='-'">Not Available</span>
                      <span v-if="asisten.nomor_telepon!='-'">{{asisten.nomor_telepon}}</span>
                    </div>
                  </div>

                  <div class="flex pt-1">
                    <div class="mr-2">
                      <img class="fab fa-line w-6 h-6">
                    </div>
                    <div class="text-lg">
                      <span v-if="asisten.id_line==NULL || asisten.id_line=='' ||asisten.id_line=='-'">Not Available</span>
                      <span v-if="asisten.id_line!='-'">{{asisten.id_line}}</span>
                    </div>
                  </div>

                  <div class="flex pt-1">
                    <div class="mr-2">
                      <img class="fab fa-instagram w-6 h-6">
                    </div>
                    <div class="text-lg">
                      <span v-if="asisten.instagram==NULL || asisten.instagram=='' ||asisten.instagram=='-'">Not Available</span>
                      <span v-if="asisten.instagram!='-'">{{asisten.instagram}}</span>
                    </div>
                  </div>

                </div>
              </div> 
            </div>
          </div>
        </div>
      </section>

  </div>
</template>

<script>
export default {
  props: [
    'allAsisten',
    'user',
  ],

  data() {
    return {
      //
    }
  },

  mounted() {

    $('body').addClass('closed');
    this.$refs.menu.scrollTop = this.position;

  },

  methods: {

    travel: function($whereTo){
      const globe = this;
      setTimeout(
        function() {
          globe.$inertia.replace('/' + $whereTo);
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
  }
}
</script>
