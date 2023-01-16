var app = app || {};

app.views.LoginViewer = Backbone.View.extend({

  initialize: function () {
    console.log("LoginView initialized");
    localStorage.setItem("auth_token", 0);
    localStorage.setItem("user", null);
    console.log(localStorage.getItem("auth_token") + " - " + localStorage.getItem("user"));
  },

  render: function () {
    var template = _.template($("#login_template").html());
    this.$el.html(template);
    this.delegateEvents({
      "click  #login_submit": "loginUser",
    });
    if (localStorage.getItem("auth_token") == 1) {
      localStorage.setItem("auth_token", 0);
      localStorage.setItem("user", null);
      console.log(localStorage.getItem("auth_token") + " * " + localStorage.getItem("user"));
      location.reload(true);
    }
    
    // 
    return this;
  },

  loginUser: function () {
    var email = this.$("#login_userEmail").val();
    var pwd = this.$("#login_password").val();
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

          if (data.status == 200) {
            localStorage.setItem("auth_token", 1);
            localStorage.setItem("user", email);
            console.log(localStorage.getItem("auth_token") + " - " + localStorage.getItem("user"));
            //setTimeout(function () {
              app.appRouter.navigate("#menu-item/home", { trigger: true, replace: true });
            //}, 0);

          } else {
            alert(data.status + ": " + data.message);
            localStorage.setItem("auth_token", 0);
            localStorage.setItem("user", null);
            setTimeout(function () {
              location.reload(true);
            }, 0);
          }
        })
        .fail(function (data) {
          localStorage.setItem("auth_token", 0);
          localStorage.setItem("user", null);
          alert("error");
        });
    }
  },
});
//});
