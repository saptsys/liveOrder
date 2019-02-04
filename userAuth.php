<?php session_start();
require 'config.php';
class authenticate extends config{
    private $Data;
    private $User;
    private $Pass;
    public $authenticated=false;
    public function __construct($user,$pass,$setCookie=true,$SetSession=true){
        $this->User=$this->filter($user);
        $this->Pass=($setCookie) ? sha1(md5($pass)) : $pass;
        $this->checkdb();
        if($this->authenticated){
            if($setCookie) $this->setCookies();
            if($SetSession) $this->setSession();
        }
    }
    //check that user is entered plain text or not for avoiding SQL injection
    public function filter($data) {
        $data = trim(htmlentities(strip_tags($data)));
        if (get_magic_quotes_gpc()) $data = stripslashes($data);
        $data = mysqli_real_escape_string($this->db(),$data);
        return $data;
    }
    public function setCookies(){
        //cookie for remember user
        $user=$this->User;
        $pass=$this->Pass;
        setcookie("user",$user,time() + (86400 * 365), "/");
        setcookie("pass",$pass,time() + (86400 * 365), "/");
    }
    public function setSession(){
        $user=$this->User;
        $pass=$this->Pass;

        //sessions
        $_SESSION['user']=$user;
        $_SESSION['pass']=$pass;
        $_SESSION['role']=$this->Data["Role"];
    }
    public function checkdb(){
        $ok=false;
        $link=$this->db();
        $user=$this->User;
        $pass=$this->Pass;
        $stmt="SELECT * FROM users WHERE Username = '$user' AND Password = '$pass' LIMIT 1";
        if($fire=mysqli_query($link,$stmt)){
            if(mysqli_affected_rows($link) == 1){
                $ok=true;
                $this->Data=mysqli_fetch_assoc($fire);
                //redirecting according their roles
                $this->authenticated=true;
                header ("Location: screens/".$this->Data["Role"]);
            } else $ok=false;
        }else $ok=false;
        if(!$ok){
            $this->authenticated=false;
            echo "<script>
                alert('Invalid Username and Password')
                window.location='login.php';
            </script>";
        }
    }
}
?>