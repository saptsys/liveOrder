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
        $("#dialog").html(data);
        $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Edit User");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {flag:"addUserDB"},
                        function (data) {
                            console.log(data);
                            if(data=="true") $("#dialog").dialog( "close" );
                        }
                    );
                }
            }
        });
    });
}
function editTable(id){
    $.post("action.php",{flag:"editTable",id:id},function(data){
        $("#dialog").html(data);
        $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Edit Table");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {flag:"addTableDB"},
                        function (data) {
                            console.log(data);
                            if(data=="true") $("#dialog").dialog( "close" );
                        }
                    );
                }
            }
        });
    });
}

function addUser (showDialog=true){
    if(showDialog){
        $.post("action.php",{flag:"addUser"},function(data){
            $("#dialog").html(data);
            $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Add User");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {flag:"addUserDB"},
                        function (data) {
                            console.log(data);
                            if(data=="true") $("#dialog").dialog( "close" );
                        }
                    );
                }
            }
        });
        });
    }else{
        $.post("action.php",{flag:"addUserDB"},function(data){
            console.log(data);
        });
    }
}
function addTable(flag=false){
    $.post("action.php",{flag:"addTable"},function(data){
        $("#dialog").html(data);
        $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Add Table");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {flag:"addTableDB"},
                        function (data) {
                            console.log(data);
                            if(data=="true") $("#dialog").dialog( "close" );
                        }
                    );
                }
            }
        });
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