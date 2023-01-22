var app = app || {};

app.views.HomeViewer = Backbone.View.extend({

  initialize: function () {
    console.log("HomeView initialized");
    location.reload(true);
    console.log(localStorage.getItem("auth_token") + " - " + localStorage.getItem("user"));
    if (localStorage.getItem("auth_token") == 0) {
        if (!app.loginView) {
            app.loginView = new app.views.LoginViewer();
        }
        var myview = app.loginView.render().el;
        this.$el.html(myview);
        app.appRouter.navigate("#", { trigger: true, replace: true });
    }
  },

  render: function () {
    if (localStorage.getItem("auth_token") == 0) {
        if (!app.loginView) {
            app.loginView = new app.views.LoginViewer();
        }
        var myview = app.loginView.render().el;
        this.$el.html(myview);
        app.appRouter.navigate("#", { trigger: true, replace: true });
        return this;
    } else{
        var template = _.template($("#home_template").html());
        this.$el.html(template);
        return this;
    }
    
  },

});
//});
