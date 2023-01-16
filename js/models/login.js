var app = app || {};
app.models.Login = Backbone.Model.extend({

  defaults: {
    userEmail: null,
    password: null,
  },

  initialize: function () {
    console.log("initialize login client");

  },
  

});

app.localStorage.testStore = Backbone.LocalStorage.extend({})

app.collections.LoginCollection = Backbone.Collection.extend({
  model: app.models.Login,

  url: "/questionier/codeigniter/index.php/api/Users/confirm/"

});
