<template>
  <div class="maoverviewdb text-secondary">
    <span class="text-color-global">IDV_HILF</span>
    <hr class="m-0 p-0" />
    <div v-if="data.count>0">
      <span>Anzahl:</span> {{ data.count }}<br>
      <router-link class="text-secondary" :to="'/auftrag/'+$route.params.id+'/idvhilf'">-> Auszug anzeigen</router-link>
    </div>
    <div v-else>
      keine Hilfsdaten geladen!<br>
      <router-link class="text-secondary" :to="'/auftrag/'+$route.params.id+'/idvhilf'">-> Jetzt laden</router-link>
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
