function logout(){
    window.location="../../lib/logout.php";
}



$(document).ready(function(){

    // $("#iBtn").hover(function(){
    //     $("#iBtn").css("opacity","1");
    // },function(){
    //     $("#iBtn").css("opacity",".4");
    // });

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
                opacity:"0.97",
            },function(){
                $("#info-page").slideDown(500);
            });

        }
        else
        {
            iBtn_State = true;
            $("#info-page").slideUp(500);
            $("#header").css("overflow","hidden");
            $("#header").animate({
                height:header_height,
                opacity:"1",
            });
            $("body").css("overflow-y","auto");
        }

    });

});