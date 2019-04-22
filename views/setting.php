<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<style>
    
</style>
<div class="wrap">
    <h1><i class="fas fa-truck"></i> Ninja Van Settings</h1>
    <div class="row">
        <?php if (isset($_POST['submitSetting'])): ?>
            <?php if (save_option_setting()): ?>
                <div class="col-md-12">
                    <div class="alert alert-success">
                      <strong>Success!</strong> Setting was update successfully!
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
        
        <?php if (isset($_POST['submitSender'])): ?>
            <?php if (save_option_sender()): ?>
                <div class="col-md-12">
                    <div class="alert alert-success">
                      <strong>Success!</strong> Sender credentials was update successfully!
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Settings Panel</div>
              <div class="panel-body">
                <div class="row">
                    <form action="" method="post">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <?php if (get_option('ninja_sandbox')): ?>
                                    <input type="checkbox" class="custom-control-input" name="sandbox" id="sandbox" style="margin: 0;" checked>
                                <?php else :?>
                                    <input type="checkbox" class="custom-control-input" name="sandbox" id="sandbox" style="margin: 0;">
                                <?php endif ?>
                              
                              <label class="custom-control-label" for="sandbox" style="margin: 0;">Sandbox Mode.</label>
                            </div>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Client ID</label>
                                <input type="text" class="form-control" name="client_id" value="<?php echo get_option('ninja_client_id');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Client Secret</label>
                                <input type="password" class="form-control" name="client_key" value="<?php echo get_option('ninja_client_secret');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="submitSetting" class="btn btn-primary btn-sm">Update Setting</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Sender Setting</div>
              <div class="panel-body">
                <div class="row">
                    <form action="" method="post">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sender Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo get_option('sender_name');?>">
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="number" class="form-control" name="phone" value="<?php echo get_option('sender_phone');?>">
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" class="form-control" name="email" value="<?php echo get_option('sender_mail');?>">
                            </div>
                            <div class="form-group">
                                <label for="">Merchant Order Number</label>
                                <input type="text" class="form-control" name="mon" value="<?php echo get_option('sender_mon');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Address 1</label>
                                <input type="text" class="form-control" name="address_1" value="<?php echo get_option('sender_address_1');?>">
                            </div>
                            <div class="form-group">
                                <label for="">Address 2</label>
                                <input type="text" class="form-control" name="address_2" value="<?php echo get_option('sender_address_2');?>">
                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" class="form-control" name="city" value="<?php echo get_option('sender_city');?>">
                            </div>
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" class="form-control" name="country" value="<?php echo get_option('sender_country');?>">
                            </div>
                            <div class="form-group">
                                <label for="">Postal Code</label>
                                <input type="text" class="form-control" name="postcode" value="<?php echo get_option('sender_postal_code');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="submitSender" class="btn btn-primary btn-sm">Update Setting</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>