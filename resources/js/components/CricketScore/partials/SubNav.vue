<template>
  <ul class="nav justify-content-center bg-change">
    <li class="nav-item mr-4 ml-2 " v-for="(item,index) in menuItems" :key="item.id">
      <router-link :to="item.routeLink" :class="[item.active ? 'nav-link '+ item.class : 'nav-link'] ">{{item.name}}</router-link>
    </li>
  </ul>
</template>
<script>
import {bus} from '../../../app';
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
  watch:{
    '$route'(to,from){
      // console.log(to.path);
      // console.log(from.path);
      if (to.path == '/teams' && from.path == '/') {
        this.$router.push('/teams');
      }
      // if (to.path == '/team-member' && from.path == '/teams') {
      //   this.$router.push({path:'/team-member'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB,props:true});
      // }
      else if (to.path == '/done' && from.path == '/match-setup/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamB) {
        if (this.elected == 'bowl') {
          // here saveTeamNames dose not change but i make second item to be First
          this.$router.push({path:'/bowler/'+this.teamName+'&'+this.saveTeamNames.TeamA+'&'+this.elected});
        }else if(this.elected == 'bat'){
          this.$router.push({path:'/strike-batter/'+this.teamName+'&'+this.elected});
        }
      }
      else if (to.path == '/done' && from.path == '/strike-batter/'+this.teamName == this.saveTeamNames.TeamA ? this.saveTeamNames.TeamA : this.saveTeamNames.TeamB+'&'+this.elected) {
        this.$router.push({path:'/non-strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected+'&'+this.strikeBatterSelectedToBat});
      }
      else if (to.path == '/done' && from.path == '/non-strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected+'&'+this.strikeBatterSelectedToBat) {
        if (this.elected == 'bowl') {
          this.$router.push({path:'/score-sheet'});
        }
        else if (this.elected == 'bat') {
          this.$router.push({path:'/bowler/'+this.saveTeamNames.TeamB});
        }
      }
      else if (to.path == '/done' && from.path == '/bowler/'+this.teamName+'&'+this.saveTeamNames.TeamA+'&'+this.elected) {
        if (this.elected == 'bowl') {
          this.$router.push({path:'/strike-batter/'+this.saveTeamNames.TeamA+'&'+this.elected});
        }else if (this.elected == 'bat') {
          this.$router.push({path:'/score-sheet'});
        }
      }
      else if (to.path == '/done' && from.path == '/wicket') {
        this.$router.push({path:'/score-sheet'});
      }
      else if (to.path == '/done' && from.path == '/new-batter') {
        this.$router.push({path:'/score-sheet'});
      }
      else if (to.path == '/new-batter' && from.path == '/score-sheet') {
        this.$router.push({path:'/new-batter'});
      }
      else if (to.path == '/settings' && from.path == '/teams') {
        this.$router.push({path:'/settings'});
      }
      else if (to.path == '/match-Setup' && from.path == '/settings') {
        this.$router.push({path:'/match-setup/'+this.saveTeamNames.TeamA+'&'+this.saveTeamNames.TeamA});
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
        this.menuItems = defaultMenu;
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

<style lang="css">
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
