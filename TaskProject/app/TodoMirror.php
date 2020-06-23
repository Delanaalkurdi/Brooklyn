<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoMirror extends Model
{
    private $isMirror=false;
    private $mirror;

    public function TodoMirror($isMirror=false)
    {
    	if(!$isMirror)
    		$this->mirror = new Todo(true);
    }
	public function insert($name, $desc)
	{
		$obj = new TodoMirror;
		$obj->name = $name;
		$obj->description = $desc;
		$obj->save();
		if(!empty($this->mirror))
			$this->mirror->insert($name, $desc);

	}
	public function delete($id)
	{
		$obj = new TodoMirror;
		$objToDelete = $obj::find($id);
		$objToDelete->delete();
		if(!empty($this->mirror))
		{
			$deleteTodo = $this->mirror->find($id);
			$deleteTodo->delete();
		}
	}
	public function update($id, $name, $desc)
	{
		$obj = new TodoMirror;
		$objToUpdate = $obj::find($id);
		$objToUpdate->name = $name;
		$objToUpdate->desc =$desc;
		$objToUpdate->save();
		if(!empty($this->mirror))
		{
			$updateTodo = $this->mirror->find($id);
			$updateTodo->name = $name;
			$updateTodo->desc =$desc;
			$updateTodo->save();
		}
	}

}
