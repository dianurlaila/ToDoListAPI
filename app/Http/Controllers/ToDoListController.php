<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\ToDoList;

class ToDoListController extends Controller
{

    public function index(Request $request)
    {

        $todolist = ToDoList::where('user_id', $request->user()->id)->orderBy('id','desc')->get();

        return response()->json($todolist);

    }

    public function show(Request $request, $id)
    {
        $todolist = ToDoList::where('id', $id)
            ->where('user_id', $request->user()->id)->first();

        return response()->json($todolist);
    }

    public function create(Request $request)
    {
        $this->validate($request, [

            'description' => 'required',
            'time' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        $todolist = $request->user()->todolists()->create([
            'description' => $request->get('description'),
            'time' => $request->get('time'),
            'date' => Carbon::createFromDate($request->get('year'), $request->get('month'), $request->get('day')),
            'status' => 0,
        ]);

        return response()->json(['success'=>'berhasil menambah data'],200);

    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'description' => 'required',
            'time' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        $todolist = ToDoList::find($id);


//        check owner ship
        if ($todolist->user_id != $request->user()->id) {
            return response()->json(['error' => 'anda bukan pemilik list todo ini'], 403);

        }

        $todolist->description = $request->get('description');
        $todolist->time = $request->get('time');
        $todolist->date = Carbon::createFromDate($request->get('year'), $request->get('month'), $request->get('day'));
        $todolist->status=0;
        $todolist->save();

        return response()->json(['success'=>'berhasil edit data'],200);
    }

    public function destroy(Request $request, $id){

        $todolist = ToDoList::find($id);
        if ($todolist->user_id != $request->user()->id) {
            return response()->json(['error' => 'anda bukan pemilik list todo ini'], 403);

        }

        $todolist->delete();

        return response()->json(['success' => true,
            'message'=>'Berhasil Menghapus Data'], 200);
    }

}
