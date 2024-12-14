<?php


class Settings extends Dbh {

    public function sy($sy){

        $ex = explode("-", $sy);

        //check if exist already

        $q = "SELECT * FROM sy;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() > 0){
            header("Location:../controllers/settings.php?error=sy");
        } else {

            $q = "INSERT INTO sy(sy_from, sy_to) VALUES(?,?);";
            $stm = $this->connect()->prepare($q);
            $stm->execute([
                $ex['0'],
                $ex['1']
            ]); 

            header("Location:../controllers/settings.php?error=void");
        }

    }

    //get the data sy

    public function get_sy(){
       
        $q = "SELECT * FROM sy;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() > 0){

            $sy = $stm->fetch();
 
        } else {
            $sy = "";
        }

        return $sy;
    }

    //edit sy

    public function edit_sy($syid, $sy){

        $x = explode("-", $sy);
        $sy_from = $x['0'];
        $sy_to = $x['1'];

        $q = "UPDATE sy SET sy_from='$sy_from', sy_to='$sy_to' WHERE syid='$syid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();
        header("Location:../controllers/settings.php?error=sy_edit");

    }

    //insert year level and section 

    public function set_yr_sections($studtype, $section){

        $q = "SELECT * FROM year_level_section WHERE studtype='$studtype' AND section='$section';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() > 0){
            header("Location:../controllers/settings.php?error=yrs");
        } else {

            $q = "INSERT INTO year_level_section(studtype, section) VALUES(?,?);";
            $stm = $this->connect()->prepare($q);
            $stm->execute([
                $studtype,
                $section
            ]); 

            header("Location:../controllers/settings.php?error=void");
        }

    }

    //get the data sy

    public function get_yrs(){
       
        $q = "SELECT * FROM year_level_section;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() > 0){

            $yrs = $stm->fetchAll();
 
        } else {
            $yrs = "";
        }

        return $yrs;
    }

    //fetch year_level_section

    public function get_year_level_section(){

        $q = "SELECT * FROM year_level_section ORDER BY section ASC;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        return $stm->fetchAll();

    }

    //update year_level_section 

    public function update_year_level_section($ylsid, $studtype, $section){

        $q = "UPDATE year_level_section SET studtype='$studtype', section='$section' WHERE ylsid='$ylsid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm){
            header("Location:../controllers/year_level_section.php?success");
        } else {
            header("Location:../controllers/year_level_section.php?failed");
        }

    }

        //get the data contributions

        public function get_contributions(){
       
            $q = "SELECT * FROM contributions;";
            $stm = $this->connect()->prepare($q);
            $stm->execute();
    
            if($stm->rowCount() > 0){
    
                $contributions = $stm->fetchAll();
     
            } else {
                $contributions = "";
            }
    
            return $contributions;
        }

    //insert contributions
        public function set_contributions($payment_for, $payment_val){
            
            $q = "SELECT * FROM contributions WHERE payment_for='$payment_for' AND payment_val='$payment_val';";
            $stm = $this->connect()->prepare($q);
            $stm->execute();

            if($stm->rowCount() > 0){
                header("Location:../controllers/settings.php?error=contributions");
            } else {
                $q = "INSERT INTO contributions(payment_for, payment_val) VALUES(?,?);";
                $stm = $this->connect()->prepare($q);
                $stm->execute([
                    $payment_for,
                    $payment_val
                ]);
                header("Location:../controllers/settings.php?error=void");
            }
        }

    //update contributions 

        public function update_contributions($pid, $payment_for, $payment_val){

            $q = "UPDATE contributions SET payment_for='$payment_for', payment_val='$payment_val' WHERE pid='$pid';";
            $stm = $this->connect()->prepare($q);
            $stm->execute();

            header("Location:../controllers/contributions.php?edit=success");

        }

  

}