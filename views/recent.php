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
                        <td>Action</td>
                    </thead>
                    <tbody>

                        <?php if (count(getData()) > 0): ?>
                            <?php foreach (getData() as $key => $value): ?>
                                <?php if (get_status_order($value->order_id) === 'shipment'): ?>
                                    <tr>
                                        <td>#<?php echo $value->order_id;?></td>
                                        <td><b><?php echo $value->tracking_id;?></b></td>
                                        <td><?php echo ucwords(get_status_order($value->order_id));?></td>
                                        <td>
                                            <button class="btn btn-danger btn-xs">Cancel Order</button>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">
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
