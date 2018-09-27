<template lang="html">
  <transition name="slide">
    <section id="settingSection">
      <!-- count section -->
      <!-- error section -->
      <ul class="list-group d-flex justify-content-arround" v-if="hasError">
        <li class="list-group-item" v-for="(item,index) in errors[0]">
          <p class="alert alert-danger" role="alert" v-if="!!item.no_ball_count">{{item.no_ball_count[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.wide_ball_count">{{item.wide_ball_count[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.last_man_standing">{{item.last_man_standing[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.unlimited_dismissals">{{item.unlimited_dismissals[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.max_balls_per_batter">{{item.max_balls_per_batter[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.max_run_per_batter">{{item.max_run_per_batter[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.max_balls_per_over">{{item.max_balls_per_over[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.overs_per_innings">{{item.overs_per_innings[0]}}</p>
          <p class="alert alert-danger" role="alert" v-if="!!item.max_overs_per_bowler">{{item.max_overs_per_bowler[0]}}</p>
        </li>
      </ul>
      <!-- /error section -->
      <!-- <small class="alert alert-danger" role="alert" v-if="hasError">{{errors[0].errors.name[0]}}</small> -->
      <ul class="list-group menu1">
        <li class="list-group-item justify-content-between" v-for="(item,index) in menu1Items" :key="index">
          {{item.name}}
          <span class="toggle-button" >
            <toggle-button
            @change="saveCountSettings(item,index,$event)"
            v-model="item.active"
            :name="item.button"
            />
          </span>
        </li>
      </ul>
      <!-- /count section -->
      <ul class="list-group menu2">
        <li  class="list-group-item justify-content-between" v-for="(item,index) in MaxCountItems" :key="index">
          {{item.name}}
          <span class="symbol-section">
            <button :class="[item.changeBg1 ? 'btn btn-default '+item.class: 'btn btn-info']" @click="increaseEffect(item)" v-html="item.symbol1"></button>
            <button class="btn btn-default counter" v-if="item.counter == 0">&#8734;</button>
            <button class="btn btn-default counter" v-else v-text="item.counter">&#8734;</button>
            <button :class="[item.changeBg2 ? 'btn btn-default '+item.class: 'btn btn-info']" @click="decreasEffect(item)" v-html="item.symbol2" ></button>
          </span>
        </li>
      </ul>
      <!-- match setting section -->
      <ul class="list-group menu3">
        <li class="list-group-item" id="heading">
          Match Settings
        </li>
        <li class="list-group-item justify-content-between">
          Overs Per Innings
          <div class="form-group">
            <!-- <label for="exampleSelect1">Example select</label> -->
            <select class="form-control" v-model="overs_per_innings">
              <option value="no_limit">No limit</option>
              <option v-for="num in 20" :value="num">{{num}}</option>
            </select>
          </div>
        </li>
        <li class="list-group-item justify-content-between">
          Max Overs Per Bowler
          <div class="form-group">
            <!-- <label for="exampleSelect1">Example select</label> -->
            <select class="form-control" v-model="max_overs_per_bowler">
              <option value="no_limit">No limit</option>
              <option v-for="num in 20" :value="num">{{num}}</option>
            </select>
          </div>
        </li>
      </ul>
      <!-- /match setting section -->
    </section>

  </transition>
</template>

<script>
import {bus} from '../../app';
export default {
  data(){
    return {
      errors:[],
      hasError:false,
      base_url:'',
      overs_per_innings:'',
      max_overs_per_bowler:'',
      changeBg1:false,
      changeBg2:false,
      counter:0,
      selectNewBatter:'',
      menu1Items:[
        {name:'No Balls count as balls faced',active:false,class:'test',button:'noBall'},
        {name:'Wides count as balls faced',active:false,class:'test',button:'wide'},
        {name:'Allow Last Man Standing',active:false,class:'test',button:'lastManStanding'},
        {name:'Unlimited dismissals',active:false,class:'test',button:'dismissals'},
      ],
      MaxCountItems:[
        {name:'Max balls per batter',active:false,class:'symbolClass1',symbol1:'&#8853;',symbol2:'&#8854;',counter:0,changeBg1:false,changeBg2:false},
        {name:'Max runs per batter',active:false,class:'symbolClass2',symbol1:'&#8853;',symbol2:'&#8854;',counter:0,changeBg1:false,changeBg2:false},
        {name:'Max balls per over',active:false,class:'symbolClass3',symbol1:'&#8853;',symbol2:'&#8854;',counter:0,changeBg1:false,changeBg2:false},
      ],
      ItemsToSaveInDatabase:[
        {
          no_ball_count:'',
          wide_ball_count:'',
          last_man_standing:'',
          unlimited_dismissals:'',
          max_balls_per_batter:'',
          max_run_per_batter:'',
          max_balls_per_over:'',
          overs_per_innings:'',
          max_overs_per_bowler:'',
          toss_won_by:'',
          elected_to:''
        }
      ],
    }
  },
  created(){
    console.log(this.test);
  },
  watch:{
    // selectNewBatter(value){
    //   if (value) {
    //     this.$router.push({path:'/strike-batter'});
    //     bus.$emit('resetMenu','selectNewBatter');
    //   }
    // },
  },
  mounted(){
    this.hasError = false;
    bus.$emit('saveTeamNames',{TeamA:this.$route.params.teamA,TeamB:this.$route.params.teamB});
    bus.$emit('resetMenu','settings');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
  },
  methods:{
    saveCountSettings(item,index,event){
      // console.log(event.value);
      // console.log(item.button);
      // now to save the data in the db
      if (item.button == 'noBall') {
        this.ItemsToSaveInDatabase.no_ball_count = event.value ? 1: 0;
      }
      if (item.button == 'wide') {
        this.ItemsToSaveInDatabase.wide_ball_count = event.value ? 1: 0;
      }
      if (item.button == 'lastManStanding') {
        this.ItemsToSaveInDatabase.last_man_standing = event.value ? 1: 0;
      }
      if (item.button == 'dismissals') {
        this.ItemsToSaveInDatabase.unlimited_dismissals = event.value ? 1: 0;
      }
    },
    increaseEffect(item){
      item.changeBg1 = !item.changeBg1;
      item.counter ++;
      // console.log(item.name);
      // console.log(item.counter);
      // now to save the value in the db
      if (item.name == 'Max balls per batter') {
        this.ItemsToSaveInDatabase.max_balls_per_batter = item.counter;
      }
      if (item.name == 'Max runs per batter') {
        this.ItemsToSaveInDatabase.max_run_per_batter = item.counter;
      }
      if (item.name == 'Max balls per over') {
        this.ItemsToSaveInDatabase.max_balls_per_over = item.counter;
      }
    },
    decreasEffect(item){
      // console.log(item);
      item.changeBg2 = !item.changeBg2;
      item.counter --;
      // now to save the value in the db
      if (item.name == 'Max balls per batter') {
        this.ItemsToSaveInDatabase.max_balls_per_batter = item.counter;
      }
      if (item.name == 'Max runs per batter') {
        this.ItemsToSaveInDatabase.max_run_per_batter = item.counter;
      }
      if (item.name == 'Max balls per over') {
        this.ItemsToSaveInDatabase.max_balls_per_over = item.counter;
      }
    },
  },
  beforeRouteLeave (to, from, next) {
    const answer = window.confirm('Do you want to save your settings?')
    if (answer) {
      // this section is for overs_per_innings and max_overs_per_bowler
      this.ItemsToSaveInDatabase.overs_per_innings = this.overs_per_innings == 'no_limit'? this.overs_per_innings = 50 : this.overs_per_innings;
      this.ItemsToSaveInDatabase.max_overs_per_bowler = this.max_overs_per_bowler == 'no_limit'? this.max_overs_per_bowler = 50 : this.max_overs_per_bowler;

      // if (this.overs_per_innings == '') {
      //   this.ItemsToSaveInDatabase.overs_per_innings = undefined;
      // }
      // if (this.max_overs_per_bowler == '') {
      //   this.ItemsToSaveInDatabase.max_overs_per_bowler = undefined;
      // }
      // console.log(this.ItemsToSaveInDatabase.overs_per_innings);

      // finally to save the data in the Database

      axios.post(this.base_url+'/settings',{
        no_ball_count:this.ItemsToSaveInDatabase.no_ball_count == undefined ? 0 :this.ItemsToSaveInDatabase.no_ball_count,
        wide_ball_count:this.ItemsToSaveInDatabase.wide_ball_count == undefined ? 0 : this.ItemsToSaveInDatabase.wide_ball_count,
        last_man_standing:this.ItemsToSaveInDatabase.last_man_standing ,
        unlimited_dismissals:this.ItemsToSaveInDatabase.unlimited_dismissals == undefined ? 0 : this.ItemsToSaveInDatabase.unlimited_dismissals,
        max_balls_per_batter:this.ItemsToSaveInDatabase.max_balls_per_batter == undefined ? 0 : this.ItemsToSaveInDatabase.max_balls_per_batter,
        max_run_per_batter:this.ItemsToSaveInDatabase.max_run_per_batter == undefined ? 0 : this.ItemsToSaveInDatabase.max_run_per_batter,
        max_balls_per_over:this.ItemsToSaveInDatabase.max_balls_per_over == undefined ? 0 : this.ItemsToSaveInDatabase.max_balls_per_over,
        overs_per_innings:this.ItemsToSaveInDatabase.overs_per_innings,
        max_overs_per_bowler:this.ItemsToSaveInDatabase.max_overs_per_bowler
      })
      .then((res)=>{
        console.log(res.data);
        next();
      })
      .catch((error)=>{
        this.hasError = true;
        this.errors.push(error.response.data);
        console.log(this.errors[0].errors);
      });

    } else {
      next(false)
    }
  }
}
</script>

<style lang="css" scoped>
.toggle-button, .symbol-section, .form-group{
  float: right;
}
.symbol-section > button{
  padding: 5px 5px;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
}
.symbolClass1, .symbolClass2, .symbolClass3{
  background-color: gray;
  border-radius: 50%;
}
#heading{
  background-color: #E1E4ED;
  font-weight: bold;
}
</style>
