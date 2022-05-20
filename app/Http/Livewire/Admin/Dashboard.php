<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $h1 = "Dashboard";
        $small = "Control panel";

        $products = Product::count();
        $users = User::count();

        return view('livewire.admin.dashboard', compact('h1', 'small', 'users', 'products'));
        // return view('livewire.admin.dashboard');
    }
}
