<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberPage extends Component
{
    public function render()
    {
        $members = Member::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('livewire.member-page', [
            'members' => $members
        ]);
    }
}
