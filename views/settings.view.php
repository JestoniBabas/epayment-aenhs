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


        if(isset($_GET['error'])){
            if($_GET['error'] !== ""){

                $error = $_GET['error'];

                if($error == "sy"){
                    $response = '<div class="alert alert-danger">You already set school year!</div>';
                } else if($error == "sy_edit"){
                    $response = '<div class="alert alert-success">School year updated successful!</div>';
                } else if($error == "yrs"){
                    $response = '<div class="alert alert-danger">Year and section to that inputs already exist!</div>';
                } else if($error == "contributions"){
                    $response = '<div class="alert alert-danger">Contributions already exist!</div>';
                }else if($error == "void"){
                    $response = '<div class="alert alert-success">Saving success!</div>';

                }

                echo '<div class="p-3">'.$response.'</div>';

            } else {
                echo "";
            }
        }

        

    ?>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="alert alert-success">
                        <b>Set current school Year</b>


                        <?php
                        require '../model/Dbh.php';
                        require '../model/Settings.php';

                        $db = new Settings();

                        $data = $db->get_sy();

                        if($data !== ""){

                        ?>
                            <form method="POST" action="../includes/update_sy.includes.php">
                                <br/>
                                <input type="hidden" name="syid" value="<?= $data['syid']; ?>"/>
                                <select name="sy" class="form-control" required >
                                    <option value="<?= $data['sy_from']."-".$data['sy_to']; ?>"><?= $data['sy_from']."-".$data['sy_to']; ?></option>
                                        <?php
                                            $from = 2024;
                                            $to = 2025;
                                            for($i = 0; $i <= 10; $i++){
                                                $sy_from = $from++;
                                                $sy_to = $to++;
                                        ?>
                                            <option value="<?= $sy_from ."-". $sy_to;  ?>"><?= $sy_from ."-". $sy_to;  ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                                <br/>
                                <input type="submit" class="btn btn-outline-success" value="UPDATE"/>
                            </form>
                        <?php
                         } else {
                        ?>
                            <form method="POST" action="../includes/set_sy.includes.php">
                                <br/>
                            <select name="sy" class="form-control" required >
                                    <option value="">Select S.Y.</option>
                                        <?php
                                            $from = 2024;
                                            $to = 2025;
                                            for($i = 0; $i <= 10; $i++){
                                                $sy_from = $from++;
                                                $sy_to = $to++;
                                        ?>
                                            <option value="<?= $sy_from ."-". $sy_to;  ?>"><?= $sy_from ."-". $sy_to;  ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                                <br/>
                                <br/><input type="submit" class="btn btn-outline-success" value="SAVE"/>
                               
                            </form>
                        <?php
                        }
                                ?>
                            
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-warning">
                        <b>Set default year level and sections</b>

                            <form method="POST" action="../includes/set_yr_sections.includes.php"><br/>
                                <b class="text-secondary">Classification (Jr/Sr)</b>
                                    <select name="studtype" class="form-control capslock" required>
                                        <option value="">Select</option>
                                        <option value="Jr High">Jr High</option>
                                        <option value="Sr High">Sr High</option>
                                    </select>
                                <b class="text-secondary">Grade level/Section</b><input type="text" name="section" class="form-control capslock" required />
                                <br/><input type="submit" class="btn btn-outline-warning" value="SAVE"/>
                                
                              

                                <?php

                                    $db = new Settings();
            
                                    $data = $db->get_yrs();
            
                                    if($data !== ""){
                                        echo  '<a href="../controllers/year_level_section.php" class="btn btn-warning">SHOW LIST</a>';
                                    }
                                ?>

                            </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-info">
                        <b>Set contributions</b>
                            <form method="POST" action="../includes/set_contributions.includes.php"><br/>
                                <b class="text-secondary">Type</b><input type="text" name="payment_for" class="form-control capslock" required />
                                <b class="text-secondary">Value</b><input type="number" name="payment_val" class="form-control" required />
                                <br/><input type="submit" class="btn btn-outline-info" value="SAVE"/>
                                <?php

                                    $db = new Settings();
            
                                    $data = $db->get_contributions();
            
                                    if($data !== ""){
                                        echo  '<a href="../controllers/contributions.php" class="btn btn-info">SHOW LIST</a>';
                                    }
                                ?>
                            </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-danger">
                       <span class="glyphicon glyphicon-warning-sign setting_icons"></span> <b class="setting_icons">WARNING</b><br/>
                       <div class="cus-set-div text-center">
                            <b>Firing up this button will tantamount to delete all students info for this current school year!<br/>Giving a way to start anew.</b><br/>
                                <a href="../includes/firebolts.inc.php">
                                    <button class="btn btn-danger btn_fire">
                                        <span class="glyphicon glyphicon-fire setting_icons"></span>
                                    </button>
                                </a>
                        </div>
                        
                    </div>
                </div>
        </div>


    </main>
</div>