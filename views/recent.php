<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


<div class="wrap">
    <h1><i class="fas fa-truck"></i> Recent Orders</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Shipment Orders</div>
                <table class="table table-bordered">
                    <thead>
                        <td>Order ID</td>
                        <td>Tracking Number</td>
                        <td>Status</td>
                        <td>Created Date</td>
                        <td>Modify Date</td>
                        <td>Action</td>
                    </thead>
                    <tbody>

                        <?php if (count(getData()) > 0): ?>
                            <?php foreach (getData() as $key => $value): ?>
                                <?php if (get_status_order($value->order_id) === 'shipment'): ?>
                                    <?php if ($value->status === 'created'): ?>
                                        <tr>
                                            <td>#<?php echo $value->order_id;?></td>
                                            <td><b><?php echo $value->tracking_id;?></b></td>
                                            <td><?php echo ucwords(get_status_order($value->order_id));?></td>
                                            <td><?php echo date('jS F Y H:ia', strtotime($value->created_date));?></td>
                                            <td><?php echo date('jS F Y H:ia', strtotime($value->modify_date));?></td>
                                            <td>
                                                <button class="btn btn-success btn-xs print" data-id="<?php echo $value->order_id;?>" data-track="<?php echo $value->tracking_id;?>" disabled><i class="fas fa-print"></i> Print WayBill</button>
                                                <button class="btn btn-danger btn-xs cancel" data-id="<?php echo $value->order_id;?>" data-track="<?php echo $value->tracking_id;?>"><i class="fas fa-times-circle"></i> Cancel Order</button>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    No Data
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Cancelled Orders</div>
                <table class="table table-bordered">
                    <thead>
                        <td>Order ID</td>
                        <td>Tracking Number</td>
                        <td>Status</td>
                        <td>Created Date</td>
                        <td>Modify Date</td>
                        <td>Action</td>
                    </thead>
                    <tbody>

                        <?php if (count(getData()) > 0): ?>
                            <?php foreach (getData() as $key => $value): ?>
                                <?php if (get_status_order($value->order_id) === 'cancelled'): ?>
                                    <?php if ($value->status === 'cancelled'): ?>
                                        <tr>
                                            <td>#<?php echo $value->order_id;?></td>
                                            <td><b><?php echo $value->tracking_id;?></b></td>
                                            <td><?php echo ucwords(get_status_order($value->order_id));?></td>
                                            <td><?php echo date('jS F Y H:ia', strtotime($value->created_date));?></td>
                                            <td><?php echo date('jS F Y H:ia', strtotime($value->modify_date));?></td>
                                            <td>
                                                <button class="btn btn-danger btn-xs delete" data-id="<?php echo $value->order_id;?>"><i class="fas fa-times-circle"></i> Delete Order</button>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    No Data
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete').click(function() {    
        var ord_id = $(this).attr('data-id');
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'delete_order',
                order_id: ord_id
            },
            success: function(e)
            {
                if (e != false) {
                    swal({title: "Success!", text: "The order has been deleted! But still in the Orders WooCommerce", type: 
                    "success"}).then(function(){ 
                       location.reload();
                       }
                    );
                }
            }
        });
    });
    $('.cancel').click(function() {
        var ord_id = $(this).attr('data-id');
        var track = $(this).attr('data-track');
        $(this).attr('disabled', true);
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'access_token',
            },
            success: function(e)
            {
                if (e.status == 200) {
                    cancel_order(e ,track, ord_id);
                }
            }
        })
    });


    $('.print').click(function() {
        var ord_id = $(this).attr('data-id');
        var track = $(this).attr('data-track');

        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'access_token',
            },
            success: function(e)
            {
                if (e.status == 200) {
                    console.log(e);
                    generate_wb(e, ord_id, track);
                }
            }
        })
    });

    function cancel_order(resp ,track, ord_id)
    {
        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'cancel_order',
                tids: track,
                order_id: ord_id,
                token: resp.access_token
            },
            success: function(e)
            {
                $('.cancel').attr('disabled', false);
                if (e.status == 200) {
                    swal({title: "Success!", text: e.message, type: 
                    "success"}).then(function(){ 
                       location.reload();
                       }
                    );
                } else {
                    swal({title: "Ooops..!", text: e.message, type: 
                    "error"}).then(function(){ 
                       location.reload();
                       }
                    );
                }
            }
        })
    }

    function generate_wb(resp, ord_id, track)
    {

        $.ajax({
            url: '<?php bloginfo('url');?>/wp-content/plugins/ninja_van/app/request.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                method: 'generate_waybill',
                tids: track,
                order_id: ord_id,
                token: resp.access_token
            },
            success: function(e)
            {
                console.log(e);
            }
        })
    }
</script>
