<template lang="html">
  <section class="strike-batter">
    <ul class="list-group">
      <li class="list-group-item" v-for="(item,index) in batterNames" v-if="item.selected == 1" :key="index">
        <div class="form-check">
          <label class="form-check-label" :for="item.member_name">
            {{item.member_name}}
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" :id="item.member_name" :name="item.member_name" :value="item.member_name" v-model="strikeBatterSelectedToBat">
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
      elected_to:'',
      teamName:'',
      strikeBatterSelectedToBat:'',
      batterNames:null,
    }
  },
  mounted(){
    bus.$emit('resetMenu','/strike-batter');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
    // now to get the team_members for the toss_won_by team
    axios.get(this.base_url+'/team-member/'+this.$route.params.teamName)
    .then((res)=>{
      // console.log(res.data);
      this.batterNames = res.data;
    })
    .catch((err)=>{console.log(err.response);});

  },
  beforeRouteLeave (to, from, next){
    if (to.path == '/done' && from.path == '/strike-batter/'+this.$route.params.teamName+'&'+this.$route.params.elected) {
      bus.$emit('strikeBatterSelectedToBat',this.strikeBatterSelectedToBat);
      next();
    }else {
      next(false);
    }
  }
}
</script>

<style lang="css">
.button{
  float: right;
}
</style>
