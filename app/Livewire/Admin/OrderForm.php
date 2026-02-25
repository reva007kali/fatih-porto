<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class OrderForm extends Component
{
    // Form Fields - Disesuaikan dengan input fleksibel
    public $name, $email, $whatsapp, $website_description;
    public $estimated_price = 0; // Input harga manual

    public function submit()
    {
        // Validasi data
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'whatsapp' => 'required|numeric',
            'website_description' => 'required|string|min:10',
            'estimated_price' => 'required|numeric|min:1000',
        ]);

        // Simpan ke Database
        $order = Order::create([
            // Generate Invoice dengan prefix REVA
            'invoice_number' => 'REVA-' . strtoupper(Str::random(6)), 
            'name' => $this->name,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'website_type' => 'Custom Request', // Menjadi fleksibel
            'description' => $this->website_description,
            // Fitur default yang include (sesuai permintaan di form)
            'features' => json_encode([
                'Domain .com', 
                'Hosting Unlimited', 
                'SSL Security', 
                'Responsive Design', 
                'WA Integration', 
                '3x Revision'
            ]),
            // Mengambil harga murni dari inputan user di form
            'total_price' => $this->estimated_price, 
        ]);

        // Redirect ke halaman invoice yang sudah kita buat
        return redirect()->route('invoice', ['order' => $order->id]);
    }

    public function render()
    {
        // Pastikan nama file view sesuai dengan lokasi file blade Anda
        return view('livewire.admin.order-form');
    }
}