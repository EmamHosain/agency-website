<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class FaqPage extends Component
{
    public function render()
    {
        $faqs = Faq::where('status', 1)
            ->orderBy('order', 'ASC')
            ->get();
        return view('livewire.faq-page',[
            'faqs'=> $faqs
        ]);
    }
}
