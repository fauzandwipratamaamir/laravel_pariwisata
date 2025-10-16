<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Category; use Illuminate\Http\Request; use Illuminate\Support\Str;
class CategoryController extends Controller{
  public function __construct(){ $this->middleware(['auth','can:admin']); }
  public function index(){ $items=Category::latest()->paginate(15); return view('admin.categories.index',compact('items')); }
  public function create(){ return view('admin.categories.create'); }
  public function store(Request $r){ $d=$r->validate(['name'=>'required']); Category::create(['name'=>$d['name'],'slug'=>Str::slug($d['name'])]); return back()->with('success','Kategori ditambahkan'); }
  public function edit(Category $category){ return view('admin.categories.edit',compact('category')); }
  public function update(Request $r, Category $category){ $d=$r->validate(['name'=>'required']); $category->update(['name'=>$d['name'],'slug'=>Str::slug($d['name'])]); return back()->with('success','Kategori diperbarui'); }
  public function destroy(Category $category){ $category->delete(); return back()->with('success','Kategori dihapus'); }
}