 app.factory("Prospectus", function($resource) {

  return $resource( api + "prospectuses/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});