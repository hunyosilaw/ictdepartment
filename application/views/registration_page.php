    <!-- Main content -->
    <div id="login-wrapper">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="logo-login">
                        <h1>Register</h1>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="account-box">

                        <?php echo form_open('register') ?>
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo set_value('name'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control"value="<?php echo set_value('username'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="img_url" placeholder="Image URL" class="form-control"value="<?php echo set_value('img_url'); ?>">
                            </div>
                            <div class="form-group">
                                <select name="position" class="form-control">
                                    <option>Select Position</option>
                                    <?php 
                                        foreach($position as $k => $val) { 
                                            echo '<option value="'.str_replace('id_','',$k);
                                            echo (set_value('position')==$k)?'selected':'';
                                            echo '">'.$val.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="site" class="form-control">
                                    <option>Select site assignment</option>
                                    <?php 
                                        foreach($site as $k => $val) { 
                                            echo '<option value="'.str_replace('id_','',$k).'">'.$val.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_2" placeholder="Repeat Password" class="form-control">
                            </div>
                        <hr>
                        <div class="row-block">
                            <div class="row">
                                <div class="col-md-12 row-block">
                                    <input type="submit" class="btn btn-primary btn-block" value="Create New Account"/>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo validation_errors('<div class="lockscreen-link">*', '</div>'); ?>