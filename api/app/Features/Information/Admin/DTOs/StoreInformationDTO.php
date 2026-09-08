<?php

namespace App\Features\Information\Admin\DTOs;

readonly class StoreInformationDTO{
  public function __construct(
    public string $title,
    public ?string $thumbnail,
    public string $description,
    public int $status,
    public int $agreementsAtOrder,
    public int $agreementAtContacts,
    public int $showInFooter,
    public int $sortOrder,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      title: $data['title'],
      thumbnail: $data['thumbnail'] ?? null,
      description: $data['description'],
      status: (int) $data['status'],
      agreementsAtOrder: (int) $data['agreements_at_order'],
      agreementAtContacts: (int) $data['agreement_at_contacts'],
      showInFooter: (int) $data['show_in_footer'],
      sortOrder: (int) $data['sort_order'],
    );
  }

  public function toArray(): array{
    return [
      'title' => $this->title,
      'thumbnail' => $this->thumbnail,
      'description' => $this->description,
      'status' => $this->status,
      'agreements_at_order' => $this->agreementsAtOrder,
      'agreement_at_contacts' => $this->agreementAtContacts,
      'show_in_footer' => $this->showInFooter,
      'sort_order' => $this->sortOrder,
    ];
  }
}
