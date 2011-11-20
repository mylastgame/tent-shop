<?php
class ModuleLoginFrame extends Module
{
  public function  handle_request() {
    $r = new ModuleResponse($this->get_name());
    $request = Request::get_request();
    $validator = Validator::get_validator();
    $customers = Customers::get_customers();
    $auth = Auth::get_auth();

    if($request->get_post('login_lframe'))
    {
      $email = trim($request->get_post('email_lframe'));
      $password = trim($request->get_post('password_lframe'));

      if(!$validator->is_email($email)) $r->set('error_email', true);
      if(!$validator->is_password($password)) $r->set('error_password', true);

      if(!$r->get('error_email') && !$r->get('error_password'))
      {
        $customer = $customers->get_customer_by_email($email);
        if($customer)
        {
          if($customer->get('password') == $customers->form_password($password, $customer->get('reg_date')))
          {
            $auth->save_for_autologin($customer);
            $auth->set_customer($customer);
            $r->set('customer', $customer);
            $r->set_template($this->get_template('login'));
            return $r;
          }
        }
        $r->set('wrong_credentials', true);
      }            
    }
    
    if($auth->get_customer())
    {
      $r->set_template($this->get_template('login'));
      $r->set('customer', $auth->get_customer());
      return $r;
    }

    $r->set_template($this->get_template('index'));
    return $r;
  }
}
?>
