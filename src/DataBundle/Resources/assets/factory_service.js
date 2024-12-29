


export function getAllDataFactories() {
    return $.get("/api/factoryAllData", function (response, textStatus , xhr) {
        return response
    })
}

export function postFactory(factoryName) {
  let body =  {
      name: factoryName 
  }

  return $.post("/api/factory", body, function (response, textStatus , xhr) {
      console.log(response, textStatus , xhr.status)
  })
}

export function deleteFactory(factoryId) {
  return $.ajax({
    url: "/api/factory/"+factoryId, 
    type: 'DELETE', 
    success: function (response, textStatus , xhr) {
      console.log(response, textStatus , xhr.status)
    }
  })
}
