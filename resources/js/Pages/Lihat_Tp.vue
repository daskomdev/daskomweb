<template>
  <div class="main_container w-full h-full overflow-hidden">

    <div class="w-full h-12 sm:flex flex-row bg-green-600 shadow-xl"
        :class="[{ 'hidden sm:hidden': !tpDataShown },
                  { 'visible sm:visible': tpDataShown }]">
      <div class="sm:w-1/2 w-auto sm:h-auto h-1/2 m-auto text-lg text-yellow-500 font-overpass-bold flex">
        <span class="m-auto">{{ praktikanNim != '' ? praktikanNim : "none" }}</span>
      </div>
      <div class="sm:w-1/2 w-auto sm:h-auto h-1/2 m-auto text-lg text-yellow-500 font-overpass-bold flex">
        <span class="m-auto truncate">{{ chosenModulID != '' ? allModul[chosenModulID-1].judul : "none" }}</span>
      </div>
    </div>

    <div class="w-full h-full"
        :class="[{ 'hidden': !tpDataShown },
                  { 'visible': tpDataShown }]">
      <div class="w-full h-full" v-bar>
        <div>
          <div class="w-full h-auto flex-row">
            <div v-for="(jawaban, index) in allTpData" v-bind:key="jawaban.id" 
                class="w-full flex-row h-auto">
              <div class="w-full h-auto flex my-10">
                <div class="h-full w-12 flex font-merri-bold text-sm sm:text-xl">
                  <div class="m-auto w-auto h-auto">{{ index +1 }}</div>
                </div>
                <div class="h-12 px-1 w-4">
                  <div class="h-full w-full bg-gray-900"/>
                </div>
                <div class="h-full w-16full break-words whitespace-pre-wrap flex px-2 font-monda text-lg sm:text-2xl">
                  <span>{{ jawaban.soal }}</span>
                </div>
              </div>
              <div class="w-full h-auto flex px-5">
                <textarea v-model="allTpData[index].jawaban" cols="30" rows="10"
                      class="font-overpass-mono-bold resize-none text-lg sm:text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                      type="text" disabled/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="w-full h-full py-4 flex"
        :class="[{ 'visible': !tpDataShown },
                  { 'hidden': tpDataShown }]">
      <div class="w-72 h-72 m-auto">
        <div class="w-full h-full flex-row">
          <div class="w-full py-2 px-5 h-1/4 flex-row">
            <span class="font-merri w-full text-left text-yellow-600 text-lg h-1/4">
              NIM
            </span>
            <div class="w-full h-3/4">
              <input v-model="praktikanNim"
                    class="font-overpass-mono-bold text-xl bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full h-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" 
                    id="Kelas" type="text" placeholder="101022130600">
            </div>
          </div>
          <div class="w-full h-1/4 flex-row py-2 px-5">
            <span class="font-merri w-full text-left text-yellow-600 text-lg h-1/4">
              Pilihan modul
            </span>
            <select v-model="chosenModulID"
                  class="block font-monda-bold text-xl appearance-none w-full h-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-teal-500">
              <option v-for="modul in allModul" v-bind:key="modul.id" :value="modul.id">
                {{ modul.judul }}
              </option>
            </select>
          </div>
          <div class="w-full h-1/4 mt-8 p-2 hover:p-3 cursor-pointer animation-enable-short flex"
              v-on:click="cekTpPraktikan()">
            <div class="w-full h-full bg-green-600 rounded-lg flex">
              <div class="w-auto h-auto m-auto font-monda-bold text-white text-2xl">
                <span>CEK TP</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: [
    'currentUser',
    'allModul',
  ],

  data() {
    return {
      allTpData: [],

      tpDataShown: false,

      praktikanNim: '',
      chosenModulID: '',
    };
  },

  methods: {
    cekTpPraktikan: function(){

      const globe = this;

      if(this.praktikanNim === '') {
        globe.$toasted.global.showError({
          message: "Isikan nim nya terlebih dahulu"
        });
        return;
      }

      if(this.chosenModulID === ''){
        globe.$toasted.global.showError({
          message: "Pilih modul nya terlebih dahulu"
        });
        return;
      }

      globe.$axios.post('/api/getTp/'+this.praktikanNim+'/'+this.chosenModulID).then(response => {

        if(response.data.message === "success") {
          
          globe.tpDataShown = true;
          globe.allTpData = response.data.all_tp;

        } else {
          globe.$toasted.global.showError({
            message: response.data.message
          });
        }
      });
    },
  }
}
</script> 