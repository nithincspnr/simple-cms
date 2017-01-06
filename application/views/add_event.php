<?php include_once('shared/top_header.php'); ?>
    <?php include_once('shared/header.php'); ?>



        <!-- Content -->
        <div id="content" class="shell">

            <!-- Help Navigation -->
            <div id="help-nav">
                <!-- <a href="./user-management.php">User Management</a> -->
            </div>
            <!-- End Help Navigation -->

            <!-- Box -->
            <div class="box">
                <!-- Box Head -->
                <div class="box-head">
                    <h6>Add New Event</h2>
                </div>
                <!-- End Box Head -->

                <form action="<?php echo $action ?>" method="<?php echo $method ?>">

                    <!-- Form -->
                    <div class="form">
                     <p>
                        Event Name <span>*</span>
                        <input type="text" name="name" class="field">
                    </p>
                    <p>
                        Place
                        <input type="text" name="place" class="field">
                    </p>
                    <p>
                        Event Date
                        <input type="text" name="date" class="field"> ( dd-mm-yyyy ) 
                    </p>

                    <p>
                        Note
                        <textarea name="note" class="field size1"></textarea>
                    </p>
                        
                    <!-- image upload widget -->
                    
                    <?php //include_once('upload-widget.php'); ?>

                    <!-- End image upload widget -->

                </div>
                <!-- End Form -->
                    
                    
                
                    

                <!-- Form Buttons -->
                <div class="buttons">
                    <input type="button" class="button" value="cancel">
                    <input type="submit" class="button" value="submit">
                </div>
                <!-- End Form Buttons -->
                </form>
            </div>
            <!-- End Box -->
        </div>

        <!-- End Content -->
        </div>

        <?php include_once('shared/footer.php'); ?>