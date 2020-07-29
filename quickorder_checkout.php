<?php
defined('_JEXEC') or die;

class plgJshoppingCheckoutQuickOrder_checkout extends JPlugin
{

    function __construct($properties = null)
    {

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