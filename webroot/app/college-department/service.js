 app.factory("CollegeDepartment", function($resource) {

  return $resource( api + "college_departments/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});
