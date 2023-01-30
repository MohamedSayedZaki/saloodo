$(document).ready(function(){
    $(".login-form").submit(function(){
        var email = $("#email").val();
        var pwd = $("#pwd").val();
        localStorage.removeItem("token");
        $.ajax({
            url: url + "api/login_check",
            type:"POST",
            data: JSON.stringify({email : email, password : pwd}),
            contentType:"application/json; charset=utf-8",
            dataType:"json",
            success: function(data){
                localStorage.setItem("token", data.token);
                location.href = url + "api/home";//"api/parcel";
            },
            error: function (data){
                console.log(data.responseJSON.message);
                alert(data.responseJSON.message);        
            }
        });

        return false;
    });
});