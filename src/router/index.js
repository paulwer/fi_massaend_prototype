import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
  // Startseite
  {
    path: '/',
    name: 'home',
    component: Home,
    props: true
  },
  // Massenänderungsaufträge
  {
    path: '/aufträge',
    name: 'aufträge',
    props: true,
    component: () => import(/* webpackChunkName: "aufträge" */ '../views/auftrag/List.vue')
  },
  {
    path: '/auftrag/new',
    name: 'auftrag_neu',
    props: true,
    component: () => import(/* webpackChunkName: "auftrag_neu" */ '../views/auftrag/Create.vue')
  },
  {
    path: '/auftrag/:id',
    name: 'auftrag',
    props: true,
    component: () => import(/* webpackChunkName: "auftrag" */ '../views/auftrag/Overview.vue')
  },
  {
    path: '/auftrag/:id/data',
    name: 'auftrag_data',
    props: true,
    component: () => import(/* webpackChunkName: "auftrag_data" */ '../views/auftrag/Data.vue')
  },
  {
    path: '/auftrag/:id/daten',
    name: 'auftrag_daten',
    props: true,
    component: () => import(/* webpackChunkName: "auftrag_daten" */ '../views/auftrag/Daten.vue')
  },
  {
    path: '/auftrag/:id/idvhilf',
    name: 'auftrag_idvhilf',
    props: true,
    component: () => import(/* webpackChunkName: "auftrag_idvhilf" */ '../views/auftrag/IDVHilf.vue')
  },
  {
    path: '/auftrag/:id/send',
    name: 'auftrag_send',
    props: true,
    component: () => import(/* webpackChunkName: "auftrag_send" */ '../views/auftrag/Send.vue')
  },
  // IDVHilf
  {
    path: '/idvhilf',
    name: 'idvhilf',
    props: true,
    component: () => import(/* webpackChunkName: "idvhilf" */ '../views/idvhilf/Action.vue')
  },
  // Vorlagen
  {
    path: '/vorlagen',
    name: 'vorlagen',
    props: true,
    component: () => import(/* webpackChunkName: "vorlagen" */ '../views/vorlage/List.vue')
  },
  {
    path: '/vorlage/:id',
    name: 'vorlage',
    props: true,
    component: () => import(/* webpackChunkName: "vorlage" */ '../views/vorlage/Overview.vue')
  },
  // {
  //   path: '/:none', 
  //   redirect: { 
  //     name: 'home' 
  //   }
  // }
]

const router = new VueRouter({
  routes
})

export default router 
