<?php
class Chart extends Dbh{

    public function payment_val(){
        $q = "SELECT SUM(payment_val) AS total_val FROM payments;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

            $row = $stm->fetch();
            $data = $row['total_val'];
      
            return $data;

    }

    public function payment_bal(){
        $q = "SELECT SUM(payment_bal) AS total_bal FROM payments;";
        $stm = $this->connect()->prepare($q);
        $stm->execute();

        $row = $stm->fetch();
            $data = $row['total_bal'];
      
            return $data;

    }

    public function to_pay(){
        // SQL query to select all values from 'payment_for'
        $q = "SELECT payment_for FROM payments;";
        
        // Prepare and execute the query
        $stm = $this->connect()->prepare($q);
        $stm->execute();
    
        $total_payment = 0;
    
        // Loop through each row and extract the number from 'payment_for'
        while ($row = $stm->fetch()) {
            // Extract the numeric part from the string (using regular expression)
            if (preg_match('/\d+/', $row['payment_for'], $matches)) {
                // Add the number to the total payment
                $total_payment += (int) $matches[0];
            }
        }
    
        return $total_payment;
    }
}