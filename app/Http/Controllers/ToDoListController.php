<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\ToDoList;

class ToDoListController extends Controller
{

    public function index(Request $request){

        $todolist = ToDoList::where('user_id',$request->user()->id)->get();

        return $todolist;

    }

    public function create(Request $request){
        $this->validate($request,[

            'description'  =>  'required',
            'time'  =>  'required',
            'day'  =>  'required',
            'month'  =>  'required',
            'year'  =>  'required',
        ]);

        $todolist= $request->user()->todolists()->create([
            'description' => $request->get('description'),
            'time' => $request->get('time'),
            'date' => Carbon::createFromDate($request->get('year'),$request->get('month'),$request->get('day')),
            'status'=>0,
        ]);

        return $todolist;

    }

}
