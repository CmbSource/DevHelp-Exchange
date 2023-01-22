/*global $,Backbone */
var app = app || {};
app.models.QItem = Backbone.Model.extend({

    urlRoot:'questionier/codeigniter/index.php/api/Question/questions',

    defaults: {
        questionId: "",
        userEmail: "",
        questionTitle: "",
        content: "",
        questionState: "",
        replyList: app.collections.ReplyItemCollection,
    },

    url: function () {
        return '/questionier/codeigniter/index.php/api/Question/questions/';
    },

    toJSON: function () {
        return {
            "questionId": this.get('questionId'),
            "userEmail": this.get('userEmail'),
            "questionTitle": this.get('questionTitle'),
            "content": this.get('content'),
            "questionState": this.get('questionState'),
        };
    }
});

app.collections.QItemCollection = Backbone.Collection.extend({

    model: app.models.QItem,

    url: "/questionier/codeigniter/index.php/api/Question/questions/"
});
