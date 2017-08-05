<?php
namespace Entity;

/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 01/08/17
 * Time: 22:05
 */
class OrderProduct extends Entity
{
    /**
     * @var int
     */
    private $id = 0;
    /**
     * @var \DateTime
     */
    private $creationDate;
    /**
     * @var \DateTime
     */
    private $lastUpdate;
    /**
     * @var int
     */
    private $sumProduct = 0;
    /**
     * @var int
     */
    private $sumPrice = 0;

    /**
     * @var int
     */
    private $send = 0;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime('now');
        $this->lastUpdate =  new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param \DateTime $lastUpdate
     */
    public function setLastUpdate(\DateTime $lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
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
     * @return int
     */
    public function getSumPrice()
    {
        return $this->sumPrice;
    }

    /**
     * @param int $sumPrice
     */
    public function setSumPrice($sumPrice)
    {
        $this->sumPrice = $sumPrice;
    }

    /**
     * @param array $attr
     * @return $this
     */
    function setAttribute(array $attr){
        $this->attr = $attr;
        $this->id = (int)$attr['id'];
        $this->creationDate = (string)$attr['creation_date'];
        $this->lastUpdate = (string)$attr['last_update'];
        $this->setSumPrice((float)$attr['sum_price']);
        $this->setSumProduct((int)$attr['sum_product']);
        $this->setSend((int)$attr['send']);
        return $this;
    }

    /**
     * @return int
     */
    public function getSend()
    {
        return $this->send;
    }

    /**
     * @param int $send
     */
    public function setSend($send)
    {
        $this->send = $send;
    }

}