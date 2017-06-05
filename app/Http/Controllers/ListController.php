<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TodoList;
use App\User;
use App;
use App\Repositories\ListRepository;

class ListController extends Controller
{

    protected $lists;

    public function index(Request $request)
    {
        $userid = Auth::id();

        $lists = $this->lists->forUser($request->user());
        return view('home', ['lists' => $lists]);


    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $request->user()->lists()->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/home');
    }

    public function destroy()
    {

    }

    public function __construct(ListRepository $lists)
    {
        $this->middleware('auth');

        $this->lists = $lists;
    }
}
