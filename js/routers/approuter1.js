/*global $,app,Backbone */
var app = app || {};
app.routers.AppRouter = Backbone.Router.extend({
  routes: {
    "": "login",
    "menu-item/register": "register",
    "menu-item/home": "home",
    "menu-item/welcome": "welcome",
    "menu-item/addQ": "addQ",
    "menu-item/searchbook": "searchbook",
    "edit/:id": "editbook",
  },

  login: function () {
    if (!app.loginView) {
      app.loginView = new app.views.LoginViewer();
    }
    var myview = app.loginView.render().el;
    $("#app").html(myview);
  },

  register: function () {
    if (!app.registerView) {
      app.registerView = new app.views.RegisterView();
    }
    var myview = app.registerView.render().el;
    $("#app").html(myview);
  },

  home: function () {
    if (!app.randomBooksView) {
        console.log("home");
      app.questionsView = new app.views.QListView({
        model: new app.collections.QItemCollection(),
      });
    }
    $("#app").html("loading...");
    app.questionsView.model.fetch({
      reset: true,
      success: function () {
        var myview = app.questionsView.render().el;
        $("#app").html(myview);
      },
    });
  },

  addQ: function () {
    if (!app.addQView) {
        console.log("add");
      app.addQView = new app.views.AddQuestionViewer({
        model: new app.models.QItem(),  
      });
    }
    $("#app").html("loading...");
    for (let i = 0; i < 2; i++) {
      var myview = app.addQView.render().el;
    }
    $("#app").html(myview);
    // app.questionsView.model.fetch({
    //   reset: true,
    //   success: function () {
    //     var myview = app.addQView.render().el;
    //     $("#app").html(myview);
    //   },
    // });
    
  },

  welcome: function () {
    if (!app.randomBooksView) {
      app.randomBooksView = new app.views.BookListView({
        model: new app.collections.BookItemCollection(),
      });
    }
    $("#app").html("loading...");
    app.randomBooksView.model.fetch({
      reset: true,
      success: function () {
        var myview = app.randomBooksView.render().el;
        $("#app").html(myview);
      },
    });
  },

  searchbook: function () {
    if (!app.searchView) {
      app.searchView = new app.views.SearchBookView();
    }
    var myview = app.searchView.render().el;
    $("#app").html(myview);
  },

  addbook: function () {
    if (!app.addBookView) {
      app.addBookView = new app.views.BookItemForm({
        model: new app.models.QItem(),
      });
    }
    var myview = app.addBookView.render().el;
    $("#app").html(myview);
  },

  editbook: function (id) {
    if (!isNaN(id) && id !== 0) {
      var book = new app.models.QItem({ id: id });
      var url = book.url() + book.get("id");
      app.editBookView = new app.views.EditBookView({ model: book });
      book.fetch({
        url: url,
        success: function (model, response, options) {
          var myview = app.editBookView.render().el;
          $("#app").html(myview);
        },
      });
    }
  },
});
