<template lang="html">
  <keep-alive>
    <section class="ScoreSheet">

      <div class="teamScore">
        <div class="customImage">
          <div class="circle1"></div>
          <div class="text1">{{teamAName | getLogoTitle}}</div>
        </div>
        <span class="Name">{{teamAName}}</span>
        <span class="Score">12/0</span>
      </div>
      <div class="teamScore">
        <div class="customImage">
          <div class="circle2"></div>
          <div class="text2">{{teamBName | getLogoTitle}}</div>
        </div>
        <span class="Name">{{teamBName}}</span>
        <span class="Score">   </span>
      </div>
      <!-- score detail section -->
      <div class="card" >
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-score-tab" data-toggle="tab" href="#nav-score" role="tab" aria-controls="nav-score" aria-selected="true">Score</a>
            <a class="nav-item nav-link" id="nav-edit-tab" data-toggle="tab" href="#nav-edit" role="tab" aria-controls="nav-edit" aria-selected="false">Edit</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-score" role="tabpanel" aria-labelledby="nav-score-tab">
            <!-- table for sore section -->
            <table class="table ">
              <!-- fot batters section -->
              <thead class="thead-light">
                <tr>
                  <th scope="col">Batters</th>
                  <th scope="col">R</th>
                  <th scope="col">B</th>
                  <th scope="col">4s</th>
                  <th scope="col">6s</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item,index) in batsmenInfo" :key="index" >
                  <td @click="makeBatterAcive(item,index)" :class="item.active ? 'name' : 'not-active'">{{item.name}}</td>
                  <td ref="runs">{{item.runs}}</td>
                  <td ref="balls">{{item.balls}}</td>
                  <td ref="fours">{{item.fours}}</td>
                  <td ref="sixes">{{item.sixes}}</td>

                </tr>
                <tr>
                  <td><span class="float-right">PARTNERSHIP</span></td>
                  <td>{{partnership.runs}}</td>
                  <td>{{partnership.balls}}</td>
                  <td>{{partnership.fours}}</td>
                  <td>{{partnership.sixes}}</td>
                </tr>
              </tbody>
              <!-- /fot batters section -->
              <!-- fot bowlers section -->
              <thead class="thead-light">
                <tr>
                  <th scope="col">Bowlers</th>
                  <th scope="col">O</th>
                  <th scope="col">M</th>
                  <th scope="col">R</th>
                  <th scope="col">W</th>
                </tr>
              </thead>
              <tbody>
                <tr >
                  <td class="name">{{modifiedBowlerInfo.name}}</td>
                  <td >{{modifiedBowlerInfo.overs}}</td>
                  <td >{{modifiedBowlerInfo.maiden_overs}}</td>
                  <td >{{modifiedBowlerInfo.runs_given}}</td>
                  <td >{{modifiedBowlerInfo.wicket_taken}}</td>
                </tr>
              </tbody>
              <!-- /fot bowlers section -->

            </table>
            <!-- /table for sore section -->
          </div>
          <div class="tab-pane fade" id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-tab">
            <!-- table for edit section -->
            <table class="table editSection">
              <thead class="bgChange">
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Ball-by-Ball</th>
                  <th scope="col">INSERT</th>
                  <th scope="col">EDIT</th>
                </tr>
              </thead>
              <tbody>
                <tr class="bgChange">
                  <td>Over 1</td>
                  <td></td>
                  <td>12 runs, 12/0</td>
                  <td>
                    <img src="/image/insert.jpg" alt="">
                  </td>
                  <td>
                    <img src="/image/edit-bgChange.jpg" alt="">
                  </td>
                </tr>
                <tr class="">
                  <td>0.3</td>
                  <td>
                    <img src="/image/button-four.jpg" alt="">
                  </td>
                  <td>
                    batter name
                  </td>
                  <td>

                  </td>
                  <td>
                    <img src="/image/edit.jpg" alt="">
                  </td>
                </tr>
                <tr class="">
                  <td>0.2</td>
                  <td>
                    <img src="/image/button-two.jpg" alt="">
                  </td>
                  <td>
                    batter name
                  </td>
                  <td>

                  </td>
                  <td>
                    <img src="/image/edit.jpg" alt="">
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- /table for edit section -->
          </div>
        </div>
      </div>
      <!-- /score detail section -->
      <!-- button section -->
      <div class="container buttonSection">
        <transition name="fade">
          <div class="row overview" v-if="overSection">
            <img src="/image/cross-image.jpg" alt="" @click="overSection = !overSection">
            <transition name="fade">
              <span class="over-count">
                Over {{overCounter}}
                <br>
                {{currentValue | upper}}
              </span>
            </transition>
            <img class="right-image" src="/image/right-image.jpg" alt="" @click="overSection = !overSection">
          </div>
        </transition>
        <div class="row">
          <table class="table table-borderless table-sm">
            <tbody class="tbody-light">
              <tr>
                <td v-for="(item,index) in buttonImagesRow1" :key="item.id">
                  <img :src="item.location" alt="" @click="calculateRuns(item)">
                </td>
              </tr>
              <tr>
                <td v-for="(item,index) in buttonImagesRow2" :key="item.id">
                  <img :src="item.location" alt="" @click="calculateRuns(item)">
                </td>
              </tr>
              <tr>
                <td v-for="(item,index) in buttonImagesRow3" @click="selectNewBatter(item)" :key="item.id">
                  <img :src="item.location" alt="" @click="calculateRuns(item)">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /button section -->
      <!-- modal section -->


      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h1>Over Summary</h1>
              <br>
              6 2 4 nb+3lb 2 3 1
              <br>
              batter 1: 1-0-19-0
              <br>
              <br>
              After 1 over: 22/0
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">End Over</button>
              <button type="button" @click="goToNextPage()" class="btn btn-primary" data-dismiss="modal">Continue next over</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /modal section -->
    </section>
  </keep-alive>
