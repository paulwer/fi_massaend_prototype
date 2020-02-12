<template>
  <div class="home my-4">
    <b-container class="h-100">
      <b-jumbotron>
        <template v-slot:header>
          <b-container>
            <b-row>
              <b-col>Daten anpassen</b-col>
              <b-col cols="3">
                <b-button @click="save">Speichern</b-button>
              </b-col>
            </b-row>
          </b-container>
        </template>
        <b-tabs content-class="mt-3" justified v-model="tabIndex">
          <b-tab title="Allgemeine Daten" :title-link-class="linkClass(0)" active>
            <b-container>
              <b-row>
                <b-col>
                  <label for="input-with-list">DynS-Funktion:</label>
                  <b-form-input list="input-list" id="input-with-list"></b-form-input>
                  <b-form-datalist id="input-list" :options="dynsoptions"></b-form-datalist>

                  <label class="mr-sm-2" for="inline-form-custom-select-auft-typ">Auftragstyp</label>
                  <b-form-select
                    class="mb-2 mr-sm-2 mb-sm-0"
                    :value="null"
                    :options="{ 'A': 'Pro Bezugsobjekt', 'B': 'Je nach Selektion' }"
                    id="inline-form-custom-select-auft-typ"
                  >
                    <template v-slot:first>
                      <option :value="null">Auftragstyp wählen...</option>
                    </template>
                  </b-form-select>
                  <label class="mr-sm-2" for="inline-form-custom-select-ko-schl">Kostenschlüssel</label>
                  <b-form-select
                    class="mb-2 mr-sm-2 mb-sm-0"
                    :value="null"
                    :options="{ '1': 'Normale', '2': 'Kostenfrei', '3': 'Seperate Abrechnung' }"
                    id="inline-form-custom-select-ko-schl"
                  >
                    <template v-slot:first>
                      <option :value="null">Kostenschlüssel wählen...</option>
                    </template>
                  </b-form-select>
                </b-col>
              </b-row>
              <b-row class="justify-content-center">
                <b-col class="text-center">
                  <br />...
                  <br />weitere Einstellungen folgen
                </b-col>
              </b-row>
            </b-container>
          </b-tab>
          <b-tab title="Datenselektion" :title-link-class="linkClass(1)">
            <b-form-textarea
              id="textarea"
              v-model="sqlselect"
              placeholder="Hier muss das SELECT für die Datenselektion definiert werden"
              rows="13"
            ></b-form-textarea>
          </b-tab>
          <b-tab title="Testlisten-Selektion" :title-link-class="linkClass(2)">
            <b-form-textarea
              id="textarea"
              v-model="sqltest"
              placeholder="Hier muss das SELECT für die Testlistenselektion definiert werden"
              rows="13"
            ></b-form-textarea>
          </b-tab>
        </b-tabs>
      </b-jumbotron>
    </b-container>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "list",
  components: {},
  data() {
    return {
      // Data
      sqlselect: "SELECT * FROM aTESTdatabase",
      sqltest: "SELECT nothing",
      // Params
      tabIndex: 1,
      dynsoptions: ["MASS_AEND_TEST", "A_SECOND_FUNCTION", "AN_OTHER_ONE"]
    };
  },
  methods: {
    linkClass(idx) {
      if (this.tabIndex !== idx) {
        return ["text-white"];
      }
    },
    save() {
      this.$router.push({path: './'});
    }
  }
};
</script>
