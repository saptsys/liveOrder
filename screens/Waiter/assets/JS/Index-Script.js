$(document).ready(function(){
    /********************  AJAX  ****************** */
    $.post("action.php",{flag:"getTable"},function(data){
        $("#loader").fadeOut();
        $("#tables-container").html(data);
        $(".dining-table div").height($(".dining-table div").width()); //it makes width == height of table div
        
        $(".dining-table div").click(function(){
            var selectedTableName = $(this).children().first().html();
            $("#tables-container").fadeOut();
            alert(selectedTableName);
        });
    });
    /*************************** UI ***********************/
    $("#tables-container").sortable();
});