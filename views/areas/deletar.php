<?php

use DAO\Area;

Area::getInstance()->deleteById(isset($_GET['area']) ? $_GET['area'] : null);
require_once('views/inicio.php');