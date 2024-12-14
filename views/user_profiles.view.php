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
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            require '../model/Users.php';

                            $userClass = new Users();

                            $user = $userClass->getAllUsers();
                        ?>

                        <table class="table table-hover table-striped table-bordered mt-4 table-responsive">
                            <tr>
                                <td><b>#</b></td>
                                <td><b>Picture</b></td>
                                <td><b>Full name</b></td>
                                <td><b>Email</b></td>
                                <td><b>Username</b></td>
                                <td><b>User type</b></td>
                                <td><b>Section</b></td>
                                <td><b>Account Created</b></td>
                                <td><b>Action</b></td>
                            </tr>
                        <?php $i = 1; ?>
                        <?php foreach($user as $userData): ?>
                        
                            <tr>
                                <td><?= $i++; ?></td>
                                <td align="center"><img src="../images/<?= $userData['avatar']; ?>" class="userList_picture" alt="avatar"/></td>
                                <td><?= strtoupper($userData['fullname']); ?>
                                    <?php
                                        if($userData['uid'] == $_SESSION['uid']){
                                            echo '<b class="text-danger">(You)</b>';
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </td>
                                <td><a href="mailto:<?= $userData['email']; ?>"><?= $userData['email']; ?></a></td>
                                <td><?= strtoupper($userData['uname']); ?></td>
                                <td><?= strtoupper($userData['utype']); ?></td>
                                <td><?= $userData['section']; ?></td>
                                <td><?= $userData['created_at']; ?></td>
                                <td>
                                    <center>
                                        <a href="../controllers/preview_user.php?uid=<?= $userData['uid']; ?>" class="btn btn-sm btn-outline-primary">
                                            <b>Action <span class="glyphicon glyphicon-pencil"></span></b>
                                        </a>
                                    </center>
                                </td>
                            </tr>

                        <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </main>
</div>