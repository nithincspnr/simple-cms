<?php include_once('shared/top_header.php'); ?>
    <?php include_once('shared/header.php'); ?>



        <!-- Content -->
        <div id="content" class="shell">

            <!-- Help Navigation -->
            <div id="help-nav">
                <!-- <a href="./user-management.php">User Management</a> &gt;
                <a href="./add-event.php">Add event</a> -->
            </div>
            <!-- End Help Navigation -->

            <?php if(!empty($_GET['msg'])) { ?>
            <div class="message thank-message">
                <p><strong><?php echo $_GET['msg'] ?></strong></p>
            </div>
            <?php } ?>

            <!-- Box -->
            <div class="box">
                <!-- Box Head -->
                <div class="box-head">
                    <h6 class="left">Events</h2>
                    <div class="right" onclick="window.location.href='./event/add'"><label class="href">Add new event</label></div>
                </div>
                <!-- End Box Head -->

                <!-- Table -->
                <div class="table">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <th>Title</th>
                            <th>Place</th>
                            <th>Event date</th>
                            <th width="110" class="ac">Manage events</th>
                        </tr>

                        <?php for ($i = 0; $i < count($data); $i++) { ?>
                        <tr>
                            <?php 
                                echo '<td>' . $data[$i]['event_title'] . '</td><td>' . 
                                              ( empty($data[$i]['event_place']) ? '--' : $data[$i]['event_place'] ) . '</td><td>' .
                                              ( empty($data[$i]['event_date']) ? '--' : $data[$i]['event_date'] ) . '</td>';
                            ?>
                            <td>
                                <a href="<?php echo BASE_URL.$_delete.'?id='.$data[$i]['id'] ?>" class="ico del">Delete</a>
                                <a href="<?php echo BASE_URL.$_edit.'?id='.$data[$i]['id'] ?>" class="ico edit">Edit</a>
                            </td>
                        </tr>
                        <?php  }  ?>
                        
                    </table>


                    <!-- Pagging -->
                    <div class="pagging">
                        <div class="left"><?php echo $paginationInfo; ?></div>
                        <div class="right">
                            <?php echo $pagintation; ?>
                        </div>
                    </div>
                    <!-- End Pagging -->

                </div>
                <!-- Table -->

            </div>
            <!-- End Box -->

            
        </div>

        <!-- End Content -->
        </div>

<?php include_once('shared/footer.php'); ?>