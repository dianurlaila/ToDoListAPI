<?php

use Illuminate\Database\Seeder;

class ToDoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wahyu        = \App\Models\User::where('username', 'wahyu')->first();
        $dian         = \App\Models\User::where('username', 'dian')->first();

        $wtodolist= new \App\Models\Todolist();
        $wtodolist->description="Makan Malam";
        $wtodolist->time="10 PM";
        $wtodolist->date="11/12/2017";
        $wtodolist->status=0;
        $wtodolist->user_id=$wahyu->id;
        $wtodolist->save();

        $wtodolist= new \App\Models\Todolist();
        $wtodolist->description="Kerjain Proyek PU";
        $wtodolist->time="14:00";
        $wtodolist->date="12/12/2017";
        $wtodolist->status=0;
        $wtodolist->user_id=$wahyu->id;
        $wtodolist->save();

        $wtodolist= new \App\Models\Todolist();
        $wtodolist->description="Proyek Sinduadi Kelar";
        $wtodolist->time="12:00";
        $wtodolist->date="11/12/2017";
        $wtodolist->status=0;
        $wtodolist->user_id=$wahyu->id;
        $wtodolist->save();

        $wtodolist= new \App\Models\Todolist();
        $wtodolist->description="Makan Malam";
        $wtodolist->time="13:00";
        $wtodolist->date="13/12/2017";
        $wtodolist->status=0;
        $wtodolist->user_id=$wahyu->id;
        $wtodolist->save();

        $dtodolist= new \App\Models\Todolist();
        $dtodolist->description="Kerjain Tugas 1";
        $dtodolist->time="1:00";
        $dtodolist->date="11/12/2017";
        $dtodolist->status=0;
        $dtodolist->user_id=$dian->id;
        $dtodolist->save();

        $dtodolist= new \App\Models\Todolist();
        $dtodolist->description="Kerjain Tugas 2";
        $dtodolist->time="11:00";
        $dtodolist->date="12/12/2017";
        $dtodolist->status=0;
        $dtodolist->user_id=$dian->id;
        $dtodolist->save();

        $dtodolist= new \App\Models\Todolist();
        $dtodolist->description="Kerjain Tugas 3";
        $dtodolist->time="14:00";
        $dtodolist->date="13/12/2017";
        $dtodolist->status=0;
        $dtodolist->user_id=$dian->id;
        $dtodolist->save();
    }
}
