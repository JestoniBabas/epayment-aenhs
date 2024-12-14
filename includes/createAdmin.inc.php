<?php
class CreateAdmin extends Dbh {

    public $fullname;
    public $email;
    public $uname;
    public $pwd;
    public $utype;
    public $avatar;

    public function makeAccountAdmin(){

        $fullname = "Juan Dela Cruz";
        $email = "admin@gmail.com";
        $uname = "admin";
        $pwd = "admin";
        $utype = "admin";
        $section = "-";
        $avatar = "avatar.png";

        $opt = [
            'cost' => 12
        ];

        $pwdHashed = password_hash($pwd, PASSWORD_BCRYPT, $opt);

        $q = "SELECT * FROM users WHERE utype='admin';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() < 1){

            $q = "INSERT INTO users(fullname, email, uname, pwd, utype, section, avatar) VALUES(?,?,?,?,?,?,?);";
            $stm = $this->connect()->prepare($q);
            $stm->execute([
                $fullname,
                $email,
                $uname,
                $pwdHashed,
                $utype,
                $section,
                $avatar
            ]);

        }

        return $stm;

    }

}