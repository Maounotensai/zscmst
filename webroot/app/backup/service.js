app.factory("Backup", function($resource) {
  return $resource( api + 'backups/:id', {id:'@id'}, {
    query: { method: 'GET', isArray: false },
    update: { method: 'PUT' }
  });
});