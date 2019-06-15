import Inertia from 'inertia-vue'
import Vue from 'vue'
import VueAnime from 'vue-animejs';

Vue.use(VueAnime)
Vue.use(Inertia)

window.$ = window.jQuery = require('jquery')
const app = document.getElementById('app')

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