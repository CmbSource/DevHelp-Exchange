
var app = app || {};

app.models.AuthModel = Backbone.LocalStorage.extend({

  

});

app.collections.AuthCollection = Backbone.Collection.extend({
  model: app.models.AuthModel,

});
