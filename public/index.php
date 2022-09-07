<?php

use Auth\IdentityProvider;
use DB\Jig;
use DB\Jig\Session;

require __DIR__ . "/../vendor/autoload.php";

$f3 = Base::instance();

// Config
$f3->config(__DIR__ . "/../app/config.ini", true);

// Routes
$f3->config(__DIR__ . "/../app/routes.ini");

// Session settings
$session = $f3->get("session");
ini_set("session.name", $session["name"]);
ini_set("session.use_strict_mode", true);
ini_set("session.use_cookies", true);
ini_set("session.use_only_cookies", true);
ini_set("session.sid_length", $session["sid_length"]);
ini_set("session.sid_bits_per_character", 6);

ini_set("session.gc_probability", $session["gc_probability"]);
ini_set("session.gc_divisor", 100);
ini_set("session.gc_maxlifetime", 10);
new Session(new Jig($session["storage"]), "sessions", null, "CSRF");

// Services
$f3->set("idp", new IdentityProvider());

// Other PHP settings
if (!$f3->PACKAGE) {
  header_remove("X-Powered-By");
}

$f3->run();
