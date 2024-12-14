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
            require '../model/Settings.php';

            $db = new Settings();

            $data = $db->get_contributions();
        ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped m-2 table-responsive">
                    <tr class="text-center">
                        <td colspan="3"><b>Contributions</b></td>
                    </tr>
                    <?php foreach($data as $row): ?>
                        <tr>
                            <form method="POST" action="../includes/contributions.inc.php">
                                <input type="hidden" name="pid" value="<?=$row['pid']; ?>"/>
                                <tr>
                                    <td>
                                        <input type="text" name="payment_for" class="form-control" value="<?= $row['payment_for']; ?>" required />
                                    </td>
                                    <td>
                                        <input type="number" name="payment_val" class="form-control" value="<?= $row['payment_val']; ?>" required />
                                    </td>
                                    <td><input type="submit" class="btn btn-outline-success" value="UPDATE"/></td>
                                </tr>
                            </form>
                    
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
          
        </div>
    </div>
    </main>
</div>