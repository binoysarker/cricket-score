<template>
  <section class="col-6 m-auto">
    <!-- navigation section -->
    <ul class="nav justify-content-center bg-change">
      <li class="nav-item mr-4 ml-2 " v-for="(item,index) in menuItems" :key="item.id">
        <router-link :to="item.routeLink" :class="[item.active ? 'nav-link '+ item.class : 'nav-link'] ">{{item.name}}</router-link>
      </li>
    </ul>
    <!-- /navigation section -->
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
      data(){
        return{
          menuItems:[
            {name:'Teams',class:'active',active:false,routeLink:'/teams'},
            {name:'Settings',class:'active',active:false,routeLink:'/settings'},
            {name:'Match Setup',class:'active',active:false,routeLink:'/match-setup'}
          ],
          teamName:'',
          elected:'',
          strikeBatterSelectedToBat:'',
          nonStrikeBatterSelectedToBat:'',
          bowlerSelectedTo:'',
          saveTeamNames:'',
        }
      },
      props:['base_url'],
      mounted(){
        bus.$emit('base_url',this.base_url);
        bus.$on('base_url',(data)=>{
          // console.log(data);
        });
      },
      watch:{
        '$route'(to,from){
          if (to.path == '/done' && from.path == '/match-setup/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB) {
            if (this.elected == 'bowl') {
              if (this.teamName == this.saveTeamNames.TeamA) {
                this.$router.push({path:'/bowler/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
              }else {
                this.$router.push({path:'/bowler/'+this.teamName+'&'+this.saveTeamNames.TeamA+'&'+this.elected});
              }
            }else if(this.elected == 'bat'){
              this.$router.push({path:'/strike-batter/'+this.teamName+'&'+this.elected});
            }
          }
          else if (to.path == '/done' && from.path == '/bowler/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected) {
            if (this.elected == 'bowl') {
              this.$router.push({path:'/strike-batter/'+this.saveTeamNames.TeamB+'&'+this.elected});
            }else if (this.elected == 'bat') {
              this.$router.push({path:'/score-sheet/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
            }
          }
          else if (to.path == '/done' && from.path == '/bowler/'+this.teamName+'&'+this.saveTeamNames.TeamA+'&'+this.elected) {
            if (this.elected == 'bowl') {
              this.$router.push({path:'/strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected});
            }else if (this.elected == 'bat') {
              this.$router.push({path:'/score-sheet/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
            }
          }
          else if (to.path == '/done' && from.path == '/strike-batter/'+this.teamName+'&'+this.elected) {
            if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bat') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamB+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else if (this.teamName != this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else {
              this.$router.push({path:'/non-strike-batter/'+this.teamName+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
          }
          else if (to.path == '/done' && from.path == '/strike-batter/'+this.saveTeamNames.TeamB+'&'+this.elected) {
            if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bat') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamB+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else {
              this.$router.push({path:'/non-strike-batter/'+this.teamName+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
          }
          else if (to.path == '/done' && from.path == '/strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected) {
            if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bat') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamB+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else if (this.teamName != this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamB+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
            else {
              this.$router.push({path:'/non-strike-batter/'+this.teamName+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
            }
          }
          else if (to.path == '/done' && from.path == '/non-strike-batter/'+this.teamName+'&'+this.elected+'&'+this.strikeBatterSelectedToBat) {
            if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bat') {
              this.$router.push({path:'/bowler/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
            }
            else if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/score-sheet/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
            }
            else if (this.teamName != this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/score-sheet/'+this.saveTeamNames.TeamB+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
            }
            else {
              this.$router.push({path:'/bowler/'+this.teamName+'&'+this.saveTeamNames.TeamA+'&'+this.elected});
            }
          }
          else if (to.path == '/done' && from.path == '/non-strike-batter/'+this.saveTeamNames.TeamB+'&'+this.elected+'&'+this.strikeBatterSelectedToBat) {
            if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bat') {
              this.$router.push({path:'/bowler/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
            }
            else if (this.teamName == this.saveTeamNames.TeamA && this.elected == 'bowl') {
              this.$router.push({path:'/score-sheet/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB+'&'+this.elected});
            }
            else {
              this.$router.push({path:'/bowler/'+this.teamName+'&'+this.saveTeamNames.TeamA+'&'+this.elected});
            }
          }

        }
      },
      
      created(){
        let defaultMenu = [
          {name:'Teams',class:'active',active:false,routeLink:'/teams'},
          {name:'Settings',class:'active',active:false,routeLink:'/settings'},
          {name:'Match Setup',class:'active',active:false,routeLink:'/match-setup'}
        ];
        let changeDefaultMenu = [
          {name:'Settings',class:'active',active:false,routeLink:'/settings'},
          {name:'Match Setup',class:'active',active:false,routeLink:'/match-setup'},
          {name:'Done',class:'active',active:false,routeLink:'/done'}
        ];
        bus.$on('goToStrikeBatter',(data)=>{
          // console.log(data);
          this.teamName = data.team;
          this.elected = data.elected;
        });
        bus.$on('saveTeamNames',(data)=>{
          // console.log(data);
          this.saveTeamNames = data;
        });
        bus.$on('strikeBatterSelectedToBat',(data)=>{
          // console.log(data);
          this.strikeBatterSelectedToBat = data;
        });
        bus.$on('nonStrikeBatterSelectedToBat',(data)=>{
          // console.log(data);
          this.nonStrikeBatterSelectedToBat = data;
        });
        bus.$on('bowlerSelectedTo',(data)=>{
          // console.log(data);
          this.bowlerSelectedTo = data;
        });
        bus.$on('resetMenu',(data)=>{
          // console.log(data);
          switch (data) {
            case 'settings':
            changeDefaultMenu = [];
            changeDefaultMenu.push(
              {name:'Teams',class:'active',active:false,routeLink:'/teams'},
              {name:'Settings',class:'active',active:false,routeLink:'/settings/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB},
              {name:'Match Setup',class:'active',active:false,routeLink:'/match-setup/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB}
            );
            this.menuItems = changeDefaultMenu;
            break;
            case 'teams':
            if (changeDefaultMenu) {
              changeDefaultMenu = [];
              changeDefaultMenu.push(
                {name:'Teams',class:'active',active:false,routeLink:'/teams'},
                {name:'Settings',class:'active',active:false,routeLink:'/settings'},
                {name:'Match Setup',class:'active',active:false,routeLink:'/match-setup'}
              );
            }else {
              this.menuItems = defaultMenu;
            }
            break;
            case '/team-member':
            defaultMenu = [];
            defaultMenu.push(
              {name:'Cancel',class:'active',active:false,routeLink:'/teams'},
              {name:'Select Team Member',class:'active',active:false,routeLink:'/teams/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB},
              {name:'Settings',class:'active',active:false,routeLink:'/settings/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB}
            );
            this.menuItems = defaultMenu;
            break;
            case '/match-setup':
            changeDefaultMenu = [];
            changeDefaultMenu.push(
              {name:'Settings',class:'active',active:false,routeLink:'/settings/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB},
              {name:'Match Setup',class:'active',active:false,routeLink:'/match-setup/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB},
              {name:'Done',class:'active',active:false,routeLink:'/done'}
            );
            this.menuItems = changeDefaultMenu;
            break;
            case '/strike-batter':
            changeDefaultMenu = [];
            changeDefaultMenu.push({name:'Select Strike Batter',class:'active',active:false,routeLink:'/strike-batter/'+this.$route.params.teamName+'&'+this.$route.params.elected},
            {name:'Done',class:'active',active:false,routeLink:'/done'});
            this.menuItems = changeDefaultMenu;
            break;
            case '/non-strike-batter':
            changeDefaultMenu = [];
            changeDefaultMenu.push({name:'Select non-strike Batter',class:'active',active:false,routeLink:'/non-strike-batter'},
            {name:'Done',class:'active',active:false,routeLink:'/done'});
            this.menuItems = changeDefaultMenu;
            break;
            case '/bowler':
            changeDefaultMenu = [];
            changeDefaultMenu.push({name:'Select Bowler',class:'active',active:false,routeLink:'/bowler/'+this.teamName+'&'+this.saveTeamNames.TeamA+'&'+this.elected},
            {name:'Done',class:'active',active:false,routeLink:'/done'});
            this.menuItems = changeDefaultMenu;
            break;
            case '/score-sheet':
            changeDefaultMenu = [];
            changeDefaultMenu.push({name:'ScoreSheet',class:'active',active:false,routeLink:'/score-sheet'},
            {name:'Exit',class:'active',active:false,routeLink:'/teams'});
            this.menuItems = changeDefaultMenu;
            break;
            case 'wicket':
            changeDefaultMenu = [];
            changeDefaultMenu.push(
              {name:'Cancel',class:'active',active:false,routeLink:'/score-sheet'},
              {name:'Wicket',class:'active',active:false,routeLink:'/wicket'},
              {name:'Done',class:'active',active:false,routeLink:'/done'}
            );
            this.menuItems = changeDefaultMenu;
            break;
            case '/new-batter':
            changeDefaultMenu = [];
            changeDefaultMenu.push(
              {name:'Cancel',class:'active',active:false,routeLink:'/score-sheet'},
              {name:'Select New Batter',class:'active',active:false,routeLink:'/new-batter'},
              {name:'Done',class:'active',active:false,routeLink:'/done'}
            );
            this.menuItems = changeDefaultMenu;
            break;

            default:
            this.menuItems = defaultMenu;
          }

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
.bg-change{
  background-color: #235594;
}
.nav{
  font-weight: bold;
  font-size: 15px;
}
.nav-link{
  color: white;
}
.nav-link:hover{
  color: black;
}
.active{
  color: white;
  font-weight: bold;
}
.router-link-active{
  font-size: 18px;
  font-weight: bold;
}
</style>
