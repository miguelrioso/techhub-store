<?php
session_start();
session_destroy();

header("Location: /techhub/public/login.php");
exit;