<?php
$user = false;
// Check if the username / link are correct
if (!empty($_REQUEST['p']))
{
    $q = Doctrine_Query::create()->from('UserPasswords up')->where("DECODE(pass, '".ENCRYPT_PASS."') = ?", $_REQUEST['p']);
    $userPassword = $q->fetchOne();

    if ($userPassword)
    {
        // Register session
        $_SESSION['userId'] = $userPassword->user_id;
        $user = UsersTable::getInstance()->find($userPassword->user_id);
        
        // Does user exist
        if ($user)
        {
            // Get user address for displaying name
            $userAddress = UserAddressTable::getAddress($user->id, 'invoice');
            
            $_SESSION['user'] = $user->username;
            $_SESSION['name'] = ($userAddress ? $userAddress->name : $user->username);
            $_SESSION['allowOrder'] = ($user->order_access == 1);
            $_SESSION['stopCredit'] = ($user->stop_credit == 1);
            $_SESSION['price_code'] = $user->price_code;


            // Remove any shopping cart info that could be from a previous browser session
            // Include shopping cart 
            require_once(_DIR_CLASSES.'ShoppingCart.class.php');

            unset($_SESSION['shopping_cart']);
            $cart = new ShoppingCart();
            $cart->reset();

            // Create user session
            $session = new UserSessions();
            $session->user_id = $user->id;
            $session->session = session_id();
            $session->last_active = new Doctrine_Expression('NOW()');
            $session->save();

            // Remove password
            $userPassword->delete();


            // Add stats
            $user->total_logins = $user->total_logins + 1;
            $user->last_login = new Doctrine_Expression('NOW()');
            $user->save();
            
            $userLogin = new UserLogins();
            $userLogin->user_id = $user->id;
            $userLogin->ip = $_SERVER['REMOTE_ADDR'];
            $userLogin->login_time = new Doctrine_Expression('NOW()');
            $userLogin->save();
            
            $_SESSION['user_logins_id'] = $userLogin->id;
        }
    }
}


?>