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
        if(isset($_GET['add'])){
            if($_GET['add'] !== ""){
                if($_GET['add'] === "success"){
                    echo '<div class="alert alert-success m-3">Student added successful!</div>';
                } else {
                    echo '<div class="alert alert-danger m-3">LRN already exist in database!</div>';
                }
            } 
        } else {
            echo '';
        }

        require '../model/Dbh.php';
        require '../model/Settings.php';

        $db = new Settings();

        $data = $db->get_sy();


    ?>

    <h2 class="text-secondary p-2 text-center">School year <?= $data['sy_from']."-".$data['sy_to']." ".$_SESSION['section'];?></h2>


    <form method="POST" action="../includes/add_student.inc.php">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <b>LRN</b>
                <input type="text" name="lrn" class="form-control capslock" placeholder="LRN" required />
            </div>
            <div class="col-md-2">
                <b>First</b>
                <input type="text" name="fname" class="form-control capslock" placeholder="First name" required />
            </div>
            <div class="col-md-2">
                <b>Middle</b>
                <input type="text" name="mname" class="form-control capslock" placeholder="Middle name" required />
            </div>
            <div class="col-md-2">
                <b>Last</b>
                <input type="text" name="lname" class="form-control capslock" placeholder="Last name" required />
            </div>
            <div class="col-md-1">
                <b>Ext.</b>
                <input type="text" name="xname" class="form-control capslock" placeholder="Ext .name" />
            </div>
            <div class="col-md-1">
                <b>Sex</b>
                <select name="sex" class="form-control capslock" required >
                    <option value="">Select</option>
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                </select>
            </div>
            <div class="col-md-2">
                <br/>
                <input type="submit" class="btn btn-outline-success" value="ADD STUDENT"/>
            </div>
        </div>
    </div>
    </form>
        
    </main>
</div>