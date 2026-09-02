<?php

namespace App\Enums;

enum Status: string{
  case DISABLED = "disabled";
  case ENABLED = "enabled";
  case DRAFT = "draft";
  case ARCHIVED = "archived";
}
