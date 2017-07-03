<?php

define('HOME_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('ASSETS_DIR', __DIR__ . '/assets/');
define('API_FACEBOOK_URL', 'https://graph.facebook.com/');
define('API_FACEBOOK_VERSION', 'v2.8');