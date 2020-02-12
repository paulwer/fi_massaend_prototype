<template>
  <div class="create">
    <b-container class="h-100 mt-4">
      <b-jumbotron>
        <template v-slot:header>Neuer Massenänderungsauftrag</template>
        <b-tabs content-class="mt-3" justified v-model="tabIndex">
          <b-tab title="Vorlage" active :title-link-class="linkClass(0)">
            <div v-if="selected.length==0" class="text-center m-3">
              <b-button @click="tabIndex++">Ohne Vorlage fortfahren</b-button>
            </div>
            <div v-else class="text-center m-3">
              <b-button @click="tabIndex++">Vorlage '{{ selected[0].name}}' verwenden</b-button>
            </div>
            <b-table small ref="toptable" :items="data" :fields="topfields">
              <template v-slot:cell(actions)="row">
                <b-button
                  size="sm"
                  @click="row.toggleDetails"
                >{{ row.detailsShowing ? 'Hide' : 'Show' }} Details</b-button>
              </template>
              <template v-slot:row-details="row">
                <b-table
                  small
                  ref="dynsfunktionentable"
                  selectable
                  :select-mode="selectMode"
                  :items="row.item.dynsfunktionen"
                  :fields="dynsfunktionenfields"
                  @row-selected="onRowSelecteddyns"
                >
                  <template v-slot:cell(selected)="{ rowSelected }">
                    <template v-if="rowSelected">
                      <span aria-hidden="true">&check;</span>
                      <span class="sr-only">Selected</span>
                    </template>
                    <template v-else>
                      <span aria-hidden="true">&nbsp;</span>
                      <span class="sr-only">Not selected</span>
                    </template>
                  </template>
                  <template v-slot:cell(actions)="row">
                    <b-button
                      size="sm"
                      @click="row.toggleDetails"
                    >{{ row.detailsShowing ? 'Hide' : 'Show' }} Details</b-button>
                  </template>
                  <template v-slot:row-details="row">
                    <b-table
                      small
                      ref="vorlagentable"
                      selectable
                      :select-mode="selectMode"
                      :items="row.item.vorlagen"
                      :fields="vorlagenfields"
                      @row-selected="onRowSelectedvorlage"
                    >
                      <template v-slot:cell(selected)="{ rowSelected }">
                        <template v-if="rowSelected">
                          <span aria-hidden="true">&check;</span>
                          <span class="sr-only">Selected</span>
                        </template>
                        <template v-else>
                          <span aria-hidden="true">&nbsp;</span>
                          <span class="sr-only">Not selected</span>
                        </template>
                      </template>
                    </b-table>
                  </template>
                </b-table>
              </template>
            </b-table>
          </b-tab>
          <b-tab title="Institutsdaten" :title-link-class="linkClass(1)">
            <b-form @submit="onSubmit">
              <b-container fluid>
                <b-row>
                  <b-col cols="6">
                    <b-form-group id="input-group-1" label="SRPlus-TicketNR.:" label-for="input-1">
                      <b-form-input
                        id="input-1"
                        v-model="form.srplus_ticketnr"
                        required
                        placeholder="SRPlus-TicketNR."
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                  <b-col cols="6">
                    <b-form-group id="input-group-2" label="Auftragsnr:" label-for="input-2">
                      <b-form-input
                        id="input-2"
                        v-model="form.auftragsnr"
                        required
                        placeholder="Auftragsnr"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>
                <b-row>
                  <b-col>
                    <b-form-group id="input-group-3" label="INR:" label-for="input-3">
                      <b-form-input id="input-3" v-model="form.inr" required placeholder="INR"></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col>
                    <b-form-group id="input-group-4-5" label="Weiteres:">
                    <b-container fluid class="m-0 p-0">
                      <b-row>
                        <b-col cols="6">
                          <b-form-input
                            id="input-4"
                            v-model="form.region"
                            required
                            placeholder="Region"
                          ></b-form-input>
                        </b-col>
                        <b-col cols="6">
                          <b-form-input
                            id="input-5"
                            v-model="form.gruppe"
                            required
                            placeholder="Gruppe"
                          ></b-form-input>
                        </b-col>
                      </b-row>
                    </b-container>
                  </b-form-group>
                  </b-col>
                  
                </b-row>
              </b-container>

              <div class="text-center m-3">
                <b-button type="submit" class="px-5">Anlage</b-button>
              </div>
            </b-form>
          </b-tab>
        </b-tabs>
      </b-jumbotron>
    </b-container>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "create",
  components: {},
  data() {
    return {
      // Data
      form: {
        // Formdaten
        srplus_ticketnr: null,
        auftragsnr: null,
        inr: null,
        region: null,
        gruppe: null
      },
      selected: [], // Vorlage selektiert
      // Preset Values
      tabIndex: 1,
      topfields: [
        { key: "selected", label: "" },
        { key: "name", label: "Name" },
        { key: "beschreibung", label: "Beschreibung" },
        { key: "actions", label: "Actions" }
      ],
      dynsfunktionenfields: [
        { key: "selected", label: "" },
        { key: "name", label: "Dyns-Funktion" },
        { key: "beschreibung", label: "" },
        { key: "actions", label: "" }
      ],
      vorlagenfields: [
        { key: "selected", label: "" },
        { key: "name", label: "Vorlagen" },
        { key: "beschreibung", label: "" },
        { key: "actions", label: "" }
      ],
      data: [
        {
          name: "Prozessgruppe1",
          beschreibung: "Text",
          dynsfunktionen: [
            {
              name: "MASS_AEND_TEST",
              beschreibung: "BlaBla",
              vorlagen: [{ id: 1, name: "Vorlage 1", beschreibung: "Test" }]
            },
            {
              name: "MASS_AEND_TEST2",
              beschreibung: "BlaBla",
              vorlagen: [{ id: 1, name: "Vorlage 1", beschreibung: "Test" }]
            }
          ]
        }
      ],
      selectMode: "single"
    };
  },
  methods: {
    onRowSelecteddyns(item) {
      if (this.$refs.vorlagentable) this.$refs.vorlagentable.clearSelected();
      this.selected = item;
    },
    onRowSelectedvorlage(item) {
      this.$refs.dynsfunktionentable.clearSelected();
      this.selected = item;
    },
    onSubmit(evt) {
      evt.preventDefault();
      let success=null;
      success=true;
      // Wenn Erfolgreich, dann leite weiter
      if (success) {
      this.$router.push({ name: 'auftrag_data', params: { id: '2' } });    
      }
      },
     linkClass(idx) {
        if (this.tabIndex !== idx) {
          return ['text-white']
        }
     }
  }
};
</script>
