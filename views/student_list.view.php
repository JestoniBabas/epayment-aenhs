
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
            require '../model/Dbh.php';
            require '../model/Students.php';

            $db = new Students();

            $data = $db->getStudentList($_SESSION['section'], $_SESSION['fullname']);
        ?>
    <div class="p-3">
        <?php
            if(isset($_GET['edit'])){
                if($_GET['edit'] !== ""){
                    if($_GET['edit'] == "success"){
                        echo '<div class="alert alert-success">Student info successfully updated!</div>';
                    }
                } else {
                    echo '';
                }
            }
        ?>

<h2 class="text-secondary p-2 text-center">Section <?= $_SESSION['section']; ?></h2>

        <table class="table table-striped table-bordered">
            <tr>
                <td><b>#</b></td>
                <td><b>LRN</b></td>
                <td><b>First name</b></td>
                <td><b>Middle name</b></td>
                <td><b>Last name</b></td>
                <td><b>Ext. name</b></td>
                <td><b>Sex</b></td>
                <td><b>Action</b></td>
            </tr>
        <?php if($data !== "") {?>
        <?php $i = 1; foreach($data as $row) : ?>
            <tr>
                
                    <form method="POST" action="../includes/student_edit_info.inc.php">
                        <input type="hidden" name="studid" value="<?=$row['studid']; ?>"/>
                        <td><?=$i++; ?></td>
                        <td><input type="text" name="lrn" class="form-control" value="<?=$row['lrn']; ?>" required/></td>
                        <td><input type="text" name="fname" class="form-control capslock" value="<?=$row['fname']; ?>" required/></td>
                        <td><input type="text" name="mname" class="form-control capslock" value="<?=$row['mname']; ?>" required/></td>
                        <td><input type="text" name="lname" class="form-control capslock" value="<?=$row['lname']; ?>" required/></td>
                        <td><input type="text" name="xname" class="form-control capslock" value="<?=$row['xname']; ?>" required/></td>
                        <td>
                            <select name="sex" class="form-control capslock" required >
                                <option value="<?=$row['sex']?>"><?=$row['sex']?></option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </td>
                         <td><input type="submit" class="btn btn-outline-success" value="UPDATE"></td>
                    </form>
                
            </tr>
        <?php endforeach; ?>
        <?php } ?>
        </table>
    </div>
    </main>

</div>