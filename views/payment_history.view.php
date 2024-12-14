
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

        <div class="container-fluid">
            <form method="POST" action="../includes/payment_search_lrn.includes.php">
                <div class="row">
                    <div class="col-md-6">
                        <br/><input type="text" name="lrn" class="form-control" placeholder="Search LRN" required />
                    </div>
                    <div class="col-md-6">
                        <br/><input type="submit" class="btn btn-outline-success" value="SEARCH"/>
                    </div>
                </div>
            </form>
            <br/>
            <?php
                if(isset($_GET['query'])){
                    if($_GET['query'] !== ""){
                        if($_GET['query'] == "void"){
                            echo '<div class="alert alert-danger">No record found! check LRN again!</div>';
                        } elseif($_GET['query'] == "overpay"){
                            echo '<div class="alert alert-danger">Amount inputted is greater than the actual balance! OVERPAY</div>';
                        } else {
                            require '../model/Dbh.php';
                            require '../model/Payments.php';
                            $db = new Payments();
                            $student = $db->get_student_payment_record($_GET['query']);

                            //settings payment for 
                            
                            require '../model/Settings.php';
                            $db = new Settings();

                            $contri = $db->get_contributions();
                            
            ?>
                    <table class="table table-bordered table-hover table-striped table-responsive">
                        <tr>
                            <td colspan="11"><b>Search Result: LRN (<span class="text-danger"> <?=$_GET['query']?></span>)</b></td>
                        </tr>
                        <tr class="fw-bold text-center">
                            <td class="bg-info">Name</td>
                            <td class="bg-info">Year level</td>
                            <td class="bg-info">Grade/Section</td>
                            <td class="bg-info">Teacher</td>
                            <td class="bg-info">Payment for</td>
                            <td class="bg-info">Amount given</td>
                            <td class="bg-info">Balance</td>
                            <td class="bg-info">Payment value</td>
                            <td class="bg-info">School Yr.</td>
                            <td class="bg-info">Date & Time</td>
                            <td class="bg-info">Action</td>
                        </tr>
                    
                    <?php foreach($student as $d) : ?>

                    
                        <form method="POST" action="../includes/update_payment.inc.php">
                            <input type="hidden" name="studid" value="<?= $d['studid']; ?>">
                            <input type="hidden" name="paymentid" value="<?= $d['paymentid']; ?>">
                            <input type="hidden" name="lrn" value="<?= $d['lrn']; ?>">
                            <input type="hidden" name="studname" value="<?= $d['studname']; ?>">
                            <input type="hidden" name="studtype" value="<?= $d['studtype']; ?>">
                            <input type="hidden" name="section" value="<?= $d['section']; ?>">
                            <input type="hidden" name="payment_for" value="<?= $d['payment_for']; ?>">
                            <input type="hidden" name="teacher" value="<?= $d['teacher']; ?>">
                            <input type="hidden" name="payment_bal" value="<?= $d['payment_bal']; ?>">
                        <tr>
                            <td><?= $d['studname']; ?></td>
                            <td><?= $d['studtype']; ?></td>
                            <td><?= $d['section']; ?></td>
                            <td><?= $d['teacher']; ?></td>
                            <td>
                                <select name="payment_for" class="form-control" required >
                                    <option value="<?= $d['payment_for']; ?>"><?= $d['payment_for']; ?></option>
                                        <?php foreach($contri as $pay) : ?>
                                            <option value="<?= $pay['payment_for']."-".$pay['payment_val']; ?>"><?= $pay['payment_for']."-".$pay['payment_val']; ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </td>
                            <td><?= $d['payment_val']; ?></td>
                            <td class="<?= $d['payment_bal'] > 0 ? "text-danger" : "text-transparent";?>"><?=  $d['payment_bal']; ?></td>
                            <td><input type="number" name="payment_val" class="form-control" placeholder="Cash" required/></td>
                            <td><?= $d['sy_from']."-".$d['sy_to']; ?></td>
                            <td><?= $d['dt']; ?></td>
                            <td align="center"><input type="submit" class="btn btn-outline-primary" value="SAVE"/></td>
                        </tr>
                        </form>
                        <?php endforeach ?>
                    </table>
            <?php

                        }
                    } else {
                        echo '';
                    }
                }
            ?>
            <br/></br/>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover table-striped table-responsive">
                        <tr class="fw-bold text-center">
                            <td>Name</td>
                            <td>Year level</td>
                            <td>Grade/Section</td>
                            <td>Teacher</td>
                            <td>Payment for</td>
                            <td>Payment value</td>
                            <td>Balance</td>
                            <td>School Yr.</td>
                            <td>Date & Time</td>
                            <!-- <td>Action</td> -->
                        </tr>

                        <?php
                            $host = "localhost";
                            $dbname = "epayment-aenhs";
                            $user = "root";
                            $pwd = "";
                    
                            $dsn = 'mysql:host=' . $host . '; dbname=' . $dbname;
                            $pdo = new PDO($dsn, $user, $pwd);
                            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                            
                            $start = 0;
                            $rows_per_page = 4  ;

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

                <?php
                    foreach($stm->fetchAll() as $row){
                ?>
                    <tr">
                        <td><?= $row['studname']; ?></td>
                        <td><?= $row['studtype']; ?></td>
                        <td><?= $row['section']; ?></td>
                        <td><?= $row['teacher']; ?></td>
                        <td><?= $row['payment_for']; ?></td>
                        <td><?= $row['payment_val']; ?></td>
                        <td class="<?= $row['payment_bal'] > 0 ? "text-danger" : "text-transparent"; ?>"><?=  $row['payment_bal']; ?></td>
                        <td><?= $row['sy_from']."-".$row['sy_to']; ?></td>
                        <td><?= $row['dt']; ?></td>
                        <!-- <td align="center">
                            <a href="?paymentid=<?= $row['paymentid']; ?>" class="btn btn-outline-info" title="EDIT">
                                <span class="glyphicon glyphicon-pencil text-secondary"></span>
                            </a>
                        </td> -->
                        
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
            </div>
        </div>
       
    </main>
</div>