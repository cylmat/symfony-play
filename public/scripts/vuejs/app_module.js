/**
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy
 * 
 * // VueJs
 * @see https://vuejs.org/api/application
 *
 * Using Html - Option preference : data, methods, and mounted
 */

// GLOBAL build : const { createApp } = Vue 

// MODULE build 
import { createApp } from 'vue' // 'https://unpkg.com/vue@3/dist/vue.esm-browser.js' -> use importmap

import Hello from './component/hello.js'
import Counter from './component/counter.js'

const app = createApp(Hello).mount('#app')
const app_counter = createApp(Counter).mount('#app_c')

/*
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue.js!'
        }
    })
*/