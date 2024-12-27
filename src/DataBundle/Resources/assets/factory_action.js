import { getFactories, postFactory } from './factory_service'

function addFactoryClickHandle() {
  $('#addFactoryButton').on( "click", function() {
      postFactory( $('#addFactoryNameInput').val() )
      return false
    } )
}

$(document).ready(function() {
    addFactoryClickHandle()
})

