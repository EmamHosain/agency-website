<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServicePage extends Component
{
    public function render()
    {
        $services = Service::orderBy('id', 'DESC')
            ->where('status', 1)
            ->get();
        return view('livewire.service-page', [
            'services' => $services
        ]);
    }
}
