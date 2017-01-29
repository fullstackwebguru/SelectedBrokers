$(document).on('click', 'a.review-more-btn', function() {
    var startPos = $(this).attr('data-pos');

    var that = $(this);

    $.ajax( {
        type: "GET",
        url : "review/generate?startPos="+startPos,
        success : function (data) {
            that.parent().parent().parent().remove();
            $("#lazy-reviews-container").append(data);
        },
        dataType: 'html'
    });
});

$(document).on('click', 'a.news-more-btn', function() {
    var startPos = $(this).attr('data-pos');

    var that = $(this);

    $.ajax( {
        type: "GET",
        url : "news/generate?startPos="+startPos,
        success : function (data) {
            that.parent().parent().parent().remove();
            $("#lazy-news-container").append(data);
        },
        dataType: 'html'
    });
});