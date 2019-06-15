(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/About.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/About.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      hover: false,
      active: false,
      scrolled: false
    };
  },
  mounted: function mounted() {
    this.active = true;
    $('.daskom-text').each(function () {
      $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='daskom-text-letter inline-block'>$&</span>"));
    });
    this.$anime.set('.daskom-text-letter', {
      opacity: 0
    });
  },
  methods: {
    travel: function travel(destination) {
      this.$inertia.replace('/' + destination, {
        data: {
          'comingFrom': 'about'
        }
      });
    },
    handleScroll: function handleScroll(evt, el) {
      window.scrollY > 5 ? this.scrolled = true : this.scrolled = false;
    },
    openDaskom: function openDaskom(event) {
      if (!this.hover) {
        this.hover = true;
        this.$anime.timeline({
          duration: 200
        }).add({
          targets: '.daskom-text-letter',
          scale: [0.3, 1],
          opacity: [0, 1],
          easing: "easeOutExpo",
          delay: function delay(el, i) {
            return 70 * (i + 1);
          }
        });
      }
    },
    closeDaskom: function closeDaskom(event) {
      var text = this.$refs.daskomText;

      if (this.hover) {
        this.hover = false;
        this.$anime.timeline({
          duration: 200
        }).add({
          targets: '.daskom-text-letter',
          scale: [1, 0.3],
          opacity: [1, 0],
          easing: "easeOutExpo",
          delay: function delay(el, i, l) {
            return 70 * (l - (i + 1));
          }
        });
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/About.vue?vue&type=template&id=169e1534&":
/*!***************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/About.vue?vue&type=template&id=169e1534& ***!
  \***************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      directives: [
        {
          name: "scroll",
          rawName: "v-scroll",
          value: _vm.handleScroll,
          expression: "handleScroll"
        }
      ],
      staticClass: "main_container w-full h-full overflow-hidden"
    },
    [
      _c(
        "div",
        {
          ref: "bgDummy",
          staticClass: "fixed bottom-0 w-full animation-enable",
          class: [
            { "h-12": !_vm.active },
            { "h-full pt-4": _vm.active && !_vm.scrolled },
            { "h-full pt-0": _vm.active && _vm.scrolled }
          ]
        },
        [
          _c("div", {
            staticClass: "flex flex-row bg-green-900 h-full animation-enable",
            class: [
              { "mx-8 rounded-t-large": !_vm.active },
              { "mx-4 rounded-t-large": _vm.active && !_vm.scrolled },
              { "mx-0 rounded-t-none": _vm.active && _vm.scrolled }
            ]
          })
        ]
      ),
      _vm._v(" "),
      _vm._m(0),
      _vm._v(" "),
      _c(
        "div",
        {
          ref: "mainMenu",
          staticClass: "fixed w-full bottom-0 animation-enable",
          class: [
            { "h-20": !_vm.active },
            { "h-full pt-8": _vm.active && !_vm.scrolled },
            { "h-full pt-0": _vm.active && _vm.scrolled }
          ]
        },
        [
          _c(
            "div",
            {
              staticClass:
                "h-16 shadow-xl flex flex-row bg-green-300 animation-enable",
              class: [
                { "mx-56 rounded-full": !_vm.active },
                { "mx-8 rounded-full": _vm.active && !_vm.scrolled },
                { "mx-0 rounded-none": _vm.active && _vm.scrolled }
              ]
            },
            [
              _c(
                "div",
                {
                  staticClass:
                    "z-0 absolute left-0 bg-green-700 h-16 cursor-pointer animation-enable",
                  class: [
                    { "w-56": _vm.hover },
                    { "w-20": !_vm.hover },
                    { "mx-56 rounded-l-full": !_vm.active },
                    { "mx-8 rounded-l-full": _vm.active && !_vm.scrolled },
                    { "mx-0 rounded-l-none": _vm.active && _vm.scrolled }
                  ],
                  on: {
                    mouseover: _vm.openDaskom,
                    mouseleave: _vm.closeDaskom,
                    click: function($event) {
                      return _vm.travel("")
                    }
                  }
                },
                [
                  _c("img", {
                    staticClass: "h-16 w-16 p-3 ml-2 select-none",
                    attrs: { src: "/assets/daskom.svg", alt: "daskom logo" }
                  }),
                  _vm._v(" "),
                  _c(
                    "span",
                    {
                      staticClass:
                        "flex absolute top-0 mt-3 ml-18 daskom-text font-monda-bold text-green-300 text-3xl select-none"
                    },
                    [_vm._v("Daskom")]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass:
                    "flex flex-row self-center w-full mr-1 font-merri font-medium text-lg"
                },
                [
                  _c("div", { staticClass: "flex-1" }),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      staticClass:
                        "chosen flex m-3 self-center cursor-pointer select-none"
                    },
                    [_vm._v("About")]
                  ),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      staticClass:
                        "flex m-3 self-center cursor-pointer select-none",
                      on: {
                        click: function($event) {
                          return _vm.travel("contact")
                        }
                      }
                    },
                    [_vm._v("Contact")]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "flex m-3 bg-green-700 text-white rounded-full py-2 px-4 cursor-pointer select-none",
                      on: {
                        click: function($event) {
                          return _vm.travel("login")
                        }
                      }
                    },
                    [_vm._v("Login")]
                  )
                ]
              )
            ]
          )
        ]
      )
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "absolute flex top-0 main-content w-full h-full pt-24 px-8"
      },
      [
        _c("div", { staticClass: "w-full h-full m-5" }, [
          _vm._v(
            "\n         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et quam pellentesque, vehicula velit porta, scelerisque purus. Donec tempor ultrices facilisis. In commodo auctor lectus vitae finibus. Aliquam fermentum nisl quis iaculis ultrices. Maecenas sagittis nibh id molestie aliquet. Vestibulum et semper metus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur euismod ex sit amet urna iaculis, aliquam lobortis nisi posuere. Nunc auctor porta tortor. Mauris ante mauris, vulputate et egestas sit amet, fringilla id dui.\n\nPellentesque varius sem sit amet metus consectetur, blandit euismod nunc mollis. Nulla viverra egestas tortor. Donec volutpat auctor orci. Aliquam maximus venenatis leo, sed vestibulum magna aliquam at. Mauris velit nunc, congue eget augue ac, porta finibus odio. Quisque fringilla eget lectus a scelerisque. Sed nec mi nec elit blandit finibus ut vel felis. Maecenas a maximus leo, pulvinar venenatis risus. In hac habitasse platea dictumst. Donec iaculis pharetra leo, vel pulvinar lacus mattis ut. Mauris facilisis nunc odio, in pulvinar justo eleifend porta. Sed quis fringilla orci, ut malesuada est. Sed vestibulum nibh nec suscipit commodo.\n\nCurabitur eget convallis orci, ac elementum quam. Pellentesque rhoncus cursus odio, non elementum nisl viverra eget. Mauris mattis rhoncus lacinia. Mauris scelerisque ligula ac orci condimentum cursus. Ut nulla arcu, sollicitudin ac posuere sed, volutpat id sem. Vivamus at urna mi. Proin feugiat, diam in fermentum semper, leo odio dignissim felis, ac interdum justo diam et justo. Nulla varius augue non eros blandit congue. Vivamus erat massa, consequat pellentesque faucibus eget, blandit quis eros. Nunc dictum faucibus neque ut aliquet. Vestibulum interdum rhoncus aliquam. \n      "
          )
        ])
      ]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/Pages/About.vue":
/*!**************************************!*\
  !*** ./resources/js/Pages/About.vue ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _About_vue_vue_type_template_id_169e1534___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./About.vue?vue&type=template&id=169e1534& */ "./resources/js/Pages/About.vue?vue&type=template&id=169e1534&");
/* harmony import */ var _About_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./About.vue?vue&type=script&lang=js& */ "./resources/js/Pages/About.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _About_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _About_vue_vue_type_template_id_169e1534___WEBPACK_IMPORTED_MODULE_0__["render"],
  _About_vue_vue_type_template_id_169e1534___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Pages/About.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Pages/About.vue?vue&type=script&lang=js&":
/*!***************************************************************!*\
  !*** ./resources/js/Pages/About.vue?vue&type=script&lang=js& ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_About_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./About.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/About.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_About_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Pages/About.vue?vue&type=template&id=169e1534&":
/*!*********************************************************************!*\
  !*** ./resources/js/Pages/About.vue?vue&type=template&id=169e1534& ***!
  \*********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_About_vue_vue_type_template_id_169e1534___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./About.vue?vue&type=template&id=169e1534& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/About.vue?vue&type=template&id=169e1534&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_About_vue_vue_type_template_id_169e1534___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_About_vue_vue_type_template_id_169e1534___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);