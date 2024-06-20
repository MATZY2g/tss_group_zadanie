<template>
  <div id="app" class="container mt-5">
    <PersonTable/>
  </div>
</template>

<script>
import PersonTable from './components/PersonTable.vue';

export default {
  name: 'App',
  components: {
    PersonTable
  }
};
</script>

