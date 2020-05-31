require('./bootstrap');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('bar-chart-component', require('./components/BarChart').default);
Vue.component('line-chart-component', require('./components/LineChart').default);
Vue.component('navbar-component', require('./components/Navbar').default);
Vue.component('notification-dropdown-component', require('./components/NotificationDropdown').default);
Vue.component('sidebar-component', require('./components/Sidebar').default);
Vue.component('user-dropdown-component', require('./components/UserDropdown').default);

const app = new Vue({
    el: '#app'
});
