<?php

class Admin extends Controller
{
  public function beforeroute(Base $f3)
  {
    parent::beforeroute($f3);

    if (!$f3->get("SESSION.username")) {
      return $f3->reroute(["login"]);
    }
  }

  public function home()
  {
    echo "This is the admin page!";
  }
}
