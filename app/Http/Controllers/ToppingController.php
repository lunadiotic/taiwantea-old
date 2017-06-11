<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use Illuminate\Support\Collection;

class ToppingController extends Controller
{
  private $bread;

  /**
   * Data For Breadcrumbs
   */
   public function __construct()
   {
       $this->bread = [
           '0' => route('home'),
           'page-title' => 'Topping',
           'menu' => 'Dashboard',
           'submenu' => 'Product',
           'active' => 'Topping'
       ];
   }

  public function index(Request $request, Builder $htmlBuilder){
      $bread = $this->bread;
      $topping = new Collection;

      if ($request->ajax()) {
          $toppings = Topping::all();
          foreach ($toppings as $row) {
              $topping->push([
                  'id' => $row->id,
                  'name' => $row->name,
                  'price' => 'Rp '.number_format($row->price),
                  'image' => "<a href='" .$row->image. "' data-lightbox='image-1' data-title='" .$row->image. "' >
                                  <img height='50' width='50' src='" .$row->image. "' alt='placeholder+image'>
                              </a>",
              ]);
          }

          return Datatables::of($topping)
                  ->addColumn('action', function($data){
                      return view('layouts.partials.datatable._action', [
                                  'model' => $data,
                                  'form_url' => route('topping.destroy', $data['id']),
                                  'edit_url' => route('topping.edit', $data['id']),
                                  'show_url' => route('topping.show', $data['id'])
                              ]);
                  })->make(true);
      }



      $html = $htmlBuilder
              ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID'])
              ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Menu'])
              ->addColumn(['data' => 'price', 'name' => 'price', 'title' => 'Price'])
              ->addColumn(['data' => 'image', 'name' => 'image', 'title' => 'Image'])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => 'false']);

      return view('pages.topping.index', compact('bread', 'html'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $bread = $this->bread;
    $bread[0] = route('topping.index');
    return view('pages.topping.create', compact('bread'));
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
        'price' => 'required|numeric',
        'image' => 'required'
      ]);

      Topping::create($request->all());

      notify()->flash('Done!', 'success', [
          'timer' => 1500,
          'text' => 'Topping successfully added',
      ]);

      return redirect()->route('topping.index');


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
    $bread[0] = route('topping.index');

    $topping = Topping::findOrFail($id);

    return view('pages.topping.edit', compact('bread', 'topping'));
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
      'price' => 'required|numeric',
      'image' => 'required'
    ]);

    $topping = Topping::findOrFail($id);
    $topping->update($request->all());

    notify()->flash('Done!', 'success', [
        'timer' => 1500,
        'text' => 'Item successfully edited',
    ]);

    return redirect()->route('topping.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      if(!Topping::destroy($id)) return redirect()->back();

      notify()->flash('Done!', 'success', [
          'timer' => 1500,
          'text' => 'Topping successfully deleted',
      ]);

      return redirect()->route('topping.index');
  }
}
