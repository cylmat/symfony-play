export default {
    data() {
        return {
            message: 'Hello Vue !',
            dynamicId: Math.floor(Math.random() * 5),
            dynamicClass: "dynamic"
        }
        /* return { helloAttributes: { message: 'Hello Vue !' } } */
    },
    template: `
        <button type="button" class="btn btn-primary" @click="appChangeButton"> Click </button>
        <span
            v-html="message"
            v-bind:id="dynamicId"
            :class="dynamicClass"
            :disabled=false
        ></span>
    `,
    methods: {
        appChangeButton() {
            this.message = '<span style="color:green">Hello Vue ' + Math.floor(Math.random() * 10) + ' !</span>'
        }
    }
}