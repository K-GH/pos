<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search,function($q) use($request){

            return $q->whereTranslationLike('name','%'.$request->search.'%');

        })->latest()->paginate(5);
        return view('dashboard.categories.index',compact('categories'));
      //  return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[];
        foreach (config('translatable.locales') as $locale) {
          
            //name ar or en are required and unique
            $rules +=[$locale.'.name' => ['required',Rule::unique('category_translations','name')]];
        }
        $request->validate($rules);

       /* $request->validate([
            'ar.name'=>'required|unique:category_translations,name',
        ]);*/

        Category::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        $rules=[];
        foreach (config('translatable.locales') as $locale) {
          
            //name ar or en are required and unique and skip this id that selected
            $rules +=[$locale.'.name' => ['required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')]];
        }
        $request->validate($rules);
      
       /* $request->validate([
            'ar.name'=>'required|unique:category_translations,name,'.$category->id,
        ]);*/

        $category->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');

    }
}
