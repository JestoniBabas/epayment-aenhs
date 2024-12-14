<?php

if(isset($_GET['uid'])){
   
    if($_GET['uid'] !== ""){

        require '../model/Users.php';

        $data = new Users();

        $uid = $_GET['uid'];

        $userData = $data->previewUser($uid);
        $sections = $data->get_year_level_section();

    }

}
?>
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


    <form method="POST" action="../includes/setUser.inc.php" enctype="multipart/form-data">
        <table class="table table-bordered tbl_previewUser">
            

            <tr>
                <td colspan="2" class="text-center">
                    <img src="../images/<?= $userData['avatar']; ?>" class="previewAvatar" alt="avatar"/><br/>
                    <b><label for="pic" class="text-primary">Change Profile Photo</label></b>
                    <input type="file" name="pic" id="pic" class="inp_pic" class="form-control" value=""/>
                </td>


            </tr>
            
            <tr>
                <td colspan="2">
                    <b>Full name</b>
                    <input type="text" name="fullname" class="form-control capslock" value="<?= $userData['fullname']; ?>" required />
                </td>
            </tr>
            
                
            <tr>
                <td colspan="2">
                    <b>Email <span class="text-danger">* deped.email only</span></b>
                    <input type="text" name="email" class="form-control capslock" value="<?= $userData['email']; ?>" required />
                </td>
            </tr>
            
                
            <tr>
                <td colspan="2">
                     <b>Username</b>
                    <input type="text" name="uname" class="form-control capslock" value="<?= $userData['uname']; ?>" required />
                </td>
            </tr>
            
        <?php 
         if($_SESSION['utype'] == "admin"){
        ?>
            <tr>
                <td colspan="2"> 
                    <b>User type</b>
                    <select name="utype" class="form-control capslock" required >
                        <option value="<?= $userData['utype']; ?>"><?= $userData['utype']; ?></option>
                        <option value="admin">Admin</option>
                        <option value="principal">Principal</option>
                        <option value="teacher">Teacher</option>
                        <option value="non-teaching">Non-teaching</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2"> 
                    <b>Grade / Section</b>
                    <select name="section" class="form-control capslock" required >
                        <option value="<?= $userData['section']; ?>"><?= $userData['section']; ?></option>
                    <?php
                        foreach($sections as $r){
                    ?>

                        <option value="<?= $r['section']; ?>"><?= $r['section']; ?></option>

                    <?php
                        }
                    ?>
                    </select>
                </td>
            </tr>

        <?php 
        } else {
        ?>

            <input type="hidden" name="utype" value="<?= $userData['utype']; ?>"/>
            <input type="hidden" name="section" value="<?= $userData['section']; ?>"/>

        <?php
        }
        ?>
           
            <input type="hidden" name="uid" value="<?= $uid; ?>"/>
           
                
            <tr>
                <td colspan="2"> 
                    <b>Account created</b>
                    <p><?= $userData['created_at']; ?></p>
                </td>
            </tr>

            <tr>
                <td colspan="2"> 
                    <b>Reset password</b>
                    <p class="text-danger">*Leave this field as blank if you dont want to change password</p>
                    <input type="text" name="pwd" class="form-control"  />
                </td>
            </tr>

            <tr  class="text-center">
                
                    <?php
                        if($_SESSION['utype'] == "admin"){
                    ?>
                        <td>
                            <a href="../controllers/user_profiles.php" class="btn btn-outline-primary">
                                <span class="glyphicon glyphicon-menu-left"></span> Back
                            </a>
                        </td>
                        <td>
                            <input type="submit" class="btn btn-outline-success" value="SAVE CHANGES" />
                        </td>
                    <?php
                        } else {
                    ?>
                        <td colspan="2">
                            <input type="submit" class="btn btn-outline-success" value="SAVE CHANGES" />
                        </td>
                    <?php
                        }
                    ?>
                    
                
                
            </tr>
        </table>

    </form>

    </main>
</div>