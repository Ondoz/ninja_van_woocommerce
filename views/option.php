<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


<div class="wrap">
    <h1><i class="fas fa-truck"></i> Ninja Van</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Processing Order</div>
                <table class="table table-bordered">
                    <thead>
                        <td>Order ID</td>
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
                                <?php if ($data->get_status() === 'processing'): ?>
                                    <tr>
                                        <td>#<?php echo $value;?></td>
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
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
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
        <div id="general">
            <div class="form-group">
                <label for="">Order ID</label>
                <input type="text" class="form-control" id="order_id" readonly="true">
            </div>
            <div class="form-group">
                <label for="">Service Level</label>
                <select id="service_level" class="form-control">
                    <option value="Standard">Standard</option>
                    <option value="Express">Express</option>
                    <option value="Sameday">Sameday</option>
                    <option value="Nextday">Nextday</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Request Tracking Number</label>
                <input type="text" class="form-control" id="rtn">
            </div>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="pickupReq" style="margin: 0;">
          <label class="custom-control-label" for="pickupReq" style="margin: 0;">Require pick up ?</label><br>
        </div>
        <br>
        <div id="pickup">
            <div class="form-group">
                <label for="">Pickup Service Type</label>
                <select id="pickup_service_type" class="form-control">
                    <option value="Scheduled">Scheduled</option>
                    <option value="On-Demand">On-Demand</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Pickup Service Level</label>
                <select id="pickup_service_level" class="form-control">
                    <option value="Standard">Standard</option>
                    <option value="Premium">Premium</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Pickup Date</label>
                <input type="date" class="form-control" id="pickup_date">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Start Time</label>
                        <input type="time" id="start_time" value="09:00:00">
                    </div>
                    <div class="col-md-6">
                        <label for="">End Time</label>
                        <input type="time" id="end_time" value="12:00:00">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Delivery Date</label>
                <input type="date" class="form-control" id="dl_date">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Start Time</label>
                        <input type="time" id="dl_start_time" value="09:00:00">
                    </div>
                    <div class="col-md-6">
                        <label for="">End Time</label>
                        <input type="time" id="dl_end_time" value="12:00:00">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Pickup Instruction</label>
                <input type="text" id="pickup_instruction" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Delivery Instruction</label>
                <input type="text" id="delivery_instruction" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Size</label>
                        <select class="form-control" id="dim_size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Weight</label>
                        <input type="number" class="form-control" placeholder="in Kilograms" id="dim_weight">
                    </div>
                    <div class="form-group">
                        <label for="">Width</label>
                        <input type="number" class="form-control" placeholder="in Centimeters" id="dim_width">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Length</label>
                        <input type="number" class="form-control" placeholder="in Centimeters" id="dim_length">
                    </div>
                    <div class="form-group">
                        <label for="">Height</label>
                        <input type="number" class="form-control" placeholder="in Centimeters" id="dim_height">
                    </div>
                </div>
            </div>
            <div class="form-group">

            </div>
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
    $('#pickup').hide();
    $('#defaultChecked2').on('click', function(event) {
        var check = $(this);
        if (check.is(':checked')) {
            $('#submitOrder').attr('disabled', false);
        } else {
            $('#submitOrder').attr('disabled', true);
        }
    });

    $('#pickupReq').on('click', function(event) {
        var check = $(this);
        if (check.is(':checked')) {
            $('#pickup').show(1000);
            $('#general').hide(1000);
        } else {
            $('#pickup').hide(1000);
            $('#general').show(1000);
        }
    });

    function create_order(e)
    {
        $('#submitOrder').html('<i class="fas fa-spin fa-spinner"></i> Creating Order..');
        var serv_lvl = $('#service_level').val();
        var req_track_n = $('#rtn').val();
        var ord_id = $('#order_id').val();
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'create_order',
                access_tokn: e.access_token,
                service_level: serv_lvl,
                rtn: req_track_n,
                order_id: ord_id,
                pk_req: $('#pickupReq').val(),
                pk_st: $('#pickup_service_type').val(),
                pk_slv: $('#pickup_service_level').val(),
                pk_date: $('#pickup_date').val(),
                pk_start: $('#start_time').val(),
                pk_end: $('#end_time').val(),
                pk_inst: $('#pickup_instruction').val(),
                dl_inst: $('#delivery_instruction').val(),
                dl_date: $('#dl_date').val(),
                dl_start: $('#dl_start_time').val(),
                dl_end: $('#dl_end_time').val(),
                weight: $('#dim_width').val(),
                width: $('#dim_width').val(),
                length: $('#dim_length').val(),
                height: $('#dim_height').val(),
                size: $('#dim_size').val()
            },
            success: function(resp)
            {
                if (resp.status == 200) {
                    update_order(resp);
                } else {
                    Swal.fire({
                      type: 'error',
                      title: resp.title,
                      text: resp.message
                    });
                    $('#submitOrder').html('Submit Order');
                    $('#submitOrder').attr('disabled', false);
                    return false;
                }
            }
        });
    }

    function update_order(e)
    {
        $('#submitOrder').html('<i class="fas fa-spin fa-spinner"></i> Update Order..');
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'update_status',
                ord_id: e.order_id,
                track_number: e.tracking_number
            },
            success: function(resp)
            {
                $('#submitOrder').html('Submit Order');
                $('#submitOrder').attr('disabled', false);
                if (resp.status == 200) {
                    Swal.fire(
                      'Success!',
                      resp.message,
                      'success'
                    );
                } else {
                    Swal.fire({
                      type: 'error',
                      title: 'Oops...',
                      text: resp.message
                    });
                }
            }
        });
    }

    $('#submitOrder').click(function(event) {
        $(this).html('<i class="fas fa-spin fa-spinner"></i> Request access token..');
        $(this).attr('disabled', true);
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'ship_order'
            },
            success: function(e){
                create_order(e);
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