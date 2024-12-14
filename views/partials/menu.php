<div class="menu">
    
    <div class="menu_header">
        <img src="../images/logo.png" class="menu_header_icon" alt="logo"/>
        <b class="webname">ePayment-AENHS</b>
    </div>

    <nav>
        <ul class="ul_menu">
            
            <li>
                <a href="../controllers/dashboard.php" class="a_nav">
                    <b><span class="glyphicon glyphicon-dashboard text_violet"></span> Dashboard</b>
                </a>
            </li>
            
            <?php

                if($_SESSION['utype'] == "admin" || $_SESSION['utype'] == "principal"){
            ?>
                <li>
                    <a href="../controllers/user_profiles.php" class="a_nav">
                        <b><span class="glyphicon glyphicon-user text_green"></span> User profiles</b>
                    </a>
                </li>
                <li>
                    <a href="../controllers/add_user_account.php" class="a_nav">
                        <b><span class="glyphicon glyphicon-plus text_lavander"></span> Add user account</b>
                    </a>
                </li>
                <li>
                    <a href="../controllers/settings.php" class="a_nav">
                        <b><span class="glyphicon glyphicon-cog text_yellow"></span> Settings</b>
                    </a>
                </li>
                <li>
                    <a href="../controllers/records.php" class="a_nav">
                    <b><span class="glyphicon glyphicon-book text_yellow"></span> Records</b>
                    </a>
                </li>
            <?php
                } else if($_SESSION['utype'] === "teacher") {
            ?>
                <li>
                    <a href="../controllers/preview_user.php?uid=<?= $_SESSION['uid']; ?>" class="a_nav">
                        <b><span class="glyphicon glyphicon-user text_green"></span> My profile</b>
                    </a>
                </li>
                <li>
                    <a href="../controllers/add_student.php" class="a_nav">
                        <b><span class="glyphicon glyphicon-pencil text_yellow"></span> Add student</b>
                    </a>
                </li>
                <li>
                    <a href="../controllers/student_list.php" class="a_nav">
                        <b><span class="glyphicon glyphicon-list text_violet"></span> Student list</b>
                    </a>
                </li>
            <?php
                } else {
            ?>
                <li>
                    <a href="../controllers/preview_user.php?uid=<?= $_SESSION['uid']; ?>" class="a_nav">
                        <b><span class="glyphicon glyphicon-user text_green"></span> My profile</b>
                    </a>
                </li>
                <li>
                    <a href="../controllers/payments.php" class="a_nav">
                        <b><span class="glyphicon glyphicon-rub text_blue"></span>Input Payment</b>
                    </a>
                </li>
                <li>
                    <a href="../controllers/payment_history.php" class="a_nav">
                        <b><span class="glyphicon glyphicon-folder-open text_yellow"></span> Payment history</b>
                    </a>
                </li>
                
            <?php
                }

            ?>
                
        
            
            <li>
                <a href="../controllers/logout.php" class="a_nav">
                <b><span class="glyphicon glyphicon-log-out text_red"></span> Log out</b>
                </a>
            </li>
        </ul>
    </nav>

</div>