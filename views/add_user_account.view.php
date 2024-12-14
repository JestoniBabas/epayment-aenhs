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

    <h2 class="text-center pt-3 pb-3">Register new user account</h2>

    <?php
        if(isset($_GET['signup'])){
            if($_GET['signup'] !== ""){
                if($_GET['signup'] == "success"){
                    echo '<div class="alert alert-success m-2">User added successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger">Something went wrong!</div>';
                }
            } else {
                echo '';
            }
        }
    ?>
    <form action="../includes/signup.inc.php" method="post">
        <div class="container-fluid p-2 mt-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="fullname" class="form-control capslock" placeholder="Set Full name" required /><br/>
                </div>
                <div class="col-md-4">
                    <input type="email" name="email" class="form-control capslock" placeholder="Set Email" required /><br/>
                </div>
                <div class="col-md-4">
                    <select name="utype" class="form-control capslock" required />
                        <option value="">Set user type</option>
                        <option value="principal">Principal</option>
                        <option value="teacher">Teacher</option>
                        <option value="non-teaching">Non-teaching</option>
                    </select><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php
                        require '../model/Dbh.php';
                        require '../model/Settings.php';
                        $db = new Settings();
                        $yrs = $db->get_yrs();

                        if($yrs != ""){
                            echo '
                            <select name="section" class="form-control capslock" required>
                                <option value="-">Section (Teachers)</option>';
                            foreach($yrs as $row){
                                echo '<option value="'.$row["section"].'">'.$row["section"].'</option>';
                            }
                            echo '
                            </select>
                            <br/>';
                        }
                    ?>
                </div>
                <div class="col-md-4">
                    <input type="text" name="uname" class="form-control capslock" placeholder="Create Username" required /><br/>
                </div>
                <div class="col-md-4">
                    <input type="password" name="pwd" class="form-control capslock" placeholder="Create password" required /><br/>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-4">
                <input type="submit" name="btn_login" class="btn btn-outline-success" value="SIGN UP">
            </div>
        </div>
    </form>


    </main>
</div>