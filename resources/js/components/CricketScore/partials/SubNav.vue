<template>
  <ul class="nav justify-content-center bg-change">
  <li class="nav-item mr-4 ml-4 " v-for="(item,index) in menuItems" :key="item.id">
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
    }
  },
  created(){
    bus.$on('addDoneBtn',(data) => {
      if (this.menuItems.name != 'Done') {
        this.menuItems.shift();
        this.menuItems.push(data);
      }
    });
    bus.$on('resetMenu',()=>{
      // this.menuItems = this.menuItems;
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
</style>
