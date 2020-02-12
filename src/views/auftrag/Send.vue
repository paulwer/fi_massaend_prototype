<template>
  <div class="create">
    <b-container class="h-100 mt-4">
      <b-jumbotron>
        <template v-slot:header>
          <b-container>
            <b-row>
              <b-col>Prod. Umsetzung</b-col>
              <b-col cols="2" v-if="loaded && sended!=true">
                <b-button @click="send">Job absenden</b-button>
              </b-col>
            </b-row>
          </b-container>
        </template>
        <div v-if="loaded && sended==null">
          <b-form-textarea id="textarea" v-model="jclcode" rows="13"></b-form-textarea>
        </div>
        <div v-if="!loaded && sended==null" class="text-center my-5">
          <b-spinner style="width: 5rem; height: 5rem;" label="Large Spinner" type="grow"></b-spinner>
          <br />Generierung wird durchgeführt
        </div>
        <div v-if="sended==false" class="text-center my-5">
          <b-spinner style="width: 5rem; height: 5rem;" label="Large Spinner" type="grow"></b-spinner>
          <br />JCL-Code wird an Großrechnerumgebung übergeben.
        </div>
        <div v-if="sended==true && result==null" class="text-center my-5">
          <b-spinner style="width: 5rem; height: 5rem;" label="Large Spinner" type="grow"></b-spinner>
          <br />JCL-Code wurde an Großrechnersystem übergeben.
          <br />Bitte auf Ausführungsende warten.
          <br />
          <br />
          <a class="text-secondary" href="https://beta92.intern/WebEnabler/" target="_blank">Beta92 (Web)</a>
          <br />
          <br />
          Erwartete Ausführung: frühstens {{EndTime.m+":"+EndTime.s}}
        </div>
        <div v-if="sended==true && result!=null" class="text-center my-5">
          <br />Hier finden Sie die Auswertung.
        </div>
      </b-jumbotron>
    </b-container>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "send",
  components: {},
  data() {
    return {
      // Data
      jclcode: "Hier steht dann der JCL-Code",
      loaded: false,
      sended: null,
      result: null,
      EndTime: {
        m: null,
        s: null
      }
    };
  },
  methods: {
    getJCL() {
      this.loaded = true;
    },
    send() {
      this.sended = false;
      setTimeout(() => {
        this.sended = true;
        setTimeout(this.updateEndTime);
      }, 2000);
    },
    updateEndTime() {
      if (this.result != null) return;
      var now = new Date();
      this.EndTime.m = 4 - (now.getMinutes() % 5);
      this.EndTime.s = ("00" + (60 - now.getSeconds())).slice(-2);
      if (this.EndTime.s == 60) {
        this.EndTime.m++;
        this.EndTime.s = "00";
      }
      // Test
      if (this.EndTime.m == 0 && this.EndTime.s == 1) {
        this.result = true;
      } else
        setTimeout(() => {
          this.updateEndTime();
        }, 10);
    }
  },
  mounted() {
    setTimeout(this.getJCL, 1000);
  }
};
</script>
