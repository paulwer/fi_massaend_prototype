<template>
  <div id="app">
    <Nav v-bind="{ auth }" />
    <b-container fluid v-if="auth.login">
      <b-row>
        <b-col cols="3">
          <Overview v-bind="{ tickets }" />
        </b-col>
        <b-col cols="9">
          <router-view v-bind="{ auth, hosts }" />
        </b-col>
      </b-row>
    </b-container>
    <Login v-else />
    <Footer />
  </div>
</template>

<script>
import Nav from "@/components/Nav";
import Footer from "@/components/Footer";
import LoginPage from "@/views/LoginPage";
import Overview from "@/components/Overview";

export default {
  name: "App",
  components: {
    Nav,
    Footer,
    Login: LoginPage,
    Overview
  },
  data() {
    return {
      auth: {
        login: true,
        admin: true,
        user: {
          name: "Paul Werner",
          uid: "J511670",
          email: "paul.werner@f-i.de",
          tel: 21853
        }
      },
      tickets: [
        {
          id: 1,
          status: "R",
          srplus_ticketnr: 12345678,
          auftragsnr: "A"
        },
        {
          id: 2,
          status: "R",
          srplus_ticketnr: 12345679,
          auftragsnr: "A"
        }
      ],
      hosts: {
        ftp: { mt91: "https://mt91.mainframe.intern" },
        mainframe: "https://mt91.mainframe.intern",
        backend: "https://test.de/",
        srplus: {
          global: "https://sus.intern/",
          ticket: "https://sus.intern/Ticket/"
        },
        dynshandbuch: {
          global: "https://dyns.intern/",
          function: "https://dyns.intern/Funktion/"
        }
      }
    };
  }
};
</script>

<style>
.form-control:focus {
  border-color: grey !important;
  box-shadow: 0 0 5px grey !important;
}
.warning-elem {
  padding: 5px;
  margin: 5px;
  padding-left: 12px;
  border-left: 6px solid #ed544a;
  background-color: rgb(204, 204, 204);
}
.task-elem {
  padding: 5px;
  margin: 5px;
  padding-left: 12px;
  border-left: 6px solid #4ab9ed;
  background-color: rgb(204, 204, 204);
}
.text-color-global {
  color: #ed544a;
}
</style>