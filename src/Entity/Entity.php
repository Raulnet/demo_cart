<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 02/08/17
 * Time: 22:58
 */

namespace Entity;

/**
 * Class Entity
 * @package Entity
 */
abstract class Entity
{
    /**
     * @var array
     */
    protected $attr = [];

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
    public function setAttribute(array $attr){
        $this->attr = $attr;
        return $this;
    }

}