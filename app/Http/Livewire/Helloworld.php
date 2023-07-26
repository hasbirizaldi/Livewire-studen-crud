<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Helloworld extends Component
{
    public $name = 'Abimanyu';
    public function mount($name){
        $this->name = $name;
    }

    public function updated(){

        $this->name = 'Saya diupdate';

    }

    public function render()
    {
        return view('livewire.helloworld');
    }
}