<template>
  <div class="footer">
    <b-container fluid>
      <b-row>
        <b-col class="text-left pt-1">
          <span id="popover-target-author" class="text-secondary">Paul Werner</span>
          <b-popover target="popover-target-author" triggers="hover" placement="top">
            <template v-slot:title>Verantwortung für Tool</template>
            <div class="text-secondary mx-2">J511670</div>
            <div class="text-secondary mx-2">
              E-Mail:
              <a href="mailto:paul.werner@f-i.de">paul.werner@f-i.de</a>
            </div>
            <div class="text-secondary mx-2">Tel: 21853</div>
          </b-popover>
        </b-col>
        <b-col class="text-right pt-1">
          <a class="text-secondary mx-2" target="_blank" href="https://sus.intern">SRPlus</a>
          <a
            class="text-secondary mx-2"
            target="_blank"
            href="N:\Funktionen\DynS-public\Doku\Bankfl. Baukasten\HTML_Kompendium\Handbuecher\Handbuch_aktuelles_Release_int\index.htm"
          >DynS-Handbuch</a>
          <a
            class="text-secondary mx-2"
            target="_blank"
            href="http://beta92.intern/WebEnabler/"
          >Beta92</a>
          <span id="popover-target-info" class="text-secondary mx-2">Info</span>
          <b-popover target="popover-target-info" triggers="hover" placement="top">
            <template v-slot:title>Zusätzliche Informationen</template>
            <div>
              <a class="text-secondary mx-2" target="_blank" href="N:\Funktionen\Datenaend\MAD\Knowhow-Massenänderung\Info_Massendatenänderung\DHTML_Auswahl.html">MAD Wissens Navigation</a>
            </div>
            <div>
              <a class="text-secondary mx-2" target="_blank" href="https://wiki.intern/pages/viewpage.action?spaceKey=mad&title=MAD+Wiki">Allgemeines Wiki</a>
            </div>
            <div>
              <a class="text-secondary mx-2" target="_blank" href="N:\Funktionen\Datenaend\Info">Info Ordner</a>
            </div>
            <div>
              <a class="text-secondary mx-2" target="_blank" href="N:\Funktionen\IDV-Aend">Ticketdaten (IDV-Aend)</a>
            </div>
          </b-popover>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "Footer"
};
</script>

<style>
.footer {
  position: fixed;
  bottom: 0%;
  width: 100%;
  background-color: #e0e0e0;
  opacity: 1;
  border-radius: 1px;
  border-color: black;
}
</style>
