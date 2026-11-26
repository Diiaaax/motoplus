<?php

namespace App\Livewire;

use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Livewire\Component;
use App\Models\Contact;

class ContactForm extends Component
{
    use WithRateLimiting;

    public $name;
    public $email;
    public $phone;
    public $message;
    public $status;
    public $success = null;

    protected function rules()
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => ['nullable', 'regex:/^[0-9]{10}$/'],
            'message' => 'required|string|min:5',
            'status'  => 'required|boolean',
        ];
    }

    protected function messages()
    {
        return [
            'phone.regex' => __('The phone number must contain exactly 10 digits.'),
        ];
    }

    public function submit()
    {
        try {
            $this->rateLimit(3, 60);

            $this->validate();

            Contact::create([
                'name'    => $this->name,
                'email'   => $this->email,
                'phone'   => $this->phone,
                'message' => $this->message,
                'status'  => $this->status,
            ]);

            $this->reset(['name', 'email', 'phone', 'message', 'status']);
            $this->success = __("Your feedback has been sent successfully!");
            $this->dispatch('resetSendButton');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('resetSendButton');
            throw $e;
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
