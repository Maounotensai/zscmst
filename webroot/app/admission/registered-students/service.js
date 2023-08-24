 app.factory("RegisteredStudent", function($resource) {

  return $resource( api + "registered_students/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});