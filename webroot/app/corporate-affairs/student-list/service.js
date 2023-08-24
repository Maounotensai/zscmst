 app.factory("StudentList", function($resource) {

  return $resource( api + "apartelle_registrations/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

 app.factory("StudentListEmail", function($resource) {

  return $resource( api + "student_applications/email/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

