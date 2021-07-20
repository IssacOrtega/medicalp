<?php

session_start();

echo 'Bienvenido ' . $_SESSION['user'] . ' eres ' . $_SESSION['roll'] . $_SESSION['id_user'] .'<br>';
echo 'Pantalla de dashboard';