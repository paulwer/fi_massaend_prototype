<template>
  <div class="maoverviewdb text-secondary">
    <span class="text-color-global">MASS_AEND_AUFTRAG</span>
    <hr class="m-0 p-0" />
    <table v-if="data.status">
      <tr>
        <th>Eigenschaft</th>
        <th>Wert</th>
      </tr>
      <tr>
        <td
          v-b-popover.hover.top="
                  'Dies ist die Ticketnummer unter welcher die Änderung vom Institut beauftragt wurde!'
                "
          title="Tabellenfeld: auftrags_nr_spk"
        >SRPlus Ticketnummer:</td>
        <td><a class="text-secondary" target="_blank" :href="hosts.srplus.ticket+data.srplus_ticketnr">{{ data.srplus_ticketnr }}</a></td>
      </tr>
      <tr>
        <td
          v-b-popover.hover.top="
                  'Dies ist eine für die Ticketnummer eindeutige Nummer oder Zeichenfolge!'
                "
          title="Tabellenfeld: auftrags_nr_bws"
        >Auftragsnummer:</td>
        <td>{{ data.auftragsnr }}</td>
      </tr>
      <tr>
        <td
          v-b-popover.hover.top="
                  'dreistellige Institutsnummer zur eindeutigen Identifizierung in einer Region + Region + Gruppe'
                "
          title="Tabellenfeld: inr"
        >Institut:</td>
        <td>{{ data.inr }} ({{ data.region }}{{ data.gruppe }})</td>
      </tr>
      <tr>
        <td
          v-b-popover.hover.top="'Status des Auftrags'"
          title="Tabellenfeld: auftrags_status (auftrags_typ)"
        >Auftragsstatus(Type):</td>
        <td>{{ data.status }} ({{ data.auftrags_typ }})</td>
      </tr>
      <tr>
        <td v-b-popover.hover.top="''" title="Tabellenfeld: beschreibung">Beschreibung:</td>
        <td>{{ data.beschreibung }}</td>
      </tr>
      <tr>
        <td
          v-b-popover.hover.top="
                  'Die UID der Bearbeiters/Erstellers des Massenänderungsauftrag'
                "
          title="Tabellenfeld: bearbeiter_bws"
        >Bearbeiter:</td>
        <td>{{ data.bearbeiter_bws }}</td>
      </tr>
      <!-- ******************************MASS_PARM********************************** -->
      <tr>
        <td
          v-b-popover.hover.top="
                  ''
                "
          title="Tabellenfeld: prozess_name"
        >DynS-Funktion:</td>
        <td><a class="text-secondary" target="_blank" :href="hosts.dynshandbuch.function+data.prozess_name">{{ data.prozess_name }}</a></td>

      </tr>
      <tr>
        <td
          v-b-popover.hover.top="
                  ''
                "
          title="Tabellenfeld: aend_pgm"
        >Massenänderungsprogramm:</td>
        <td>{{ data.aend_pgm }}</td>
      </tr>
      <tr>
        <td
          v-b-popover.hover.top="
                  ''
                "
          title="Tabellenfeld: aend_pgm_parm"
        >Parameter:</td>
        <td>{{ data.aend_pgm_parm }}</td>
      </tr>
      <!-- ******************************ABRECHNUNG********************************* -->
      <tr>
        <td
          v-b-popover.hover.top="
                  'Schlüsselverzeichnis fehlt'
                "
          title="Tabellenfeld: mass_aend_grps_schl 	"
        >Grundpreisschlüssel:</td>
        <td>{{ data.mass_aend_grps_schl }}</td>
      </tr>
      <tr>
        <td
          v-b-popover.hover.top="
                  'Schlüsselverzeichnis fehlt'
                "
          title="Tabellenfeld: mass_aend_spk_kst 	"
        >Kostenstelle:</td>
        <td>{{ data.mass_aend_spk_kst }}</td>
      </tr>
      <!-- ********************AUSFUEHRUNG********************* -->
      <div
        @click="$root.$emit('bv::toggle::collapse', 'collapse-ausf')"
        class="collapse-link text-color-global"
      >
        Ausführung
        <hr class="m-0 p-0" />
      </div>
      <!-- Element to collapse -->
      <b-collapse id="collapse-ausf">
        <tr>
          <td
            v-b-popover.hover.top="
                  'Die UID des Freigebers der Massenänderung'
                "
            title="Tabellenfeld: frgb_uid"
            v-if="data.frgb_uid"
          >Freigeber-UID:</td>
          <td v-if="data.frgb_uid">{{ data.frgb_uid }}</td>
          <td v-else>nicht freigegeben</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td
            v-b-popover.hover.top="'Schlüsselverzeichnis fehlt'"
            title="Tabellenfeld: ausfuehr_lts"
          >ausfuehr_lts:</td>
          <td v-if="data.ausfuehr_lts">{{ data.ausfuehr_lts }}</td>
          <td v-else>nicht ausgeführt</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td
            v-b-popover.hover.top="'Schlüsselverzeichnis fehlt'"
            title="Tabellenfeld: ausfuehr_zeilen_nhst"
          >ausfuehr_zeilen_nhst:</td>
          <td v-if="data.ausfuehr_zeilen_nhst">{{ data.ausfuehr_zeilen_nhst }}</td>
          <td v-else>nicht ausgeführt</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td
            v-b-popover.hover.top="'Schlüsselverzeichnis fehlt'"
            title="Tabellenfeld: ausfuehr_art_nhst"
          >ausfuehr_art_nhst:</td>
          <td v-if="data.ausfuehr_art_nhst">{{ data.ausfuehr_art_nhst }}</td>
          <td v-else>nicht ausgeführt</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td
            v-b-popover.hover.top="'Schlüsselverzeichnis fehlt'"
            title="Tabellenfeld: ausfuehr_art_ltzt"
          >Ausführart:</td>
          <td v-if="data.ausfuehr_art_ltzt">{{ data.ausfuehr_art_ltzt }}</td>
          <td v-else>nicht ausgeführt</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td
            v-b-popover.hover.top="''"
            title="Tabellenfeld: przs_afrf_anz_fehl_d"
          >Fehlgeschlagen(D):</td>
          <td>{{ data.przs_afrf_anz_fehl_d }}</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td
            v-b-popover.hover.top="''"
            title="Tabellenfeld: przs_afrf_anz_fehl_p"
          >Fehlgeschlagen(P):</td>
          <td>{{ data.przs_afrf_anz_fehl_p }}</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td v-b-popover.hover.top="''" title="Tabellenfeld: przs_afrf_anz_info">Info:</td>
          <td>{{ data.przs_afrf_anz_info }}</td>
        </tr>
        <tr v-if="data.frgb_uid">
          <td v-b-popover.hover.top="''" title="Tabellenfeld: przs_afrf_anz_ok">Erfolgreich:</td>
          <td>{{ data.przs_afrf_anz_ok }}</td>
        </tr>
      </b-collapse>

      <!-- ********************QS********************* -->
      <div
        @click="$root.$emit('bv::toggle::collapse', 'collapse-qs')"
        class="collapse-link text-color-global"
      >
        QS
        <hr class="m-0 p-0" />
      </div>
      <!-- Element to collapse -->
      <b-collapse id="collapse-qs">
        <tr>
          <td
            v-b-popover.hover.top="
                  'SChlüsselverzeichnis fehlt'
                "
            title="Tabellenfeld: przs_afrf_qs_kz"
          >Kennzeichen:</td>
          <td>{{ data.przs_afrf_qs_kz }}</td>
        </tr>
        <tr>
          <td v-b-popover.hover.top="''" title="Tabellenfeld: przs_afrf_qs_lim">QS-Limit:</td>
          <td>{{ data.przs_afrf_qs_lim }}</td>
        </tr>
        <tr>
          <td v-b-popover.hover.top="''" title="Tabellenfeld: przs_afrf_qs_text">QS-Text:</td>
          <td>{{ data.przs_afrf_qs_text }}</td>
        </tr>
      </b-collapse>
      <div
        @click="$root.$emit('bv::toggle::collapse', 'collapse-techn')"
        class="collapse-link text-color-global"
      >
        Techn. Parameter
        <hr class="m-0 p-0" />
      </div>
      <!-- Element to collapse -->
      <b-collapse id="collapse-techn">
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: commit_ts"
          >Commit TS:</td>
          <td>{{ data.commit_ts }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    'Commitrate des Prozesses'
                  "
            title="Tabellenfeld: przs_commit_rate"
          >Commit Rate:</td>
          <td>{{ data.przs_commit_rate }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: vp_wltg_mm"
          >vp_wltg_mm:</td>
          <td>{{ data.vp_wltg_mm }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: aend_ltzt_ts"
          >Letzte Änderung:</td>
          <td>{{ data.aend_ltzt_ts }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: aend_ltzt_uid"
          >Letzte Änderung UID:</td>
          <td>{{ data.aend_ltzt_uid }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    'Kennzeichnet, dass Daten erneut selektiert werden soll'
                  "
            title="Tabellenfeld: atg_refresh_kz"
          >Refresh KZ:</td>
          <td>{{ data.atg_refresh_kz }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: sbtr_uid"
          >sbtr_uid:</td>
          <td>{{ data.sbtr_uid }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: sql_ausfuehr_dtm"
          >sql_ausfuehr_dtm:</td>
          <td>{{ data.sql_ausfuehr_dtm }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: sql_fehler_text"
          >sql_fehler_text:</td>
          <td>{{ data.sql_fehler_text }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: eingangs_datum"
          >eingangs_datum:</td>
          <td>{{ data.eingangs_datum }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: ausfuehr_adtm"
          >ausfuehr_adtm:</td>
          <td>{{ data.ausfuehr_adtm }}</td>
        </tr>
        <tr>
          <td
            v-b-popover.hover.top="
                    ''
                  "
            title="Tabellenfeld: ausfuehr_edtm"
          >ausfuehr_edtm:</td>
          <td>{{ data.ausfuehr_edtm }}</td>
        </tr>
      </b-collapse>

      <div
        @click="$root.$emit('bv::toggle::collapse', 'collapse-srplus')"
        class="collapse-link text-color-global"
      >
        Weiteres - SRPlus
        <hr class="m-0 p-0" />
      </div>
      <!-- Element to collapse -->
      <b-collapse id="collapse-srplus">
        <tr>
          <td v-b-popover.hover.top="''" title="Tabellenfeld: ticket_ktgr_2">Ticket Kategorie 2:</td>
          <td>{{ data.ticket_ktgr_2 }}</td>
        </tr>
        <tr>
          <td v-b-popover.hover.top="''" title="Tabellenfeld: ticket_ktgr_3">Ticket Kategorie 3:</td>
          <td>{{ data.ticket_ktgr_3 }}</td>
        </tr>
        <tr>
          <td v-b-popover.hover.top="''" title="Tabellenfeld: ticket_ktgr_4">Ticket Kategorie 4:</td>
          <td>{{ data.ticket_ktgr_4 }}</td>
        </tr>
      </b-collapse>
    </table>
    <span v-else>keine Daten vorhanden!</span>
  </div>
</template>

<script>
export default {
  name: "MAOverviewDB",
  props: {
    data: {
      type: Object
    },
    hosts: {
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
