<template lang="html">
  <section class="MatchSetupSection">
    <ul class="list-group">
      <li class="list-group-item heading">Toss won by</li>
      <li class="list-group-item" v-for="(item,index) in teamMembers" :key="index">
        <div class="form-check">
          <label class="form-check-label" :for="item">
            {{item}}
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" :id="item" :name="item" :value="item" v-model="pickedTeam">
          </span>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item heading">Elected to</li>
      <li class="list-group-item" >
        <div class="form-check">
          <label class="form-check-label" for="bat">
            bat
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" id="bat" name="bat" value="bat" v-model="elected">
          </span>
        </div>
      </li>
      <li class="list-group-item">
        <div class="form-check">
          <label class="form-check-label" for="bowl">
            bowl
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" id="bowl" name="bowl" value="bowl" v-model="elected">
          </span>
        </div>
      </li>

    </ul>
  </section>
</template>

<script>
import {bus} from '../../app';
export default {
  data(){
    return {
      base_url:'',
      button:'/svg/tick.svg',
      showRightCircle: false,
      pickedTeam:'',
      elected:'',
      teamMembers:null,
    }
  },
  watch:{
    pickedTeam(value){
      if (value == this.$route.params.teamA) {
        this.teamMembers = {
          teamA: value,
          teamB: this.$route.params.teamB
        };
      }else if (value == this.$route.params.teamB) {
        this.teamMembers = {
          teamA: value,
          teamB: this.$route.params.teamA
        };
      }
      else {
        this.teamMembers = {
          teamA: this.$route.params.teamA,
          teamB: this.$route.params.teamB
        };
      }
    }
  },

  mounted(){
    bus.$emit('saveTeamNames',{TeamA:this.$route.params.teamA,TeamB:this.$route.params.teamB});
    bus.$emit('resetMenu','/match-setup');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
    let teamNames = {
      teamA: this.$route.params.teamA,
      teamB:this.$route.params.teamB
    };
    this.teamMembers = teamNames;

  },
  beforeRouteLeave (to, from, next){
    // save toss won by and elelted to data to the db
    axios.post(this.base_url+'/settings',{toss_won_by:this.pickedTeam,elected_to:this.elected})
    .then((res)=>{
      // console.log(res.data);
    })
    .catch((error)=>{console.log(error.response);}) ;
    bus.$emit('goToStrikeBatter',{team:this.teamMembers.teamA,elected:this.elected});
    next();
  },

}
</script>

<style lang="css" scoped>
.heading{
  background-color: #E1E4ED;
}

/* .active{
  background-color: #75C791;
} */
.button{
  float: right;
}
</style>
