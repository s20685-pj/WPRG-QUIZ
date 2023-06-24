<?php
// Usunięcie cookie o nazwie 'user'
setcookie('user', '', time() - 3600, '/');

// Przekierowanie na stronę index.php
header('Location: index.php');
exit;
?>