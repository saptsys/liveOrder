<?php
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
            $ok;
            $con=$this->db();
            $stmt=$con->prepare('SELECT * FROM users WHERE Username = ? AND Password = ? LIMIT 1');
            $stmt->bind_param("ss",$user,$pass);
            if($stmt->execute()){
                if($stmt){
                    $ok=true;
                    $data=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    $data=$data[0];
                    
                    //redirection according their role and create cookie and sessions
                    echo "this is an ". $data['FirstName']." ".$data['LastName']." redirect to ".$data['Role'] ."Page";
                }
            }else $ok=false;
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