<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;



#[Layout('layouts.app')]
class OrderForm extends Component
{
    // Form Fields
    public $name, $email, $whatsapp, $description;
    public $website_type = 'landing_page';
    public $selected_features = [];

    // Data Referensi
    public $packages = [
        'landing_page' => ['name' => 'Landing Page', 'price' => 1500000],
        'company_profile' => ['name' => 'Company Profile', 'price' => 3000000],
        'ecommerce' => ['name' => 'E-Commerce', 'price' => 5000000],
    ];

    public $features_list = [
        'seo' => ['name' => 'Optimasi SEO', 'price' => 500000],
        'logo' => ['name' => 'Desain Logo', 'price' => 300000],
        'copywriting' => ['name' => 'Copywriting Content', 'price' => 700000],
    ];

    public function getTotalPriceProperty()
    {
        $basePrice = $this->packages[$this->website_type]['price'] ?? 0;
        $extraPrice = 0;

        foreach ($this->selected_features as $feature) {
            $extraPrice += $this->features_list[$feature]['price'] ?? 0;
        }

        return $basePrice + $extraPrice;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'whatsapp' => 'required|numeric',
            'website_type' => 'required',
        ]);

        $order = Order::create([
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'name' => $this->name,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'website_type' => $this->packages[$this->website_type]['name'],
            'description' => $this->description,
            'features' => json_encode($this->selected_features),
            'total_price' => $this->total_price,
        ]);

        return redirect()->route('invoice', ['order' => $order->id]);

    }

    public function render()
    {
        return view('livewire.admin.order-form');
    }
}