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
        faTimes} from '@fortawesome/free-solid-svg-icons';
import { faLine,
        faInstagram } from '@fortawesome/free-brands-svg-icons';
import Vuebar from 'vuebar';
import StarRating from 'vue-star-rating'

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

new Vue({
  render: h => h(Inertia, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: page => files(`./Pages/${page}.vue`).default,
    },
  }),
}).$mount(app)