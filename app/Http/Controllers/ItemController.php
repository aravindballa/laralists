<?php

namespace App\Http\Controllers;

use App\TodoList;
use Illuminate\Http\Request;

use App\Repositories\ListRepository;
use App\Item;

class ItemController extends Controller
{
    protected $lists;

    public function index(Request $request)
    {
        $id = $request->id;
        return $this->lists->itemsForList($id);
    }

    public function toggleCompleted(Request $request)
    {
        $id = $request->id;
        $item = Item::find($id);
        $item->completed = ! $item->completed;
        $item->save();

        return 'success';
    }

    public function store(Request $request)
    {

//        $item = Item::create([
//            'description' => $request->des,
//            'completed' => false,
//            'starred' => false,
//            'todo_list_id' => $request->list,
//            ]);

        $list = TodoList::where('id', $request->id);
//        $list->items()->create(['description' => $request->des, 'completed' => false,
//            'starred' => false]);

        $item = new Item;
        $item->description = $request->des;
        $item->comleted = false;
        $item->starred = false;
        $item->todo_list_id = $request->list;
        $item->save();


        return 'success';
    }

    public function __construct(ListRepository $lists)
    {
        $this->lists = $lists;
    }
}
