app.factory("AddingDroppingSubject", function($resource) {

  return $resource( api + "adding_dropping_subjects/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("AddingDroppingSubjectApprove", function($resource) {

  return $resource( api + "adding_dropping_subjects/approve/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("AddingDroppingSubjectDisapproved", function($resource) {

  return $resource( api + "adding_dropping_subjects/disapprove/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});