$(document).ready(function(){
    $(".parcel-new-form").submit(function(){

        var title = $("#title").val();
        var pick_up = $("#pick-up").val();
        var drop_off = $("#drop-off").val();
        
        $.ajax({
            type: "POST",
            url: url + "api/parcel/add",
            headers: {
                'Authorization': "Bearer " + localStorage.getItem("token")
            },
            data: JSON.stringify({title : title, pick_up : pick_up, drop_off : drop_off}),
            contentType:"application/json; charset=utf-8",
            dataType:"json",
            success: function(data){
                console.log(data);
                location.href = url + "api/parcel/index";
            },
            error: function (data){
                alert(data);        
                console.log(data);
                // location.href = url + "logout";
            }            
        });

        return false;
    });
});