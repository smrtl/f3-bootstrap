<?php

namespace Controllers;

class Controller
{
  protected string $requiredRole = "";

  public function beforeroute(\Base $f3)
  {
    if ($f3->get("SESSION.expire") && $f3->get("SESSION.expire") < time()) {
      $f3->clear("SESSION");
    }

    $f3->copy("JAR.expire", "SESSION.expire");
    $f3->set("COOKIE." . session_name(), session_id());

    if ($this->requiredRole != "") {
      $roles = $f3->get("SESSION.roles");

      if (!is_array($roles) || !in_array($this->requiredRole, $roles)) {
        $f3->reroute(["login"]);
      }
    }
  }

  public function render($name): void
  {
    \Base::instance()->set("page", $name . ".html");
    echo \Template::instance()->render("_layout.html");
  }
}
