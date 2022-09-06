<?php

class Root extends Controller
{
  public function home()
  {
    $this->render("home");
  }

  public function page(Base $f3, $args)
  {
    $path = $args["*"];
    if ($path === "error") {
      throw new Exception("Boom!");
    }
    echo "Path: " . $path;
  }

  public function login()
  {
    $this->render("login");
  }

  public function auth(Base $f3)
  {
    if (!$f3->get("POST.username") || $f3->get("POST.username") != $f3->get("POST.password")) {
      $f3->set("message", "Invalid user ID or password");
      $this->login($f3);
    } else {
      $f3->copy("POST.username", "SESSION.username");
      $f3->reroute(["home"]);
    }
  }

  public function logout(Base $f3)
  {
    $f3->clear("SESSION");
    $f3->reroute(["home"]);
  }

  public function error(Base $f3)
  {
    $log = new Log("error.log");
    $log->write("Error: " . $f3->get("ERROR.text"));
    $log->write(print_r($f3->get("ERROR.trace"), true));

    echo "The error '" . $f3->get("ERROR.text") . "' has been logged.";
  }
}
