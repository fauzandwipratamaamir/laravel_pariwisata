<?php
namespace App\Http\Controllers;

use App\Models\{TourPackage, Category, Destination};
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $r){
        $q = TourPackage::with('images','destination','category')->where('is_active',1)
            ->when($r->keyword, fn($x)=>$x->where('title','like','%'.$r->keyword.'%'))
            ->when($r->category, fn($x)=>$x->where('category_id',$r->category))
            ->when($r->destination, fn($x)=>$x->where('destination_id',$r->destination))
            ->when($r->min_price, fn($x)=>$x->where('base_price','>=',$r->min_price))
            ->when($r->max_price, fn($x)=>$x->where('base_price','<=',$r->max_price))
            ->orderByDesc('id');
        $packages = $q->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $destinations = Destination::orderBy('name')->get();
        return view('packages.index', compact('packages','categories','destinations'));
    }

    public function show(TourPackage $package){
        $package->load(['images','itinerary','schedules','destination','category']);
        return view('packages.show', compact('package'));
    }
}