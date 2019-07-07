import Inertia from 'inertia-vue'
import Vue from 'vue'
import VueAnime from 'vue-animejs';
import Toasted from 'vue-toasted';
import Axios from 'axios';

Vue.use(VueAnime)
Vue.use(Inertia)
Vue.use(Toasted)

Vue.prototype.$axios = Axios
window.$ = window.jQuery = require('jquery')
const app = document.getElementById('app')

Vue.toasted.register('showError',
    (payload) => {
        if(! payload.message) {
    	    return "Maaf, telah terjadi sesuatu<br>(Panggil <b>FAI</b> untuk dilihat lebih lanjut)"
        }
        return payload.message;
    },
    {
      type: "error",
      icon: "warning",
      theme: "outline", 
      position: "bottom-center",
      singleton: true,
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
      icon: "done",
      theme: "outline", 
      position: "bottom-center",
      singleton: true,
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
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
    },
  })
}).$mount(app)