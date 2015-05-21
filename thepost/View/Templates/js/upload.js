function upload(type, id){
    $("button.update").removeClass("btn-default").addClass("btn-primary");
    $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate").text();



    var title = $(".title").text();
    var text = $(".text").text();
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

        },
        error: function () {
            $("button.update").removeClass("btn-default").addClass("btn-danger");
        }


    });
}
