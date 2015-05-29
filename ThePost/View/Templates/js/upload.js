function uploadEntry(type, id){
    $("button.update").removeClass("btn-default").addClass("btn-primary");
    $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate").text();
    $("span.update").text(" Updating");


    var title = $("h2.title.onedit").text();
    var text = $('.summernote').code();
    var data = {
        "title": title,
        "text": text
    };



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

function addEntry(type){

    $("button.update").removeClass("btn-default").addClass("btn-primary");
    $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate").text();
    $("span.update").text(" Publishing");


    var title = $("h2.title.onedit").text();
    var text = $('.summernote').code();
    var id = 0;
    var data = {
        "title": title,
        "text": text
    };



    $.ajax({
        type: 'POST',
        url: '/upload/'+type+"/"+id,
        data: data,
        success: function () {
            $("button.update").removeClass("btn-default").addClass("btn-success");
            $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-ok").text();
            $("span.update").text(" Published");
        },
        error: function () {
            $("button.update").removeClass("btn-default").addClass("btn-danger");
        }


    });
}


function uploadOptions(type, key, event){
    event.preventDefault();
    $("button.setting-"+key).removeClass("btn-default").addClass("btn-primary");
    $("button.setting-"+key+" .glyphicon").removeClass().addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate").text();
    $("span.string-setting-"+key).text(" Updating");


    var value = $('.input-setting-'+key).val();
    var data = {
        "value": value
    };



    $.ajax({
        type: 'POST',
        url: '/upload/'+type+"/"+key,
        data: data,
        success: function () {
            $("button.setting-"+key).removeClass("btn-default").addClass("btn-success");
            $("button.setting-"+key+" .glyphicon").removeClass().addClass("glyphicon glyphicon-ok").text();
            $("span.string-setting-"+key).text(" Updated");
        },
        error: function () {
            $("button.setting-"+key).removeClass("btn-*").addClass("btn-danger");
        }


    });
}



function remove(){

}