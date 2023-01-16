/*global $,Backbone,_,validateForm,alert,BookListItemView */
//$(function () {
var app = app || {};

app.views.LoginView = Backbone.View.extend({
//   tagName: "ul",
//   className: "login",

  initialize: function () {
    // app.loginResults = new app.collections.LoginCollection();
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
      alert("User Email and Password is Required!");
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
          //setViewPost();
          //   var result = app.searchBookResults.add(data);
          //   if (!result.length) {
          //     alert("No books found");
          //   }
            if (data.staus == 200) {
                alert("success");
                //app.routers.AppRouter
                //alert(data.message);
                //app.appRouter.navigate("#", {trigger: true, replace: true});
            }
            else {
                alert(data.message);
            }
        })
        .fail(function (data) {
          alert("error");
        });
    }
  },

  //   setViewPost: function () {
  //     $.ajax({
  //       url: "/questionier/codeigniter/index.php/bookapp/index/",
  //       type: "GET",
  //       dataType: "json",
  //     })
  //       .done(function (data) {
  //         setViewPost();
  //         var result = app.searchBookResults.add(data);
  //         if (!result.length) {
  //           alert("No books found");
  //         }
  //       })
  //       .fail(function (data) {
  //         alert("error");
  //       });
  //   },

  // render: function () {
  //     this.$el.empty();   // empty previous results view
  //     _.each(this.model.models, function (login) {
  //         this.$el.append(new app.views.BookListItemView({model: login}).render().el);
  //     }, this);
  //     return this;
  // }

  // el: $("#divLoginClient"),

  // initialize: function () {
  //     var that = this;
  //     this.listeLoginClients = new app.collections.LoginCollection();
  //     this.listLoginClients = new app.collections.LoginCollection();
  //     this.listeLoginClients.bind("add", function (model) {
  //         that.addClientToList(model);
  //     });

  //     this.listLoginClients.bind("add", function (model) {
  //         that.addLoginToList(model);
  //     });
  // },

  // events: {
  //     'click #cmdAddLoginClient': 'cmdAddLoginClient_Click',
  //     'click #login': 'login'
  // },

  // cmdAddLoginClient_Click: function () {

  //     var tmpLoginClient = new app.models.Login({
  //         userEmail: $("#txtIdClient").val(),
  //         password: $("#txtNomClient").val(),
  //     });

  //     this.listeLoginClients.add(tmpLoginClient);
  // },

  // addClientToList: function (model) {

  //     r_userEmail = model.get('userEmail');
  //     r_password = model.get('password');

  //     $("#listeClient").html("<font size=5 color=green>You are Successfully Registered, Now you can Login</font>");

  // },

  // addLoginToList: function (model) {  ;
  //     if (model.get('userEmail') == r_userEmail && model.get('password') == r_password) {
  //         $("#divClient").html("<font size=4 color=blue>Login sucessfull</font>");
  //     }
  //     else {
  //         $("#listeClient").html("<font size=5 color=green>Failed Logged in, Retry</font>");
  //     }
  // }
});
//});
