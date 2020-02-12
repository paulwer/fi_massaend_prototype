<template>
  <div class="home my-4">
    <b-container class="h-100">
      <b-jumbotron>
        <template v-slot:header>Massenänderungsaufträge</template>
        <b-container fluid>
          <b-row v-if="loaded">
            <b-form-group
              label="Filter"
              label-cols-sm="3"
              label-align-sm="right"
              label-size="sm"
              label-for="filterInput"
              class="mb-0"
            >
              <b-input-group size="sm">
                <b-form-input
                  v-model="filter"
                  type="search"
                  id="filterInput"
                  placeholder="Suche"
                ></b-form-input>
                <b-input-group-append>
                  <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </b-row>
          <b-row>
            <b-table v-if="loaded" striped hover :items="data" :fields="fields" :filter="filter" :current-page="currentPage" :per-page="perPage">
              <template v-slot:cell(id)="data">
                <!-- `data.value` is the value after formatted by the Formatter -->
                <router-link class="text-color-global" :to="'/auftrag/'+data.value">-></router-link>
              </template>
              <template v-slot:cell(auftrags_nr_spk)="data">
                <!-- `data.value` is the value after formatted by the Formatter -->
                <a
                  class="text-color-global"
                  target="_blank"
                  :href="hosts.srplus.ticket+data.value"
                >{{ data.value }}</a>
              </template>
              <template v-slot:cell(prozess_name)="data">
                <!-- `data.value` is the value after formatted by the Formatter -->
                <a
                  class="text-color-global"
                  target="_blank"
                  :href="hosts.dynshandbuch.function+data.value"
                >{{ data.value }}</a>
              </template>
            </b-table>
          </b-row>
          <b-row v-if="!loaded" class="m-5">Daten werden geladen...</b-row>
          <hr v-if="loaded">
          <b-row v-if="loaded">
            <b-col sm="5" md="6" class="my-1">
              <b-form-group
                label="Per page"
                label-cols-sm="6"
                label-cols-md="4"
                label-cols-lg="3"
                label-align-sm="right"
                label-size="sm"
                label-for="perPageSelect"
                class="mb-0"
              >
                <b-form-select
                  v-model="perPage"
                  id="perPageSelect"
                  size="sm"
                  :options="pageOptions"
                ></b-form-select>
              </b-form-group>
            </b-col>

            <b-col sm="7" md="6" class="my-1">
              <b-pagination
                v-model="currentPage"
                :total-rows="totalRows"
                :per-page="perPage"
                align="fill"
                size="sm"
                class="my-0"
              ></b-pagination>
            </b-col>
          </b-row>
        </b-container>
      </b-jumbotron>
    </b-container>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "list",
  props: {
    hosts: {
      type: Object
    }
  },
  data() {
    return {
      data: null,
      loaded: false,
      fields: [
        { key: "id", label: "" },
        { key: "auftrags_nr_spk", label: "TicketNr.", sortable: true },
        { key: "auftrags_nr_bws", label: "AuftragsNr.", sortable: true },
        { key: "prozess_name", label: "Prozess", sortable: true },
        { key: "status", label: "Status", sortable: true },
        { key: "bearbeiter_bws", label: "Bearbeiter", sortable: true },
        { key: "eingangs_datum", label: "Erstelldatum", sortable: true }
      ],
      totalRows: 0,
      filter: null,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10,20,50]
    };
  },
  methods: {
    setDefault() {
      this.data = [
        {
          id: 1,
          auftrags_nr_spk: 12345678,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 24681236,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 21365489,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 20365459,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 76513256,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 78945213,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 24681236,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 21365489,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 20365459,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 76513256,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 78945213,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 24681236,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 21365489,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 20365459,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 76513256,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 78945213,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 94321456,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 84521365,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        },
        {
          id: 1,
          auftrags_nr_spk: 45623598,
          auftrags_nr_bws: 5678,
          prozess_name: "MASS_AEND_TEST",
          status: "R",
          bearbeiter_bws: "J511670",
          eingangs_datum: "05.03.1999",
        }
      ];
      this.totalRows=this.data.length;
      this.loaded = true;
    }
  },
  created: function() {
    setTimeout(this.setDefault, 1000);
  }
};
</script>

<style scoped>
td,
th {
  padding: 2px;
}
</style>
