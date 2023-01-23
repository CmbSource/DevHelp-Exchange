/*global $,Backbone,_,validateForm,alert,BookListItemView,app,confirm,alert */
/*$(function () {
    "use strict";
*/
var app = app || {};
app.views.EditBookView = Backbone.View.extend({
  tagName: "ui",

  className: "questionReply",

  initialize: function () {
    console.log("EditBookView initialized");
  },

  render: function () {
    var template = _.template(
      $("#viewQuestion_template").html(),
      this.model.attributes
    );
    this.$el.html(template);
    console.log(this.model);
    this.options.collections.models.forEach((element) => {
      console.log(element);
    });
    // this.$el.empty(); // empty previous results view
    _.each(
      this.options.collections.models,
      function (replyItem) {
        this.$el.append(
          new app.views.ReplyListItemView({ model: replyItem }).render().el
        );
      },
      this
    );

    this.delegateEvents({
      "click  #reply_submit": "replyAdd",
    });
    return this;
  },

  replyAdd: function (params) {
    var email = localStorage.getItem("user");
    var replyBody = this.$("#reply").val();
    var questionId = this.model.attributes.questionId;
    if (!replyBody) {
      alert("Reply box is empty!");
    } else {
      $.ajax({
        url: "codeigniter/index.php/api/Question/replies/",
        type: "POST",
        dataType: "json",
        data: {
          userEmail: email,
          questionId: questionId,
          content: replyBody,
        },
      })
        .done(function (data) {
          if (data.status == 200) {
            alert(data.message);
            setTimeout(function () {
              location.reload(true);
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

app.views.ReplyListItemView = Backbone.View.extend({
  tagName: "li",

  className: "replyItem",

  render: function () {
    var template = _.template(
      $("#ReplyItem_template").html(),
      this.model.attributes
    );
    this.$el.html(template);
    this.$("#markCorrect_submit").css("color", "#52c715");
    if (this.model.attributes.replyState == "Answer") {
      this.$(".card").css("background-color", "#b1dd9a");
    }
    // if (localStorage.getItem("user") == this.model.attributes.userEmail) {
    //   this.$("#deleteQuestion_submit").css("color", "red");
    // } else {
    //   this.$("#deleteQuestion_submit").prop("disabled", true);
    // }
    this.delegateEvents({
      "click  #markCorrect_submit": "markCorrect",
    });
    return this;
  },

  markCorrect: function () {
    var questionId = this.model.attributes.questionId;
    var replyId = this.model.attributes.replyId;

    $.ajax({
    url: "codeigniter/index.php/api/Question/replystate/",
    type: "PATCH",
    dataType: "json",
    data: {
      "replyId": replyId,
      "questionId": questionId
    },
    })
    .done(function (data) {
        if (data.status == 200) {
        alert(data.message);
        setTimeout(function () {
            location.reload(true);
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

});

app.views.ReplyListView = Backbone.View.extend({
  tagName: "ul",

  className: "replylist",

  initialize: function () {
    var _this = this; //view reference
  },

  render: function () {
    this.$el.empty(); // empty previous results view
    var _count = 0;
    _.each(
      this.options.collections.models,
      function (replyItem) {
        _count++;
        this.$el.append(
          new app.views.ReplyListItemView({ model: replyItem }).render().el
        );
      },
      this
    );
    return this;
  },
});
