<?php

namespace Controllers;

class Admin extends Controller
{
  protected string $requiredRole = "admin";

  public function home($f3)
  {
    echo "This is the admin page!";
  }
}
