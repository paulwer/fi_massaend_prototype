<template>
  <div class="nav">
    <b-container fluid class="py-2">
      <b-row>
        <b-col cols="8" class="header text-white uppercase" @click="$router.push({name: 'home'});">
          <!-- Logo -->
          <span class="font-weight-bold">
            AUFTRAGS
          </span>
          <span>
            ABWICKLUNG
          </span>
        </b-col>
        <b-col cols="2">
          <!-- Usefull Links -->
          <router-link v-if="auth.login" class="text-white font-weight-bold mx-2" to="/aufträge">Massenänderung</router-link>
          <router-link v-if="auth.login && auth.admin" class="text-white font-weight-bold mx-2" to="/vorlagen">Vorlagen</router-link>
        </b-col>
        <b-col cols="2" class="text-right text-white">
          <div v-if="auth.login">
            {{ auth.user.name }} ({{ auth.user.uid }})
          </div>
          <div v-else>
            Nicht eingeloggt
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>


<script>
  export default {
    name: 'Nav',
    props: {
      auth: {
        type: Object
      }
    }
  }
</script>

<style>
.nav {
  background-color: #ed544a;
  box-shadow: 0px 5px 5px silver;
}
.header :hover{
  cursor: pointer;
}
</style>
