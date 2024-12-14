<?php

require 'Dbh.php';

class Users extends Dbh {

    //create user account
    public function createUser($fullname, $email, $uname, $pwd, $utype, $section, $avatar) {

        $avatar = "avatar.png";

        $g = "SELECT * FROM year_level_section WHERE section='$section';";
        $s = $this->connect()->prepare($g);
        $s->execute();

        $r = $s->fetch();

        $studtype = $r['studtype'];


        if($utype !== "teacher"){
            $section = "-";
            $studtype = "-";
        }

        //hash password
        $options = [
            'cost' => 12
        ]; 

        $pwdHashed = password_hash($pwd, PASSWORD_BCRYPT, $options);
        //end hash

        $sql = "INSERT INTO users(fullname, email, uname, pwd, utype, studtype, section, avatar) VALUES(?,?,?,?,?,?,?,?)";
        $stm = $this->connect()->prepare($sql);
        $stm->execute([
            $fullname,
            $email,
            $uname,
            $pwdHashed,
            $utype,
            $studtype,
            $section,
            $avatar
        ]);

        if($stm){
            header("Location:../add_user_account.php?signUp=success");

        } else {
            header("Location:../add_user_account.php?signUp=failed");
        }

        return $stm;
        
    }

    //log in user
    //grab first email to fetch the password 
    //then verify password

    public function loginEmail($email) {

        $q = "SELECT * FROM users WHERE email='$email';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() > 0){

            $userPwd = $stm->fetch();
            return $userPwd;

        }
    }


    //get all users

    public function getAllUsers(){

        $q = "SELECT * FROM users ORDER BY fullname ASC";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        $user = $stm->fetchAll();
        
        return $user;
        
    }

    //preview user data 

    public function previewUser($uid){

        $q = "SELECT * FROM users WHERE uid='$uid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        $row = $stm->fetch();

        return $row;

    }

    //update user data 

    public function setUser($uid, $fullname, $email, $uname, $pwd, $utype, $section, $avatar){

        $g = "SELECT * FROM year_level_section WHERE section='$section';";
        $s = $this->connect()->prepare($g);
        $s->execute();

        $r = $s->fetch();

        $studtype = $r['studtype'];

        

        $avatar = $_FILES['pic']['name'];
        
        if($avatar !== ""){

            $allowed = array("jpeg", "jpg", "gif", "png");
            $ext = explode(".", $avatar);

            if(in_array($ext[1], $allowed)){
                

                $pic_name = md5($avatar).time().".".$ext[1];
                $loc = "../images/";
                
                if(move_uploaded_file($_FILES["pic"]["tmp_name"], $loc.$pic_name)) {
                    
                   $q = "UPDATE users SET avatar='$pic_name' WHERE uid='$uid';";
                   $stm = $this->connect()->prepare($q);
                   $stm->execute();

                   if($uid === $_SESSION['uid']){
                        $_SESSION['avatar'] = $pic_name;
                    }

                }
                
            }

           
        }

        if($pwd !== ""){

            //hash password
            $options = [
                'cost' => 12
            ]; 

            $pwdHashed = password_hash($pwd, PASSWORD_BCRYPT, $options);
            //end hash

            $q = "UPDATE users SET pwd='$pwdHashed' WHERE uid='$uid';";
            $stm = $this->connect()->prepare($q);
            $stm->execute();

        }

        //if usertype is teacher then update to another users
        if($utype !== "teacher"){
            $section = "-";
        }

        $q = "UPDATE users SET fullname='$fullname', email='$email', uname='$uname', utype='$utype', studtype='$studtype', section='$section' WHERE uid='$uid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        
    }

    //fetch year_level_section

    public function get_year_level_section(){

        $q = "SELECT * FROM year_level_section ORDER BY section ASC;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        return $stm->fetchAll();

    }

    public function get_teacher_uid($fullname, $studtype, $section){

        $q = "SELECT * FROM users WHERE fullname='$fullname' AND studtype='$studtype' AND section='$section';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        $data = $stm->fetch();

        return $data;

    }

}