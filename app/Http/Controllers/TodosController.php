<?php

namespace App\Http\Controllers;

USE App\Todo;

use Illuminate\Http\Request;

class TodosController extends Controller
{
    
  public function index(){
      // Fetch all todos from Database
      // display them in todos.index page

      $todos = Todo::all();

      return view('todos.index')->with('todos', $todos);
    }

    

    
  public function show(Todo $todo){

    //$todo = Todo::find($todoId); //it will return an object under id number

    return view('todos.show')->with('todo', $todo);
  }

  

  
  public function create(){
    return view('todos.create');
  }

  
  
  public function store(){

    $this->validate(request(), [
      'name' => 'required|min:6|max:20',
      'description' => 'required',
    ]);

    $data = request()->all();

    $todo = new Todo(); //new instance of model
    $todo->name = $data['name'];
    $todo->description = $data['description'];
    $todo->completed = false;
    $todo->save(); //to save in Database

    session()->flash('success', 'Todo created successfully.');

    return redirect('/todos'); //to go back to the todos list page

  }

  
  

  public function edit(Todo $todo){
    
    //$todo = Todo::find($todoId); //it will return an object under id number
    
    return view('todos.edit')->with('todo', $todo);
  
  }

  

  
  public function update(Todo $todo){
      
    $this->validate(request(), [
      'name' => 'required|min:6|max:20',
      'description' => 'required',
    ]);

    $data = request()->all();

    //$todo = Todo::find($todoId);

    $todo->name = $data['name'];
    $todo->description = $data['description'];
    //$todo->completed = false;
    
    $todo->save(); //to save in Database

    session()->flash('success', 'Todo updated successfully.');

    return redirect('/todos');
  }

  

  
  public function destroy(Todo $todo){
      
    //$todo = Todo::find($todoId);
    $todo->delete();

    session()->flash('success', 'Todo deleted successfully.');
    
    return redirect('/todos');
  }



  public function complete(Todo $todo){
    
    $todo->completed = true;
    $todo->save();
    
    session()->flash('success', 'Todo completed successfully.');
    
    return redirect('/todos');
  }


}