</template>

<script>
import {bus} from '../../app';
export default {
  data(){
    return {
      base_url:'',
      teamAName: this.$route.params.teamA,
      teamBName: this.$route.params.teamB,
      batsmenInfo:[],
      bowlersInfo:[],
      strikeBatter:'',
      nonStrikeBatter:'',
      bowlerName:'',
      showModal:false,
      overSection:false,
      ballCounter:0,
      overCounter:0,
      currentValue:'',
      maiden_overs:0,
      extra_runs:0,
      no_ball:0,
      wide_ball:0,
      leg_bye:0,
      bye:0,
      wicket_taken:0,
      partnership:{
        runs:0,
        balls:0,
        fours:0,
        sixes:0,
      },
      buttonImagesRow1:[
        {id:1,location:'/image/button-dot.jpg',value:0},
        {id:2,location:'/image/button-one.jpg',value:1},
        {id:3,location:'/image/button-two.jpg',value:2},
        {id:4,location:'/image/button-three.jpg',value:3},
        {id:5,location:'/image/button-fill.jpg',value:'return'}
      ],
      buttonImagesRow2:[
        {id:1,location:'/image/button-four.jpg',value:4},
        {id:2,location:'/image/button-six.jpg',value:6},
        {id:3,location:'/image/button-five.jpg',value:5},
        {id:4,location:'/image/empty-circle.jpg',value:0},
        {id:5,location:'/image/button-action.jpg',value:'action'}
      ],
      buttonImagesRow3:[
        {id:1,location:'/image/button-wide.jpg',value:'wide_ball'},
        {id:2,location:'/image/button-no-ball.jpg',value:'no_ball'},
        {id:3,location:'/image/button-bye.jpg',value:'bye'},
        {id:4,location:'/image/button-leg-bye.jpg',value:'leg_bye'},
        {id:5,location:'/image/button-wicket.jpg',value:'wicket_taken'},
      ]
    }
  },
  computed:{

    modifiedBowlerInfo(){
      _.assign(this.bowlersInfo,{name:this.bowlerName});
      return this.bowlersInfo;
    },
  },
  filters:{
    getLogoTitle(value){
      if (value) {
        let str = _.startCase(_.toLower(value));
        let matches = str.match(/\b(\w)/g);
        let achronym = matches.join(' ');
        return achronym;
      }
    },
    upper(value){
      return _.toUpper(value);
    },
  },
  watch:{
    showModal(value){
      if (value) {
        $('#exampleModal').modal('toggle');
      }
    },

  },
  methods:{
    makeBatterAcive(item,index){
      item.active = true;
      if (index == 0) {
        this.batsmenInfo[1].active = false;
      }
      if (index == 1) {
        this.batsmenInfo[0].active = false;
      }
    },
    goToNextPage(){
      // now make another request to save the partnership data in the partnerships table
      axios.post(this.base_url+'/partnership',{
        batsman_one: this.strikeBatter,
        batsman_two: this.nonStrikeBatter,
        total_runs: this.partnership.runs,
        total_balls: this.partnership.balls,
        total_fours: this.partnership.fours,
        total_sixes: this.partnership.sixes
      })
      .then((res)=>{console.log(res.data);})
      .catch((err)=>{console.log(err.response);});

      this.$router.push({path:'/wicket'});
      $('#exampleModal').modal('hide');
    },
    selectNewBatter(item){
      if (item.location == '/image/button-wicket.jpg') {
        this.$router.push({path:'/new-batter'});
      }
    },
    // here the main calculateRuns will be done
    calculateRuns(item){
      // checking runs for no_ball, wide_ball, leg_bye,bye,wicket_taken start
      if (item.value == 'no_ball') {this.extra_runs ++}
      else if (item.value == 'wide_ball') {this.extra_runs ++}
      else if (item.value == 'leg_bye') {this.extra_runs ++}
      else if (item.value == 'bye') {this.extra_runs ++}
      else if (item.value == 'wicket_taken') {this.wicket_taken ++}
      // checking runs for no_ball, wide_ball, leg_bye,bye,wicket_taken end
      this.overSection = true;
      // console.log(item.value);
      let checkpoint = [0.6,1.6,2.6,3.6,4.6,5.6,6.6,7.6,8.6,9.6,10.6,11.6,12.6,13.6,14.6,15.6,16.6,17.6,18.6,19.6,20.6];
      this.overCounter = +(this.overCounter + 0.1).toFixed(1);
      for (var i = 0; i < checkpoint.length; i++) {
        if (this.overCounter === checkpoint[i]) {
          this.showModal = true;
          this.overCounter = +(this.overCounter + 0.4).toFixed(1);
          break;
        }
      }
      // console.log(this.overCounter);
      this.ballCounter ++;
      this.currentValue = item.value;

      // get the active batter info start
      let getBatterInfo = _.filter(this.batsmenInfo,(obj)=>{return obj.active == true;});
      // console.log(getBatterInfo[0].id);
      // get the active batter info end

      // maiden_overs section start
      let tempRuns = [];
      tempRuns.push(this.ballCounter);
      for (var i = 0; i <= checkpoint.length; i++) {
        if (this.overCounter == checkpoint[i] && tempRuns.length > 0) {
          for (var j = 0; j < tempRuns.length; j++) {
            if (tempRuns[i] != 0) {
              this.maiden_overs += 1;
              break;
            }
          }
        }
      }
      // maiden_overs section end

      // now to update the data of balls runs overs in the battingstable by id
      axios.post(this.base_url+'/battings',{
        batter_id: getBatterInfo[0].id,
        batter_runs: item.value,
        batter_balls: this.ballCounter,
      })
      .then((res)=>{
        // console.log(res.data);
        // now to show the response data in the view of batter section
        let runs = '';
        if (res.data == 'no_ball' || res.data == 'wide_ball'|| res.data == 'leg_bye'|| res.data == 'bye') {
          return true;
        }
        else {
          let activeBatsmanInfo = _.find(this.batsmenInfo,(obj)=>{return obj.active == true;});
          activeBatsmanInfo.runs = res.data.runs;
          activeBatsmanInfo.balls = res.data.balls;
          activeBatsmanInfo.fours = res.data.fours;
          activeBatsmanInfo.sixes = res.data.sixes;
        }

      })
      .catch((err)=>{console.log(err.response);});
      // console.log(typeof(item.value));
      // now make another request to save the bowler data to the bowlings table
      axios.post(this.base_url+'/bowlings',{
        overs: this.overCounter,
        maiden_overs: this.maiden_overs,
        runs_given: typeof(item.value) == 'string' ? this.extra_runs : item.value,
        no_ball: this.no_ball,
        wide_ball: this.wide_ball,
        leg_bye: this.leg_bye,
        bye: this.bye,
        wicket_taken: this.wicket_taken,
      })
      .then((res)=>{
        // console.log(res.data);
        this.bowlersInfo.overs = res.data.overs;
        this.bowlersInfo.maiden_overs += res.data.maiden_overs;
        this.bowlersInfo.runs_given += res.data.runs_given;
        this.bowlersInfo.no_ball += res.data.no_ball;
        this.bowlersInfo.wide_ball += res.data.wide_ball;
        this.bowlersInfo.leg_bye += res.data.leg_bye;
        this.bowlersInfo.bye += res.data.bye;
        this.bowlersInfo.wicket_taken += res.data.wicket_taken;

      })
      .catch((err)=>{console.log(err.response);});

      /**
       * partnership section start
       */
      this.partnership.runs = +(this.$refs.runs[0].innerText) + +(this.$refs.runs[1].innerText);
      this.partnership.balls = +(this.$refs.balls[0].innerText) + +(this.$refs.balls[1].innerText);
      this.partnership.fours = +(this.$refs.fours[0].innerText) + +(this.$refs.fours[1].innerText);
      this.partnership.sixes = +(this.$refs.sixes[0].innerText) + +(this.$refs.sixes[1].innerText);



      /**
       * partnership section end
       */


    },
  },
  mounted(){
    bus.$emit('resetMenu','/score-sheet');
    bus.$on('base_url',(data)=>{
      this.base_url = data;
    });


    // now get only bowlers table info
    axios.get(this.base_url+'/bowlings')
    .then((res)=>{
      // console.log(res.data);
      this.bowlersInfo = res.data;
    })
    .catch((err)=>{console.log(err.response);});


    // now get team member info related to batters from the battings table
    axios.get(this.base_url+'/battings/get-batting-team-members')
    .then((res)=>{
      // console.log(res.data);
      this.strikeBatter = res.data[0].member_name;
      this.nonStrikeBatter = res.data[1].member_name;

    })
    .catch((err)=>{console.log(err.response);});


    // now get all the team, team member info related to bowlers from the bowllings table
    axios.get(this.base_url+'/bowlings/get-bowling-team-members')
    .then((res)=>{
      // console.log(res.data);
      this.bowlerName = res.data.member_name;
    })
    .catch((err)=>{console.log(err.response);});

    // now get only battings table info
    /**
    *this is the most critical part of this view page to re assign new key value pair
    **/
    axios.get(this.base_url+'/battings')
    .then((res)=>{
      // console.log(res.data);
      let newbatsmenInfo = res.data;
      newbatsmenInfo[0] = Object.assign({}, res.data[0], {
        active: true,
        name: this.strikeBatter
      });
      newbatsmenInfo[1] = Object.assign({}, res.data[1], {
        active: false,
        name: this.nonStrikeBatter
      });
      this.batsmenInfo = newbatsmenInfo;
      // console.log(newbatsmenInfo);
    })
    .catch((err)=>{console.log(err.response);});
  },
}
</script>

