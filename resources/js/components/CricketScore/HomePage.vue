<template>
  <section class="col-6 m-auto">
    <sub-menu></sub-menu>
    <!-- <match-setup></match-setup>
    <teams-section></teams-section> -->
    <transition name="slide-fade">
      <router-view name="settings-section"></router-view>
      <router-view name="match-setup"></router-view>
      <router-view name="teams-section"></router-view>
      <router-view name="teams-member-section"></router-view>
      <router-view name="strike-batter"></router-view>
      <router-view name="non-strike-batter"></router-view>
      <router-view name="bowler-section"></router-view>
      <router-view name="score-sheet"></router-view>
      <router-view name="wicket-section"></router-view>
      <router-view name="new-batter"></router-view>
    </transition>
  </section>
</template>
<script>
import {bus} from '../../app';
    export default {
      props:['base_url'],
      mounted(){
        bus.$emit('base_url',this.base_url);
        bus.$on('base_url',(data)=>{
          // console.log(data);
        });
      },
    }
</script>
<style lang="css" scoped>
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(100px);
  opacity: 0;
}

</style>
