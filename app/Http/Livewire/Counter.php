<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $like = 1;

    public $messages  = '';

    public $isShow = true;

    protected $rules = [
        'messsages' =>  'min:10'
    ];

    public function render()
    {
        return view('components.guest.counter');
    }

    public function increment()
    {
        $this->like++;
    }

    public function decrement()
    {
        $this->like--;

        if ($this->like == 0) {
            $this->isShow = false;
        }
    }
}
