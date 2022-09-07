<?php

namespace Controllers;

class Root extends Controller
{
  public function home()
  {
    $this->render("home");
  }

  public function login(\Base $f3)
  {
    $f3->COPY("CSRF", "SESSION.csrf");
    $this->render("login");
  }

  public function auth(\Base $f3)
  {
    if ($f3->get("POST.username") != "" && $f3->get("POST.csrf") === $f3->get("SESSION.csrf")) {
      $response = $f3
        ->get("idp")
        ->validateIdentity($f3->get("POST.username"), $f3->get("POST.password"));

      if ($response->isValid()) {
        $f3->clear("SESSION.csrf");
        $f3->set("SESSION.username", $response->getUsername());
        $f3->set("SESSION.roles", $response->getRoles());
        $f3->set("SESSION.metadata", $response->getMetadata());
        $f3->reroute(["home"]);
      }
    }

    $f3->set("message", "Invalid user ID or password");
    $this->login($f3);
  }

  public function logout(\Base $f3)
  {
    $f3->clear("SESSION");
    $f3->reroute(["home"]);
  }

  public function error(\Base $f3)
  {
    $this->render("error");
  }
}
