export default {
    data() {
        return {
            message: 'Hello Vue !',
            dynamicId: Math.floor(Math.random() * 5),
            dynamicClass: "dynamic"
        }
        /* return { helloAttributes: { message: 'Hello Vue !' } } */
    },
    methods: {
        appChangeButton() {
            this.message = '<span style="color:green">Hello Vue ' + Math.floor(Math.random() * 10) + ' !</span>'
        }
    }
}