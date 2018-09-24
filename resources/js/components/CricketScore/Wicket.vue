<template lang="html">
  <section class="wicketSection">
    <!-- match setting section -->
    <ul class="list-group menu3">

      <li class="list-group-item justify-content-between">
        Batter Out
        <div class="form-group">
          <!-- <label for="exampleSelect1">Example select</label> -->
          <select class="form-control" id="exampleSelect1">
            <option>batter name 1</option>
            <option>batter name 2</option>
          </select>
        </div>
      </li>
      <li class="list-group-item justify-content-between">
        Dismissal Type
        <div class="form-group">
          <!-- <label for="exampleSelect1">Example select</label> -->
          <select class="form-control" id="exampleSelect1">
            <option>Select</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
      </li>
      <li class="list-group-item justify-content-between">
        Fielder(Assist)
        <div class="form-group">
          <!-- <label for="exampleSelect1">Example select</label> -->
          <select class="form-control" id="exampleSelect1">
            <option>Select</option>
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
</template>

<script>
import {bus} from '../../app';
export default {
  mounted(){
    bus.$emit('resetMenu','wicket');
  },
}
</script>

<style lang="css" scoped>
.wicketSection{
  font-size: 15px;
  font-weight: bold;
}
.form-group{
  float: right;
}
</style>
