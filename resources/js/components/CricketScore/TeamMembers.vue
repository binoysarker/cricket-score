<template lang="html">
  <section class="strike-batter">
    <div class="card mt-2">
      <!-- alert section -->
      <div v-if="hasStatus" class="alert alert-primary" role="alert">
        {{statusMessage}}
        <span class="badge badge-danger float-right" @click="hasStatus = false">X</span>
      </div>
      <br>
      <!-- /alert section -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
        Select Team Members
      </button>
      <br>
      <hr>
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2">
        Create Team Members
      </button>
    </div>

    <!-- modal for displaying team members -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Selete Team Members</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <select class="custom-select" v-model="selectTeam">

              <option :value="$route.params.teamA">{{$route.params.teamA}}</option>
              <option :value="$route.params.teamB">{{$route.params.teamB}}</option>
            </select>
            <br>
            <!-- show the batterNames according to the team name -->
            <ul class="list-group">
              <li class="list-group-item" @click="markTeamMembers(item)" v-for="(item,index) in batterNames" :key="index" v-if="item.selected != 1">
                <div class="form-check">
                  <label class="form-check-label" :for="item.member_name.replace(' ','')">
                    {{item.member_name}}
                  </label>
                  <span class="button">
                    <input class="form-check-input" type="checkbox" :id="item.member_name.replace(' ','')" :name="item.member_name.replace(' ','')" :value="item.member_name.replace(' ','')" >
                  </span>
                </div>
              </li>
            </ul>
            <!-- /show the batterNames according to the team name -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"  data-dismiss="modal">Save Team Members</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /modal for displaying team members -->
    <!-- modal for creating team members -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Team Memebers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <select class="custom-select" v-model="editTeam">
              <option :value="$route.params.teamA">{{$route.params.teamA}}</option>
              <option :value="$route.params.teamB">{{$route.params.teamB}}</option>
            </select>
            <!-- form section -->
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Name:</span>
              </div>
              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="teamMemberName">
            </div>
            <br>

            <!-- /form section -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="saveEditTeamData()" data-dismiss="modal">Create</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal for creating team members -->
  </section>
</template>

<script>
import {bus} from '../../app';
export default {
  data(){
    return {
      base_url:'',
      selectTeam:'',
      editTeam:'',
      teamMemberName:'',
      batterNames:null,
      hasStatus:false,
      statusMessage:'',
    }
  },
  watch:{
    selectTeam(teamName){
      // get the team_members name according to the team name
      axios.get(this.base_url+'/team-member/'+teamName)
      .then((res)=>{
        // console.log(res.data);
        this.batterNames = res.data;
      })
      .catch((err)=>{console.log(err.response);});
    },
  },
  methods:{

    saveEditTeamData(){
      if (this.editTeam == this.$route.params.teamA) {
        axios.post(this.base_url+'/team-member',{member_name:this.teamMemberName,team_name:this.$route.params.teamA})
        .then((res)=>{
          if (res.data.status) {
            this.hasStatus = true;
            this.statusMessage = res.data.status;
          }
          else {
            // console.log(res.data);
            // this.batterNames = res.data;
          }
          location.reload();
        })
        .catch((err)=>{console.log(err.response);});
      }else if (this.editTeam == this.$route.params.teamB) {
        axios.post(this.base_url+'/team-member',{member_name:this.teamMemberName,team_name:this.$route.params.teamB})
        .then((res)=>{
          if (res.data.status) {
            this.hasStatus = true;
            this.statusMessage = res.data.status;
          }
          else {
            // console.log(res.data);
            // this.batterNames = res.data;
          }
        })
        .catch((err)=>{console.log(err.response);});
      }
    },
    markTeamMembers(item){
      // save the seleted data to the team_members table
      axios({
        method: 'put',
        url: this.base_url+'/team-member/'+item.id,
        data: {
          picked_names:item.member_name
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      .then((res)=>{
        // console.log(res.data);

      })
      .catch((err)=>{console.log(err.response);});
    },
  },
  mounted(){
    // this.hasStatus = false;
    bus.$emit('saveTeamNames',{TeamA:this.$route.params.teamA,TeamB:this.$route.params.teamB});
    bus.$emit('resetMenu','/team-member');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });
  },
}
</script>

<style lang="css">
.button{
  float: right;
}
span.badge{
  cursor: pointer;
}
</style>
