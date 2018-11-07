<div class="brand clearfix">
    <a href="tdashboard.php" style="font-size: 22px; padding-top:1%; color:#5cb85c"><font face="Trebuchet MS"> Transplant Admin Page</font></a>  
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
    
    <ul class="ts-profile-nav">
        <li class="ts-account">
            <a href="#"><img src="images/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> <?php echo $_SESSION['tlogin']; ?> <i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="tchange-password.php"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Change Password</a></li>
                <li><a href="tlog-out.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li>
            </ul>
        </li>
    </ul>
   </div>
