<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;


class InvoiceController extends Controller
{
    public function show(Order $order) {
        return view('invoice', compact('order'));
    }
}
