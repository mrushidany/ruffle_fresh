<template>
    <span v-on="$listeners" v-bind="$attrs">{{ tweenedNumber }}</span>
</template>

<script>
import {TweenLite} from 'gsap'
// import {mapState} from 'vuex'
// Returns the number of full stop in given string.
const countFullstops = (str) => str.replace(/[^.]/g, '').length

export default {
  name: 'number',
  props: {
    from: {
      type: [Number, String],
      default: 0
    },
    index:{
        type:Number
    },
    // to: {
    //   type: [Number, String],
    //   required: true,
    //   default: 0
    // },
    format: {
      type: Function,
      default: (num) => parseInt(num)
    },
    duration: {
      type: Number,
      default: 1 // Duration of animation in seconds
    },
    easing: {
      type: String,
      default: 'Power0.easeInOut'
    },
    delay: {
      type: Number,
      default: 0.1 // Delay the animation in seconds
    },
    animationPaused: {
      type:Boolean, default: true
    } // Stops animation before start
  },
  data() {
    return {
      fromProp: this.from,
    //   toProp:this.to
    }
  },
  computed: {
    // ...mapState({
    //     toProp: state => state.to[1],
    //     hasCompleted: state => state.hasCompleted
    // }),
    toProp(){
      return this.$store.state.toX
    },
    tweenedNumber () {
      return this.format(this.fromProp)
    }
  },
  methods: {
    tween (value) {
      const vm = this
      const tLite = TweenLite
        .to(vm.$data, vm.duration, {
          fromProp: value,
          paused: vm.animationPaused,
          ease: vm.easeCheck(),
          onStart: () => vm.$emit('start'),
          onComplete: () => vm.$emit('complete'),
          onUpdate: () => vm.$emit('update'),
          delay: vm.delay // In seconds
        })
      vm.tween.tLite = tLite
    },
    play () {
      this.tween.tLite.play()
    },
    pause () {
      this.tween.tLite.pause()
    },
    restart () {
      this.tween.tLite.restart()
    },
    easeCheck () {
      const vm = this
      if (countFullstops(vm.easing) !== 1) {
        throw new Error('Invalid ease type. (eg. easing="Power1.easeOut")')
      }
      return vm.easing
    }
  },
  watch: {
    toProp (newValue) {
      this.tween(newValue[this.index])
    }
  },
  mounted() {
    this.tween(this.toProp)
  }
}
</script>

<style>

</style>
