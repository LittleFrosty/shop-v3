<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\ListCartDTO;
use App\Features\Cart\Models\Cart;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class ListCartQuery{
  public function handle(ListCartDTO $dto): LengthAwarePaginator{
    return Cart::query()
      ->withCount('products')
      ->when($dto->status !== null, fn ($query) => $query->where('status', $dto->status->value))
      ->when($dto->email !== null, fn ($query) => $query->where('email', 'like', '%'.$dto->email.'%'))
      ->when($dto->name !== null, fn ($query) => $query->where('name', 'like', '%'.$dto->name.'%'))
      ->when($dto->createdFrom !== null, fn ($query) => $query->where(
        'created_at',
        '>=',
        Carbon::parse($dto->createdFrom)->startOfDay(),
      ))
      ->when($dto->createdTo !== null, fn ($query) => $query->where(
        'created_at',
        '<=',
        Carbon::parse($dto->createdTo)->endOfDay(),
      ))
      ->orderByDesc('created_at')
      ->orderByDesc('id')
      ->paginate(50);
  }
}
