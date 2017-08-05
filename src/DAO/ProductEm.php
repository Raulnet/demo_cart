<?php
namespace DAO;

use Entity\Product as EntityProduct;
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 02/08/17
 * Time: 21:49
 */
class ProductEm extends DAO
{

    protected $table = "product";

    /**
     * @return array|bool
     */
    public function getProducts(){
        $raw = $this->query("SELECT * FROM product", []);
        if($raw){
            $products = [];
            foreach ($raw as $data){
                $product = new EntityProduct();
                $product->setAttribute($data);
                $products[] = $product;
            }
            return $products;
        }
        return false;
    }




}