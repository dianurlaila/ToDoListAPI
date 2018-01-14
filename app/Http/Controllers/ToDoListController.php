<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\ToDoList;

class ToDoListController extends Controller
{


//    fungsi untuk melihat semua todolist
    public function index(Request $request)
    {
        // variabel $todolist mengambil data dari table todolist di database, 
        // baris 19 artinya, mengambil data yang user_id sama dengan user id pengguna yang akses, terus
        // oerderBy itu artinya diurutkan descending atau id yang paling besar ke kecil, terus arti
        // arti get mengambil semua data dari perintah sebelumnya.
        $todolist = ToDoList::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();

        return response()->json($todolist);

    }


//    fungsi untuk melihat todolist id tertentu
    public function show(Request $request, $id)
    {   
        // todolist ini mengecek, 
        $todolist = ToDoList::where('id', $id)
            ->where('user_id', $request->user()->id)->first();

        return response()->json($todolist);
    }

//    fungsi untuk menambah todolist
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
            'date'=>Carbon::parse(Carbon::createFromDate($request->get('year'), $request->get('month'), $request->get('day')))->format('d/m/Y'),
            'status' => 0,
        ]);

        return response()->json(['success' => 'berhasil menambah data'], 200);

    }


//    fungsi untuk mengedit todolist
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
        $todolist->date = Carbon::parse(Carbon::createFromDate($request->get('year'), $request->get('month'), $request->get('day')))->format('d/m/Y');
        $todolist->status = 0;
        $todolist->save();

        return response()->json(['success' => 'berhasil edit data'], 200);
    }


//    fungsi untuk menghapus todolist

    public function destroy(Request $request, $id)
    {

        $todolist = ToDoList::find($id);
        if ($todolist->user_id != $request->user()->id) {
            return response()->json(['error' => 'anda bukan pemilik list todo ini'], 403);

        }

        $todolist->delete();

        return response()->json(['success' => true,
            'message' => 'Berhasil Menghapus Data'], 200);
    }


//    fungsi untuk check selesai pada todolist tertentu
    public function checkDone(Request $request, $id)
    {
        $todolist = ToDoList::find($id);

        if ($todolist->user_id != $request->user()->id) {
            return response()->json(['error' => 'anda bukan pemilik list todo ini'], 403);

        }

        $todolist->status = 1;

        $todolist->save();

        return response()->json(['success' => true,
            'message' => 'List ini di check selesai'], 200);
    }


//    fungsi untuk check belum selesai pada todolist tertentu
    public function checkUndone(Request $request, $id)
    {
        $todolist = ToDoList::find($id);

        if ($todolist->user_id != $request->user()->id) {
            return response()->json(['error' => 'anda bukan pemilik list todo ini'], 403);

        }

        $todolist->status = 0;

        $todolist->save();

        return response()->json(['success' => true,
            'message' => 'List ini di check belum selesai'], 200);
    }

//    fungsi untuk melihat todolist hari ini
    public function todolistToday(Request $request)
    {

        $todolist = ToDoList::where('user_id',$request->user()->id)
                ->where('date',Carbon::parse(Carbon::today('Asia/Jakarta'))->format('d/m/Y'))->get();

        return $todolist;


    }

//    todolist kemarin
    public function todolistYesterday(Request $request)
    {

        $todolist = ToDoList::where('user_id',$request->user()->id)
            ->where('date',Carbon::parse(Carbon::yesterday('Asia/Jakarta'))->format('d/m/Y'))->get();

        return $todolist;


    }


//todolist besok
    public function todolistTommorow(Request $request)
    {

        $todolist = ToDoList::where('user_id',$request->user()->id)
            ->where('date',Carbon::parse(Carbon::tomorrow('Asia/Jakarta'))->format('d/m/Y'))->get();

        return $todolist;


    }

    public function todolistYearweek(Request $request)
    {

        $todolist = ToDoList::where('user_id',$request->user()->id)
            ->where('date',Carbon::parse(Carbon::yearweek('Asia/Jakarta'))->format('d/m/Y'))->get();

        return $todolist;


    }

}
