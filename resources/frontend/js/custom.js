/* Write here your custom javascript codes */

// declare url ajax load data
var url = 'http://localhost/~maulayyacyber/mtt/'

// function articles
$(document).ready(function(){
    articles(0);

    $("#load_more").click(function(e){
        e.preventDefault();
        var page = $(this).data('val');
        articles(page);

    });
});

var articles = function(page){
    $("#loader").show();
    $("#load_more").show();
    $.ajax({
        url: url+"home/get_articles",
        type:'GET',
        data: {page:page}
    }).done(function(response){
        $("#articles").append(response);
        $("#loader").hide();
        $('#load_more').data('val', ($('#load_more').data('val')+1));
        //scroll();
        if(response == ""){
            $("#load_more").hide();
        }
    });
};

// function events
$(document).ready(function(){
    events(0);

    $("#load_more_events").click(function(e){
        e.preventDefault();
        var page = $(this).data('val');
        events(page);

    });
});

var events = function(page){
    $("#loader").show();
    $("#load_more_events").show();
    $.ajax({
        url: url+"home/get_events",
        type:'GET',
        data: {page:page}
    }).done(function(response){
        $("#events").append(response);
        $("#loader").hide();
        $('#load_more_events').data('val', ($('#load_more_events').data('val')+1));
        //scroll();
        if(response == ""){
            $("#load_more_events").hide();
        }
    });
};