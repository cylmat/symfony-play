
/** @todo import with webpack */

function runapi(moduleName) {
  $.get(moduleName, function(data) {
    json = JSON.stringify(data, null, 2)
    $('#data_result').html(json)
  })

  return false
}
