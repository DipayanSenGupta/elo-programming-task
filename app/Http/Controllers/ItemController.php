<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use Illuminate\Http\Request;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $sortBy = $request->sortBy;

        // DB::table('items')
        // ->join('categories', function($join)
        // {
        //     $join->on('categories.id', '=', 'items.category_id')
        //          ->where('categories.aisle', '=', sortBy);
        // })
        // ->select('items.id', 'items.name', 'items.price','categories.aisle','categories.name')
        // ->get();

        $aisle = [];
        $categories = Category::all();
        foreach ($categories as $category) {
            array_push($aisle, $category->aisle);
        }
        $aisle = array_unique($aisle);
        sort($aisle);
        $sortBy = '';
        $items = Item::paginate(20);
        return view('index')->with('items', $items)->with('aisles', $aisle)->with('sortBy', $sortBy);
    }

    function action(Request $request)
    {
      if ($request->ajax()) {

        // $items = DB::table('items')
        // ->join('categories', 'items.category_id', '=', 'category.id')
        // ->where('categories.aisle','=','query1')
        // ->select('users.*', 'contacts.phone', 'orders.price')
        // ->get();
        $aisle = [];
        $categories = Category::all();
        foreach($categories as $category){
            array_push($aisle,$category->aisle);
        }
        $aisle = array_unique($aisle);
        sort($aisle);
        $aisle_output=null;
        foreach($aisle as $i){
            $aisle_output.='<option>'.$i.'</option>'.'<br>';
        }
        $output = '';
        $query = $request->get('query');
        if ($query != '') {
          $data = DB::table('items')
            ->where('price', '>', $query)
            // ->orWhere('price', 'like', '%' . $query . '%')
            //  ->orderBy('CustomerID', 'desc')
            ->get();
        } else {
          $data = DB::table('items')
            //  ->orderBy('CustomerID', 'desc')
            ->get();
        }
        $total_row = $data->count();
        if ($total_row > 0) {
          foreach ($data as $row) {
            $output .= '
          <tr id=product'.$row->id.' class="active">
           <td>' . $row->name . '</td>
           <td>' . $row->price . '</td>
           <td width="35%">
           <button class="btn btn-warning btn-detail open_modal" value='.$row->id.'>Edit</button>
           <button class="btn btn-danger btn-delete delete-product" value='.$row->id.'>Delete</button>
       </td>
          </tr>
          ';
          }
        } else {
          $output = '
         <tr>
          <td align="center" colspan="5">No Data Found</td>
         </tr>
         ';
        }
        $data = array(
          'table_data'  => $output,
          'total_data'  => $total_row,
          'aisles' => $aisle_output,
        );
  
        echo json_encode($data);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Item::create($request->input());
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {

        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return response()->json($item);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->name;
        $item->price = $request->price;
        $item->save();
        return response()->json([
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'category_name' => $item->category->name,
            'category_aisle' => $item->category->aisle
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
    }
}
