app.factory("Club", function ($resource) {
  return $resource(
    api + "clubs/:id",
    { id: "@id" },
    {
      query: { method: "GET", isArray: false },

      update: { method: "PUT" },

      search: { method: "GET" },
    }
  );
});
