app.factory("StudentApplicationRate", function($resource) {

  return $resource( api + "student_applications/rate/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentApplicationEmail", function($resource) {

  return $resource( api + "student_applications/email/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentApplicationSchedule", function($resource) {

  return $resource( api + "student_applications/send_schedule/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentApplicationBulkEmail", function($resource) {

  return $resource( api + "student_applications/bulk_email/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentApplicationMedicalRequest", function($resource) {

  return $resource( api + "student_applications/request_interview/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentApplicationQualify", function($resource) {

  return $resource( api + "student_applications/qualify/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("StudentApplicationUnqualify", function($resource) {

  return $resource( api + "student_applications/unqualify/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});
