<?php

Doctrine_Query::create()->delete('UserSessions')->where('user_id = ?', $_SESSION['userId'])->execute();

unset($_SESSION);
session_destroy();



header('Location: /');
exit;
?>
