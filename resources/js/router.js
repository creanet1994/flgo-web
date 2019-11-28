import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home';
import About from './pages/About';
import Register from './pages/Register';
import Login from './pages/Login';
import Dashboard from './pages/user/Dashboard';
import Registro from './pages/user/Registrar';
import Datos from './pages/user/Datos';
import Index from './pages/user/registros/Index';

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/about',
    name: 'about',
    component: About,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  { 
    path: '/registrar',
    name: 'registrar',
    component: Registro,
    meta: {
      auth: true
    }
  },
  { 
    path: '/verRegistro',
    name: 'verRegistro',
    component: Index,
    meta: {
      auth: true
    }
  },
  { 
    path: '/datos',
    name: 'datos',
    component: Datos,
    meta: {
      auth: true
    }
  },
  { 
    path: '*', redirect: '/dashboard' 
  }
]
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router