<template lang="html">
  <section class="strike-batter">
    <ul class="list-group">
      <li class="list-group-item" v-for="(item,index) in batterNames" :key="item.name">
        <div class="form-check">
          <label class="form-check-label" :for="item.name.replace(' ','')">
            {{item.name}}
          </label>
          <span class="button">
            <input class="form-check-input" type="radio" :id="item.name.replace(' ','')" :name="item.name.replace(' ','')" :value="item.name.replace(' ','')" v-model="pickedName">
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
      pickedName:'',
      batterNames:[
        {name:'name 1',class:'active',active:false},
        {name:'name 2',class:'active',active:false},
        {name:'name 3',class:'active',active:false},
        {name:'name 4',class:'active',active:false},
        {name:'name 5',class:'active',active:false},
        {name:'name 6',class:'active',active:false},
        {name:'name 7',class:'active',active:false},
      ],
    }
  },
  mounted(){
    bus.$emit('resetMenu','/strike-batter');
  },
}
</script>

<style lang="css">
.button{
  float: right;
}
</style>
