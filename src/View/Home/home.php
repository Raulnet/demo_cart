<?php
require ROOT."src/View/layout/header.php";
$page = 'home';
require ROOT."src/View/layout/navbar.php";
?>
    <div class="container">
        <div class="col-md-8">
            <div class="row">
                <?php foreach ($products as $product) : ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="product thumbnail">
                            <img src="<?= $product->img ?>" alt="<?= $product->title ?>">
                            <div class="caption">
                                <h4><?= $product->title ?></h4>
                                <a href="#" class="btn btn-primary pull-right addProduct" role="button" data-product_id="<?= $product->id ?>"><span class="glyphicon glyphicon-shopping-cart"></span> <?= $product->price ?>€ </a>
                                <a href="#" class="btn btn-default" role="button" data-toggle="modal" data-target="#product_<?= $product->id ?>_Modal"><span class="glyphicon glyphicon-eye-open"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="product_<?= $product->id ?>_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?= $product->title ?></h4>
                                </div>
                                <div class="modal-body">
                                    <img class="img-responsive" src="<?= $product->img ?>" alt="<?= $product->title ?>">
                                    <p><?= $product->description ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">retour</button>
                                    <button type="button" class="btn btn-primary pull-right addProduct" role="button" data-product_id="<?= $product->id ?>"><span class="glyphicon glyphicon-shopping-cart"></span> <?= $product->price ?>€</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div>Panier <span id="sum_product">(0)</span> <span id="order" class="pull-right">0.00€</span></div>
                </div>
                <table id="cart" class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-xs-6">Product</th>
                        <th class="col-xs-2">total</th>
                        <th class="col-xs-2">prix</th>
                        <th class="col-xs-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="cart_action" class="panel-footer">
                    <a id="sendOrder" class="btn btn-success">buy</a>
                    <a id="resetCart" class="btn btn-danger">reset</a>
                </div>
            </div>

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