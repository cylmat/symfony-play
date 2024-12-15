import { ref, reactive, onMounted } from 'vue'
import { debounce } from 'lodash'

export default {
    // `setup` is a special hook dedicated for the Composition API.
    setup() {
        const test = 'alpha'

        function setupincrement() {
            // .value is needed in JavaScript
            count.value++
        }

        return {
            test,
            setupincrement
        }
    },
    data() {
        return {
            message: 'Hello Vue !',
            dynamicId: Math.floor(Math.random() * 5),
            dynamicclass: "dynamic",
            testattributes: "voila",
            deux: "voila2"
        }
        /* return { helloAttributes: { message: 'Hello Vue !' } } */
    },
    // Computed PROPERTY, cached datas !
    computed: {
        displayProfile() {
            return `I ${this.message} and i am ${this.deux}`
        }
    },
    template: `
        <button
            type="button"
            class="btn btn-primary"
            @click="appChangeButton"
            @other="setupincrement"
        > Click </button>
        <span
            v-html="message"
            v-bind:id="dynamicId"
            :class="dynamicclass"
            :disabled=false
            v-if="true"

            v-bind:[attributenamedata]="deux"
            attributenamedata="testattributes"
        ></span>
    `,
    methods: {
        // AVOID ARROW increment: () => {} // no THIS access
        async appChangeButton() {
            this.message = '<span style="color:green">Hello Vue ' + Math.floor(Math.random() * 10) + ' !</span>'
            // ...await nextTick()
            // Now the DOM is updated
        },
        clickSample() {}
    },

    /** ************ **/

    // SAMPLE methods: {click: debounce(function () { ... }, 500)
    created() {
        // each instance now has its own copy of debounced handler
        this.debouncedClick = _.debounce(this.clickSample, 500)
    },
    unmounted() {
        // also a good idea to cancel the timer
        // when the component is removed
        this.debouncedClick.cancel()
    },
    /*
        WARNING Vue3 use Proxy
        @https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy
        */
   // `mounted` is a lifecycle hook
    mounted() {
        // `this` refers to the component instance.
        // when the instance is first created, data can be mutated as well
        this.message = this.message + ''

        console.log('Application mounted');
    }
}