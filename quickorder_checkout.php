<?php
defined('_JEXEC') or die;

class plgJshoppingCheckoutQuickOrder_checkout extends JPlugin
{


     
    function onBeforeCartLoad($cart){

        if ( $cart->type_cart != 'quickorder_checkout' )  return ; #END IF
        $this->app = \Joomla\CMS\Factory::getApplication();
        $dispatcher = JDispatcher::getInstance();
        
        $checkoutOrderModel = JSFactory::getModel('checkoutOrder', 'jshop');

        $adv_user = JSFactory::getUser();
        $adv_user->l_name = $this->app->input->get('l_name' , null ) ;
        $adv_user->phone = $this->app->input->get('phone' , null ) ;

        $post = [] ;
        $product_id = 77 ;
        $quantity = 1 ;
        $attribut = [] ;
        $freeattribut = false ;

        $cart->add($product_id, $quantity, $attribut, $freeattribut) ;




        try
        {
            // Code that may throw an Exception or Error.
            $checkoutOrderModel->setCart( $cart )   ;
            $order =  $checkoutOrderModel->orderDataSave($adv_user, $post , $cart);
            $order->order_created = 1;
            $order->store();
            $order->updateProductsInStock(1);

            /*$orderTable = JSFactory::getTable('order', 'jshop');
            $orderTable->load($order->order_id);
            $orderTable->order_created = 1;
            $dispatcher->trigger('onBeforeAdminFinishOrder', array(&$order));
            $orderTable->store();
            $orderTable->updateProductsInStock(1);*/
            

        }
        catch (Exception $e)
        {
            // Executed only in PHP 5, will not be reached in PHP 7
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            echo'<pre>';print_r( $e );echo'</pre>'.__FILE__.' '.__LINE__;
            die(__FILE__ .' '. __LINE__ );
        }





    }







    /**
     * Событие после того как товар добавлен в корзину
     * @param $cart
     * @param $product_id
     * @param $quantity
     * @param $attribut
     * @param $freeattribut
     *
     *
     * @since version
     */
    function onAfterCartAddOk( $cart, $product_id, $quantity, $attribut, $freeattribut ){
        /*echo'<pre>';print_r( $cart );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $product_id );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $quantity );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $attribut );echo'</pre>'.__FILE__.' '.__LINE__;
        echo'<pre>';print_r( $freeattribut );echo'</pre>'.__FILE__.' '.__LINE__;

        die(__FILE__ .' '. __LINE__ );*/

    }
    function onBeforeSaveNewProductToCart(&$cart, &$temp_product, &$product, &$errors, &$displayErrorMessage){

    }

    function onBeforeSaveUpdateProductToCart(&$cart, &$product, $key, &$errors, &$displayErrorMessage, &$product_in_cart, &$quantity){

    }

    function onAfterAddProductToCart(&$cart, &$product_id, &$quantity, &$attr_id, &$freeattributes, &$errors, &$displayErrorMessage){

    }

    function onAfterRefreshProductInCart(&$quantity, &$cart){

    }

    function onBeforeDisplayCart(&$cart) {

    }

    function onBeforeDisplayCartView(&$view){

    }

    function onBeforeDisplayCheckoutFinish(&$text, &$order_id){

    }

    function onBeforeLoadWishlistRemoveToCart(&$number_id) {

    }

    function onAfterWishlistRemoveToCart(&$cart) {

    }

    function onBeforeDisplayWishlistView(&$view) {

    }

    function onBeforeDisplayMyAccountView(&$view) {

    }

    public function onBeforeDiscountSave(&$coupon, &$cart){

    }

    function onAfterDiscountSave(&$coupon, &$cart){

    }
}