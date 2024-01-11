export default {
  data() {
      return {
          message: 'Hello Vue !'
      }
  },
  methods: {
      appChangeButton() {
          this.message = 'Hello Vue ' + Math.floor(Math.random() * 10) + ' !'
      }
  }
}