<style lang="css" scoped>

.circle1{
  /* float: left; */
  width: 80px;
  height: 80px;
  background-color: #6BC4F0;
  border-radius: 50%;
  position: relative;
}
.circle2{
  /* float: left; */
  width: 80px;
  height: 80px;
  background-color: #6BC4F0;
  border-radius: 50%;
  position: relative;
}
.text1{
  width: 50px;
  height: 50px;
  font-size: 30px;
  position: absolute;
  left: 2.5rem;
  top: 4.4rem;
  color: white;
}
.text2{
  width: 50px;
  height: 50px;
  font-size: 30px;
  position: absolute;
  left: 2.5rem;
  top: 10.5rem;
  color: white;
}
.teamScore{
  display: flex;
  justify-content: space-between;
  padding: 10px;
}
.Name{
  align-self: center;
  font-size: 20px;
  font-weight: bold;
}
.not-active{
  cursor: pointer;
}
.Score{
  float: right;
  align-self: center;
  font-size: 20px;
  font-weight: bold;
}
.card > nav{
  text-decoration: none;
  background-color: #E1E4ED;
  color: black !important;
}
.table{
  color: black;
}
.buttonSection{
  border: 2px solid #91959B;
  border-radius: 5px 5px 0 0;
}
.buttonSection img{
  width: 80px;
  height: 80px;
  cursor: pointer;
}
.overview{
  justify-content: space-between;
}
.overview .over-count{
  font-size: 20px;
  font-weight: bold;
  text-align: center;
}
.bgChange{
  background-color: #E1E4ED;
}
.editSection img{
  width: 40px;
  height: 40px;
  cursor: pointer;
}
.modal-body{
  text-align: center;
  font-size: 15px;
}
.name{
  background-color: #00519C;
  border-radius: 20px;
  cursor: pointer;
}
.right-image{
  margin-right: 20px;
}

/*
animation section
 */
 .fade-enter-active, .fade-leave-active {
  transition: all .5s ease;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  transform: translateY(10px);
  opacity: 0;
}
</style>
