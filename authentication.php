<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] != "POST") exit();
    require 'config.php';
    class authenticate extends config{
        public function __construct($user,$pass){
            $user=$this->filter($user);
            $pass=$this->filter($pass);
            $this->checkdb($user,$pass);
        }
        //check that user is entered plain text or not
        public function filter($data) {
            $data = trim(htmlentities(strip_tags($data)));
            if (get_magic_quotes_gpc()) $data = stripslashes($data);
            $data = mysqli_real_escape_string($this->db(),$data);
            return $data;
        }
        public function checkdb($user,$pass){
            $ok=false;
            $link=$this->db();
            $pass=sha1(md5($pass));
            $stmt="SELECT * FROM users WHERE Username = '$user' AND Password = '$pass' LIMIT 1";
            if($fire=mysqli_query($link,$stmt)){
                if(mysqli_affected_rows($link) == 1){
                    $ok=true;
                    $data=mysqli_fetch_assoc($fire);
                    //cookie for remember user
                    $user=(string)$data['Username'];
                    $pass=(string)  $data['Password'];
                    setcookie("user",$user,time() + (86400 * 365), "/");
                    setcookie("pass",$pass,time() + (86400 * 365), "/");

                    //sessions
                    $_SESSION['user']=$user;
                    $_SESSION['pass']=$pass;
                    $_SESSION['role']=$data["Role"];

                    //redirecting according their roles
                    header ("Location: screens/".$data["Role"]);
                } 
            }else{ 
                $ok=false;
            }
        }
    }
    $allok=false;
    if ( (isset($_POST['username'])) && (isset($_POST["password"])) ) {
       if( ($_POST['username'] != "") && ($_POST['password'] != "") ){
            $allok=true;
       }else $allok=false;
    }else $allok = false;
    if($allok) {
        $auth=new authenticate($_POST["username"],$_POST["password"]);
    }else{
        echo "something went wrong";
    }
?>