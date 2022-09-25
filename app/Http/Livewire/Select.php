<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Category;

class Select extends Component
{
    public $category;
    public $message;
    public $categories = [];
    public $barangs = [];
    public $barang;
    public function render()
    {
        // dd($this->category);
        // if(!empty($this->category)){
        //     $this->barangs = Barang::where('category_id', 16)->get();
        // }
        $this->categories = Category::all();
        return view('livewire.select');
    }
}
