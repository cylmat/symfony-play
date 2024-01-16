// module.exports = # without webpack

export default function runapi() {
  var link = this.getAttribute('data-link')
  $.get(link, function(data) {
    const json = JSON.stringify(data, null, 2)
    $('#data_result').html(json)
  })
}

const buttonElement = $('.clickableButton').each(function(i) {
  this.addEventListener("click", runapi);
}) //document.getElementById("ninebutton");

