<?php
namespace Controller;

use DAO\OrderProductEm;
use DAO\ProductEm;
use DAO\ProductHasOrderEm;
use Entity\OrderProduct;
use Entity\Product;
use Model\ProductService;

/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 01/08/17
 * Time: 19:58
 */
class HomeController extends AbstractController
{

    /**
     * @return string
     * @throws \Exception
     */
    public function run(){
        if(!$_SESSION['order_id']){
            $orderProductEm = new OrderProductEm();
            $_SESSION['order_id'] = $orderProductEm->create();
        }
        $action = $this->getAction($_SERVER[REQUEST_URI]);
        if (method_exists($this, $action)) {
            return $this->$action();
        }

        throw new \Exception('route '.$_SERVER[REQUEST_URI].' undefined');

    }

    /**
     * @return bool
     */
    public function homeAction(){
        $productEm = new ProductEm();
        $products = $productEm->getProducts();

        return $this->render("Home/home", [
            "products" => $products
        ]);
    }

    /**
     * @return bool
     */
    public function commandAction(){
        $orderProductEm = new OrderProductEm();
        $orders = $orderProductEm->findBy(["send" => 1]);
        return $this->render("Command/command", [
            'orders' => $orders
        ]);
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function addProductAction(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $response = [];
            $productId = $_POST['product_id'];
            $orderProductEm = new OrderProductEm();
            if((int)$_SESSION['order_id'] === 0){
                throw new \Exception(" id_order undefined ");
            }
            $orderId = (int)$_SESSION['order_id'];
            $orderProduct = $orderProductEm->find($orderId);
            $orderProductEntity = new OrderProduct();
            $orderProductEntity->setAttribute($orderProduct);
            $productEm = new ProductEm();
            $product = $productEm->find($productId);
            if($product){
                $productEntity = new Product();
                $productEntity->setAttribute($product);
                $productService = new ProductService();
                $productService->addProduct($productEntity, $orderProductEntity);
                return $this->getCart($orderProductEntity);
            }
            return $this->response($response);
        }
        throw new \Exception('METHOD '.$_SERVER['REQUEST_METHOD'].' unvailable');
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function removeProductAction(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $response = [];
            $productId = $_POST['product_id'];
            if((int)$_SESSION['order_id'] === 0){
                throw new \Exception(" id_order undefined ");
            }
            $orderId = (int)$_SESSION['order_id'];
            $orderProductEm = new OrderProductEm();
            $orderProduct = $orderProductEm->find($orderId);
            $orderProductEntity = new OrderProduct();
            $orderProductEntity->setAttribute($orderProduct);
            $productEm = new ProductEm();
            $product = $productEm->find($productId);
            if($product){
                $productEntity = new Product();
                $productEntity->setAttribute($product);
                $productService = new ProductService();
                $productService->removeProduct($productEntity, $orderProductEntity);
                return $this->getCart($orderProductEntity);
            }
            return $this->response($response);
        }
        throw new \Exception('METHOD '.$_SERVER['REQUEST_METHOD'].' unvailable');
    }

    /**
     * @throws \Exception
     */
    public function sendOrderAction(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if((int)$_SESSION['order_id'] === 0){
                throw new \Exception(" id_order undefined ");
            }
            $orderId = (int)$_SESSION['order_id'];
            $orderProductEm = new OrderProductEm();
            $orderProduct = $orderProductEm->find($orderId);
            $orderProductEntity = new OrderProduct();
            $orderProductEntity->setAttribute($orderProduct);
            $orderProductEntity->setSend(1);
            $orderProductEm->update($orderProductEntity);


            return $this->getOrderTemplate($orderProductEntity);


        }
        throw new \Exception('METHOD '.$_SERVER['REQUEST_METHOD'].' unvailable');
    }

    /**
     * @return int
     */
    public function initOrderAction(){
        $orderProductEm = new OrderProductEm();
        $_SESSION['order_id'] = $orderProductEm->create();
        $orderId = (int)$_SESSION['order_id'];
        $orderProduct = $orderProductEm->find($orderId);
        $orderProductEntity = new OrderProduct();
        $orderProductEntity->setAttribute($orderProduct);
        return $this->getCart($orderProductEntity);
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function resetCartAction(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if((int)$_SESSION['order_id'] === 0){
                throw new \Exception(" id_order undefined ");
            }
            $orderId = (int)$_SESSION['order_id'];
            $orderProductEm = new OrderProductEm();
            $orderProduct = $orderProductEm->find($orderId);
            $orderProductEntity = new OrderProduct();
            $orderProductEntity->setAttribute($orderProduct);
            $productHasOrderEm = new ProductHasOrderEm();
            $productHasOrderEm->resetCart($orderProductEntity);
            return $this->getCart($orderProductEntity);
        }
        throw new \Exception('METHOD '.$_SERVER['REQUEST_METHOD'].' unvailable');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function getDetailOrderAction(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'];
            $orderProductEm = new OrderProductEm();
            $orderProduct = $orderProductEm->find($orderId);
            $orderProductEntity = new OrderProduct();
            $orderProductEntity->setAttribute($orderProduct);
            $orderProductEm->update($orderProductEntity);
            return $this->getOrderTemplate($orderProductEntity);
        }
        throw new \Exception('METHOD '.$_SERVER['REQUEST_METHOD'].' unvailable');
    }

    /**
     * @param OrderProduct $orderProductEntity
     * @return int
     */
    private function getCart(OrderProduct $orderProductEntity){
        $cart = [];
        $orderProductEm = new OrderProductEm();
        $orderProduct = $orderProductEm->find($orderProductEntity->getId());
        $productHasOrderEm = new ProductHasOrderEm();
        $productHasOrder = $productHasOrderEm->getCart($orderProductEntity);
        $cart['order'] = $orderProduct;
        $cart['products'] = $productHasOrder;
        return $this->response($cart);
    }

    /**
     * @param OrderProduct $orderProductEntity
     * @return bool
     */
    private function getOrderTemplate(OrderProduct $orderProductEntity){
        $orderProductEm = new OrderProductEm();
        $orderProduct = $orderProductEm->find($orderProductEntity->getId());
        $productHasOrderEm = new ProductHasOrderEm();
        $productHasOrder = $productHasOrderEm->getCart($orderProductEntity);
        $params['order'] = $orderProduct;
        $params['products'] = $productHasOrder;
        return $this->render('Home/_order', $params);
    }




}