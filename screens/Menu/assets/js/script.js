$(document).ready(function () {
    search("");

    $("#searchBox").keyup(function(){
        search($(this).val());
    });
    var searchBox_width = $("#searchBox").width();
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if(scroll > 68)
        {
            $("#searchBox").css({
                position:"fixed",
                width:searchBox_width,
                marginTop:"-70px"
            });
        }   
        else
        {
            $("#searchBox").css({
                position:"static"
            });
        }
    });

});
function search(query) { 
    $.post("action.php",{flag:"search",type:"none",query:query},function(data){
        $(".result-row").html(data);
    });
}