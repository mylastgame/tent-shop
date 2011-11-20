<?php
class ModuleAccount extends Module
{
  public function handle_request()
  {
    $request = Request::get_request();    
    
    if($request->uri_less_than(1))
    {
      return $this->show_account();
    }

    if($request->uri_equal(1))
    {
      if($request->get_first() == 'new') return $this->new_account();
      if($request->get_first() == 'orders') return $this->account_orders();
      if($request->get_first() == 'change') return $this->change_account();
      if($request->get_first() == 'logout') return $this->logout();
    }

    $e = new SystemError('BadRequestParameter');
    Errors::get_instance()->add_error($e);
    return false;        
  }

  public function show_account()
  {
    $request = Request::get_request();  
    $validator = Validator::get_validator();
    $customers = Customers::get_customers();
    $auth = Auth::get_auth();
    $r = new ModuleResponse($this->get_name());

    if($request->get_post('login'))
    {
      $email = trim($request->get_post('email'));
      $password = trim($request->get_post('password'));

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
            $r->set_template($this->get_template('account'));
            return $r;
          }
        }
        $r->set('wrong_credentials', true);
      }            
    }

    if($auth->get_customer())
    {
      $r->set('customer', $auth->get_customer());
      $r->set_template($this->get_template('account'));
      return $r;
    }

    $r->set_template($this->get_template('index'));
    return $r;
  }

  public function new_account()
  {
    $request = Request::get_request();
    $r = new ModuleResponse($this->get_name());    

    if($request->get_post('submit'))
    {
      $validator = Validator::get_validator();
      $customers = Customers::get_customers();
      
      $email = trim($request->get_post('email'));
      $password = trim($request->get_post('password'));

      if(!$validator->is_email($email)) $r->set('error_email', true);
      if(!$validator->is_password($password)) $r->set('error_password', true);

      if(!$r->get('error_email') && !$r->get('error_password'))
      {
        $customers = Customers::get_customers();
        if($customers->get_customer_by_email($email))
        {
          $r->set('email_exists', true);
          $r->set_template($this->get_template('new_account'));
          return $r;
        }


        $values['reg_date'] = $reg_date = time();
        $values['password'] = $customers->form_password($password, $reg_date);
        $values['email'] = $email;
        $customer = new Customer($values);
        $id = $customer->save('new');

        $r->set('customer', $customer);
        $r->set('new_account', true);
        $r->set_template($this->get_template('change_account'));
        return $r;
      }
    }        
    $r->set_template($this->get_template('new_account'));
    return $r;
  }

  public function logout()
  {
    $auth = Auth::get_auth()->logout();
    $r = new ModuleResponse($this->get_name());
    $r->set_template($this->get_template('index'));
    return $r;
  }

  public function change_account()
  {
    $r = new ModuleResponse($this->get_name());
    $validator = Validator::get_validator();
    $request = Request::get_request();
    $auth = Auth::get_auth();
    $customers = Customers::get_customers();

    $customer = $auth->get_customer();

    if(!$customer)
    {
      $r->set_template($this->get_template('index'));
      return $r;
    }

    $r->set('customer', $customer);

    if($request->get_post('change'))
    {
      $values['email'] = $validator->safe($request->get_post('email'));
      $values['name'] = $validator->safe($request->get_post('name'));
      $values['phone'] = $validator->safe($request->get_post('phone'));
      $values['address'] = $validator->safe($request->get_post('address'));
      $values['notes'] = $validator->safe($request->get_post('notes'));

      if(!$validator->is_email($values['email'])) $errors['email'] = true;
      if(!$validator->is_text($values['name'])) $errors['name'] = true;
      if(!$validator->is_phone($values['phone'])) $errors['phone'] = true;
      if(!$validator->is_text($values['address'])) $errors['address'] = true;
      if(!$validator->is_text($values['notes'])) $errors['notes'] = true;

      if(!$errors)
      {
        if($customers->get_customer_by_email($values['email'])->get('id') != $customer->get('id'))
        {
          $r->set('email_exists', true);
          $r->set_template($this->get_template('change_account'));
          return $r;
        }
        $customer->set($values);
        $customer->save();
        $r->set_template($this->get_template('account'));
        return $r;
      }
      $r->set('errors', $errors);
    }

    if($request->get_post('change_password'))
    {
      $values['password'] = $validator->safe($request->get_post('password'));
      if(!$validator->is_password($values['password'])) $errors['password'] = true;

      if(!$errors)
      {
        $customers = Customers::get_customers();
        $values['password'] = $customers->form_password($values['password'], $customer->get('reg_date'));
        $customer->set($values);
        $customer->save();
        $r->set_template($this->get_template('account'));
        return $r;
      }
      $r->set('errors', $errors);
    }
    
    $r->set_template($this->get_template('change_account'));
    return $r;
  }
}
?>
