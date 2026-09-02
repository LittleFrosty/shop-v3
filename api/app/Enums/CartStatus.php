<?php

namespace App\Enums;

enum CartStatus: string{
  case PENDING = "pending";
  case SHIPPED = "shipped";
  case COMPLETE = "complete";
  case CANCELLED = "cancelled";
  case PENDING_DELIVERY = "pending-delivery";
}
