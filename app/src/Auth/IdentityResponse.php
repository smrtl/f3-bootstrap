<?php

namespace Auth;

class IdentityResponse
{
  private ?string $username;
  private array $roles;
  private array $metadata;

  public function __construct(?string $username, array $roles = [], array $metadata = [])
  {
    $this->username = $username;
    $this->roles = $roles;
    $this->metadata = $metadata;
  }

  public function isValid(): bool
  {
    return $this->username !== null;
  }

  public function getUsername(): string
  {
    return $this->username;
  }

  public function getRoles(): array
  {
    return $this->roles;
  }

  public function getMetadata(): array
  {
    return $this->metadata;
  }
}
