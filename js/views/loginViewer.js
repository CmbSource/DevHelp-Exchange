/*global $,Backbone,_,validateForm,alert,BookListItemView */
//$(function () {
var app = app || {};

app.views.LoginView = Backbone.View.extend({
  //   tagName: "ul",
  //   className: "login",

  initialize: function () {
    //app.loginResults = new app.collections.LoginCollection();
    // app.loginResultsView = new app.views.BookListView(); //model in place collection
    console.log("LoginView initialized");
  },

  render: function () {
    var template = _.template($("#login_template").html());
    this.$el.html(template);
    // app.loginResults.reset();
    // this.$el.append(app.loginResultsView.render().el);
    this.delegateEvents({
      "click  #login_submit": "loginUser",
    });
    return this;
  },

  loginUser: function () {
    var email = this.$("#login_userEmail").val();
    var pwd = this.$("#login_password").val();
    // app.loginResults.reset();
    if (!email || !pwd) {
      alert("User Email and Password is RequiredE!");
    } else {
      $.ajax({
        url: "codeigniter/index.php/api/Users/confirm/",
        type: "POST",
        dataType: "json",
        data: {
          userEmail: email,
          password: pwd,
        },
      })
        .done(function (data) {
          if (data.status == 200) {
            app.appRouter.navigate("#", { trigger: true, replace: true });
          } else {
            this.$("#login_userEmail").val("");
            this.$("#login_password").val();
            // app.appRouter.navigate("#/menu-item/login", {
            //   trigger: true,
            //   replace: true,
            // });
            alert(data.status + ": " + data.message);
          }
        })
        .fail(function (data) {
          alert("error");
        });
    }
  },
});
//});
