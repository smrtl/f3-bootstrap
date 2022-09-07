<?php

namespace Controllers;

class Content extends Controller
{
  protected string $requiredRole = "user";

  public function home(\Base $f3, array $args)
  {
    $path = $args["*"];
    if ($path === "error") {
      throw new \Exception("Boom!");
    }
    echo "Path: " . $path;
  }
}
