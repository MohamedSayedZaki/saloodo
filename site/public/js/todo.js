$(document).ready(function(){
    $(".parcel").click(function(){
        var parcel = $(this).data('id');

        $.ajax({
            type: "POST",
            url: url + "api/todo/create",
            headers: {
                'Authorization': "Bearer " + localStorage.getItem("token")
            },
            data: JSON.stringify({parcel : parcel}),
            contentType:"application/json; charset=utf-8",
            dataType:"json",
            success: function(data){
                console.log(data);
                alert(data.responseText);
                location.href = url + "api/todo";
            },
            error: function (data){
                $(this).attr("disabled");
                alert(data.responseText);        
                console.log(data);        
                // location.href = url + "logout";
            }            
        });

        return false;        
    });
});