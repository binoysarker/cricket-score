<template lang="html">
  <section class="teamsSection">
    <div class="jumbotron">
      <h1 class="display-3">Select Teams</h1>
      <div class="form-group">
        <select class="form-control" id="exampleSelect1">
          <option>Select Team A</option>
          <option>team 1</option>
          <option>team 2</option>
          <option>team 3</option>
          <option>team 4</option>
        </select>
      </div>
      <h1 class="verses">Vs</h1>
      <div class="form-group">
        <select class="form-control" id="exampleSelect1">
          <option>Select Team B</option>
          <option>team 1</option>
          <option>team 2</option>
          <option>team 3</option>
          <option>team 4</option>
        </select>
      </div>
      <p class="lead">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Create New
        </button>
        <button type="button" class="btn btn-primary" name="done">Done</button>
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
              <input type="text" class="form-control" id="inputText" aria-describedby="emailHelp" placeholder="Team Name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {bus} from '../../app';
export default {
  mounted(){
    bus.$emit('resetMenu','teams');
  },
}
</script>

<style lang="css" scoped>
.verses{
  text-align: center;
}
</style>
