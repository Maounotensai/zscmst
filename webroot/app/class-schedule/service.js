 app.factory("ClassSchedule", function($resource) {

  return $resource( api + "class_schedules/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});
