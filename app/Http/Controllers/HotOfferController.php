<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotOffer;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use Illuminate\Support\Collection;

class HotOfferController extends Controller
{
    private $bread;

    /**
     * Data For Breadcrumbs
     */
    public function __construct()
    {
        $this->bread = [
            '0' => route('home'),
            'page-title' => 'Hot Offer',
            'menu' => 'Admin',
            'submenu' => 'Dashboard',
            'active' => 'Hot Offer'
        ];
    }
    public function index(Request $request, Builder $htmlBuilder){
        $bread = $this->bread;
        $hotoffer = new Collection;

        if ($request->ajax()) {
            $hot_offers = HotOffer::all();
            foreach ($hot_offers as $row) {
                $hotoffer->push([
                    'id' => $row->id,
                    'image' => "<a href='" .$row->image. "' data-lightbox='image-1' data-title='" .$row->image. "' >
                                    <img height='50' width='50' src='" .$row->image. "' alt='placeholder+image'>
                                </a>",
                    'status' => $row->status == 1 ? 'Show' : 'Hide',
                ]);
            }

            return Datatables::of($hotoffer)
                    ->addColumn('action', function($data){
                        return view('layouts.partials.datatable._action', [
                                    'model' => $data,
                                    'form_url' => route('hot_offer.destroy', $data['id']),
                                    'edit_url' => route('hot_offer.edit', $data['id']),
                                    'show_url' => route('hot_offer.show', $data['id'])
                                ]);
                    })->make(true);
        }



        $html = $htmlBuilder
                ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID'])
                ->addColumn(['data' => 'image', 'name' => 'image', 'title' => 'Image'])
                ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status'])
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => 'false']);

        return view('pages.hot_offer.index', compact('bread', 'html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bread = $this->bread;
        $bread[0] = route('hot_offer.index');
        return view('pages.hot_offer.create', compact('bread'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'image' => 'required',
            'status' => 'required'
        ]);

        HotOffer::create($request->all());

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Hot Offer successfully added',
        ]);

        return redirect()->route('hot_offer.index');
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
        $bread[0] = route('hot_offer.index');

        $hot_offer = HotOffer::findOrFail($id);
        return view('pages.hot_offer.edit', compact('hot_offer', 'bread'));
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
        $this->validate($request,[
            'image' => 'required',
            'status' => 'required'
        ]);

        $hot_offer = HotOffer::findOrFail($id);
        $hot_offer->update($request->all());

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Hot Offer successfully edited',
        ]);

        return redirect()->route('hot_offer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!HotOffer::destroy($id)) return redirect()->back();

        notify()->flash('Done!', 'success', [
            'timer' => 1500,
            'text' => 'Hot Offer successfully deleted',
        ]);

        return redirect()->route('hot_offer.index');
    }
}
