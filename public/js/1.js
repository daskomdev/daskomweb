(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/Contact.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/Contact.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************/
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
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['comingFrom'],
  data: function data() {
    return {
      hover: false,
      active: false,
      scrolled: false,
      animated: false,
      animationEnable: true
    };
  },
  mounted: function mounted() {
    $('body').addClass('closed');
    $('.daskom-text').each(function () {
      $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='daskom-text-letter inline-block'>$&</span>"));
    });
    this.$anime.set('.daskom-text-letter', {
      opacity: 0
    });
    var globe = this;

    if (this.comingFrom == 'about' || this.comingFrom == 'login') {
      this.animationEnable = false;
      this.active = true;
      this.animated = true;
      setTimeout(function () {
        globe.animationEnable = true;
      }, 100);
    } else {
      this.active = true;
      setTimeout(function () {
        globe.animated = true;
      }, 1000);
    }
  },
  methods: {
    travel: function travel(destination) {
      this.$inertia.replace('/' + destination, {
        data: {
          'comingFrom': 'contact'
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/Contact.vue?vue&type=template&id=2c2b26f2&":
/*!*****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/Contact.vue?vue&type=template&id=2c2b26f2& ***!
  \*****************************************************************************************************************************************************************************************************/
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
          staticClass: "fixed bottom-0 w-full",
          class: [
            { "h-12": !_vm.active },
            { "h-full pt-4": _vm.active && !_vm.scrolled },
            { "h-full pt-0": _vm.active && _vm.scrolled },
            { "animation-enable": _vm.animationEnable }
          ]
        },
        [
          _c("div", {
            staticClass: "flex flex-row bg-green-900 h-full",
            class: [
              { "mx-8 rounded-t-large": !_vm.active },
              { "mx-4 rounded-t-large": _vm.active && !_vm.scrolled },
              { "mx-0 rounded-t-none": _vm.active && _vm.scrolled },
              { "animation-enable": _vm.animationEnable }
            ]
          })
        ]
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "absolute top-0 main-content w-full h-full pt-24 z-10",
          class: [
            { "px-8": !_vm.scrolled },
            { "px-0": _vm.scrolled },
            { "animation-enable": _vm.animationEnable }
          ]
        },
        [_vm._v("\n      WORK IN PROGRESS\n  ")]
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          ref: "mainMenu",
          staticClass: "fixed w-full z-20",
          class: [
            { "bottom-0 h-20": !_vm.active },
            {
              "bottom-0 h-full pt-8":
                _vm.active && !_vm.scrolled && !_vm.animated
            },
            {
              "bottom-0 h-full pt-0":
                _vm.active && _vm.scrolled && !_vm.animated
            },
            {
              "top-0 h-auto pt-8": _vm.active && !_vm.scrolled && _vm.animated
            },
            { "top-0 h-auto pt-0": _vm.active && _vm.scrolled && _vm.animated },
            { "animation-enable": _vm.animationEnable }
          ]
        },
        [
          _c(
            "div",
            {
              staticClass: "h-16 shadow-xl flex flex-row bg-green-300",
              class: [
                { "mx-56 rounded-full": !_vm.active },
                { "mx-8 rounded-full": _vm.active && !_vm.scrolled },
                { "mx-0 rounded-none": _vm.active && _vm.scrolled },
                { "animation-enable": _vm.animationEnable }
              ]
            },
            [
              _c(
                "div",
                {
                  staticClass:
                    "z-0 absolute left-0 bg-green-700 h-16 cursor-pointer",
                  class: [
                    { "w-56": _vm.hover },
                    { "w-20": !_vm.hover },
                    { "mx-56 rounded-l-full": !_vm.active },
                    { "mx-8 rounded-l-full": _vm.active && !_vm.scrolled },
                    { "mx-0 rounded-l-none": _vm.active && _vm.scrolled },
                    { "animation-enable": _vm.animationEnable }
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
                        "dynamic flex m-3 self-center cursor-pointer select-none",
                      on: {
                        click: function($event) {
                          return _vm.travel("about")
                        }
                      }
                    },
                    [_vm._v("About")]
                  ),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      staticClass:
                        "chosen flex m-3 self-center cursor-pointer select-none"
                    },
                    [_vm._v("Contact")]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "button flex m-3 bg-green-700 text-white rounded-full py-2 px-4 cursor-pointer select-none",
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
var staticRenderFns = []
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

/***/ "./resources/js/Pages/Contact.vue":
/*!****************************************!*\
  !*** ./resources/js/Pages/Contact.vue ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Contact_vue_vue_type_template_id_2c2b26f2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Contact.vue?vue&type=template&id=2c2b26f2& */ "./resources/js/Pages/Contact.vue?vue&type=template&id=2c2b26f2&");
/* harmony import */ var _Contact_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Contact.vue?vue&type=script&lang=js& */ "./resources/js/Pages/Contact.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Contact_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Contact_vue_vue_type_template_id_2c2b26f2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Contact_vue_vue_type_template_id_2c2b26f2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Pages/Contact.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Pages/Contact.vue?vue&type=script&lang=js&":
/*!*****************************************************************!*\
  !*** ./resources/js/Pages/Contact.vue?vue&type=script&lang=js& ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Contact_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Contact.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/Contact.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Contact_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Pages/Contact.vue?vue&type=template&id=2c2b26f2&":
/*!***********************************************************************!*\
  !*** ./resources/js/Pages/Contact.vue?vue&type=template&id=2c2b26f2& ***!
  \***********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Contact_vue_vue_type_template_id_2c2b26f2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Contact.vue?vue&type=template&id=2c2b26f2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/Contact.vue?vue&type=template&id=2c2b26f2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Contact_vue_vue_type_template_id_2c2b26f2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Contact_vue_vue_type_template_id_2c2b26f2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);