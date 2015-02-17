<?php

require_once "../vendor/autoload.php";
require_once "../bootstrap/bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
