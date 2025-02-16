<?php

namespace App\Livewire;

use App\Models\ContactInformation;
use Livewire\Component;

class ContactUs extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';


    protected function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'email' => 'required|email',
            'message' => 'required',

        ];
    }

    public function save()
    {
        $this->validate();
        ContactInformation::create(
            $this->only(['name', 'email', 'message'])
        );
        session()->flash('success', 'Submitted');
        $this->reset();
        // return $this->redirect(route('contact_us_page'));
    }
    public function render()
    {
        return view('livewire.contact-us');
    }
}
