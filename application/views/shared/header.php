<!-- Header -->
<div id="header">
    <div class="shell">

        <div id="head">
            <h1><a href="<?php echo BASE_URL ?>">Admin </a></h1>
            <div class="right">
                <p>
                    Welcome <strong><?php echo $_SESSION['logged_user']['display_name'] ?></strong> |
                    <!-- <a href="./auth/logout">Change password</a> | -->
                    <a href="<?php echo BASE_URL . $config['url']['logout'] ?>">Logout</a>
                </p>
            </div>
        </div>

        <!-- Navigation -->
        <div id="navigation">
            <ul>
                <li>
                    <a href="<?php echo BASE_URL ?>" class=<?php if(isset($nav_dash))echo 'active';?> ><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL . $config['url']['list_event'] ?>" class=<?php if(isset($nav_event))echo 'active';?> ><span>Events</span></a>
                </li>
            </ul>
        </div>
        <!-- End Navigation -->

    </div>
</div>
<!-- End Header -->