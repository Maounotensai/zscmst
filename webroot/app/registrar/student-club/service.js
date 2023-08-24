app.factory("StudentClub", function($resource) {

  return $resource( api + "student_clubs/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentClubApprove", function($resource) {

  return $resource( api + "student_clubs/approve/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentClubDisapprove", function($resource) {

  return $resource( api + "student_clubs/disapprove/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

