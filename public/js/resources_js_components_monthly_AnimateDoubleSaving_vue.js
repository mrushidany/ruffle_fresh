"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_monthly_AnimateDoubleSaving_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Counter-animate.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Counter-animate.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/gsap-core.js");
//
//
//
//
 // import {mapState} from 'vuex'
// Returns the number of full stop in given string.

var countFullstops = function countFullstops(str) {
  return str.replace(/[^.]/g, '').length;
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'number',
  props: {
    from: {
      type: [Number, String],
      "default": 0
    },
    index: {
      type: Number
    },
    // to: {
    //   type: [Number, String],
    //   required: true,
    //   default: 0
    // },
    format: {
      type: Function,
      "default": function _default(num) {
        return parseInt(num);
      }
    },
    duration: {
      type: Number,
      "default": 1 // Duration of animation in seconds

    },
    easing: {
      type: String,
      "default": 'Power0.easeInOut'
    },
    delay: {
      type: Number,
      "default": 0.1 // Delay the animation in seconds

    },
    animationPaused: {
      type: Boolean,
      "default": true
    } // Stops animation before start

  },
  data: function data() {
    return {
      fromProp: this.from //   toProp:this.to

    };
  },
  computed: {
    // ...mapState({
    //     toProp: state => state.to[1],
    //     hasCompleted: state => state.hasCompleted
    // }),
    toProp: function toProp() {
      return this.$store.state.toX;
    },
    tweenedNumber: function tweenedNumber() {
      return this.format(this.fromProp);
    }
  },
  methods: {
    tween: function tween(value) {
      var vm = this;
      var tLite = gsap__WEBPACK_IMPORTED_MODULE_0__.TweenLite.to(vm.$data, vm.duration, {
        fromProp: value,
        paused: vm.animationPaused,
        ease: vm.easeCheck(),
        onStart: function onStart() {
          return vm.$emit('start');
        },
        onComplete: function onComplete() {
          return vm.$emit('complete');
        },
        onUpdate: function onUpdate() {
          return vm.$emit('update');
        },
        delay: vm.delay // In seconds

      });
      vm.tween.tLite = tLite;
    },
    play: function play() {
      this.tween.tLite.play();
    },
    pause: function pause() {
      this.tween.tLite.pause();
    },
    restart: function restart() {
      this.tween.tLite.restart();
    },
    easeCheck: function easeCheck() {
      var vm = this;

      if (countFullstops(vm.easing) !== 1) {
        throw new Error('Invalid ease type. (eg. easing="Power1.easeOut")');
      }

      return vm.easing;
    }
  },
  watch: {
    toProp: function toProp(newValue) {
      this.tween(newValue[this.index]);
    }
  },
  mounted: function mounted() {
    this.tween(this.toProp);
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Counter_animate_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Counter-animate.vue */ "./resources/js/components/Counter-animate.vue");
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

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    CounterAnimate: _Counter_animate_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  mounted: function mounted() {
    this.drawType = localStorage.getItem('currentDrawTypeName');
    this.drawTypeId = localStorage.getItem('currentDrawTypeId'); // this.init()
  },
  data: function data() {
    return {
      drawType: '',
      slots: 10,
      times: 0,
      lastSlotCounter: 0,
      begin: true,
      winner: '',
      isGrandWinner: false,
      winnerCategoryImage: '../assets/',
      drawWinnerCount: 0,
      account_number: '',
      phone_number: '',
      winner_name: '',
      winnerCategory: {},
      isloading: false,
      winnerAnimate: [],
      completedAnimations: [],
      winners: [],
      hasCompletedDraw: false,
      categories: [],
      completedCategories: [],
      drawTypeId: 0,
      setGrandWinner: false,
      subDrawType: 4,
      done: false
    };
  },
  computed: {
    icon: function icon() {
      return this.winnerCategoryImage + this.winnerCategory.image;
    }
  },
  methods: {
    toArray: function toArray(phone) {
      var _this = this;

      var array = phone.split("");
      this.winnerAnimate = array;
      array.forEach(function (i) {
        return _this.completedAnimations.push(false);
      });
    },
    start: function start() {
      this.isGrandWinner = false;
      this.isloading = true;
      this.completedAnimations = [];
      this.begin = true;
      this.times = 0;

      for (var index = 1; index <= this.slots; index++) {
        var data = {
          index: index - 1,
          value: 9
        };
        this.completedAnimations.push(false);
        this.$store.commit('setToX', data);
        this.$refs['n' + index][0].play();
      }
    },
    replay: function replay() {
      for (var index = 1; index <= this.slots; index++) {
        this.$refs['n' + index][0].restart();
      }
    },
    pause: function pause() {
      for (var index = 1; index <= this.slots; index++) {
        this.$refs['n' + index][0].pause();
      }
    },
    completedAnimation: function completedAnimation(slot) {
      var _this2 = this;

      if (this.winnerAnimate.length != this.slots) {
        this.replay();
        return;
      }

      if (slot == this.slots) {
        this.lastSlotCounter++;
      }

      if (!this.completedAnimations[slot - 1]) {
        this.$refs['n' + slot][0].restart();
        var data = {
          index: slot - 1,
          value: this.winnerAnimate[slot - 1]
        };
        this.$store.commit('setToX', data);
      }

      setTimeout(function () {
        _this2.completedAnimations[slot - 1] = true;

        if (slot === _this2.slots && _this2.completedAnimations[slot - 1]) {
          _this2.times++;

          if (_this2.begin && _this2.times == 2) {
            _this2.lastSlotCounter = 0;

            try {
              _this2.isloading = false;

              _this2.openModal();
            } catch (error) {
              console.log(error);
            }

            _this2.begin = false;
          }
        }
      }, 3000);
    },
    ///added
    init: function init() {
      var _this3 = this;

      this.axios.get('draw/winners').then(function (response) {
        if (response.status == 200) {
          _this3.categories = [];
          _this3.winners = [];
          var data = response.data['winners'];
          var cats = response.data['categories'];
          var comps = response.data['completedCategories'];
          _this3.drawWinnerCount = response.data['totalWinners'];

          if (_this3.drawTypeId == 3) {
            _this3.drawWinnerCount = 1;
          }

          data.forEach(function (winner) {
            console.log(w);
            var w = {
              id: winner.id,
              name: winner.participant.name,
              phone: winner.phone_number,
              category_name: _this3.drawTypeId == 3 ? 'Grand Prize' : winner.category.name,
              category_id: winner.category.id,
              drawType: winner.draw.draw_type.name
            };

            _this3.winners.push(w);
          });
          cats.forEach(function (cat) {
            var c = {
              id: cat.id,
              name: cat.name
            };

            _this3.categories.push(c);
          });
          comps.forEach(function (comp) {
            _this3.completedCategories.push(comp);
          });
        }
      })["catch"](function (error) {
        console.log(error);

        if (error.response.status == 404) {
          _this3.$swal({
            position: 'top-center',
            icon: 'info',
            title: 'No active draw',
            showConfirmButton: false,
            timer: 2000
          });

          _this3.$router.push({
            name: 'draw-select'
          });
        }
      })["finally"](function () {
        _this3.isloading = false;
        _this3.winners.length == _this3.drawWinnerCount ? _this3.hasCompletedDraw = true : _this3.hasCompletedDraw = false;
      });
    },
    spin: function spin() {
      var _this4 = this;

      this.start();
      var body = {
        draw_type_id: localStorage.getItem('currentDrawTypeId'),
        draw_id: 4,
        sub_draw_type: localStorage.getItem('currentSubDrawTypeId')
      };
      this.axios.post('spin', body).then(function (response) {
        if (response.status == 200) {
          var data = response.data['winners'];
          data.filter(function (value, index) {
            _this4.toArray(value.phone_number);
          });
          _this4.winners = response.data['winners'];
        } else if (response.status == 201) {
          _this4.pause();

          _this4.$swal({
            position: 'top-center',
            icon: 'info',
            title: response.data['message'],
            showConfirmButton: true,
            timer: 5000
          });

          _this4.isloading = true;
          _this4.hasCompletedDraw = true;
        } else if (response.status == 202) {
          _this4.pause();

          _this4.$swal({
            position: 'top-center',
            icon: 'info',
            title: response.data['message'],
            showConfirmButton: false,
            timer: 2000
          });
        } else if (response.status == 203) {
          _this4.pause();

          _this4.$swal({
            position: 'top-center',
            icon: 'info',
            title: response.data['message'],
            showConfirmButton: false,
            timer: 2000
          });
        }
      })["catch"](function (error) {
        console.log(error);

        _this4.replay();
      });
    },
    exportAndCompleteDraw: function exportAndCompleteDraw() {
      this.exportWinners();
      this.completeDraw();
    },
    completeDraw: function completeDraw() {
      var _this5 = this;

      var drawId = localStorage.getItem('currentDrawId');
      this.axios.post('draw/complete/' + drawId).then(function (response) {
        _this5.$router.push({
          name: 'draw-select'
        });
      })["catch"](function (error) {
        console.log(error);
      })["finally"](function () {
        _this5.isloading = false;

        if (drawId === 3) {
          _this5.setGrandWinner = true;
          _this5.isGrandWinner = true;
        }
      });
    },
    complete: function complete() {
      $('#winnerModal').modal('toggle');
      this.isloading = false;
      this.hasCompletedDraw = false;
      this.done = true;
    },
    exportWinners: function exportWinners() {
      var _this6 = this;

      var drawId = localStorage.getItem('currentDrawId');
      var today = new Date();
      var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
      this.axios.get('export/winner/' + drawId, {
        responseType: 'arraybuffer'
      }).then(function (response) {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');
        fileLink.href = fileURL;
        fileLink.setAttribute('download', localStorage.currentDrawTypeName + '-' + date + '.xlsx');
        document.body.appendChild(fileLink);
        fileLink.click();
      })["catch"](function (error) {
        console.log(error);
      })["finally"](function () {
        _this6.isloading = false;
      });
    },
    openModal: function openModal() {
      $('#winnerModal').modal({
        backdrop: 'static',
        keyboard: false
      });
    },
    closeModal: function closeModal() {
      $('#winnerModal').modal('toggle');
      this.init();
    },
    discardAndContinue: function discardAndContinue() {
      var _this7 = this;

      if (this.drawTypeId == 3) {
        this.isloading = true;
        var body = {
          account_number: this.account_number,
          activeDraw: 3
        };
        this.axios.post('grand_winner/disqualify', body).then(function (response) {
          console.log(response);

          if (response.status == 200) {
            _this7.$swal({
              position: 'top-center',
              icon: 'success',
              title: _this7.winner_name + '( ' + _this7.account_number + ' )' + ' has been disqualified'
            });

            _this7.closeModal();
          }
        })["catch"](function (error) {
          console.log(error);
        })["finally"](function () {
          _this7.isloading = false;
          _this7.setGrandWinner = false;
        });
      }

      this.isloading = true;
      var body = {
        account_number: this.account_number,
        activeDraw: localStorage.getItem('currentDrawId')
      };
      this.axios.post('winner/disqualify', body).then(function (response) {
        console.log(response);

        if (response.status == 200) {
          _this7.$swal({
            position: 'top-center',
            icon: 'success',
            title: _this7.winner_name + '( ' + _this7.account_number + ' )' + ' has been disqualified'
          });

          _this7.closeModal();
        }
      })["catch"](function (error) {
        console.log(error);
      })["finally"](function () {
        _this7.isloading = false;
      });
    },
    saveWinner: function saveWinner(phone) {
      var _this8 = this;

      this.isloading = true;
      var body = {
        account_number: phone,
        activeDraw: localStorage.getItem('currentDrawId'),
        drawTypeId: this.drawTypeId,
        winnerCategory: localStorage.getItem('currentDrawId')
      };
      console.log(body.winnerCategory);
      console.log(this.winnerCategory.id);
      this.axios.post('winner/store', body).then(function (response) {
        console.log(response);

        if (response.status == 200) {
          _this8.done = true;
        }
      })["catch"](function (error) {
        console.log(error);
      })["finally"](function () {
        _this8.isloading = false;
        _this8.setGrandWinner = true;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.number-container[data-v-0d1a52e2]{\n    display: flex !important;\n    flex-direction: row !important;\n    flex-wrap: nowrap !important;\n    justify-content: space-evenly;\n    margin-bottom: 30px;\n}\n.winner[data-v-0d1a52e2] {\n    color: black;\n    font-size: 48px;\n    font-weight: 700;\n    line-height: 40px;\n}\n.number[data-v-0d1a52e2]{\n    padding: 0px 12px;\n    /* margin: 0px 10px; */\n    font-size: 32px;\n    font-weight: 500;\n    color: black;\n\n    /* margin-left: auto;\n    margin-right: auto; */\n\n    border: 1px solid #3DB4E6;\n    border-radius: 9px;\n}\n.spin-button-container[data-v-0d1a52e2]{\n    margin-top: 50px;\n}\n.none[data-v-0d1a52e2] {\n    display: none;\n}\n.spin-button[data-v-0d1a52e2]{\n    padding: 10px 10px;\n    font-weight: 500;\n    width:300px;\n\n    display: block;\n    margin-left: auto;\n    margin-right: auto;\n\n    background: linear-gradient(95.04deg, #3DB0E6 38.99%, #17A0D9 100%);\n    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.04), 0px 0px 2px rgba(0, 0, 0, 0.06), 0px 0px 1px rgba(0, 0, 0, 0.04);\n    border-radius: 9px;\n\n    color: white;\n    font-size: 16px;\n    font-weight: 700;\n}\n.btn-complete[data-v-0d1a52e2]{\n    background: linear-gradient(95.04deg, #e6513d 38.99%, #d94417 100%);\n    color: white;\n}\n.list-container[data-v-0d1a52e2]{\n    margin: 10px 20px;\n    padding: 20px 20px;\n    text-align: left;\n}\n.list-item[data-v-0d1a52e2]{\n    font-size:40px;\n    font-weight: bolder;\n    color: rgb(100, 97, 97);\n}\n.export-button[data-v-0d1a52e2]{\n    position: absolute;\n    right: 16px;\n    min-width: 130px;\n    height: 40px;\n\n    background: linear-gradient(95.04deg, #3DB0E6 38.99%, #17A0D9 100%);\n    color: white;\n}\n.table-header[data-v-0d1a52e2]{\n    background: linear-gradient(95.04deg, #3DB0E6 38.99%, #17A0D9 100%);\n    color: white;\n}\n.category[data-v-0d1a52e2]{\n    height: 58px;\n    width: 125px;\n\n    background: #FCFCFC;\n    color: black;\n    border: 1px solid #979797;\n    border-radius: 9px;\n\n    line-height: 58px;\n    text-align: center;\n    margin: 5px 5px;\n}\n.category[data-v-0d1a52e2]:hover{\n    cursor: pointer;\n}\n.selected_category[data-v-0d1a52e2]{\n    background: #B6B8B9;\n    color: white;\n    border: 1px solid #B6B8B9;\n    box-sizing: border-box;\n    border-radius: 9px;\n}\n.jackpot-modal-content[data-v-0d1a52e2]{\n    padding: 50px;\n    text-align: center;\n}\n.jackpot-modal-content .title[data-v-0d1a52e2]{\n    color: #2F2B2A;\n    font-size: 32px;\n    font-weight: 700;\n    line-height: 24px;\n}\n.jackpot-modal-content .winner-number[data-v-0d1a52e2]{\n    color: #3DB0E6;\n    font-size: 48px;\n    font-weight: 700;\n    line-height: 40px;\n}\n.jackpot-modal-content .winner-category[data-v-0d1a52e2]{\n    color: #706D6C;\n    font-size: 32px;\n    font-weight: 500;\n    line-height: 24px;\n}\n.prizes-counter[data-v-0d1a52e2] {\n    background: #32CD30;\n    color: white;\n    border-radius: 3px;\n    border: none;\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_style_index_0_id_0d1a52e2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css& */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_style_index_0_id_0d1a52e2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_style_index_0_id_0d1a52e2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/components/Counter-animate.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/Counter-animate.vue ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Counter_animate_vue_vue_type_template_id_33139716___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Counter-animate.vue?vue&type=template&id=33139716& */ "./resources/js/components/Counter-animate.vue?vue&type=template&id=33139716&");
/* harmony import */ var _Counter_animate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Counter-animate.vue?vue&type=script&lang=js& */ "./resources/js/components/Counter-animate.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Counter_animate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Counter_animate_vue_vue_type_template_id_33139716___WEBPACK_IMPORTED_MODULE_0__.render,
  _Counter_animate_vue_vue_type_template_id_33139716___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Counter-animate.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/monthly/AnimateDoubleSaving.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/components/monthly/AnimateDoubleSaving.vue ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _AnimateDoubleSaving_vue_vue_type_template_id_0d1a52e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true& */ "./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true&");
/* harmony import */ var _AnimateDoubleSaving_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AnimateDoubleSaving.vue?vue&type=script&lang=js& */ "./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=script&lang=js&");
/* harmony import */ var _AnimateDoubleSaving_vue_vue_type_style_index_0_id_0d1a52e2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css& */ "./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _AnimateDoubleSaving_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AnimateDoubleSaving_vue_vue_type_template_id_0d1a52e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _AnimateDoubleSaving_vue_vue_type_template_id_0d1a52e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "0d1a52e2",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/monthly/AnimateDoubleSaving.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/Counter-animate.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/Counter-animate.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Counter_animate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Counter-animate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Counter-animate.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Counter_animate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./AnimateDoubleSaving.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css&":
/*!**************************************************************************************************************************!*\
  !*** ./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css& ***!
  \**************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_style_index_0_id_0d1a52e2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=style&index=0&id=0d1a52e2&scoped=true&lang=css&");


/***/ }),

/***/ "./resources/js/components/Counter-animate.vue?vue&type=template&id=33139716&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/Counter-animate.vue?vue&type=template&id=33139716& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Counter_animate_vue_vue_type_template_id_33139716___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Counter_animate_vue_vue_type_template_id_33139716___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Counter_animate_vue_vue_type_template_id_33139716___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Counter-animate.vue?vue&type=template&id=33139716& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Counter-animate.vue?vue&type=template&id=33139716&");


/***/ }),

