<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<style>
    
</style>
<div class="wrap">
    <h1><i class="fas fa-truck"></i> Ninja Van</h1>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <td>Order ID</td>
                    <td>Status</td>
                    <td>Payment Method</td>
                    <td>Created</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php foreach (get_all_order() as $key => $value): ?>
                        <?php 
                            $data  = get_order($value);
                        ?>
                        <?php if ($data->get_shipping_method() === 'NinjaVan Shipping'): ?>
                            <tr>
                                <td>#<?php echo $value;?></td>
                                <td><?php echo ucwords($data->get_status());?></td>
                                <td><?php echo ucwords($data->get_payment_method());?></td>
                                <td><?php echo date('jS F Y', strtotime($data->get_date_created()));?></td>
                                <td>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary btn-xs shopOrder" data-id="<?php echo $value;?>">Ship Order</button>
                                      <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" class="bill_det" data-id="<?php echo $value;?>">Billing Details</a></li>
                                        <li><a href="#" class="shipDet" data-id="<?php echo $value;?>">Shipping Details</a></li>
                                      </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="BillDet" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Billing Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <tr>
                        <td>First Name</td>
                        <td class="billing_first_name"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td class="billing_last_name"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td class="billing_Phone"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="billing_email"></td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td class="billing_company"></td>
                    </tr>
                    <tr>
                        <td>Address 1</td>
                        <td class="billing_address_1"></td>
                    </tr>
                    <tr>
                        <td>Address 2</td>
                        <td class="billing_address_2"></td>
                    </tr>
                    
                    <tr>
                        <td>City</td>
                        <td class="billing_city"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td class="billing_state"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td class="billing_country"></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td class="billing_postcode"></td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="shipDetMod" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Shipping Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <tr>
                        <td>First Name</td>
                        <td class="shipping_first_name"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td class="shipping_last_name"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td class="shipping_Phone"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="shipping_email"></td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td class="shipping_company"></td>
                    </tr>
                    <tr>
                        <td>Address 1</td>
                        <td class="shipping_address_1"></td>
                    </tr>
                    <tr>
                        <td>Address 2</td>
                        <td class="shipping_address_2"></td>
                    </tr>
                    
                    <tr>
                        <td>City</td>
                        <td class="shipping_city"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td class="shipping_state"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td class="shipping_country"></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td class="shipping_postcode"></td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="shipOrder" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ship Order</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Order ID</label>
            <input type="text" class="form-control" id="order_id" readonly="true">
        </div>
        <div class="form-group">
            <label for="">Service Level</label>
            <select id="service_type" class="form-control">
                <option value="Standard">Standard</option>
                <option value="Express">Express</option>
                <option value="Sameday">Sameday</option>
                <option value="Nextday">Nextday</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Request Tracking Number</label>
            <input type="number" class="form-control" id="rtn">
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="defaultChecked2" style="margin: 0;">
          <label class="custom-control-label" for="defaultChecked2" style="margin: 0;">The shipping details was correct.</label><br>
          <small>if the shipping details wasn't correct, you can edit at <a target="_blank" href="<?php bloginfo('url');?>/wp-admin/edit.php?post_type=shop_order">orders</a> or ask the customer manually.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="submitOrder">Submit Order</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#submitOrder').attr('disabled', true);
    $('#defaultChecked2').on('click', function(event) {
        var check = $(this);
        if (check.is(':checked')) {
            $('#submitOrder').attr('disabled', false);
        } else {
            $('#submitOrder').attr('disabled', true);
        }
    });

    $('#submitOrder').click(function(event) {
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'ship_order'
            },
            success: function(e){
                console.log(e);
            }
        })
    });

    $('.bill_det').click(function(event) {
        var order_id = $(this).attr('data-id');
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'get_data_billing',
                id: order_id
            },
            success: function(e)
            {
                $('#BillDet').modal('show');
                $('.billing_first_name').html(e.first_name);
                $('.billing_last_name').html(e.last_name);
                $('.billing_Phone').html(e.phone);
                $('.billing_email').html(e.email);
                $('.billing_company').html(e.company);
                $('.billing_address_1').html(e.address_1);
                $('.billing_address_2').html(e.address_2);
                $('.billing_city').html(e.city);
                $('.billing_state').html(e.state);
                $('.billing_country').html(e.country);
                $('.billing_postcode').html(e.postcode);
                console.log(e);
            }
        })        
    });
    $('.shopOrder').click(function(event) {
        var order_id = $(this).attr('data-id');
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'rtn',
                id: order_id
            },
            success: function(e)
            {
                $('#order_id').val(order_id);
                $('#shipOrder').modal('show');
                $('#rtn').val(e);
            }
        }) 
        
    });
    $('.shipDet').click(function(event) {
        var order_id = $(this).attr('data-id');
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'get_data_shipping',
                id: order_id
            },
            success: function(e)
            {
                $('#shipDetMod').modal('show');
                console.log(e);
                $('.shipping_first_name').html(e.first_name);
                $('.shipping_last_name').html(e.last_name);
                $('.shipping_Phone').html(e.phone);
                $('.shipping_email').html(e.email);
                $('.shipping_company').html(e.company);
                $('.shipping_address_1').html(e.address_1);
                $('.shipping_address_2').html(e.address_2);
                $('.shipping_city').html(e.city);
                $('.shipping_state').html(e.state);
                $('.shipping_country').html(e.country);
                $('.shipping_postcode').html(e.postcode);
            }
        })
        
    });
</script>