<?php
    session_start();
    if( ( (isset($_COOKIE['user'])) && (isset($_COOKIE['pass'])) ) ){
        if( !( isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['role']) ) ){
            require_once '../../auth.php';
            $auth = new authenticate($_COOKIE['user'],$_COOKIE['pass'],false,true);
            if(!$auth->authenticated) header('Location: ../../');
            else{
                header('Location: ../../');
                exit();
            }
        }else{
            if(! ($_SESSION['role'] == "Waiter") ){
                header('Location: ../../');
            }
        }
    }else{
        header('Location: ../../');
        exit();
    }
    include "../../config.php";
    $mycon = new config();
    $con = $mycon->db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home : Waiter</title>
    <link rel="icon" href="https://image.flaticon.com/icons/png/512/65/65155.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="../../assets/js/JQueryUi/jquery-ui.css">
    <link rel="stylesheet" href="../../assets/js/jquery-ui.structure.css">
    <link rel="stylesheet" href="../../assets/js/jquery-ui.theme.css">
    <script src="../../assets/js/JQueryUi/jquery-ui.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/print.css">
    <link rel="stylesheet" href="../../assets/css/Index-style.css">
    <link rel="stylesheet" href="assets/css/Index-Media-Query.css">
    <link rel="stylesheet" href="../../assets/css/header.css">

    <script src="../../assets/js/script.js"></script>
</head>
<body>
    
<?php require_once '../../component/header.php'?>
    <div id="main-page" class="container">
        <hr>

        <div id="tabs">
            <ul>
                <li><a id="tablesTab" href="#tables">Tables</a></li>
                <li><a id="kitchenTab" href="#kitchen">Kitchen <span id='totalReady'></span></a></li>
            </ul>
            <div id="tables">
                <div id="tables-container" class="row"></div><!--#tables-container-->
                <center><div id="loader"><img src="../../assets/images/loader.gif" width=100px alt="Loading.."></div></center>
                <div id="menu-container" class="row"></div>
            </div>
            <div id='kitchen'>
            </div>
        </div>

    </div> <!-- #main-page .container .row -->
    <div id="dialog" title="Ordered Items">
    </div>

    <div id="feedbackWrapper">
        <div id="feedbackOpen"style="margin-top:5px" >
            <textarea class="form-control" placeholder="Feedback Here..." style="resize: none;" id="feedbackarea" cols="30" rows="3"></textarea>
        </div>
    </div>
<script src="assets/JS/Index-Script.js"></script>
</body>
</html>
<div id="print_page_conainer"></div>

<script language="VBScript">
// THIS VB SCRIP REMOVES THE PRINT DIALOG BOX AND PRINTS TO YOUR DEFAULT PRINTER
Sub window_onunload()
On Error Resume Next
Set WB = nothing
On Error Goto 0
End Sub

Sub Print()
OLECMDID_PRINT = 6
OLECMDEXECOPT_DONTPROMPTUSER = 2
OLECMDEXECOPT_PROMPTUSER = 1


On Error Resume Next

If DA Then
call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)

Else
call WB.IOleCommandTarget.Exec(OLECMDID_PRINT ,OLECMDEXECOPT_DONTPROMPTUSER,"","","")

End If

If Err.Number <> 0 Then
If DA Then 
Alert("Nothing Printed :" & err.number & " : " & err.description)
Else
HandleError()
End if
End If
On Error Goto 0
End Sub

If DA Then
wbvers="8856F961-340A-11D0-A96B-00C04FD705A2"
Else
wbvers="EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B"
End If

document.write "<object ID=""WB"" WIDTH=0 HEIGHT=0 CLASSID=""CLSID:"
document.write wbvers & """> </object>"
</script>
