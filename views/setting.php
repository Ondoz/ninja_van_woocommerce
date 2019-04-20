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
            <?php if (save_option()): ?>
                <div class="col-md-12">
                    <div class="alert alert-success">
                      <strong>Success!</strong> Setting was updated successfully!
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
    </div>
</div>