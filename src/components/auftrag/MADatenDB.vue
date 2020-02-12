<template>
  <div class="maoverviewdb text-secondary">
    <span class="text-color-global">MASS_AEND_DATEN</span>
    <hr class="m-0 p-0" />
        <div v-if="data.count>0">
    <span>Anzahl:</span> {{ data.count }}<br>
    <router-link class="text-secondary" :to="'/auftrag/'+$route.params.id+'/daten'">-> Auszug anzeigen</router-link>
        </div>
        <div v-else>
          keine Daten selektiert!<br>
          <router-link class="text-secondary" :to="'/auftrag/'+$route.params.id+'/data'">-> Massenänderungsauftrag anpassen</router-link>
        </div>
  </div>
</template>


<script>
export default {
  name: "MAOverviewDB",
  props: {
    data: {
      type: Object
    }
  }
};
</script>

<style scoped>
.collapse-link {
  cursor: pointer;
}
</style>
