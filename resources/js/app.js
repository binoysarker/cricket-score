
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// vue js toggle button
import ToggleButton from 'vue-js-toggle-button';

// vue router section

import VueRouter from 'vue-router';

Vue.use(VueRouter);
Vue.use(ToggleButton);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('navbar-section', require('./components/CricketScore/partials/Navbar.vue'));
Vue.component('sub-menu', require('./components/CricketScore/partials/SubNav.vue'));
Vue.component('home-page', require('./components/CricketScore/HomePage.vue'));
const MatchSetup = Vue.component('match-setup', require('./components/CricketScore/MatchSetup.vue'));
const SettingsSection = Vue.component('settings-section', require('./components/CricketScore/SettingsSection.vue'));
const TeamsSection = Vue.component('teams-section', require('./components/CricketScore/TeamsSection.vue'));
const StrikeBatter = Vue.component('strike-batter', require('./components/CricketScore/StrikeBatter.vue'));
const NonStrikeBatter = Vue.component('non-Strike-batter', require('./components/CricketScore/NonStrikeBatter.vue'));
const Bowler = Vue.component('bowler-section', require('./components/CricketScore/Bowler.vue'));
const ScoreSheet = Vue.component('bowler-section', require('./components/CricketScore/ScoreSheet.vue'));
const Wicket = Vue.component('bowler-section', require('./components/CricketScore/Wicket.vue'));
const NewBatter = Vue.component('bowler-section', require('./components/CricketScore/NewBatter.vue'));

// router section
const routes = [
  { path: '/teams', components:{'teams-section': TeamsSection} },
  { path: '/settings', components:{'settings-section': SettingsSection} },
  { path: '/match-setup', components:{'match-setup': MatchSetup} },
  { path: '/strike-batter', components:{'strike-batter': StrikeBatter} },
  { path: '/non-strike-batter', components:{'non-strike-batter': NonStrikeBatter} },
  { path: '/bowler', components:{'bowler-section': Bowler} },
  { path: '/score-sheet', components:{'score-sheet': ScoreSheet} },
  { path: '/wicket', components:{'wicket-section': Wicket} },
  { path: '/new-batter', components:{'new-batter': NewBatter} },
];
const router = new VueRouter({
  routes // short for `routes: routes`
});

// bus section
export const bus = new Vue();

const app = new Vue({
    el: '#app',
    router
});
