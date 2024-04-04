<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Reservation;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $categoryCount = Category::count();
        $itemCount = Item::count();
        $sliderCount = Slider::count();
        $reservations = Reservation::where('status', false)->get();
        $contactCount = Contact::count();
    
        return view('admin.dashboard', compact('categoryCount', 'itemCount', 'sliderCount', 'reservations', 'contactCount'));
    }
    
}
