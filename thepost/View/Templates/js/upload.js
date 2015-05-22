function upload(type, id){
    $("button.update").removeClass("btn-default").addClass("btn-primary");
    $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate").text();
    $("span.update").text(" Updating");


    var title = $("h2.title.onedit").text();
    var text = $('.summernote').code();
    var data = {
        "title": title,
        "text": text
    }



    $.ajax({
        type: 'POST',
        url: '/upload/'+type+"/"+id,
        data: data,
        success: function () {
            $("button.update").removeClass("btn-default").addClass("btn-success");
            $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-ok").text();
            $("span.update").text(" Updated");
        },
        error: function () {
            $("button.update").removeClass("btn-default").addClass("btn-danger");
        }


    });
}
