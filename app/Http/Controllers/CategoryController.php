<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use Validator;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    private $bread;

    /**
     * Data For Breadcrumbs
     */
    public function __construct()
    {
        $this->bread = [
            '0' => route('home'),
            'page-title' => 'Category',
            'menu' => 'Dashboard',
            'submenu' => 'Product',
            'active' => 'Category'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder){
        $bread = $this->bread;

        if ($request->ajax()) {
            $categories = Category::all();

            return Datatables::of($categories)
                ->addColumn('action', function($data){
                    return view('layouts.partials.datatable._action', [
                        'model' => $data,
                        'form_url' => route('category.destroy', $data['id']),
                        'edit_url' => route('category.edit', $data['id']),
                        'show_url' => route('category.show', $data['id'])
                    ]);
                })->make(true);
        }



        $html = $htmlBuilder
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID'])
            ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Category'])
            ->addColumn(['data' => 'slug', 'name' => 'slug', 'title' => 'Slug'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => 'false']);

        return view('pages.category.index', compact('bread', 'html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bread = $this->bread;
        $bread[0] = route('category.index');
        return view('pages.category.create', compact('bread'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:categories',
            'slug' => 'unique:categories'
        ]);

        Category::create($request->all());

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Category successfully added',
        ]);

        return redirect()->route('category.index');
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
    public function edit($id)
    {
        $bread = $this->bread;
        $bread[0] = route('category.index');

        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category', 'bread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'title' => 'required|unique:categories,title,' . $id,
          'slug' => 'required|unique:categories,slug,'. $id
      ]);

      $category = Category::findOrFail($id);
      $category->update($request->all());

      notify()->flash('Done!', 'success', [
          'timer' => 1500,
          'text' => 'Category successfully Edited',
      ]);

      return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(!Category::destroy($id)) return redirect()->back();

       notify()->flash('Done!', 'success', [
           'timer' => 1500,
           'text' => 'Category successfully Deleted',
       ]);

       return redirect()->route('category.index');
    }
}
