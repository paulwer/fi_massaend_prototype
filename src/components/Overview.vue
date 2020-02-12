<template>
  <div class="Overview">
    <b-jumbotron class="mt-4">
    <template v-slot:header>Übersicht</template>
    <p>
      Aktuelle Aufträge in Bearbeitung durch ihren User.
    </p>
    <table>
      <tr v-if="tickets.length!=0">
        <th class="px-1">TicketNr.</th>
        <th class="px-1">AuftragsNr.</th>
        <th class="px-1">Status</th>
        <th class="px-1">SRPlus</th>
        <th class="px-1"></th>
      </tr>
      <tr v-for="item in tickets" :key="item">
        <td><router-link class="text-secondary text-decoration-none" :to="'/auftrag/'+ item.id">{{item.srplus_ticketnr}}</router-link></td>
        <td><router-link class="text-secondary text-decoration-none" :to="'/auftrag/'+ item.id">{{item.auftragsnr}}</router-link></td>
        <td><router-link class="text-secondary text-decoration-none" :to="'/auftrag/'+ item.id">{{item.status}}</router-link></td>
        <td class="text-center"><a class="text-color-global font-weight-bold text-uppercase" :href="'https://sus.intern/Ticket/'+item.srplus_ticketnr">-></a></td>
        <td class="text-center"><a class="text-color-global font-weight-bold text-uppercase" v-b-popover.hover.top="'Aus Ansicht entfernen'">X</a></td>
      </tr>
    </table>
      <div v-for="item in tickets" :key="item">
        
      </div>
    <b-button variant="outline-dark" class="my-2" @click="$router.replace('/auftrag/new');">Neuer Auftrag</b-button><br>
  </b-jumbotron>
  </div>
</template>

<script>
export default {
  name: 'Overview',
  props: ['tickets']
}
</script>
<style>

</style>