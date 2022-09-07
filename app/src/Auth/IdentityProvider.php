<?php

namespace Auth;

class IdentityProvider
{
  private $users = [
    "admin" => ["password" => "admin", "roles" => ["admin", "user"]],
    "user" => ["password" => "user", "roles" => ["user"]],
  ];

  public function validateIdentity(string $username, string $password): IdentityResponse
  {
    if (array_key_exists($username, $this->users)) {
      $user = $this->users[$username];
      if ($user["password"] == $password) {
        return new IdentityResponse($username, $user["roles"]);
      }
    }
    return new IdentityResponse(null);
  }
}
