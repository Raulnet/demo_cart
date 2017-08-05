<?php
require ROOT."src/View/layout/header.php";
$page = 'command';
require ROOT."src/View/layout/navbar.php";
?>
    <div class="container">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>produits</th>
                    <th>TTC</th>
                    <th>date</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order):  ?>
                    <tr>
                        <td><?=$order['id'] ?></td>
                        <td><?=$order['sum_product'] ?></td>
                        <td><?=$order['sum_price'] ?>€</td>
                        <td><?=$order['last_update'] ?></td>
                        <td><a href="#" 
                               class="btn btn-default getDetailOrder"
                               role="button" 
                               data-toggle="modal"
                               data-order_id="<?=$order['id'] ?>"
                               data-target="#order_Modal">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="order_Modal" tabindex="-1" role="dialog" aria-labelledby="label_order_Modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">facture</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">retour</button>
                </div>
            </div>
        </div>
    </div>
<?php
require ROOT."src/View/layout/footer.php";
?>