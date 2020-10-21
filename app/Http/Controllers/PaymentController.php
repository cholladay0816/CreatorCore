<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Commission $commission)
    {
        return $commission;
    }
}
