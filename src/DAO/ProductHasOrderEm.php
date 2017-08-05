<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 04/08/17
 * Time: 22:48
 */

namespace DAO;


use Entity\OrderProduct;
use Entity\ProductHasOrder;

class ProductHasOrderEm extends DAO
{

    protected $table = "product_has_order";

    /**
     * @param ProductHasOrder $productHasOrder
     * @return bool|int
     */
    public function create(ProductHasOrder $productHasOrder){
        $params = [
            ':order_id' => $productHasOrder->getOrderId(),
            ':product_id' => $productHasOrder->getProductId(),
            ':sum_product' => $productHasOrder->getSumProduct(),
            ':sum_price'   => $productHasOrder->getSumPrice()
        ];
        $this->query("INSERT INTO product_has_order
                      (order_id, product_id, sum_product, sum_price) 
                      VALUES (:order_id, :product_id, :sum_product, :sum_price);",
            $params);
        return $this->lastId;
    }

    /**
     * @param ProductHasOrder $productHasOrder
     * @return bool|ProductHasOrder
     */
    public function update(ProductHasOrder $productHasOrder){
        $params = [
            ':product_id' => $productHasOrder->getProductId(),
            ':order_id' => $productHasOrder->getOrderId(),
            ':sum_product' => (int)$productHasOrder->getSumProduct(),
            ':sum_price'   => (float)$productHasOrder->getSumPrice()
        ];
        if($this->query("UPDATE product_has_order 
                          SET sum_product = :sum_product, sum_price = :sum_price 
                          WHERE product_id = :product_id 
                          AND order_id =:order_id  ;",
            $params)){
            return $productHasOrder;
        }
        return false;
    }

    /**
     * @param OrderProduct $orderProduct
     * @return array|bool
     */
    public function getCart(OrderProduct $orderProduct){
        $query = "SELECT po.*, p.title 
                    FROM product_has_order po 
                    JOIN product p ON p.id = po.product_id 
                    WHERE po.sum_product > 0 
                    AND order_id = :order_id ;";
        $params = [
            ':order_id' => $orderProduct->getId()
        ];


        return $this->query($query, $params)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param OrderProduct $orderProduct
     * @return bool
     */
    public function resetCart(OrderProduct $orderProduct){
        $params = [
            ':order_id' => $orderProduct->getId(),
        ];
        $this->query("UPDATE product_has_order 
                          SET sum_product = 0, sum_price = 0 
                          AND order_id =:order_id  ;",
            $params);
        $this->query("UPDATE order_product 
                          SET sum_product = 0, sum_price = 0 
                          AND id =:order_id  ;",
            $params);
        return true;
    }


}