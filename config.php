<?php

/*
 * Using define we create constants, which we will use in the whole project, specifically
 * when creating the database connection. We do not make changes so often, that is why we keep
 * the database information in config.php. Benefits of doing this is that when we want to make a change,
 * we do it here. For example, the DB_USER could be with a different value -> root2
 */
define('DB_PASS','');
define('DB_USER','root');
define('DB_HOST','127.0.0.1');
define('DB_NAME','AssignmentManager');
