<template>
  <div class="home mt-4">
    <b-container class="h-100">
      <b-jumbotron>
        <template v-slot:header>Willkommen</template>
        Willkommen in der Anwendung Auftragsabwicklung. Bitte wählen Sie aus den folgenden Optionen:
        <b-container>
          <b-row class="my-5 justify-content-center">
            <b-col cols="3" class="m-2">
              <div class="elem-clickable py-5 text-center border" @click="$router.push('/idvhilf');">
                IDV_HILF
              </div>            </b-col>
            <b-col cols="3" class="m-2">
              <div class="elem-clickable py-5 text-center border" @click="$router.push('/aufträge');">
                Massenänderungsaufträge
              </div>            </b-col>
            <b-col v-if="auth.admin" cols="3" class="m-2">
              <div class="elem-clickable py-5 text-center border" @click="$router.push('/vorlagen');">
                Vorlagenverwaltung
              </div>
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
  name: 'home',
  props: {
      auth: {
        type: Object
      }
    }
}
</script>
<style scoped>
.elem-clickable {
  border-radius: 10px;
  transition: 1s;
}
.elem-clickable:hover {
  background-color: #ed544a;
  border-radius: 18px;
  box-shadow: 2px 2px silver;
  cursor: pointer;
}
</style>
