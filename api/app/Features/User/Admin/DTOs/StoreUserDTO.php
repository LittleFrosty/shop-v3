<?php

namespace App\Features\User\Admin\DTOs;

readonly class StoreUserDTO{
  public function __construct(
    public string $name,
    public string $email,
    public ?string $company,
    public ?string $phone,
    public string $password,
    public string $country,
    public string $city,
    public string $address,
    public int $status,
    public bool $wholesale,
    public int $wholesaleProfile,
    public string $totalSum,
    public ?string $emailVerifiedAt,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      name: $data['name'],
      email: $data['email'],
      company: $data['company'] ?? null,
      phone: $data['phone'] ?? null,
      password: $data['password'],
      country: $data['country'],
      city: $data['city'],
      address: $data['address'],
      status: (int) $data['status'],
      wholesale: (bool) $data['wholesale'],
      wholesaleProfile: (int) $data['wholesale_profile'],
      totalSum: (string) $data['total_sum'],
      emailVerifiedAt: $data['email_verified_at'] ?? null,
    );
  }

  public function toArray(): array{
    return [
      'name' => $this->name,
      'email' => $this->email,
      'company' => $this->company,
      'phone' => $this->phone,
      'password' => $this->password,
      'country' => $this->country,
      'city' => $this->city,
      'address' => $this->address,
      'status' => $this->status,
      'wholesale' => $this->wholesale,
      'wholesale_profile' => $this->wholesaleProfile,
      'total_sum' => $this->totalSum,
      'email_verified_at' => $this->emailVerifiedAt,
    ];
  }
}
