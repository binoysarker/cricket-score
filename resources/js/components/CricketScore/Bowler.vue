<template lang="html">
  <section class="non-strike-batter">
    <ul class="list-group">
      <li class="list-group-item" v-for="(item,index) in bowlerNames" v-if="item.selected == 1 && item.member_name" :key="index">
        <div class="form-check">
          <label class="form-check-label" :for="item.member_name">
            {{item.member_name}}
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" :id="item.member_name" :name="item.member_name" :value="item.member_name" v-model="bowlerSelectedTo" @click="bowlerId(item.id)">
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
      bowlerNames:null,
      bowlerSelectedTo:'',
      bowlerSelectedToId:''
    }
  },
  methods:{
    bowlerId(id){
      this.bowlerSelectedToId = id;
    }
  },
  mounted(){
    bus.$emit('resetMenu','/bowler');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
    // now to get the team_members for the toss_won_by team

    if (this.$route.params.elected.slice(0,3) == 'bat') {
      axios.get(this.base_url+'/team-member/'+this.$route.params.teamB)
      .then((res)=>{
        // console.log(res.data);
        this.bowlerNames = res.data;
      })
      .catch((err)=>{console.log(err.response);});
    }else {
      axios.get(this.base_url+'/team-member/'+this.$route.params.teamA)
      .then((res)=>{
        // console.log(res.data);
        this.bowlerNames = res.data;
      })
      .catch((err)=>{console.log(err.response);});
    }
  },
  beforeRouteLeave (to, from, next){
    if (to.path == '/done' && from.path == '/bowler/'+this.$route.params.teamA+'&'+this.$route.params.teamB+'&'+this.$route.params.elected) {
      bus.$emit('bowlerSelectedTo',this.bowlerSelectedTo);
      // update the strikeBatterSelectedToBat data in the team_members table
      axios({
        method: 'put',
        url: this.base_url+'/team-member/'+this.bowlerSelectedToId,
        data: {
          bowler_selected:this.bowlerSelectedTo
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
