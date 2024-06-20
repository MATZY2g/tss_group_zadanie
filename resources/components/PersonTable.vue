<template>
  <div>
    <div class="d-flex mb-3 ">
      <div class="me-2">
        <input v-model="search" @input="fetchPersons" placeholder="Search..." class="form-control me-2"/>
      </div>
      <button @click="openCreateModal" class="btn btn-success">Create New User</button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="person in persons" :key="person.id">
          <td>{{ person.id }}</td>
          <td>{{ person.name }}</td>
          <td>{{ person.age }}</td>
          <td>{{ person.gender }}</td>
          <td>
            <button @click="openEditModal(person)" class="btn btn-primary btn-sm me-2">Edit</button>
            <button @click="deletePerson(person.id)" class="btn btn-danger btn-sm">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <CreatePersonModal @person-created="fetchPersons" />
    <EditPersonModal :person="selectedPerson" @person-updated="fetchPersons" />
  </div>
</template>

<script>
import axios from 'axios';
import CreatePersonModal from './CreatePersonModal.vue';
import EditPersonModal from './EditPersonModal.vue';

export default {
  components: {
    CreatePersonModal,
    EditPersonModal
  },
  data() {
    return {
      persons: [],
      search: '',
      selectedPerson: {}
    };
  },
  methods: {
    fetchPersons() {
      axios.get(`/api/persons`, { params: { search: this.search } })
        .then(response => {
          this.persons = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    deletePerson(id) {
      axios.delete(`/api/persons/${id}`)
        .then(() => {
          this.fetchPersons();
        })
        .catch(error => {
          console.error(error);
        });
    },
    openEditModal(person) {
      this.selectedPerson = Object.assign({}, person);
      $('#editPersonModal').modal('show');
    },
    openCreateModal() {
      $('#createPersonModal').modal('show');
    }
  },
  mounted() {
    this.fetchPersons();
  }
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
