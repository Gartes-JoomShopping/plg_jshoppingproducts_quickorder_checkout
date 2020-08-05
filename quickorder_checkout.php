<?php
defined('_JEXEC') or die;

class plgJshoppingCheckoutQuickOrder_checkout extends JPlugin
{


     
    function onBeforeCartLoad($cart){

        if ( $cart->type_cart != 'quickorder_checkout' )  return ; #END IF
        $this->app = \Joomla\CMS\Factory::getApplication();
        $dispatcher = JDispatcher::getInstance();
        
        $checkoutOrderModel = JSFactory::getModel('checkoutOrder', 'jshop');

        $post = [] ;
        $attribut = [] ;
        $freeattribut = false ;

        $adv_user = JSFactory::getUser();
        $adv_user->l_name = $this->app->input->get('l_name' , null , 'STRING' ) ;
        $adv_user->phone = $this->app->input->get('phone' , null  ) ;
        $category_id = $this->app->input->get('category_id' , null , 'INT') ;
        $product_id = $this->app->input->get('product_id' , null , 'INT' ) ;
        $quantity = 1 ;



        $cart->add($product_id, $quantity, $attribut, $freeattribut) ;




        try
        {
            // Code that may throw an Exception or Error.
            $checkoutOrderModel->setCart( $cart )   ;
            $order =  $checkoutOrderModel->orderDataSave($adv_user, $post , $cart);
            $order->order_created = 1;
            $order->store();
            $order->updateProductsInStock(1);
            $this->order = $order ;






            $checkout = \JSFactory::getModel('checkout', 'jshop');
            $checkout->sendOrderEmail($order->order_id,  1);


            $result['html'] = $this->loadTemplate( 'order_accept' ) ;

            $registry = new \Joomla\Registry\Registry();
            $registry->loadObject($order) ;
            $result['orderDetail'] = $registry->toObject();


            

            echo new JResponseJson($result);
            die();


            
            

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
     * Загрузите файл макета плагина. Эти файлы могут быть переопределены с помощью стандартного Joomla! Шаблон
     *
     * Переопределение :
     *                  JPATH_THEMES . /html/plg_{TYPE}_{NAME}/{$layout}.php
     *                  JPATH_PLUGINS . /{TYPE}/{NAME}/tmpl/{$layout}.php
     *                  or default : JPATH_PLUGINS . /{TYPE}/{NAME}/tmpl/default.php
     *
     *
     * переопределяет. Load a plugin layout file. These files can be overridden with standard Joomla! template
     * overrides.
     *
     * @param string $layout The layout file to load
     * @param array  $params An array passed verbatim to the layout file as the `$params` variable
     *
     * @return  string  The rendered contents of the file
     *
     * @since   5.4.1
     * @todo Add temlate
     */
    private function loadTemplate ( $layout = 'default' )
    {
        $path = \Joomla\CMS\Plugin\PluginHelper::getLayoutPath( 'jshoppingproducts', 'quickorder', $layout );
        // Render the layout
        ob_start();
        include $path;
        return ob_get_clean();
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