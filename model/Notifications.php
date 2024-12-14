<?php

class Notifications extends Dbh{

    public function fetch_notif_counter($uid){

        $q = "SELECT * FROM notif_counter WHERE uid='$uid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() > 0){
            echo '<span class="badge bg-danger"><a href="../controllers/notifications.php" class="text-white a_notif">'.$stm->rowCount().'</a></span>';
        }
    }



    public function insert_notifications($uid, $icon, $notification){

        $q = "INSERT INTO notifications(uid, icon, notification) VALUES(?,?,?)";
        $stm = $this->connect()->prepare($q);
        $stm->execute([
            $uid,
            $icon,
            $notification
        ]);

        $q = "INSERT INTO notif_counter(uid) VALUES(?)";
        $stm = $this->connect()->prepare($q);
        $stm->execute([
            $uid
        ]);

    }

    public function clear_notif_counter($uid){

        $q = "DELETE FROM notif_counter WHERE uid='$uid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

    }

    public function fetch_notifications($uid){

        $q = "SELECT * FROM notifications WHERE uid='$uid' ORDER BY notid DESC LIMIT 0, 20;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() < 1){
            $data = "";
        } else {
            $data = $stm->fetchAll();
        }

        return $data;

    }

    //get admin uid 
    public function getAdminUid(){

        $q = "SELECT * FROM users WHERE utype='admin';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        $data = $stm->fetch();

        return $data;

    }

    public function getAllNotif(){
        $q = "SELECT * FROM notifications;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        
        
        return $stm->rowCount();
    }

}