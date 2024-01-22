/**
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy
 * 
 * // VueJs
 * @see https://vuejs.org/api/application
 *
 * Using Html - Option preference : data, methods, and mounted
 * 
 */

// GLOBAL build : const { createApp } = Vue 

// MODULE build 
import { createApp } from 'vue' // 'https://unpkg.com/vue@3/dist/vue.esm-browser.js' -> use importmap

import Hello from '../atom/hello-sample.js'
import Sfc from '../atom/counter.vue'

const app = createApp(Hello).mount('#app')
createApp(Sfc).mount('#app_sfc')

/*
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue.js!'
        }
    })
*/