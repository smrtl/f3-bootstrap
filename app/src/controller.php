<?php

class Controller
{
  public function beforeroute(Base $f3)
  {
    if ($f3->get("SESSION.expire") && $f3->get("SESSION.expire") < time()) {
      $f3->clear("SESSION");
    }

    $f3->copy("JAR.expire", "SESSION.expire");
    $f3->set("COOKIE." . session_name(), session_id());
  }

  public function render($name): void
  {
    Base::instance()->set("page", $name . ".html");
    echo Template::instance()->render("_layout.html");
  }
}
