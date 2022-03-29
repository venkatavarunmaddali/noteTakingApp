require('./bootstrap');


import * as Vue from 'vue'

import { createApp } from 'vue'
import App from './vue/app.vue'


const app = createApp(App)

app.mount('#app')

// import * as Vue from 'vue'

// import App from './vue/app.vue'

// const app = new Vue({
// 	el:'#app',
// 	components:{App}
// });