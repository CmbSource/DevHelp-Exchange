/*global $,Backbone */
var app = app || {};
app.models.ReplyItem = Backbone.Model.extend({

    urlRoot:'questionier/codeigniter/index.php/api/Question/replies',

    defaults: {
        questionId: "",
        replyId: "",
        userEmail: "",
        content: "",
        replyState: ""
    },

    url: function () {
        return '/questionier/codeigniter/index.php/api/Question/replies/';
    },

    toJSON: function () {
        return {
            "questionId": this.get('questionId'),
            "replyId": this.get('replyId'),
            "userEmail": this.get('userEmail'),
            "content": this.get('content'),
            "replyState": this.get('replyState')
        };
    }
});

app.collections.ReplyItemCollection = Backbone.Collection.extend({

    model: app.models.ReplyItem,

    url: "/questionier/codeigniter/index.php/api/Question/replies/"
});
