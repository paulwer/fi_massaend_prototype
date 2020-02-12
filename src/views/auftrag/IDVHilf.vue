<template>
  <div class="home my-4">
    <b-container class="h-100">
      <b-jumbotron>
        <template v-slot:header>
          <div v-if="count=0 || loadagain">IDV_HILF laden</div>
          <div v-else>Daten in IDV_HILF</div>          
        </template>
        <div v-if="count=0 || !loadagain">
          <b-button @click="loadagain=true">Hilfsdatenbank erneut laden</b-button>
          <br><br>Hier wird ein Auszug der Daten aus der Tabelle IDV_HILF zu finden sein...
        </div>
        <div v-else>
        Hier können Sie die Hilfsdatenbank beladen
        <div v-cloak @drop.prevent="addFile" @dragover.prevent class="draganddrop">
          <h2>Files to Upload (Drag them over)</h2>
          <b-form-group label-for="fileElem">
            <b-form-file
              id="fileElem"
              multiple
              accept=".csv, .xlsx, .txt"
              @change="handleFiles"
              size="sm"
            ></b-form-file>
          </b-form-group>
        </div>
        <b-container class="my-5">
          <b-row v-for="file in files" :key="file.name">
            <b-col cols="11" class="m-0 p-1">{{ file.name }} ({{ file.size | kb }} kb)</b-col>
            
            <b-col class="ml-1 my-auto p-0">
              <b-button @click="removeFile(file)" title="Remove">X</b-button>
            </b-col>
          </b-row>
          <hr />
          <b-button :disabled="uploadDisabled" @click="upload">Upload</b-button>
        </b-container></div>
        
      </b-jumbotron>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "list",
  components: {},
  props: {
    hosts: {
      type: Object
    }
  },
  data() {
    return {
      count: 100,
      loadagain: false,
      files: []
    };
  },
  computed: {
    uploadDisabled() {
      return this.files.length === 0;
    }
  },
  methods: {
    handleFiles(e) {
      let inputFiles = e.target.files;
      if (!inputFiles) return;
      // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
      [...inputFiles].forEach(f => {
        this.files.push(f);
      });
      e.target.value = ""; // tmp in file input löschen
    },
    addFile(e) {
      let droppedFiles = e.dataTransfer.files;
      if (!droppedFiles) return;
      this.files=[];
      // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
      [...droppedFiles].forEach(f => {
        this.files.push(f);
      });
    },
    removeFile(file) {
      this.files = this.files.filter(f => {
        return f != file;
      });
    },
    upload() {
      let formData = new FormData();
      this.files.forEach((f, x) => {
        formData.append("file" + (x + 1), f);
      });

      fetch(this.hosts.ftp.mt91, {
        method: "POST",
        body: formData
      })
        .then(res => res.json())
        .then(res => {
          window.console.log("done uploading", res);
        })
        .catch(e => {
          window.console.error(JSON.stringify(e.message));
        });
    }
  }
};
</script>

<style>
.draganddrop {
  margin-top: 20px;
  padding: 20px;
  border: dotted black;
  border-radius: 10px;
}
</style>