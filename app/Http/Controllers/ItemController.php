<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    private $bread;

    /**
     * Data For Breadcrumbs
     */
     public function __construct()
     {
         $this->bread = [
             '0' => route('home'),
             'page-title' => 'Item',
             'menu' => 'Dashboard',
             'submenu' => 'Product',
             'active' => 'Item'
         ];
     }

    public function index(Request $request, Builder $htmlBuilder){
        $bread = $this->bread;
        $item = new Collection;

        if ($request->ajax()) {
            $items = Item::all();
            foreach ($items as $row) {
                $item->push([
                    'id' => $row->id,
                    'name' => $row->name,
                    'category' => $row->category->title,
                    'price' => 'Rp '.number_format($row->price),
                    'image' => "<a href='" .$row->image. "' data-lightbox='image-1' data-title='" .$row->image. "' >
                                    <img height='50' width='50' src='" .$row->image. "' alt='placeholder+image'>
                                </a>",
                ]);
            }

            return Datatables::of($item)
                    ->addColumn('action', function($data){
                        return view('layouts.partials.datatable._action', [
                                    'model' => $data,
                                    'form_url' => route('item.destroy', $data['id']),
                                    'edit_url' => route('item.edit', $data['id']),
                                    'show_url' => route('item.show', $data['id'])
                                ]);
                    })->make(true);
        }



        $html = $htmlBuilder
                ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID'])
                ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Menu'])
                ->addColumn(['data' => 'category', 'name' => 'category', 'title' => 'Category'])
                ->addColumn(['data' => 'price', 'name' => 'price', 'title' => 'Price'])
                ->addColumn(['data' => 'image', 'name' => 'image', 'title' => 'Image'])
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => 'false']);

        return view('pages.item.index', compact('bread', 'html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $bread = $this->bread;
      $bread[0] = route('item.index');
      $select_category = Category::pluck('title', 'id');
      return view('pages.item.create', compact('bread', 'select_category'));
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
          'name' => 'required|unique:items',
          'slug' => 'required|unique:items',
          'category_id' => 'required|string',
          'price' => 'required|numeric',
          'image' => 'required'
        ]);

        Item::create($request->all());

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Item successfully added',
        ]);

        return redirect()->route('item.index');


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
      $bread[0] = route('item.index');
      $select_category = Category::pluck('title', 'id');
      $item = Item::findOrFail($id);

      return view('pages.item.edit', compact('bread', 'select_category', 'item'));
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
        'name' => 'required|unique:items',
        'slug' => 'required|unique:items',
        'category_id' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required'
      ]);

      $item = Item::findOrFail($id);
      $item->update($request->all());

      notify()->flash('Done!', 'success', [
          'timer' => 1500,
          'text' => 'Item successfully edited',
      ]);

      return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Item::destroy($id)) return redirect()->back();

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Item successfully deleted',
        ]);

        return redirect()->route('item.index');
    }
}
