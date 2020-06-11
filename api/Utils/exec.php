<?php

$f= str_replace("\\","/", getcwd());
exec('php '. $f.'/calculateAllScores.php');
