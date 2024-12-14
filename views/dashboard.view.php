
<div class="content">
    <div class="content_header">
            <button class="burger" onClick="showMenu()">
                <div></div>
                <div></div>
                <div></div>
            </button>
            <b class="locname"><?=$locName;?></b>
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
            
            <div class="row">
                <div class="col-md-4">
                    <div class="cus-div p-2 m-4">
                        <img src="../images/users.png" class="idash" alt="icon"/>
                        <br/><b>User Accounts</b>
                        <h2>
                        <?php
                            require '../model/Users.php';
                            $db = new Users();
                            echo number_format(count($db->getAllUsers()));
                        ?>
                        </h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cus-div p-2 m-4">
                        <img src="../images/payments.png" class="idash" alt="icon"/>
                        <br/><b>Payments</b>
                        <h2>
                        <?php
                            require '../model/Payments.php';
                            $db = new Payments();
                            echo number_format($db->payments());
                        ?>
                        </h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cus-div p-2 m-4">
                        <img src="../images/notifications.png" class="idash" alt="icon"/>
                        <br/><b>Notificatons</b>
                        <h2>
                        <?php
                            require '../model/Notifications.php';
                            $db = new Notifications();
                            echo number_format($db->getAllNotif());
                        ?>
                        </h2>
                    </div>
                </div>
            </div>

            <?php
                require '../model/Chart.php';
                require '../model/Students.php';
                $chart = new Chart();
                $payment_val = $chart->payment_val();
                $payment_bal = $chart->payment_bal();
                $to_pay = $chart->to_pay();

                $db = new Students();
                $male_students = $db->male_students();
                $female_students = $db->female_students();
            ?>

            <div class="row">
                <div class="col-md-4">
                    <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
                </div>

                <div class="col-md-4">
                    <div class="alert alert-info cus_text">
                        <b>To pay</b><span class="badge bg-primary"><?=number_format($to_pay); ?></span>
                        <b>Collections</b><span class="badge bg-success"><?=number_format($payment_val); ?></span>
                        <b>Balance</b><span class="badge bg-danger"><?=number_format($payment_bal); ?></span>
                    </div>
                    
                    
                </div>

                <div class="col-md-4">
                    <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
    </main>
</div>