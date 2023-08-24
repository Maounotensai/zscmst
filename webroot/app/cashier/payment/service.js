 app.factory("Payment", function($resource) {

  return $resource( api + "payments/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' },

    search: { method: 'GET' },

  });

});

 app.factory("CashierSub", function($resource) {

  return $resource( api + 'cashier_subs/:id', {id:'@id'}, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT' }

  });

});

 