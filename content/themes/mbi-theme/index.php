<?php

// load all data here and put into $data global container

// $data->add('solutions', $knapp->get_solutions());

// // load parts afterwards (header also uses $data etc.)

include(locate_template('header.php'));

// include(locate_template('parts/menu.part.php')); // you don't have to use global $var; inside to get global variables :)

include(locate_template('footer.php'));