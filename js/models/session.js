var app = app || {};
app.
app.models.Session = Backbone.Model.extend({
  defaults: {
    userEmail: null,
    password: null,
  },

  initialize: function () {
    load();
  },

  load: function () {
    
  }


});

app.collections.LoginCollection = Backbone.Collection.extend({
  model: app.models.Login,

  url: "/questionier/codeigniter/index.php/api/Users/confirm/",
});
