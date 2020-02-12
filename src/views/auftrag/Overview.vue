<template>
  <div class="home my-4">
    <b-container class="h-100">
      <b-jumbotron>
        <template v-slot:header>
          <b-container>
            <b-row>
              <b-col>Massenänderungsauftrag</b-col>
              <b-col v-if="sendable">
                <b-button @click="sendproductive">Produktivumsetzung</b-button>
              </b-col>
            </b-row>
          </b-container>
        </template>
        <div v-if="loaded">
          <div
            v-if="data.idv_hilf.count>0 && data.mass_aend_daten.count>0 && data.idv_hilf.count!=data.mass_aend_daten.count && data.mass_aend_auftrag.data.status"
            class="warning-elem"
          >Die Anzahl der selektierten Datensätze stimmt nicht mit der Anzahl der Datensätze in der IDV_HILF-Tabelle überein!</div>
          <div
            v-if="data.idv_hilf.count==0 && data.mass_aend_daten.count==0 && !data.mass_aend_auftrag.data.status"
            class="task-elem"
          >
            Noch keine Daten vorhanden:
            <router-link
              :to="'/auftrag/'+$route.params.id+'/data'"
            >Jetzt Daten zu Massenänderungsauftrag anlegen!</router-link>
          </div>
          <div
            v-if="data.idv_hilf.count>0 && data.mass_aend_daten.count==0 && !data.mass_aend_auftrag.data.status"
            class="task-elem"
          >
            Hilfsdatenbank geladen.
            <router-link
              :to="'/auftrag/'+$route.params.id+'/data'"
            >Jetzt Massenänderungsauftrag anlegen!</router-link>
          </div>
          <div
            v-if="data.idv_hilf.count>0 && data.mass_aend_daten.count>0 && !data.mass_aend_auftrag.data.status"
            class="warning-elem"
          >Unbekannter Fehler: Daten in MASS_AEND_DATEN gefunden, aber kein Auftrag in MASS_AEND_AUFTRAG gefunden.</div>
          <div
            v-if="data.idv_hilf.count>0 && data.mass_aend_daten.count==0 && data.mass_aend_auftrag.data.status"
            class="warning-elem"
          >
            Keine selektierten Daten gefunden. Bitte bis Ende der Ausführung warten oder SQL anpassen.
            <router-link :to="'/auftrag/'+$route.params.id+'/data'">Massenänderungsauftrag anpassen!</router-link>
          </div>
        </div>
        <b-container
          v-if="loaded && !(data.idv_hilf.count==0 && data.mass_aend_daten.count==0 && !data.mass_aend_auftrag.data.status)"
          fluid
          class="text-seondary"
        >
          <b-row>
            <b-col>
              <MAOverviewDB
                v-bind="{ sysdata: data.sysauftrag, data: data.mass_aend_auftrag.data, hosts }"
              />
            </b-col>
            <b-col>
              <div class="mb-2">
                <MAIDVHilfDB v-bind="{ data: data.idv_hilf }" />
              </div>
              <div class="mt-2">
                <MADatenDB v-bind="{ data: data.mass_aend_daten }" />
              </div>
            </b-col>
          </b-row>
        </b-container>
        <div v-if="!loaded">Daten werden abgerufen...</div>
        <hr class="mt-5" />
        <b-button @click="testdaten1">T1</b-button>
        <b-button @click="testdaten2">T2</b-button>
        <b-button @click="testdaten5">T3</b-button>
        <b-button @click="testdaten4">T4</b-button>
        <b-button @click="testdaten3">T5</b-button>
      </b-jumbotron>
    </b-container>
  </div>
</template>

