/*global $,Backbone,_,validateForm,alert,BookListItemView */
//$(function () {
var app = app || {};
app.views.QListItemView = Backbone.View.extend({

    tagName: "li",

    render: function () {
        var template = _.template($("#qItem_template").html(), this.model.attributes);
        this.$el.html(template);
        if (this.model.attributes.questionState == 'Answered') {
            this.$(".card").css('background-color', '#b1dd9a');
        }
        if (localStorage.getItem("user") == this.model.attributes.userEmail) {
            this.$("#deleteQuestion_submit").css('color', 'red');
        } else {
            this.$("#deleteQuestion_submit").prop("disabled",true);
        }
        this.delegateEvents({
            "click  #deleteQuestion_submit": "questionDelete",
          });
        return this;
    },

    questionDelete: function () {
        var questionId = this.model.attributes.questionId;
        $.ajax({
        url: "codeigniter/index.php/api/Question/questions/" + questionId,
        type: "DELETE",
        dataType: "json",
        data: {},
        })
        .done(function (data) {
            if (data.status == true) {
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
        
      },

});
app.views.QListView = Backbone.View.extend({

    tagName: "ul",

    className: "questionlist",

    initialize: function () {
        if (localStorage.getItem("auth_token") == 0) {
            app.appRouter.navigate("#", { trigger: true, replace: true });
        }else{
            var _this = this; //view reference
            this.model.on("reset", this.render, this);
            this.model.on("add", function (qitem) {
                _this.$el.append(new app.views.QListItemView({model: qitem}).render().el);
        });
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
        } else {
            this.$el.empty();   // empty previous results view
            _.each(this.model.models, function (qitem) {
                this.$el.append(new app.views.QListItemView({model: qitem}).render().el);
            }, this);
            return this;
        }
        
    }
});
//});