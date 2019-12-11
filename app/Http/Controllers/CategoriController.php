<?php

namespace App\Http\Controllers;
use App\Categary;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateRequest;


class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index')->with('categories', Categary::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {


        Categary::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Category create successfuly'); // successefuly alert

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categary $category)   //here categoy is the selected category and here instanse name should be the route name in the web.api or route list
    {
        // $categories = Categary::find($categoriesId);
        return view('category.create')->with('categories', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,Categary $category )
    {
        // $category->name = $request->name;
        // $category->save();

        $category->update([      // we can update using this way
        'name' => $request->name
        ]);

        session()->flash('success','Category update successfuly');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categary $category)
    {
        $category->delete();

        session()->flash('success','Category Delete Successfully');

       return redirect(route('categories.index'));
    }
}