<script>
import MAOverviewDB from "@/components/auftrag/MAOverviewDB";
import MAIDVHilfDB from "@/components/auftrag/MAIDVHilfDB";
import MADatenDB from "@/components/auftrag/MADatenDB";
export default {
  name: "auftrag_overview",
  components: {
    MAOverviewDB,
    MAIDVHilfDB,
    MADatenDB
  },
  props: {
    hosts: {
      type: Object
    }
  },
  data() {
    return {
      data: null,
      loaded: null,
      info: null,
      sendable: false
    };
  },
  mounted() {
    // Get Data from
    this.loaded = false;
    fetch(this.hosts.ftp.mt91, {
      method: "GET"
    })
      .then(res => res.json())
      .then(res => {
        this.data = res.data;
      })
      .catch(error => {
        window.console.log(
          "Keine oder falsche Antwort von Server: " +
            this.hosts.backend +
            "auftrag/" +
            this.$route.params.id +
            " Es werden Testdaten verwendet " +
            error
        );
        this.testdaten0();
      });
  },
  methods: {
    sendproductive() {
      if (this.sendable) {
        this.$router.push({name: "auftrag_send", params:{id: this.$route.params.id}});
      }
    },
    testdaten0() {
      this.data = {
        sysauftrag: {},
        mass_aend_auftrag: {
          count: 0,
          data: {
            status: null
          }
        },
        mass_aend_daten: {
          count: 0
        },
        idv_hilf: {
          count: 0
        }
      };
      this.loaded = true;
    },
    testdaten1() {
      this.data = {
        sysauftrag: {},
        mass_aend_auftrag: {
          count: 0,
          data: {
            status: null
          }
        },
        mass_aend_daten: {
          count: 0
        },
        idv_hilf: {
          count: 2000
        }
      };
      this.loaded = true;
    },
    testdaten2() {
      this.data = {
        sysauftrag: {},
        mass_aend_auftrag: {
          count: 0,
          data: {
            srplus_ticketnr: 12345678,
            auftragsnr: 6784,
            inr: "010",
            region: "BY",
            gruppe: 1,
            auftrags_typ: "B",
            bearbeiter_bws: "J511670",
            beschreibung: "Testdaten",
            prozess_name: "DYNS_PROZESS",
            aend_pgm: "MAD01010",
            aend_pgm_parm: "MAIL=NEIN",
            mass_aend_grps_schl: "1",
            mass_aend_spk_kst: "000",
            status: "R"
          }
        },
        mass_aend_daten: {
          count: 0
        },
        idv_hilf: {
          count: 2000
        }
      };
      this.loaded = true;
      this.sendable = true;
    },
    testdaten3() {
      this.data = {
        sysauftrag: {},
        mass_aend_auftrag: {
          count: 0,
          data: {
            status: null
          }
        },
        mass_aend_daten: {
          count: 199
        },
        idv_hilf: {
          count: 2000
        }
      };
      this.loaded = true;
    },
    testdaten4() {
      this.data = {
        sysauftrag: {},
        mass_aend_auftrag: {
          count: 0,
          data: {
            srplus_ticketnr: 12345678,
            auftragsnr: 6784,
            inr: "010",
            region: "BY",
            gruppe: 1,
            auftrags_typ: "B",
            bearbeiter_bws: "J511670",
            beschreibung: "Testdaten",
            prozess_name: "DYNS_PROZESS",
            aend_pgm: "MAD01010",
            aend_pgm_parm: "MAIL=NEIN",
            mass_aend_grps_schl: "1",
            mass_aend_spk_kst: "000",
            status: "R"
          }
        },
        mass_aend_daten: {
          count: 200
        },
        idv_hilf: {
          count: 2000
        }
      };
      this.loaded = true;
    },
    testdaten5() {
      this.data = {
        sysauftrag: {},
        mass_aend_auftrag: {
          count: 0,
          data: {
            srplus_ticketnr: 12345678,
            auftragsnr: 6784,
            inr: "010",
            region: "BY",
            gruppe: 1,
            auftrags_typ: "B",
            bearbeiter_bws: "J511670",
            beschreibung: "Testdaten",
            prozess_name: "DYNS_PROZESS",
            aend_pgm: "MAD01010",
            aend_pgm_parm: "MAIL=NEIN",
            mass_aend_grps_schl: "1",
            mass_aend_spk_kst: "000",
            status: "R"
          }
        },
        mass_aend_daten: {
          count: 1999
        },
        idv_hilf: {
          count: 2000
        }
      };
      this.loaded = true;
    }
  }
};
</script>
