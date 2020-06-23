<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index() {
      $name = 'Delana';
      $desc = 'Angel';
      $todo = new Todo;
      $todo->insertRecord($name, $desc);
      return view('task_view',[]);
   }
   
}