/***/ "./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true& ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_template_id_0d1a52e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_template_id_0d1a52e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AnimateDoubleSaving_vue_vue_type_template_id_0d1a52e2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Counter-animate.vue?vue&type=template&id=33139716&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Counter-animate.vue?vue&type=template&id=33139716& ***!
  \***************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "span",
    _vm._g(_vm._b({}, "span", _vm.$attrs, false), _vm.$listeners),
    [_vm._v(_vm._s(_vm.tweenedNumber))]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/monthly/AnimateDoubleSaving.vue?vue&type=template&id=0d1a52e2&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticStyle: { "row padding": "80px" } }, [
    _c("div", { staticClass: "col-md-6 offset-3 text-center" }, [
      _c(
        "h5",
        {
          staticStyle: {
            color: "black",
            "font-weight": "bold",
            padding: "12px 0px",
            "font-size": "32px"
          }
        },
        [_vm._v("NCBA JACKPOT - " + _vm._s(_vm.drawType))]
      )
    ]),
    _vm._v(" "),
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "col-md-6 offset-3 text-center" }, [
      _c(
        "div",
        { staticClass: "number-container" },
        _vm._l(_vm.slots, function(slot, index) {
          return _c(
            "div",
            { key: slot },
            [
              _c("counter-animate", {
                ref: "n" + slot,
                refInFor: true,
                staticClass: "number",
                attrs: { index: index },
                on: {
                  complete: function($event) {
                    return _vm.completedAnimation(slot)
                  }
                }
              })
            ],
            1
          )
        }),
        0
      ),
      _vm._v(" "),
      !_vm.isloading && !_vm.hasCompletedDraw && !_vm.done
        ? _c(
            "button",
            {
              staticClass: "btn spin-button mt-5",
              class: { none: _vm.isloading && _vm.hasCompletedDraw },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  return _vm.spin()
                }
              }
            },
            [_vm._v("Spin")]
          )
        : _vm._e(),
      _vm._v(" "),
      _vm.isloading && !_vm.hasCompletedDraw
        ? _c("p", [_vm._v("finding the lucky winner...")])
        : _vm._e(),
      _vm._v(" "),
      _vm.done
        ? _c(
            "button",
            {
              staticClass: "btn spin-button btn-complete",
              on: {
                click: function($event) {
                  return _vm.exportAndCompleteDraw()
                }
              }
            },
            [_vm._v("Export and Complete Draw")]
          )
        : _vm._e()
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "col-md-8 offset-2 mt-5" }, [
      _c("table", { staticClass: "table table-striped table-sm" }, [
        _vm._m(1),
        _vm._v(" "),
        _vm.done
          ? _c(
              "tbody",
              _vm._l(_vm.winners, function(winner, index) {
                return _c("tr", { key: index, staticClass: "slist-item" }, [
                  _c("td", [_vm._v(_vm._s(index + 1))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(winner.phone_number))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(winner.name))]),
                  _vm._v(" "),
                  _c("td", [_vm._v("Double Saving")])
                ])
              }),
              0
            )
          : _vm._e()
      ])
    ]),
    _vm._v(" "),
    !_vm.hasCompletedDraw
      ? _c("div", [
          _c(
            "div",
            {
              staticClass: "modal fade",
              attrs: {
                id: "winnerModal",
                tabindex: "-1",
                role: "dialog",
                "aria-labelledby": "winnerModalTitle",
                "aria-hidden": "true"
              }
            },
            [
              _c(
                "div",
                {
                  staticClass: "modal-dialog modal-dialog-centered",
                  attrs: { role: "document" }
                },
                [
                  _c("div", { staticClass: "modal-content" }, [
                    _c(
                      "div",
                      { staticClass: "modal-body jackpot-modal-content" },
                      [
                        _c("p", { staticClass: "title" }, [
                          _vm._v("Double Saving")
                        ]),
                        _vm._v(" "),
                        _c("img", {
                          staticStyle: {
                            height: "190px",
                            width: "auto",
                            "object-fit": "contain"
                          },
                          attrs: { src: "../images/double_savings.png" }
                        }),
                        _vm._v(" "),
                        _c("p", { staticClass: "winner" }, [
                          _vm._v("200 - winners !")
                        ]),
                        _vm._v(" "),
                        !_vm.isloading
                          ? _c("div", { staticClass: "row" }, [
                              _c(
                                "div",
                                { staticClass: "col-md-6 offset-md-3" },
                                [
                                  _c(
                                    "button",
                                    {
                                      staticClass: "btn btn-primary mt-5",
                                      attrs: { type: "button" },
                                      on: {
                                        click: function($event) {
                                          return _vm.complete()
                                        }
                                      }
                                    },
                                    [_vm._v("Complete")]
                                  )
                                ]
                              )
                            ])
                          : _vm._e(),
                        _vm._v(" "),
                        _vm.isloading
                          ? _c("p", [_vm._v("please wait...")])
                          : _vm._e()
                      ]
                    )
                  ])
                ]
              )
            ]
          )
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-6 offset-3 my-4" }, [
      _c("div", { staticClass: "row justify-content-start" }, [
        _c("div", { staticClass: "col-md-3 offset-1 category" }, [
          _c("p", { staticClass: "name" }, [_vm._v("Double Saving")])
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", { staticClass: "table-header" }, [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("S/N")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Winner")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Name")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Awards")])
      ])
    ])
  }
]
render._withStripped = true



/***/ })

}]);