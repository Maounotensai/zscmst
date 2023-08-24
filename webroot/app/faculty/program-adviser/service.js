 app.factory("ProgramAdviser", function($resource) {

  return $resource( api + "program_advisers/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("ProgramAdviserEnlist", function($resource) {

  return $resource( api + "program_advisers/enlist/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});