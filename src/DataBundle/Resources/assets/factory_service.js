


export function getFactories() {
    return $.get("/api/factoryAll", function (response, textStatus , xhr) {
        return response
    })
}

export function postFactory(factoryName) {
  let body =  {
      name: factoryName 
  }

  $.post("/api/factory", body, function (response, textStatus , xhr) {
      console.log(response, textStatus , xhr.status)
  })
}