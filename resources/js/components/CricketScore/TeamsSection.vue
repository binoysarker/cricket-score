<template lang="html">
  <section class="teamsSection">
    <div class="jumbotron">
      <h1 class="display-3">Select Teams</h1>
      <div class="form-group">
        <select class="form-control" v-if="TeamNames.length >= 0 " v-model="selectTeamA" id="exampleSelect1">
          <option v-for="(item,index) in TeamNames[0]" :value="item" :key="index" >{{item.name}}</option>
        </select>
        <select class="form-control" v-else name="" >
          <option value="no_team">No Team Name</option>
        </select>
        <small class="alert alert-danger" role="alert" v-if="hasError">{{errors[0].errors.name[0]}}</small>

      </div>
      <h1 class="verses">Vs</h1>
      <div class="form-group">
        <select class="form-control" v-if="TeamNames.length >= 0 " v-model="selectTeamB" id="exampleSelect1">
          <option :value="item"
          v-for="(item,index) in TeamNames[0]"
          :key="index" >{{item.name}}</option>
        </select>
        <select class="form-control" v-else name="" >
          <option value="no_team">No Team Name</option>
        </select>
        <small class="alert alert-danger" role="alert" v-if="hasError">{{errors[0].errors.name[0]}}</small>
      </div>
      <p class="lead">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Create New
        </button>
        <button type="button" @click="goToNextPage()" class="btn btn-primary" name="done">Done</button>
      </p>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Team</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inputText">Team Name</label>
              <input type="text" class="form-control" ref="teamName" id="inputText" aria-describedby="emailHelp" placeholder="Team Name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" @click="saveTeamName()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {bus} from '../../app';
export default {
  data(){
    return {
      TeamNames:[],
      selectTeamA:'',
      selectTeamB:'',
      base_url:'',
      errors:[],
      hasError:false
    }
  },
  methods:{
    saveTeamName(){
      let teamName = this.$refs.teamName.value.trim().toString();
      if (teamName != null) {
        // make axios request to save the team name
        axios.post(this.base_url+'/team',{name:teamName})
        .then((res)=>{
          // console.log(res.data);
          // this.TeamNames.push(res.data);
          location.reload();
        })
        .catch((error)=>{
          // console.log(error.response.data);
          this.hasError = true;
          this.errors.push(error.response.data);
        });
      }
    },
    goToNextPage(){
      // let teamName = this.$refs.teamName.value.trim().toString();
      // save the verses info
      bus.$emit('saveTeamNames',{TeamA:this.selectTeamA.name,TeamB:this.selectTeamB.name});
      axios.post(this.base_url+'/team',{TeamA:this.selectTeamA.name,TeamB:this.selectTeamB.name})
      .then((res)=>{console.log(res.data);})
      .catch((error)=>{console.log(error.response);});

      this.$router.push({path:'/team-member/'+this.selectTeamA.name+'&'+this.selectTeamB.name, props:true});
    },
  },
  mounted(){
    // console.log(this.TeamNames.length);
    this.hasError = false;
    bus.$emit('resetMenu','teams');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
    // get all the team names
    axios.get(this.base_url+'/team')
    .then((res)=>{
      // console.log(this.TeamNames);
      this.TeamNames.push(res.data);
    })
    .catch((err)=>{
      // console.log(err.response);
      this.hasError = true;
      this.errors.push(err.response);
    });
  },


}
</script>

<style lang="css" scoped>
.verses{
  text-align: center;
}
</style>
