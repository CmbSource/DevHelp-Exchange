/*jslint nomen: true */
/*global $,Backbone,_,validateForm,alert,BookListItemView */
/*$(function () {
    "use strict";
*/
var app = app || {};

app.views.SearchBookView = Backbone.View.extend({

    initialize: function () {
        // app.searchBookResults = new app.collections.QItemCollection();
        // app.searchBookResultsView = new app.views.QListView({model: app.searchBookResults}); //model in place collection
        console.log("SearchQuestionView initialized");
    },

    render: function () {
        var template = _.template($("#searchbook_template").html());
        this.$el.html(template);
        // app.searchBookResults.reset();
        // this.$el.append(app.searchBookResultsView.render().el);
        this.delegateEvents({
            "click  #booksearch_submit"  : "searchBook",
            "keypress #searchBook_book_name" : "onkeypress"
        });
        return this;
    },

    searchBook : function () {
        var title = this.$("#searchBook_book_name").val();
        // app.searchBookResults.reset();
        if (!title) {
            alert("please enter the book name");
        } else {
            $.ajax({
                url: "codeigniter/index.php/api/Question/questionbyTitle/",
                type: "POST",
                dataType: "json",
                data: {
                    questionTitle: title
                }
            })
                .done(function (data) {
                    if (data["questionId"].length > 0) {
                        var subRoute = "#edit/" + data["questionId"];
                        app.appRouter.navigate(subRoute, { trigger: true, replace: true });
                    } else {
                        alert("No question found");
                    }
                })
                .fail(function (data) {
                    alert("No question found");
                });
        }
    },

    onkeypress: function (event) {
        if (event.keyCode === 13) {
            event.preventDefault(); // to prevent default submission action when enter key is pressed
        }
    }
});
//});
