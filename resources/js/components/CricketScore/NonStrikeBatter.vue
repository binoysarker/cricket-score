<template lang="html">
  <section class="non-strike-batter">
    <ul class="list-group">
      <li class="list-group-item" v-for="(item,index) in nonStrikeBatterNames" v-if="item.selected == 1 && item.member_name != $route.params.strikeBatterSelectedToBat" :key="index">
        <div class="form-check">
          <label class="form-check-label" :for="item.member_name">
            {{item.member_name}}
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" :id="item.member_name" :name="item.member_name" :value="item.member_name" v-model="nonStrikeBatterSelectedToBat" @click="nonStrikeBatterId(item.id)">
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
      nonStrikeBatterNames:null,
      nonStrikeBatterSelectedToBat:'',
      nonStrikeBatterSelectedToBatId:''
    }
  },
  methods:{
    nonStrikeBatterId(id){
      this.nonStrikeBatterSelectedToBatId = id;
    }
  },
  mounted(){
    bus.$emit('resetMenu','/non-strike-batter');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
    // now to get the team_members for the toss_won_by team
    axios.get(this.base_url+'/team-member/'+this.$route.params.teamName)
    .then((res)=>{
      // console.log(res.data);
      this.nonStrikeBatterNames = res.data;
    })
    .catch((err)=>{console.log(err.response);});
  },
  beforeRouteLeave (to, from, next){
    if (to.path == '/done' && from.path == '/non-strike-batter/'+this.$route.params.teamName+'&'+this.$route.params.elected+'&'+this.$route.params.strikeBatterSelectedToBat) {
      bus.$emit('nonStrikeBatterSelectedToBat',this.nonStrikeBatterSelectedToBat);
      // update the strikeBatterSelectedToBat data in the team_members table
      axios({
        method: 'put',
        url: this.base_url+'/team-member/'+this.nonStrikeBatterSelectedToBatId,
        data: {
          non_strike_batter:this.nonStrikeBatterSelectedToBat
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      .then((res)=>{
        console.log(res.data);

      })
      .catch((err)=>{console.log(err.response);});
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
