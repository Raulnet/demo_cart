<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 04/08/17
 * Time: 22:31
 */

namespace Model;

use Entity\OrderProduct;
use Entity\Product;
use DAO\OrderProductEm;
use DAO\ProductHasOrderEm;
use Entity\ProductHasOrder;


/**
 * Class ProductService
 * @package model
 */
class ProductService
{

    /**
     * @param Product $product
     * @param OrderProduct $orderProduct
     * @return bool
     */
    public function addProduct(Product $product, OrderProduct $orderProduct){
        $poEm = new ProductHasOrderEm();
        $productHasOrderEntity = new ProductHasOrder();
        $productHasOrder = $poEm->findBy(['product_id' => $product->getId(), 'order_id' => $orderProduct->getId()]);
        if(!$productHasOrder){
            $productHasOrderEntity->setProductId($product->getId());
            $productHasOrderEntity->setOrderId($orderProduct->getId());
            $productHasOrderEntity->setSumPrice($product->getPrice());
            $productHasOrderEntity->setSumProduct(1);
            $poEm->create($productHasOrderEntity);
        } else {
            $productHasOrderEntity->setAttribute($productHasOrder);
            $sumProduct = (int)$productHasOrderEntity->getSumProduct()+1;
            $productHasOrderEntity->setSumProduct($sumProduct);
            $sumPrice =  (float)$productHasOrderEntity->getSumPrice()+$product->getPrice();
            $productHasOrderEntity->setSumPrice($sumPrice);
            $poEm->update($productHasOrderEntity);
        }
            $sumProduct = (int)$orderProduct->getSumProduct()+1;
            $orderProduct->setSumProduct($sumProduct);
            $sumPrice = (float)$orderProduct->getSumPrice()+$product->getPrice();
            $orderProduct->setSumPrice($sumPrice);
            $orderProductEm = new OrderProductEm();
            $orderProductEm->update($orderProduct);
            return true;
    }


    /**
     * @param Product $product
     * @param OrderProduct $orderProduct
     * @return bool
     */
    public function removeProduct(Product $product, OrderProduct $orderProduct){
        $poEm = new ProductHasOrderEm();
        $productHasOrderEntity = new ProductHasOrder();
        $productHasOrder = $poEm->findBy(['product_id' => $product->getId(), 'order_id' => $orderProduct->getId()]);
        if(!$productHasOrder){
            return false;
        } else {
            $productHasOrderEntity->setAttribute($productHasOrder);
            $sumProduct = (int)$productHasOrderEntity->getSumProduct()-1;
            $productHasOrderEntity->setSumProduct($sumProduct);
            $sumPrice =  (float)$productHasOrderEntity->getSumPrice()-$product->getPrice();
            $productHasOrderEntity->setSumPrice($sumPrice);
            $poEm->update($productHasOrderEntity);
        }
        $orderProduct->setSumProduct($orderProduct->getSumProduct()-1);
        $orderProduct->setSumPrice($orderProduct->getSumPrice()-$product->getPrice());
        $orderProductEm = new OrderProductEm();
        $orderProductEm->update($orderProduct);
        return true;
    }


}