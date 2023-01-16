/*global $,Backbone,_,validateForm,alert,BookListItemView */
//$(function () {
var app = app || {};
app.views.BookListItemView = Backbone.View.extend({

    tagName: "li",

    render: function () {
        var template = _.template($("#bookitem_template").html(), this.model.attributes);
        this.$el.html(template);
        return this;
    }
});
app.views.BookListView = Backbone.View.extend({

    tagName: "ul",

    className: "booklist",

    initialize: function () {
        if (localStorage.getItem("auth_token") == 0) {
            app.appRouter.navigate("#", { trigger: true, replace: true });
        }else{
            var _this = this; //view reference
            this.model.on("reset", this.render, this);
            this.model.on("add", function (bookitem) {
                _this.$el.append(new app.views.BookListItemView({model: bookitem}).render().el);
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
            _.each(this.model.models, function (bookitem) {
                this.$el.append(new app.views.BookListItemView({model: bookitem}).render().el);
            }, this);
            return this;
        }
        
    }
});
//});