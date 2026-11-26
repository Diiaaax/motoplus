<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Models\DeliveryPrice;
use App\Models\Order;
use App\Models\Client;
use App\Services\DeliveryService;

class OrderForm extends Component
{
    public $product;

    public $name;
    public $phone;
    public $confirmPhone;
    public $wilaya_code;
    public $commune_id;
    public $delivery_method = 'Door';

    public $communes = [];
    public $deliveryPrice = 0;

    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required|digits:10',
        'confirmPhone' => 'required|same:phone',
        'wilaya_code' => 'required',
        'commune_id' => 'required',
        'delivery_method' => 'required|in:Door,StopDesk',
    ];

    public function mount($product)
    {
        $this->product = $product;
        $this->updateDeliveryPrice();
    }

    public function updateWilayaCodeHandler()
    {
        $this->wilaya_code = (int)$this->wilaya_code;
        $this->commune_id = null;
        $this->communes = Commune::where('wilaya_code', $this->wilaya_code)->get()->toArray();
        $this->updateDeliveryPrice();
    }

    public function updatedDeliveryMethod()
    {
        $this->updateDeliveryPrice();
    }

    public function updateDeliveryPrice()
    {
        $delivery = DeliveryPrice::where('wilaya_code', (int)$this->wilaya_code)->first();
        $this->deliveryPrice = $delivery
            ? ($this->delivery_method === 'Door' ? $delivery->door : $delivery->stopdesk)
            : 0;
    }

    public function getTotalPriceProperty()
    {
        return $this->product->price + $this->deliveryPrice;
    }

    public function submitOrder()
    {
        $this->validate();

        $client = Client::where('phone', $this->phone)->first();

        if ($client) {
            $client->update([
                'name' => $this->name,
                'ip_address' => request()->ip(),
            ]);
            $client->increment('total_orders', 1);
            $client->increment('amount_spent', $this->totalPrice);
        } else {
            $client = Client::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'total_orders' => 1,
                'amount_spent' => $this->totalPrice,
                'ip_address' => request()->ip(),
            ]);
        }

        Order::create([
            'client_id' => $client->id,
            'product_id' => $this->product->id,
            'commune_id' => $this->commune_id,
            'delivery_method' => $this->delivery_method,
            'total_price' => $this->totalPrice,
            'ip_address' => request()->ip(),
        ]);

        session()->flash('message', 'Your order has been placed successfully!');

        $this->reset(['name', 'phone', 'confirmPhone', 'wilaya_code', 'commune_id', 'delivery_method']);
        $this->communes = [];
    }

    public function render()
    {
        return view('livewire.order-form', [
            'wilayas' => Wilaya::all(),
            'deliveryPrice' => $this->deliveryPrice,
            'totalPrice' => $this->totalPrice,
        ]);
    }
}
