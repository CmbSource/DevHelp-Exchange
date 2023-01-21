var app = app || {};

app.views.AddQuestionViewer = Backbone.View.extend({
  initialize: function () {
    console.log("Add Question initialized");
    console.log(
      localStorage.getItem("auth_token") + " - " + localStorage.getItem("user")
    );
    if (localStorage.getItem("auth_token") == 0) {
      if (!app.loginView) {
        app.loginView = new app.views.LoginViewer();
      }
      var myview = app.loginView.render().el;
      this.$el.html(myview);
      app.appRouter.navigate("/", { trigger: true, replace: true });
    }
  },

  render: function () {
    if (localStorage.getItem("auth_token") == 0) {
      if (!app.loginView) {
        app.loginView = new app.views.LoginViewer();
      }
      var myview = app.loginView.render().el;
      this.$el.html(myview);
      app.appRouter.navigate("/", { trigger: true, replace: true });
      return this;
    } else {
      var template = _.template($("#addquestion_template").html());
      this.$el.html(template);
      this.delegateEvents({
        "click  #question_submit": "questionCreate",
      });
      return this;
    }
  },

  questionCreate: function () {
    var title = this.$("#qTitle").val();
    var email = localStorage.getItem("user");
    var qBody = this.$("#field5").val();
    if (!title || !qBody ) {
      alert("All the fields are Required!");
    } else {
      $.ajax({
        url: "codeigniter/index.php/api/Question/questions/",
        type: "POST",
        dataType: "json",
        data: {
          userEmail: email,
          questionTitle: title,
          content: qBody,
        },
      })
        .done(function (data) {
          if (data.status == 200) {
            alert(data.message);
            setTimeout(function () {
              app.appRouter.navigate("#menu-item/home", { trigger: true, replace: true });
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
