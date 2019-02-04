$(document).ready(function () {
    getUsers();
    getTables();
    setInterval(() => {
        getUsers();
        getTables();
    }, 5000);
});
function getUsers() { 
    $.post("action.php",{flag:"getUsers"},function(data){
        $("#userContent").html(data);
    });
}
function getTables() { 
    $.post("action.php",{flag:"getTables"},function(data){
        $("#tableContent").html(data);
    });
}
function editUser(id){
    $.post("action.php",{flag:"editUser",id:id},function(data){
        $("#dialog").attr('title', 'Edit User');
        $("#dialog").html(data);
        $("#dialog").dialog(); 
    });
}
function editTable(id){
    $.post("action.php",{flag:"editTable",id:id},function(data){
        $("#dialog").attr('title', 'Edit Table');
        $("#dialog").html(data);
        $("#dialog").dialog(); 
    });
}
function deleteUser (id){
    $.post("action.php",{flag:"deleteUser",id:id},function(data){
        if(data=="1") $("#user"+id).fadeOut();
    });
}
function deleteTable (id){
    $.post("action.php",{flag:"deleteTable",id:id},function(data){
        if(data=="1") $("#table"+id).fadeOut();
    });
}
function addUser (){
    $.post("action.php",{flag:"addUser"},function(data){
        console.log(data);
    });
}
function addTable(){
    $.post("action.php",{flag:"addTable"},function(data){
        console.log(data);
    });
}

