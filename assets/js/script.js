function logout(){
    window.location="../../lib/logout.php";
}



$(document).ready(function(){

    $("#header").hover(function(){
        $("#iBtn").fadeIn(1500);
    },function(){
        $("#iBtn").fadeOut(1500);
    });

    var iBtn_State = true;
    var header_height = $("#header").height();
    $("#iBtn").click(function(){
        if(iBtn_State)
        {
            iBtn_State = false;
            $("body").css("overflow","hidden");
            $("#header").css("overflow","auto");
            $("#header").animate({
                height:"100vh",
                opacity:"0.9",
            },function(){
                $("#info-page").show();
            });

        }
        else
        {
            iBtn_State = true;
            $("#info-page").hide();
            $("#header").css("overflow","hidden");
            $("#header").animate({
                height:header_height,
                opacity:"1",
            });
            $("body").css("overflow-y","auto");
        }

    });

});