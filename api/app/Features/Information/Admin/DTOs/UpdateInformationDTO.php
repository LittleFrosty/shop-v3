<?php

namespace App\Features\Information\Admin\DTOs;

readonly class UpdateInformationDTO{
  public function __construct(
    public int $id,
    public ?string $title = null,
    public ?string $thumbnail = null,
    public bool $thumbnailProvided = false,
    public ?string $description = null,
    public ?int $status = null,
    public ?int $agreementsAtOrder = null,
    public ?int $agreementAtContacts = null,
    public ?int $showInFooter = null,
    public ?int $sortOrder = null,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      id: (int) $data['id'],
      title: $data['title'] ?? null,
      thumbnail: $data['thumbnail'] ?? null,
      thumbnailProvided: array_key_exists('thumbnail', $data),
      description: $data['description'] ?? null,
      status: isset($data['status']) ? (int) $data['status'] : null,
      agreementsAtOrder: isset($data['agreements_at_order']) ? (int) $data['agreements_at_order'] : null,
      agreementAtContacts: isset($data['agreement_at_contacts']) ? (int) $data['agreement_at_contacts'] : null,
      showInFooter: isset($data['show_in_footer']) ? (int) $data['show_in_footer'] : null,
      sortOrder: isset($data['sort_order']) ? (int) $data['sort_order'] : null,
    );
  }

  public function changes(): array{
    $changes = array_filter([
      'title' => $this->title,
      'description' => $this->description,
      'status' => $this->status,
      'agreements_at_order' => $this->agreementsAtOrder,
      'agreement_at_contacts' => $this->agreementAtContacts,
      'show_in_footer' => $this->showInFooter,
      'sort_order' => $this->sortOrder,
    ], static fn (mixed $value): bool => $value !== null);

    if ($this->thumbnailProvided) {
      $changes['thumbnail'] = $this->thumbnail;
    }

    return $changes;
  }
}
