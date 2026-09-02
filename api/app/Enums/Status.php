<?php

namespace App\Enums;

enum Status: int{
  case Disabled = 0;
  case Enabled = 1;
  case Draft = 2;
  case Archived = 3;
}
