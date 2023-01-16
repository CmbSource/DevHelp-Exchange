var app = app || {};

app.views.RegisterView = Backbone.View.extend({
    
  initialize: function () {
    console.log("RegisterView initialized");
    localStorage.setItem("auth_token", 0);
    localStorage.setItem("user", null);
    console.log(
      localStorage.getItem("auth_token") + " - " + localStorage.getItem("user")
    );
  },

  render: function () {
    var template = _.template($("#register_template").html());
    this.$el.html(template);
    this.delegateEvents({
      "click  #register_submit": "registerUser",
    });
    return this;
  },

  registerUser: function () {
    var email = this.$("#register_userEmail").val();
    var pwd = this.$("#register_password").val();
    var name = this.$("#register_userName").val();
    // app.registerResults.reset();
    if (!email || !pwd || !name) {
      alert("All the fields are Required!");
    } else {
      $.ajax({
        url: "codeigniter/index.php/api/Users/user/",
        type: "POST",
        dataType: "json",
        data: {
          userName: name,
          userEmail: email,
          password: pwd,
        },
      })
        .done(function (data) {
          if (data.status == 200) {
            alert(data.message);
            setTimeout(function () {
              app.appRouter.navigate("#", { trigger: true, replace: true });
            }, 0);
          } else {
            alert(data.status + ": " + data.message);
            setTimeout(function () {
              location.reload(true);
            }, 0);
          }
        })
        .fail(function (data) {
          alert("error");
          setTimeout(function () {
            location.reload(true);
          }, 0);
        });
    }
  },
});
//});
