<?php
namespace Entity;

/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 01/08/17
 * Time: 22:04
 */
class Product extends Entity
{
    /**
     * @var int
     */
    private $id = 0;
    /**
     * @var string
     */
    private $title = "";
    /**
     * @var string
     */
    private $description = "";
    /**
     * @var float
     */
    private $price = 0.0;
    /**
     * @var string
     */
    private $img = "";

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->title;
    }

    /**
     * @param array $attr
     * @return $this
     */
    function setAttribute(array $attr){
        $this->attr = $attr;
        $this->id = (int)$attr['id'];
        $this->setTitle((string)$attr['title']);
        $this->setDescription((string)$attr['description']);
        $this->setImg((string)$attr['img']);
        $this->setPrice((float)$attr['price']);
        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

}