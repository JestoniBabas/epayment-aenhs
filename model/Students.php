<?php

class Students extends Dbh{

    //check double lrn
    // public function lrnDoubleChecker($lrn, $sy_from, $sy_to){
    //     $q = "SELECT * FROM students WHERE LRN='$lrn' AND sy_from='$sy_from' AND sy_to='$sy_to';";
    //     $stm = $this->connect()->prepare($q);
    //     $stm->execute();

    // }

    public function insertStudent($lrn, $fname, $mname, $lname, $xname, $sex, $studtype, $section, $teacher){

        $qu = "SELECT * FROM students WHERE lrn='$lrn';";
        $p = $this->connect()->prepare($qu);
        $p->execute();

        if($p->rowCount() > 0){
             header("Location:../controllers/add_student.php?add=failed");
        } else {
            $q = "INSERT INTO students(lrn, fname, mname, lname, xname, sex, studtype, section, teacher, uid) VALUES(?,?,?,?,?,?,?,?,?,?);";
            $stm = $this->connect()->prepare($q);
            $stm->execute([
                $lrn,
                $fname,
                $mname,
                $lname,
                $xname,
                $sex,
                $studtype,
                $section,
                $teacher,
                $_SESSION['uid']
            ]);

            header("Location:../controllers/add_student.php?add=success");
        }

    }

    public function getTeacherYrlevel($section){

        $q = "SELECT * FROM year_level_section WHERE section='$section';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        $data = $stm->fetch();

        return $data;

    }

    public function getStudentList($section, $fullname){

        $q = "SELECT * FROM students WHERE section='$section' AND teacher='$fullname' ORDER BY fname ASC;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() < 1){
            $data = "";
        } else {
            $data = $stm->fetchAll();
        }
        return $data;

    }

    public function editStudentInfo($studid, $lrn, $fname, $mname, $lname, $xname, $sex) {

        $q = "UPDATE students SET lrn='$lrn', fname='$fname', mname='$mname', lname='$lname', xname='$xname', sex='$sex' WHERE studid='$studid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        header("Location:../controllers/student_list.php?edit=success");
        
    }

    //stud payment 
    public function search_student($lrn){


        $q = "SELECT * FROM students WHERE lrn='$lrn';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() < 1){
            header("Location:../controllers/payments.php?search=failed");
        } else {
            $data = $stm->fetch();
            $studid = $data['studid'];
            header("Location:../controllers/payments.php?search=".$studid."");
        }

    }

    //search student via studid 
    public function get_student($studid){


        $q = "SELECT * FROM students WHERE studid='$studid';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        $data = $stm->fetch();
        return $data;
    
    }

    //number of male students
    public function male_students(){
        $q = "SELECT * FROM students WHERE sex='MALE';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        return $stm->rowCount();
    }

    //number of female students
    public function female_students(){
        $q = "SELECT * FROM students WHERE sex='FEMALE';";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        return $stm->rowCount();
    }

    //get all student list
    public function getAllStudents(){
        $q = "SELECT * FROM students";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        if($stm->rowCount() > 0){
            $data = $stm->fetchAll();
        }
        return $data;
    }

    //insert student info to students_history for reference
    public function insertStudentsRecord($lrn, $fname, $mname, $lname, $xname, $sex, $studtype, $section, $teacher, $sy_from, $sy_to){

       $q = "INSERT INTO students_history(lrn, fname, mname, lname, xname, sex, studtype, section, teacher, sy_from, sy_to) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
        $stm = $this->connect()->prepare($q);
        $stm->execute([
            $lrn,
            $fname,
            $mname,
            $lname,
            $xname,
            $sex,
            $studtype,
            $section,
            $teacher,
            $sy_from,
            $sy_to
        ]);

    }

     //insert student info to students_history for reference
     public function deleteStudentsRecord($studid){

        $q = "DELETE FROM students WHERE studid='$studid'";
        $stm = $this->connect()->prepare($q);
        $stm->execute();
 
     }

    


}