<div class="row">
    <table class="table table-striped col-xs-12">
        <thead>
        <tr>
            <td>Produits</td>
            <td>total</td>
            <td>prix</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product):  ?>
            <tr>
                <td><?= $product['title'] ?></td>
                <td><?= $product['sum_product'] ?></td>
                <td><?= $product['sum_price'] ?>€</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <hr />
    <div class="col-md-offset-6 col-xs-6">
        <table class=" table table-striped">
            <tr>
                <th>Total Produit(s)</th>
                <td><?= (int)$order['sum_product']  ?></td>
            </tr>
            <tr>
                <th>Total HT</th>
                <td><?= round((float)$order['sum_price']/1.196, 2)  ?>€</td>
            </tr>
            <tr>
                <th>Total TTC (19.6%)</th>
                <td><?= (float)$order['sum_price']  ?>€</td>
            </tr>
        </table>
    </div>

</div>
