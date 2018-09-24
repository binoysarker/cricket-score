<template lang="html">
  <section class="ScoreSheet">

    <div class="teamScore">
      <div class="customImage">
        <div class="circle1"></div>
        <div class="text1">WC</div>
      </div>
      <span class="Name">WarWickshirn CCC</span>
      <span class="Score">12/0</span>
    </div>
    <div class="teamScore">
      <div class="customImage">
        <div class="circle2"></div>
        <div class="text2">WC</div>
      </div>
      <span class="Name">Surrey CCC</span>
      <span class="Score"></span>
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
              <tr>
                <td class="name">Batter 1</td>
                <td>4</td>
                <td>4</td>
                <td>0</td>
                <td>0</td>
              </tr>
              <tr>
                <td class="name">Batter 2</td>
                <td>4</td>
                <td>4</td>
                <td>0</td>
                <td>0</td>
              </tr>
              <tr>
                <td>PARTNERSHIP</td>
                <td>4</td>
                <td>4</td>
                <td>0</td>
                <td>0</td>
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
              <tr>
                <td class="name">bowler 1</td>
                <td>4</td>
                <td>4</td>
                <td>0</td>
                <td>0</td>
              </tr>
              <tr>
                <td class="name">bowler 2</td>
                <td>4</td>
                <td>4</td>
                <td>0</td>
                <td>0</td>
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
      <div class="row overview">
        <img src="/image/cross-image.jpg" alt="">
        <span class="over-count">
          Over 1.2
          <br>
          LEG BY
        </span>
        <img src="/image/right-image.jpg" alt="">
      </div>
      <div class="row">
        <table class="table table-borderless table-sm">
          <tbody class="tbody-light">
            <tr>
              <td v-for="(item,index) in buttonImagesRow1" :key="item.id">
                <img :src="item.location" alt="">
              </td>
            </tr>
            <tr>
              <td v-for="(item,index) in buttonImagesRow2" :key="item.id">
                <img :src="item.location" alt="">
              </td>
            </tr>
            <tr>
              <td v-for="(item,index) in buttonImagesRow3" @click="selectNewBatter(item)" :key="item.id">
                <img :src="item.location" alt="">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /button section -->
    <!-- modal section -->
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

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
        <button type="button" @click="goToNextPage()" class="btn btn-primary">Continue this over</button>
      </div>
    </div>
  </div>
</div>
    <!-- /modal section -->
  </section>
</template>

<script>
import {bus} from '../../app';
export default {
  data(){
    return {
      showModal:false,
      buttonImagesRow1:[
        {id:1,location:'/image/empty-circle.jpg',active:false},
        {id:2,location:'/image/button-one.jpg',active:false},
        {id:3,location:'/image/button-two.jpg',active:false},
        {id:4,location:'/image/button-three.jpg',active:false},
        {id:5,location:'/image/button-fill.jpg',active:false}
      ],
      buttonImagesRow2:[
        {id:1,location:'/image/button-four.jpg',active:false},
        {id:2,location:'/image/button-six.jpg',active:false},
        {id:3,location:'/image/button-five.jpg',active:false},
        {id:4,location:'/image/empty-circle.jpg',active:false},
        {id:5,location:'/image/button-action.jpg',active:false}
      ],
      buttonImagesRow3:[
        {id:1,location:'/image/button-black.jpg',active:false},
        {id:2,location:'/image/button-black.jpg',active:false},
        {id:3,location:'/image/button-black.jpg',active:false},
        {id:4,location:'/image/button-black.jpg',active:false},
        {id:5,location:'/image/button-wicket.jpg',active:false},
      ]
    }
  },
  watch:{
    showModal(value){
      if (value) {
        $('#exampleModal').modal('toggle');
      }
    }
  },
  methods:{
    goToNextPage(){
      this.$router.push({path:'/wicket'});
      $('#exampleModal').modal('hide');
    },
    selectNewBatter(item){
      if (item.location == '/image/button-wicket.jpg') {
        this.$router.push({path:'/new-batter'});
      }
    },
  },
  mounted(){
    bus.$emit('resetMenu','/score-sheet');
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
}
</style>
