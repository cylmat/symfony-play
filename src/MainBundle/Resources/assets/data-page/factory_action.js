import { getAllDataFactories, postFactory, deleteFactory } from './factory_service'

function factoryClickHandle() {
  $('#addFactoryButton').on( "click", function() {
    let name =  $('#addFactoryNameInput').val() 
    postFactory(name)
      .done(function(data) {
        refreshData()
      })
    return false
  })
}

window.delFactoryClickHandle = function (element) {
  deleteFactory( element.dataset.factoryId ) // $(element).attr('data-factory-id')
    .done(function(data) {
      refreshData()
    })
  return false
}

function refreshData() {
    getAllDataFactories().done(function(data) {
      let html = ''
      data.factories.forEach(factoryData => {
        html += `
          <div class="d-block">
            <span>${factoryData.name}</span>
            <button 
              class="delFactoryButton"
              onClick="return window.delFactoryClickHandle(this)"
              data-factory-id="${factoryData.id}"
            >X</button>
          </div>
        `
      });
      $('#factoriesList').html($.parseHTML(html))
        
    })
}

$(function() {
  refreshData()
  factoryClickHandle()
})
