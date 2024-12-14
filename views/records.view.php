<div class="content">
    <div class="content_header">
            <button class="burger" onClick="showMenu()">
                <div></div>
                <div></div>
                <div></div>
            </button>
        <b class="locname"><?= $locName; ?></b>
        <ul class="ul_header_content">
            <li>
                <?php echo $_SESSION['fullname']."/".strtoupper($_SESSION['utype']); ?>
                <img src="../images/<?php echo $_SESSION['avatar']; ?>" class="header_content_avatar" alt="avatar">
            </li>
            <li class="li_rel">
                <span id="notif_loader"></span>
                <span class="glyphicon glyphicon-bell bell" onclick="trigger_notification()"></span>
            </li>
        </ul>
            
    </div>

    <main>

<div class="p-2">
        <?php
            $host = "localhost";
            $dbname = "epayment-aenhs";
            $user = "root";
            $pwd = "";
       
            $dsn = 'mysql:host=' . $host . '; dbname=' . $dbname;
            $pdo = new PDO($dsn, $user, $pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            $start = 0;
            $rows_per_page = 10  ;

            //get total rows in db 
            $q = "SELECT * FROM payments";
            $stm = $pdo->prepare($q);
            $stm->execute();

            $total_rows = $stm->rowCount();

            //divide 

            $pages = ceil($total_rows / $rows_per_page);

            if(isset($_GET['page'])){
                $page = $_GET['page'] - 1;
                $start = $page * $rows_per_page;
            }

            $q = "SELECT * FROM payments ORDER BY paymentid DESC LIMIT $start, $rows_per_page";
            $stm = $pdo->prepare($q);
            $stm->execute();

           
        ?>

        <div class="alert alert-info">
            <form method="POST" action="../includes/search_records_by_dates.inc.php">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <b>Date from</b>
                            <input type="date" name="d_from" class="form-control"/>
                        </div>
                        <div class="col-md-3">
                            <b>Date to</b>
                            <input type="date" name="d_to" class="form-control"/>
                        </div>
                        <div class="col-md-3">
                            <br/>
                            <input type="submit" class="btn btn-outline-success" value="SEARCH RECORD"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        

        <table class="table table-striped table-hover table-bordered">
            <tr>
                <td colspan="11"><p class="text-danger"><b>NOTE:</b> Fetch records is sorted from the recent transactions for ease of search.</p></td>
            </tr>
            <tr class="text-center">
                <td><b>Ref #</b></dt>
                <td><b>LRN</b></dt>
                <td><b>Name</b></dt>
                <td><b>Teacher</b></dt>
                <td><b>Year level</b></dt>
                <td><b>Grade / Section</b></dt>
                <td><b>Payment for</b></dt>
                <td><b>Payment value</b></dt>
                <td><b>Balance</b></dt>
                <td><b>Date & Time</b></dt>
                <td><b>S.Y.</b></dt>
            </tr>
        <?php
            foreach($stm->fetchAll() as $row){
        ?>
            <tr">
                <td><?= $row['ref']; ?></td>
                <td><?= $row['lrn']; ?></td>
                <td><?= $row['studname']; ?></td>
                <td><?= $row['teacher']; ?></td>
                <td><?= $row['studtype']; ?></td>
                <td><?= $row['section']; ?></td>
                <td><?= $row['payment_for']; ?></td>
                <td><?= $row['payment_val']; ?></td>
                <td class="<?= $row['payment_bal'] > 0 ? "text-danger" : "text-transparent"; ?>"><?=  $row['payment_bal']; ?></td>
                <td><?= $row['dt']; ?></td>
                <td><?= $row['sy_from']."-".$row['sy_to']; ?></td>
            </tr>
        <?php
            }
        ?>

        </table>

Showing 1 of <?= $pages; ?>
<nav aria-label="Page navigation example">
  <ul class="pagination">


        <?php
            if(isset($_GET['page']) && $_GET['page'] > 1){
        ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $_GET['page'] - 1;?>">Previous</a></li>
        <?php
            } else {
        ?>
            <li class="page-item"><a class="page-link">Previous</a></li>
        <?php
            }
        ?>
    

    <?php
    for($counter = 1; $counter <= $pages; $counter++){
    ?>
        <li class="page-item"><a class="page-link" href="?page=<?=$counter; ?>"><?= $counter; ?></a></li>
    <?php
    }
    ?>
    

        <?php
            if(!isset($_GET['page'])){
        ?>
            <li class="page-item"><a class="page-link" href="?page=2">Next</a></li>
        <?php
            } else {
                if($_GET['page'] >= $pages){
        ?>
            <li class="page-item"><a class="page-link">Next</a></li>
        <?php
                } else {
        ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $_GET['page'] + 1; ?>">Next</a></li>
        <?php
                }
            }
        ?>

</nav>

        </div>

            
        



    </main>
</div>