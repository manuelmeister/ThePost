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
        statusCode:{
            404: function(){
                $("button.update").removeClass().addClass("update btn btn-danger");
                $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-remove").text();
                $("#crud-error").removeClass("hidden").text('Sorry, Entry could not be updated.');
            },
            401: function(){
                $("button.update").removeClass().addClass("update btn btn-danger");
                $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-remove").text();
                $("#crud-error").removeClass("hidden").html('You are not allowed to update, because you are not <a href="/login/">logged in</a>.');
            },
            406: function(){
                $("button.update").removeClass().addClass("update btn btn-danger");
                $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-remove").text();
                $("#crud-error").removeClass("hidden").html('You are not allowed to update, because this post does not belong to you.');
            }
        },
        success: function () {
            $("button.update").removeClass("btn-default").addClass("btn-success");
            $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-ok").text();
            $("span.update").text(" Updated");
            window.location.replace("/");
        }


    });
}

function addEntry(type){

    $("button.update").removeClass("btn-default").addClass("btn-primary");
    $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate").text();
    $("span.update").text(" Publishing");

    var title = $("h2.title.onedit").text();
    var text = $('.summernote').code();
    var data = {
        "title": title,
        "text": text
    };

    $.ajax({
        type: 'POST',
        url: '/create/'+type+"/",
        data: data,
        success: function () {
            $("button.update").removeClass("btn-default").addClass("btn-success");
            $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-ok").text();
            $("span.update").text(" Published");
            window.location.replace("/");
        },
        statusCode:{
            404: function(){
                $("button.update").removeClass().addClass("btn btn-danger");
                $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-remove").text();
                $("span.update").text(" Error");
                $("#crud-error").removeClass("hidden").text('Sorry, Entry could not be created.');
            },
            401: function(){
                $("button.update").removeClass().addClass("btn btn-danger");
                $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-remove").text();
                $("span.update").text(" Error");
                $("#crud-error").removeClass("hidden").html('You are not allowed to create, because you are not <a href="/login/">logged in</a>.');
            }
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
            $("span.update").text(" Error");
            $("button.update .glyphicon").removeClass().addClass("glyphicon glyphicon-remove").text();
        }
    });
}



function deleteEntry(key){

    $.ajax({
        type: 'POST',
        url: '/delete/entry/'+key,
        data: true,
        statusCode:{
            404: function(){
                $("#crud-error").removeClass("hidden").text('Sorry, Entry could not be deleted.');
                $("button.update .glyphicon").removeClass("glyphicon-*").addClass("glyphicon-remove").text();
                $("span.update").text(" Error");
            },
            401: function(){
                $("#crud-error").removeClass("hidden").html('You are not allowed to delete, because you are not <a href="/login/">logged in</a>.');
                $("button.update .glyphicon").removeClass("glyphicon-*").addClass("glyphicon-remove").text();
                $("span.update").text(" Error");
            }
        },
        success: function () {
            window.location.replace("/");
        }
    });

}

function areYouSure() {
    $("#sureDiv").show();
}

function notSure() {
    $("#sureDiv").hide();
}