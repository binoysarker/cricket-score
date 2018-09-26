<template lang="html">
  <section class="MatchSetupSection">
    <ul class="list-group">
      <li class="list-group-item heading">Toss won by</li>
      <li class="list-group-item" v-for="(item,index) in teamMembers" :key="item.id">
        <div class="form-check">
          <label class="form-check-label" :for="item.name.replace(' ','')">
            {{item.name}}
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" :id="item.name.replace(' ','')" :name="item.name.replace(' ','')" :value="item.name.replace(' ','')" v-model="pickedTeam">
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
      user_id:'',
      button:'/svg/tick.svg',
      showRightCircle: false,
      pickedTeam:'',
      elected:'',
      teamMembers:[
        {id:1,name:'Team A',class:'active',active:false},
        {id:2,name:'Team B',class:'active',active:false},
      ],
    }
  },

  mounted(){
    bus.$emit('resetMenu','/match-setup');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
    bus.$on('user_id',(data)=>{
      this.user_id = data;
    });
    // now to get the team name based on the user_id and verses
    axios.get(this.base_url+'/team')
    .then((res)=>{console.log(res.data);})
    .catch((err)=>{err.response});
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
