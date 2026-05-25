<?php
$password = '123456';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash generado: " . $hash;
echo "<br><br>";
echo "Copia este hash y pégalo en el SQL de abajo:";
echo "<br><br>";
echo '<textarea rows="3" cols="80">';
echo "UPDATE usuarios SET password = '$hash' WHERE email = 'admin@correo.com';";
echo '</textarea>';
?>