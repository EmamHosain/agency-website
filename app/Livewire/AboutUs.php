<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        $members = Member::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('livewire.about-us', [
            'members' => $members,
        ]);
    }
}
