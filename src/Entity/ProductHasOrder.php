<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 04/08/17
 * Time: 22:35
 */

namespace Entity;

/**
 * Class ProductHasOrder
 * @package Entity
 */
class ProductHasOrder extends Entity
{
    /**
     * @var int
     */
    private $orderId = 0;
    /**
     * @var int
     */
    private $productId = 0;
    /**
     * @var int
     */
    private $sumProduct = 0;
    /**
     * @var float
     */
    private $sumPrice = 0.00;

    /**
     * @return array
     */
    public function getAttr()
    {
        return $this->attr;
    }

    /**
     * @param array $attr
     * @return $this
     */
    public function setAttribute(array $attr)
    {
        $this->attr = $attr;
        $this->setOrderId((int) $attr['order_id']);
        $this->setProductId((int)$attr['product_id']);
        $this->setSumProduct((int)$attr['sum_product']);
        $this->setSumPrice((float)$attr['sum_price']);
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getSumProduct()
    {
        return $this->sumProduct;
    }

    /**
     * @param int $sumProduct
     */
    public function setSumProduct($sumProduct)
    {
        $this->sumProduct = $sumProduct;
    }

    /**
     * @return float
     */
    public function getSumPrice()
    {
        return $this->sumPrice;
    }

    /**
     * @param float $sumPrice
     */
    public function setSumPrice($sumPrice)
    {
        $this->sumPrice = $sumPrice;
    }


}