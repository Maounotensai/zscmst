app.factory("BlockSection", function($resource) {

  return $resource( api + "block_sections/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("BlockSectionScheduleView", function($resource) {

  return $resource( api + "block_sections/schedule_view/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("BlockSectionScheduleAdd", function($resource) {

  return $resource( api + 'block_sections/schedule_add/:id', {id:'@id'}, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

app.factory("BlockSectionScheduleDelete", function($resource) {

  return $resource( api + 'block_sections/schedule_delete/:id', {id:'@id'}, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});