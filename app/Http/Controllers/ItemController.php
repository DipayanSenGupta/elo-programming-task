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
    public function index()
    {
        return view('index');
    }

    function action(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query1 = $request->get('query1');

            if ($query == '' || $query1 == '') {
                if ($query != '') {
                    $data = DB::table('items')
                        ->join('categories', 'items.category_id', '=', 'categories.id')
                        ->where('items.price', '>', $query)
                        ->select('items.id', 'items.name', 'items.price', 'categories.name AS c_name', 'categories.aisle')
                        ->get();;
                } elseif ($query1 != '') {
                    $data = DB::table('items')
                        ->join('categories', 'items.category_id', '=', 'categories.id')
                        ->where('categories.aisle', '=', $query1)
                        ->select('items.id', 'items.name', 'items.price', 'categories.name AS c_name', 'categories.aisle')
                        ->get();
                } else {
                    $data = DB::table('items')
                        ->join('categories', 'items.category_id', '=', 'categories.id')
                        ->select('items.id', 'items.name', 'items.price', 'categories.name AS c_name', 'categories.aisle')
                        ->get();;
                }
            } else {
                $data = DB::table('items')
                    ->join('categories', 'items.category_id', '=', 'categories.id')
                    ->where('categories.aisle', '=', $query1)
                    ->where('items.price', '>', $query)
                    ->select('items.id', 'items.name', 'items.price', 'categories.name AS c_name', 'categories.aisle')
                    ->get();;
            }
            $aisle = [];
            $categories = Category::all();
            foreach ($categories as $category) {
                array_push($aisle, $category->aisle);
            }
            $aisle = array_unique($aisle);
            sort($aisle);
            $aisle_output = null;
            foreach ($aisle as $i) {
                if ($i == $query1) {
                    $aisle_output .= '<option selected="selected">' . $i . '</option>' . '<br>';
                } else {
                    $aisle_output .= '<option>' . $i . '</option>' . '<br>';
                }
            }
            $output = '';

            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr id=product' . $row->id . ' class="active">
                    <td>' . $row->id . '</td>
                    <td>' . $row->name . '</td>
                    <td>' . $row->price . '</td>
                    <td>' . $row->c_name . '</td>
                    <td>' . $row->aisle . '</td>

                    <td width="35%">
                    <button class="btn btn-warning btn-detail open_modal" value=' . $row->id . '>Edit</button>
                    <button class="btn btn-danger btn-delete delete-product" value=' . $row->id . '>Delete</button>
                    </td>
                    </tr>';
                }
            } else {
                $output = '
                <tr>
                <td align="center" colspan="5">No Data Found</td>
                </tr>';
            }
            $data = array(
                'table_data'  => $output,
                'aisles' => $aisle_output,
            );

            return response()->json($data);
        }
    }

    public function store(Request $request)
    {
        $item = Item::create($request->input());
        return response()->json($item);
    }


    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function edit(Item $item)
    {
        return response()->json($item);
    }

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


    public function destroy(Item $item)
    {
        $item->delete();
    }
}