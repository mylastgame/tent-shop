<?php
class Account
{
  private static $instance;
  private $customer;
  private $errors;

  public static function getInstance()
  {
    if(!isset(self::$instance)) self::$instance = new Account();
    return self::$instance;
  }

  private function  __construct()
  {
    $this->customer = false;
    $this->loadCustomer();
  }

  private function loadCustomer()
  {
    $request = Request::getInstance();
    $id = $request->getCookie('user_id');

    if(!$id) return false;
    $validator = Validator::getInstance();
    if(!$validator->isId($id)) return false;

    $customers = new Customers();
    $customer = $customers->findElementBy(array('id'=>$id, 'hash'=>$this->getHash()));
    if(!$customer) return false;
    
    $this->customer = $customer;
  }

  private function getHash()
  {
    $request = Request::getInstance();
    return md5($request->getServer('HTTP_USER_AGENT').$request->getServer('REMOTE_ADDR'));
  }

  public function getErrors()
  {
    if($this->errors) return $this->errors;
    return false;
  }

  public function getCustomer()
  {
    if($this->customer) return $this->customer;
    return false;
  }

  public function checkLogin($email, $password)
  {
    $request = Request::getInstance();
    $validator = Validator::getInstance();

    $this->checkValues(array('email'=>$email, 'password'=>$password));
    if($this->errors) return false;
    
    $customers = new Customers();
    $customer = $customers->findElementBy(array('email'=>$validator->safe($email)));
    if(!$customer)
    {
      $this->errors['unknownEmail'] = true;
      return false;
    }
    
    if($this->genPassword($password, $customer->get('reg_date')) != $customer->get('password'))
    {
      $this->errors['badPassword'] = true;
      return false;
    }

    $this->customer = $customer;
    $this->saveCookie();
  }

  public function genPassword($password, $date)
  {
    return md5(md5($password).md5($date));
  }

  public function saveCookie()
  {
    $value['hash'] = $this->getHash();
    if($value['hash'] != $this->customer->get('hash'))
    {
      $this->customer->set($value);
      $this->customer->save();
    }    
    setcookie('user_id', $this->customer->get('id'), time() + 3600, "/", SITE_NAME);
  }

  public function logout()
  {
    $this->customer = false;
    setcookie('user_id', '', time(), "/", SITE_NAME);
  }

  public function change()
  {
    $request = Request::getInstance();
    if($request->getPost('change')) $this->changeAccount();
    if($request->getPost('change_password')) $this->changePassword();
  }

  private function changeAccount()
  {
    $request = Request::getInstance();
    $validator = Validator::getInstance();

    $this->checkValues($request->getPostAll());
    if($this->errors) return false;

    $customers = new Customers();
    $customer = $customers->findElementBy(array('email'=>$request->getPost('email')));
    if($customer->get('id') != $this->customer->get('id')) $this->errors['emailExists'] = true;
    if($this->errors) return false;

    $this->customer->set(array('email'=>$request->getPost('email'), 'name'=>$request->getPost('name'),
        'phone'=>$request->getPost('phone'), 'address'=>$request->getPost('address'), 'notes'=>$request->getPost('notes')));
    $this->customer->save();
  }

  public function changePassword()
  {
    $request = Request::getInstance();
    $validator = Validator::getInstance();

    $this->checkValues($request->getPostAll());
    if($this->errors) return false;

    $this->customer->set(array('password'=>$this->genPassword($password, $this->customer->get('reg_date'))));
    $this->customer->save();
  }

  public function newCustomer()
  {
    $request = Request::getInstance();
    $validator = Validator::getInstance();

    $this->checkValues($request->getPostAll());
    if($this->errors) return false;

    $customers = new Customers();
    $customer = $customers->findElementBy(array('email'=>$request->getPost('email')));
    if($customer) $this->errors['emailExists'] = true;
    if($this->errors) return false;


    $reg_date = time();
    $password = $this->genPassword($request->getPost('password'), $reg_date);

    $customer = new Customer(array('email'=>$request->getPost('email'), 'password'=>$request->getPost('password'), 'reg_date'=>$reg_date));
    $id = $customer->newElement();
    $customer->set(array('id'=>$id));
    $this->customer = $customer;
    $this->saveCookie();
  }

  public function checkValues($values)
  {
    foreach ($values as $key=>$value)
    {
      if($key == 'id') $this->checkId($value);
      if($key == 'email') $this->checkEmail($value);
      if($key == 'name') $this->checkName($value);
      if($key == 'phone') $this->checkPhone($value);
      if($key == 'password')$this->checkPassword($value);
      if($key == 'address') $this->checkAddress($value);
      if($key == 'notes') $this->checkNotes($value);
    }
  }

  public function checkId($value)
  {
    if(Validator::getInstance()->isId($value)) return true;
    $this->errors['id'] = true;
  }

  public function checkEmail($value)
  {
    if(Validator::getInstance()->isEmail($value)) return true;
    $this->errors['email'] = true;
  }

  public function checkPassword($value)
  {
    if(Validator::getInstance()->isPassword($value)) return true;
    $this->errors['password'] = true;
  }

  public function checkPhone($value)
  {
    if(Validator::getInstance()->isPhone($value)) return true;
    $this->errors['phone'] = true;
  }

  public function checkName($value)
  {
    if(Validator::getInstance()->isText($value)) return true;
    $this->errors['name'] = true;
  }

  public function checkAddress($value)
  {
    if(Validator::getInstance()->isText($value)) return true;
    $this->errors['address'] = true;
  }

  public function checkNotes($value)
  {
    if(Validator::getInstance()->isText($value)) return true;
    $this->errors['notes'] = true;
  }

  public function checkEmpty($values)
  {
    if(empty($values['email'])) $this->errors['emptyEmail'] = true;
    if(empty($values['name'])) $this->errors['emptyName'] = true;
    if(empty($values['phone'])) $this->errors['emptyPhone'] = true;
    if(empty($values['address'])) $this->errors['emptyAddress'] = true;
  }

  public function getCustomerOrders()
  {
    if(!$this->customer) return false;
    $orders = new Orders();
    $orders->load('with_spec_field', 'cus_id', $this->customer->get('id'));
    if($orders->get()) return $orders->get();
    return false;
  }

  public function getCustomerOrder($id)
  {
    $orders = $this->getCustomerOrders();
    if(!$orders) return false;
    
    foreach ($orders as $order)
    {
      if($order->get('id') == $id) return $order;
    }
    return false;
  }

}
?>
