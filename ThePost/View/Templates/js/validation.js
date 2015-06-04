function checkPass()
{
    //passwords
    var pass1 = document.getElementById('user_password').value;
    var pass2 = document.getElementById('user_password_verify').value;

    //validation
    if(pass1 == pass2){
        $('#confirmMessage').html("Passwords Match!");
        $('#confirmMessageDiv').removeClass('alert alert-warning').addClass('alert alert-success').show();
        return true;
    }else{
        $('#confirmMessage').html("Passwords Do Not Match!");
        $('#confirmMessageDiv').removeClass('alert alert-success').addClass('alert alert-warning').show();
        return false;

    }
}

function checkSubmit(){
    if (checkPass()) {
        document.getElementById("installForm").submit();
    } else {
        $('#passwordsAlert').show();
    }

}