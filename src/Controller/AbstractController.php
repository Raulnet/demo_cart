<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 01/08/17
 * Time: 21:35
 */

namespace Controller;

/**
 * Class AbstractController
 * @package Controller
 */
abstract class AbstractController
{
    const ROOT_TEMPLATE = "src/View/";
    const EXTENSION_TEMPLATE = ".php";
    const DEFAULT_ACTION = "homeAction";

    public function getAction($request = ""){
        $url= str_replace('/', '', $request);
        if(empty($url)){
            return self::DEFAULT_ACTION;
        }
        return $url.'Action';
    }

    /**
     * @param $template
     * @param array $params
     * @return bool
     */
   public function render($template, $params = []){
       foreach ($params as $key => $value){
           $$key = $value;
       }
        require ROOT.self::ROOT_TEMPLATE.$template.self::EXTENSION_TEMPLATE;
        return true;
    }

    /**
     * @param $query
     * @return \PDOStatement
     */
    public function getQuery($query){
        return $this->bdd->query($query);
    }

    /**
     * @param array $params
     * @return int
     */
    public function response($params = []){
        echo json_encode($params);
        return true;
    }
}