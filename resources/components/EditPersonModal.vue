<template>
  <div class="modal fade" id="editPersonModal" tabindex="-1" role="dialog" aria-labelledby="editPersonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPersonModalLabel">Edit Person</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="updatePerson">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" v-model="person.name" required>
            </div>
            <div class="form-group">
              <label for="age">Age</label>
              <input type="number" class="form-control" id="age" v-model="person.age" required>
            </div>
            <div class="form-group">
              <label for="gender">Gender</label>
              <select class="form-control" id="gender" v-model="person.gender" required>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['person'],
  methods: {
    updatePerson() {
      axios.put(`/api/persons/${this.person.id}`, this.person)
        .then(response => {
          this.$emit('person-updated', response.data);
          $('#editPersonModal').modal('hide');
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>

<style scoped>
.modal-body {
  overflow-y: auto;
}
</style>
