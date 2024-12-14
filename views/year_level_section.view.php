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

            $data = $db-> get_year_level_section();
        ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-hover table-striped m-2 table-responsive">
                    <tr class="text-center">
                        <td colspan="3"><b>Junior High</b></td>
                    </tr>
                    <?php foreach($data as $row): ?>
                        <tr>
                            <?php
                            if($row['studtype'] === "Jr High"){
                            ?>
                                <form method="POST" action="../includes/year_level_section.inc.php">
                                <input type="hidden" name="ylsid" value="<?=$row['ylsid']; ?>"/>
                                <tr>
                                    <td>
                                        <select name="studtype" class="form-control" required >
                                            <option value="<?=$row['studtype']; ?>"><?=$row['studtype']; ?></option>
                                            <option value="Jr High">Jr High</option>
                                            <option value="Sr High">Sr High</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="section" class="form-control" value="<?= $row['section']; ?>" required />
                                    </td>
                                    <td><input type="submit" class="btn btn-outline-success" value="UPDATE"/></td>
                                </tr>
                                </form>
                    
                            <?php } ?>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-hover table-striped m-2 table-responsive">
                    <tr class="text-center">
                        <td colspan="3"><b>Senior High</b></td>
                    </tr>
                    <?php foreach($data as $row): ?>
                        <tr>
                            <?php
                            if($row['studtype'] === "Sr High"){
                            ?>
                                <form method="POST" action="../includes/year_level_section.inc.php">
                                <input type="hidden" name="ylsid" value="<?=$row['ylsid']; ?>"/>
                                <tr>
                                    <td>
                                        <select name="studtype" class="form-control" required >
                                            <option value="<?=$row['studtype']; ?>"><?=$row['studtype']; ?></option>
                                            <option value="Jr High">Jr High</option>
                                            <option value="Sr High">Sr High</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="section" class="form-control" value="<?= $row['section']; ?>" required />
                                    </td>
                                    <td><input type="submit" class="btn btn-outline-success" value="UPDATE"/></td>
                                </tr> 
                                </form>
                            <?php } ?>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
    </main>
</div>