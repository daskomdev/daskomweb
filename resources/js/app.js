import Inertia from 'inertia-vue'
import Vue from 'vue'
import VueAnime from 'vue-animejs';
import Toasted from 'vue-toasted';
import Axios from 'axios';
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { faExclamationCircle, 
        faCheckCircle, 
        faUserEdit, 
        faSignOutAlt, 
        faCode, 
        faFileCode,
        faListAlt,
        faHistory,
        faChartArea,
        faEnvelopeOpen,
        faArrowCircleDown,
        faEnvelope,
        faWindowMaximize,
        faWindowClose,  
        faPaperPlane, 
        faPhone,
        faAddressCard,
        faAt,
        faChalkboardTeacher,
        faPlus,
        faTrash,
        faPen,
        faBook,
        faCaretDown,
        faCaretUp,
        faCheck,
        faTimes,
        faCaretLeft,
        faCaretRight,
        faCalendarAlt} from '@fortawesome/free-solid-svg-icons';
import { faLine,
        faInstagram } from '@fortawesome/free-brands-svg-icons';
import Vuebar from 'vuebar';
import StarRating from 'vue-star-rating';

library.add(faExclamationCircle);
library.add(faCheckCircle);
library.add(faUserEdit);
library.add(faSignOutAlt);
library.add(faCode);
library.add(faFileCode);
library.add(faListAlt);
library.add(faHistory);
library.add(faChartArea);
library.add(faEnvelopeOpen);
library.add(faArrowCircleDown);
library.add(faEnvelope);
library.add(faWindowClose);
library.add(faPaperPlane);
library.add(faAddressCard);
library.add(faWindowMaximize);
library.add(faLine);
library.add(faInstagram);
library.add(faPhone);
library.add(faAt);
library.add(faChalkboardTeacher);
library.add(faPlus);
library.add(faTrash);
library.add(faPen);
library.add(faBook);
library.add(faCaretDown);
library.add(faCaretUp);
library.add(faCheck);
library.add(faTimes);
library.add(faCaretLeft);
library.add(faCaretRight);
library.add(faCalendarAlt);
dom.watch(); 

Vue.use(VueAnime)
Vue.use(Inertia)
Vue.use(Toasted);
Vue.use(Vuebar);
Vue.component('star-rating', StarRating);

Vue.prototype.$axios = Axios
window.$ = window.jQuery = require('jquery')
const app = document.getElementById('app')
const files = require.context('./', true, /\.vue$/i)

Vue.toasted.register('showError',
    (payload) => {
        if(! payload.message) {
    	    return "Maaf, telah terjadi sesuatu<br>(Panggil FAI untuk dilihat lebih lanjut)"
        }
        return payload.message;
    },
    {
      type: "error",
      iconPack : 'fontawesome',
      icon: "exclamation-circle",
      theme: "outline", 
      position: "bottom-center",
      duration : 2000
    }
)

Vue.toasted.register('showSuccess',
    (payload) => {
        if(! payload.message) {
    	    return "Proses telah berhasil"
        }
        return payload.message;
    },
    {
      type: "success",
      iconPack : 'fontawesome',
      icon: "check-circle",
      theme: "outline", 
      position: "bottom-center",
      duration : 2000
    }
)

Vue.directive('scroll', {
  inserted: function (el, binding) {
    let f = function (evt) {
      if (binding.value(evt, el)) {
        window.removeEventListener('scroll', f)
      }
    }
    window.addEventListener('scroll', f)
  }
})

Vue.component('Timer',{
	template: `
  	<div>
      <div v-show ="statusType !== 'expired'">
        <div class="day">
          <span class="number">{{ days }}</span>
          <div class="format">{{ wordString.day }}</div>
        </div>
        <div class="hour">
          <span class="number">{{ hours }}</span>
          <div class="format">{{ wordString.hours }}</div>
        </div>
        <div class="min">
          <span class="number">{{ minutes }}</span>
          <div class="format">{{ wordString.minutes }}</div>
        </div>
        <div class="sec">
          <span class="number">{{ seconds }}</span>
          <div class="format">{{ wordString.seconds }}</div>
        </div>
      </div>
      <div class="message">{{ message }}</div>
      <div class="status-tag" :class="statusType">{{ statusText }}</div>
    </div>
  `,
  props: ['starttime','endtime','trans'] ,
  data: function(){
  	return{
    	timer:"",
      wordString: {},
      start: "",
      end: "",
      interval: "",
      days:"",
      minutes:"",
      hours:"",
      seconds:"",
      message:"",
      statusType:"",
      statusText: "",
    
    };
  },
  created: function () {
        this.wordString = JSON.parse(this.trans);
    },
  mounted(){
    this.start = new Date(this.starttime).getTime();
    this.end = new Date(this.endtime).getTime();
    // Update the count down every 1 second
    this.timerCount(this.start,this.end);
    this.interval = setInterval(() => {
        this.timerCount(this.start,this.end);
    }, 1000);
  },
  methods: {
    timerCount: function(start,end){
        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = start - now;
        var passTime =  end - now;

        if(distance < 0 && passTime < 0){
            this.message = this.wordString.expired;
            this.statusType = "expired";
            this.statusText = this.wordString.status.expired;
            clearInterval(this.interval);
            return;

        }else if(distance < 0 && passTime > 0){
            this.calcTime(passTime);
            this.message = this.wordString.running;
            this.statusType = "running";
            this.statusText = this.wordString.status.running;

        } else if( distance > 0 && passTime > 0 ){
            this.calcTime(distance); 
            this.message = this.wordString.upcoming;
            this.statusType = "upcoming";
            this.statusText = this.wordString.status.upcoming;
        }
    },
    calcTime: function(dist){
      // Time calculations for days, hours, minutes and seconds
        this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
        this.hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
        this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
    }
  }
});

new Vue({
  render: h => h(Inertia, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: page => files(`./Pages/${page}.vue`).default,
    },
  }),
}).$mount(app)