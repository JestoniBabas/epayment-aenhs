<?php

class Payments extends Dbh {

    public function insert_payment($lrn, $studid, $studname, $studtype, $section, $teacher, $payment_for, $payment_val){

        //input current sy
        $query = "SELECT * FROM sy;";
        $execute = $this->connect()->prepare($query);
        $execute->execute();

        $r = $execute->fetch();

        $ex = explode("-", $payment_for);

        $bal = $ex['1'] - $payment_val;

        $ref = time()."-".$studid;

        $q = "INSERT INTO payments(lrn, studid, studname, studtype, section, teacher, payment_for, payment_val, payment_bal, sy_from, sy_to, ref)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stm = $this->connect()->prepare($q);
        $stm->execute([
            $lrn,
            $studid,
            $studname,
            $studtype,
            $section,
            $teacher,
            $payment_for,
            $payment_val,
            $bal,
            $r['sy_from'],
            $r['sy_to'],
            $ref
        ]);

    }

    public function payments(){
        $q = "SELECT SUM(payment_val) FROM payments;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        foreach($stm as $row){
            $data = $row['SUM(payment_val)'];
        }
        
        return $data;
    }

    public function search_student_lrn($lrn){
        $q = "SELECT * FROM payments WHERE lrn='$lrn';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() < 1){
            header("Location:../controllers/payment_history.php?query=void");
        } else {
             header("Location:../controllers/payment_history.php?query=$lrn");
        }
    }

    public function get_student_payment_record($lrn){
        $q = "SELECT * FROM payments WHERE lrn='$lrn' ORDER BY paymentid DESC;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        return $stm->fetchAll();
    }

    public function update_payment_info($paymentid, $lrn, $payment_bal){
        $q = "UPDATE payments SET payment_bal='$payment_bal' WHERE paymentid='$paymentid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();
    }

    public function search_records_dates($d_from, $d_to){

        $q = "SELECT * FROM payments WHERE DATE(dt) BETWEEN '$d_from' AND '$d_to';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() < 1){
            $data = "0";
        } else {
            $data = $stm->fetchAll();
        }

        return $data;

    }
        

}