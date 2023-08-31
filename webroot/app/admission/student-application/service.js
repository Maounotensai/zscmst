app.factory("StudentApplication", function($resource) {

  return $resource( api + "student-applications/:id", { id: '@id', search: '@search' }, {

    query: { method: 'GET', isArray: false },

    update: {

      method: 'POST',

      headers: { 'Content-Type': undefined, enctype: 'multipart/form-data' },

      transformRequest: function(data) {
        
        var formData = new FormData();

        attachment = [];

        formData.append('data', JSON.stringify(data));

        // attach file

        applicationImage = document.getElementById('applicationImage');

        if (applicationImage != null && applicationImage.files.length > 0)

        var count = applicationImage.files.length - 1;

        for(var i = 0; i <= count ; i++){

          formData.append('attachment[]', applicationImage.files[i]);

        }

        return formData;

      }

    },

    save: {

      method: 'POST',

      headers: { 'Content-Type': undefined, enctype: 'multipart/form-data' },

      transformRequest: function(data) {

        // transform data

        var formData = new FormData();

        attachment = [];

        formData.append('data', JSON.stringify(data));

        // attach file

        applicationImage = document.getElementById('applicationImage');

        if (applicationImage != null && applicationImage.files.length > 0)

        var count = applicationImage.files.length - 1;

        for(var i = 0; i <= count ; i++){

          formData.append('attachment[]', applicationImage.files[i]);

        }

        return formData;

      }

    },

    search: { method: 'GET' },

  });

});

app.factory("StudentApplicationImage", function($resource) {

  return $resource( api + "student_application_images/:id", { id: '@id' }, {

    query: { method: 'GET', isArray: false },

    update: { method: 'PUT'},

    save: {

      method: 'POST',
      
      headers: { 'Content-Type': undefined, enctype: 'multipart/form-data' },

      transformRequest: function(data) {

        // transform data

        var formData = new FormData();

        attachment = [];

        formData.append('data', JSON.stringify(data));

        // attach file

        applicationImage = document.getElementById('applicationImage');

        if (applicationImage != null && applicationImage.files.length > 0)

        var count = applicationImage.files.length - 1;

        for(var i = 0; i <= count ; i++){

          formData.append('attachment[]', applicationImage.files[i]);

        }

        return formData;

      }

    }

  });

});

app.factory("StudentApplicationRemoveImage", function($resource) {

  return $resource( api + "student_applications/deleteImage/:id", { id: '@id' }, {

  });

});