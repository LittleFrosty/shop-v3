<?php

namespace App\Features\Cart\Admin\Actions;

use App\Features\Cart\Admin\DTOs\DeleteCartDTO;
use App\Features\Cart\Admin\Queries\DeleteCartQuery;
use Illuminate\Support\Facades\DB;

class DeleteCartAction{
  public function __construct(private DeleteCartQuery $query){}

  public function handle(DeleteCartDTO $dto): void{
    DB::transaction(function () use ($dto): void{
      $cart = $this->query->handle($dto);
      $cart->products()->delete();
      $cart->delete();
    });
  }
}
