<?php
namespace App\Http\Controllers;

use App\Models\{TourPackage, Category, Destination};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $featured = TourPackage::with('images','destination')->where('is_active',1)->latest()->take(6)->get();
        $categories = Category::orderBy('name')->get();
        $destinations = Destination::orderBy('name')->get();
        return view('home', compact('featured','categories','destinations'));
    }
}