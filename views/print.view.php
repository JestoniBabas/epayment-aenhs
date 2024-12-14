<link rel="stylesheet" type="text/css" href="../css/app.css"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
<?php
session_start();

echo '<div class="print_header">
                <img src="../images/edu_logo.png" class="edu_logo" alt="logo"/>
                <h4 class="p-0 m-0">Republic of the Philippines</h4>
                <h3 class="p-0 m-0">Department of Education</h3>
                <h5 class="p-0 m-0">Region II - Cagayan Valley</h5>
                <h5 class="p-0 m-0">Schools Division Office of Cagayan</h5>
                <h5 class="p-0 m-0">Aparri East National High School</h5>
        </div>
        
        <table class="tbl_print">
            <tr>
                <td colspan="10"><b>Search results FROM '.$_SESSION['d_from']." to ".$_SESSION['d_to'].'</b></td>
            </tr>
            <tr>
                <td>LRN</td>
                <td>Name</td>
                <td>Year level</td>
                <td>Section</td>
                <td>Teacher</td>
                <td>Payment for</td>
                <td>Payment given</td>
                <td>Payment bal</td>
                <td>S.Y.</td>
                <td>Date & time</td>
            </tr>';


$_SESSION['payment_for'] = 0; 
$_SESSION['payment_val'] = 0; 
$_SESSION['payment_bal'] = 0; 

foreach($_SESSION['data'] as $row){
    
    echo '<tr>
            <td>'.$row['lrn'].'</td>
            <td>'.$row['studname'].'</td>
            <td>'.$row['studtype'].'</td>
            <td>'.$row['section'].'</td>
            <td>'.$row['teacher'].'</td>
            <td>'.$row['payment_for'].'</td>
            <td>'.$row['payment_val'].'</td>
            <td>'.$row['payment_bal'].'</td>
            <td>'.$row['sy_from']."-".$row['sy_to'].'</td>
            <td>'.$row['dt'].'</td>
        </tr>';
        $ex = explode("-", $row['payment_for']);
        $_SESSION['payment_for'] += $ex[1];
        $_SESSION['payment_val'] += $row['payment_val'];
        $_SESSION['payment_bal'] += $row['payment_bal'];
}
echo '
        <tr>
            <td colspan="5" align="right"><b>Totals</b></td>
            <td><b>'.number_format($_SESSION['payment_for']).'</b></td>
            <td><b>'.number_format($_SESSION['payment_val']).'</b></td>
            <td><b>'.number_format($_SESSION['payment_bal']).'</b></td>
            <td colspan="2"></td>
        </tr>
    </table>
    <div class="print_footer">
        <img src="../images/footer_logo.png" class="footer_logo" alt="logo"/>
        <img src="../images/logo.png" class="footer_orig" alt="logo"/>
        <div class="footer_floater">
            
            <p class="p-0 m-0">Address:  Maura, Aparri, Cagayan, 3515</p>
            <p class="p-0 m-0">Telephone Nos.: Contact Nos.: +639102924796</p>
            <p class="p-0 m-0">Email Address: 300471@deped.gov.ph</p>
            <p class="p-0 m-0">Website: https://sites.google.com/deped.gov.ph/300471</p>

        </div>
        
    </div>
    
    <button class="btn btn-danger" id="btn_print" onclick="window.print()">Print</button>
    <a class="btn btn-primary" id="btn_return" href="../controllers/records.php">Back</a>

    ';