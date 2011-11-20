<?php
class ModuleCartFrame extends Module
{
  public function  handle_request()
  {
    $r = new ModuleResponse($this->get_name());
    $request = Request::get_request();
    $validator = Validator::get_validator();
    $cart = Cart::get_cart();

    if($request->get_post('purchase'))
    {
      $values['amount'] = $validator->safe($request->get_post('amount'));
      $values['product_id'] = $validator->safe($request->get_post('product_id'));

      if(!$validator->is_id($values['amount'])) $errors['amount'] = true;
      if(!$validator->is_id($values['product_id'])) $errors['product_id'] = true;

      if(!$errors)
      {
        $cart->add_purchase($values);
      }
    }

    //if($cart->get_purchases()) $r->set('purchases', $cart->get_purchases());
    $r->set_template($this->get_template('index'));
    return $r;
  }
  
}
?>
