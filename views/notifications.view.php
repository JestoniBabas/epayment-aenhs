
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
            //clear notif counter
            require '../model/Dbh.php';
            require '../model/Notifications.php';

            $db = new Notifications();

            $db->clear_notif_counter($_SESSION['uid']);

            $data = $db->fetch_notifications($_SESSION['uid']);

            if($data !== ""){
                foreach($data as $row){
?>
            <div class="cont_notif">
                <img src="../images/<?= $row['icon']; ?>" class="i_notif" alt="icon"/> <?= $row['notification']; ?>
                <span class="not_time"><span class="glyphicon glyphicon-time"></span> <?= $row['dt']; ?></span>
            </div>
<?php
                }
            }
        ?>


    </main>
</div>