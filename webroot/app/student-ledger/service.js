 app.factory("StudentLedger", function($resource) {

  return $resource( api + "student_ledgers/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});
