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
        <?php
            if(isset($_GET['payment'])){
                if($_GET['payment'] !== ""){
                    if($_GET['payment'] === "success"){
                        echo '<div class="alert alert-success m-2">Payment success!</div>';
                    } else {
                        echo '<div class="alert alert-danger m-2">Payment failed to execute!</div>';
                    }
                }
            }
        ?>
        <form method="POST" action="../includes/payment_search_student.inc.php">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6"><br/>
                        <input type="text" name="lrn" class="form-control" placeholder="INPUT LRN" required />
                    </div>
                   
                    <div class="col-md-6"><br/>
                        <input type="submit" class="btn btn-outline-success" value="SEARCH"/>
                    </div>
                </div>
            </div>
        </form>


        <?php

            if(isset($_GET['search'])){

                if($_GET['search'] !== ""){

                    if($_GET['search'] === "failed"){

                        echo '<div class="alert alert-danger m-3">Sorry! your inputs do not match any database records!</div>';

                    } else {

                        require '../model/Dbh.php';
                        require '../model/Students.php';
                    
                        $studid = $_GET['search'];

                        $db = new Students();

                        $data = $db->get_student($studid);
?>

                        <form method="POST" action="../includes/payment_success.inc.php">

                            <input type="hidden" name="lrn" value="<?= $data['lrn']; ?>"/>
                            <input type="hidden" name="studid" value="<?= $studid; ?>"/>
                            <input type="hidden" name="studtype" value="<?= $data['studtype']; ?>"/>
                            <input type="hidden" name="section" value="<?= $data['section']; ?>"/>
                            <input type="hidden" name="uid" value="<?= $data['uid']; ?>"/>
                            <input type="hidden" name="studname" value="<?= $data['fname']." ".$data['mname']." ".$data['lname']; ?>"/>
                            <input type="hidden" name="teacher" value="<?= $data['teacher']; ?>"/>


                            <div class="alert alert-info m-3">
                                <table class="table table-transparent">
                                    <tr>
                                        <td><b>Student name</b></td>
                                        <td><b>Year level</b></td>
                                        <td><b>Section</b></td>
                                        <td><b>Payment for</b></td>
                                        <td><b>Payment value</b></td>
                                        <td><b>Action</b></td>
                                    </tr>
                                    <tr>
                                        <td><?= $data['fname']." ".$data['mname']." ".$data['lname']; ?></td>
                                        <td><?= $data['studtype']; ?></td>
                                        <td><?= $data['section']; ?></td>
                                        <td>
                                        <?php

                                            require '../model/Settings.php';
                                            $db = new Settings();

                                            $contri = $db->get_contributions();

                                        ?>
                                        <select name="payment_for" class="form-control" required >
                                            <option value="">Select</option>
                                                <?php foreach($contri as $pay) : ?>
                                                    <option value="<?= $pay['payment_for']."-".$pay['payment_val']; ?>"><?= $pay['payment_for']."-".$pay['payment_val']; ?></option>
                                                <?php endforeach; ?>
                                        </select>

                                        </td>

                                        <td>
                                            <input type="number" name="payment_val" class="form-control" placeholder="Cash" required />
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-outline-info" value="SUBMIT"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>

<?php

                    }

                } else {
                    echo '';
                }
            }

        ?>
    </main>
</div>