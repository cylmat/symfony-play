export default {
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
    template: `
        <button type="button" class="btn btn-primary" @click="appChangeButton"> Click </button>
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
        appChangeButton() {
            this.message = '<span style="color:green">Hello Vue ' + Math.floor(Math.random() * 10) + ' !</span>'
        }
    }
}