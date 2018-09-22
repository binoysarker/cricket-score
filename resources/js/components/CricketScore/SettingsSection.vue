<template lang="html">
  <transition name="slide">
    <section id="settingSection">
      <!-- count section -->
      <ul class="list-group menu1">
        <li class="list-group-item justify-content-between" v-for="(item,index) in menu1Items" :key="item.id">
          {{item.name}}
          <span class="toggle-button">
            <toggle-button v-model="myDataVariable1" :name="item.button"/>
          </span>
        </li>
      </ul>
      <!-- /count section -->
      <ul class="list-group menu2">
        <li  class="list-group-item justify-content-between" v-for="(item,index) in MaxCountItems" :key="item.id">
          {{item.name}}
          <span class="symbol-section">
            <span class="symbol1" v-html="item.symbol1"></span>
            <span class="counter">&#8734;</span>
            <span class="symbol2" v-html="item.symbol2"></span>
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
            <select class="form-control" id="exampleSelect1">
              <option>No limit</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </li>
        <li class="list-group-item justify-content-between">
          Max Overs Per Bowler
          <div class="form-group">
            <!-- <label for="exampleSelect1">Example select</label> -->
            <select class="form-control" id="exampleSelect1">
              <option>No limit</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
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
      myDataVariable1:'',
      menu1Items:[
        {id:1,name:'No Balls count as balls faced',active:false,class:'test',button:'no-ball'},
        {id:2,name:'Wides count as balls faced',active:false,class:'test',button:'wide'},
        {id:3,name:'Allow Last Man Standing',active:false,class:'test',button:'last-man'},
        {id:4,name:'Unlimited dismissals',active:false,class:'test',button:'dismissals'},
      ],
      MaxCountItems:[
        {id:1,name:'Max balls per batter',active:false,class:'test',symbol1:'&#8853;',symbol2:'&#8854;'},
        {id:2,name:'Max runs per batter',active:false,class:'test',symbol1:'&#8853;',symbol2:'&#8854;'},
        {id:3,name:'Max balls per over',active:false,class:'test',symbol1:'&#8853;',symbol2:'&#8854;'},
      ],
    }
  },
  mounted(){
    bus.$emit('resetMenu');
  },
}
</script>

<style lang="css" scoped>
.toggle-button, .symbol-section, .form-group{
  float: right;
}
.symbol-section > span{
  padding: 5px 5px;
  font-size: 18px;
  cursor: pointer;
}
#heading{
  background-color: #E1E4ED;
  font-weight: bold;
}
</style>
