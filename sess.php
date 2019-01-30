<?php
error_reporting(E_ALL);
session_start();
if (isset($_POST['session'])) {
    $session = eval("return {$_POST['session']};");
    if (is_array($session)) {
        $_SESSION = $session;
        header("Location: {$_SERVER['PHP_SELF']}?saved");
    }
    else {
        header("Location: {$_SERVER['PHP_SELF']}?error");
    }
}

$session = htmlentities(var_export($_SESSION, true));
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Session Variable Management</title>
        <style>
            textarea { font: 12px Consolas, Monaco, monospace; padding: 2px; border: 1px solid #444444; width: 99%; }
            .saved, .error { border: 1px solid #509151; background: #DDF0DD; padding: 2px; }
            .error { border-color: #915050; background: #F0DDDD; }
        </style>
    </head>
    <body>
        <h1>Session Variable Management</h1>
<?php if (isset($_GET['saved'])) { ?>
        <p class="saved">The session was saved successfully.</p>
<?php } else if (isset($_GET['error'])) { ?>
        <p class="error">The session variable did not parse correctly.</p>
<?php } ?>
        <form method="post">
            <textarea name="session" rows="<?php echo count(preg_split("/\n|\r/", $session)); ?>"><?php echo $session; ?></textarea>
            <input type="submit" value="Update Session">
        </form>
    </body>
</html>