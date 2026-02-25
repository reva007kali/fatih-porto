<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Livewire\Attributes\Layout;



#[Layout('layouts.app')]
class OrderList extends Component
{
    use WithPagination;

    public $search = '';

    // Reset halaman jika user mengetik di kolom pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteOrder($id)
    {
        Order::find($id)->delete();
        session()->flash('message', 'Pesanan berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.order-list', [
            'orders' => Order::where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('invoice_number', 'like', '%' . $this->search . '%')
                        ->latest()
                        ->paginate(10)
        ]);
    }
}
