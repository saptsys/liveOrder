$(document).ready(function(){
    /********************  AJAX  ****************** */
      
    establishTables();

    /*************************** JS ***********************/





    /*************************** UI ***********************/
});

function establishTables() //its fetch tables and code of onclick on tables
{
    $("#loader").show();
    $.post("action.php",{flag:"getTable"},function(data){
        $("#loader").hide();
        $("#tables-container").html(data)
        $(".dining-table div").height($(".dining-table div").width()); //it makes width == height of table div
        var height = $(".dining-table").height();
        $(".arrows").css({
            "margin-top":height/2+10+"px"
        });
        

        $(".dining-table div").click(function(){
            var selectedTableName = $(this).children().first().html();
            obj = $(this).parent();
            $('.dining-table').not(obj).each(function(){
                $(this).hide(500);
            });
            $(".backArrow").fadeIn();
            $(".forwardArrow").fadeIn();
            tableSelected(selectedTableName);
        });
        $(".backArrow").click(function(){
            $(".forwardArrow").fadeOut();
            $("#tables-container .dining-table ").show(500);
            $(".backArrow").fadeOut();
            $("#menu-container").slideUp();
        });
    });
}
function tableSelected(tableName)
{
    $("#loader").show();
    data="";
    $("#menu-container").slideDown();
    $.post("action.php",{flag:"getMenu"},function(data,status){
        if(status=="success"){
            $("#loader").hide();
            $("#menu-container").html(data);
        }
        
    });
}
