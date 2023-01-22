/*global $,Backbone,_,validateForm,alert,BookListItemView,app,confirm,alert */
/*$(function () {
    "use strict";
*/
var app = app || {};
app.views.EditBookView = Backbone.View.extend({
  tagName: "div",

  className: "questionReply",

  initialize: function () {
    console.log("EditBookView initialized");
  },

  render: function () {
    var template = _.template(
      $("#addquestion_template").html(),
      this.model.attributes
    );
    console.log(this.model);
    this.options.collections.models.forEach((element) => {
      console.log(element);
    });
    this.$el.html(template);
    return this;
  },
});

app.views.ReplyListItemView = Backbone.View.extend({
  tagName: "li",

  render: function () {
    var template = _.template(
      $("#qItem_template").html(),
      this.model.attributes
    );
    // this.$el.html(template);
    // if (this.model.attributes.questionState == "Answered") {
    //   this.$(".card").css("background-color", "#b1dd9a");
    // }
    // if (localStorage.getItem("user") == this.model.attributes.userEmail) {
    //   this.$("#deleteQuestion_submit").css("color", "red");
    // } else {
    //   this.$("#deleteQuestion_submit").prop("disabled", true);
    // }
    // this.delegateEvents({
    //   "click  #deleteQuestion_submit": "questionDelete",
    // });
    return this;
  },
});

app.views.ReplyListView = Backbone.View.extend({
  tagName: "ul",

  className: "replylist",

  initialize: function () {
    var _this = this; //view reference
    this.model.on("reset", this.render, this);
    this.model.on("add", function (replyItem) {
      _this.$el.append(
        new app.views.ReplyListItemView({ model: replyItem }).render().el
      );
    });
  },

  render: function () {
    this.$el.empty(); // empty previous results view
    _.each(
      this.options.collections.models,
      function (replyItem) {
        this.$el.append(
          new app.views.ReplyListItemView({ model: replyItem }).render().el
        );
      },
      this
    );
    return this;
  },
});
