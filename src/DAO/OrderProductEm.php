<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 03/08/17
 * Time: 21:09
 */

namespace DAO;

use Entity\OrderProduct;

/**
 * Class OrderEm
 * @package DAO
 */
class OrderProductEm extends DAO
{
    /**
     * @var string
     */
    protected $table = 'order_product';

    /**
     * @return bool|int
     */
    public function create(){
        $order = new OrderProduct();
        $params = [
            ':creation_date' => $order->getCreationDate()->format("Y-m-d H:i:s"),
            ':last_update' => $order->getLastUpdate()->format("Y-m-d H:i:s"),
            ':sum_product' => $order->getSumProduct(),
            ':sum_price'   => $order->getSumPrice()
        ];
        $this->query("INSERT INTO order_product 
                      (creation_date, last_update, sum_product, sum_price) 
                      VALUES (:creation_date, :last_update, :sum_product, :sum_price);",
            $params);
        return $this->lastId;
    }

    /**
     * @param OrderProduct $order
     * @return bool|OrderProduct
     */
    public function update(OrderProduct $order){
        $order->setLastUpdate(new \DateTime('now'));
        $params = [
            ':id' => $order->getId(),
            ':last_update' => $order->getLastUpdate()->format("Y-m-d H:i:s"),
            ':sum_product' => (int)$order->getSumProduct(),
            ':sum_price'   => (float)$order->getSumPrice(),
            ':send'        => (int)$order->getSend()
        ];

        if($this->query("UPDATE order_product 
                          SET last_update = :last_update, 
                          sum_product = :sum_product, 
                          sum_price = :sum_price, 
                          send = :send 
                          WHERE id = :id ;",
            $params)){
            return $order;
        }
        return false;
    }

}