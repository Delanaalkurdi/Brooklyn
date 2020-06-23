<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    private $mirror;

    public function Todo($isMirror=false)
    {
    	if(!$isMirror)
    		$this->mirror = new TodoMirror(true);
    }
	public function insertRecord($name, $desc)
	{
		$obj = new Todo;
		$obj->name = $name;
		$obj->description = $desc;
		$obj->save();
		if(!empty($this->mirror))
			$this->mirror->insert($name, $desc);

	}
	public function deleteRecord($id)
	{
		$obj = new Todo;
		$objToDelete = $obj::find($id);
		$objToDelete->delete();
		if(!empty($this->mirror))
		{
			$deleteMirror = $this->mirror->find($id);
			$deleteMirror->delete();
		}
	}
	public function updateRecord($id, $name, $desc)
	{
		$obj = new Todo;
		$objToUpdate = $obj::find($id);
		$objToUpdate->name = $name;
		$objToUpdate->desc =$desc;
		$objToUpdate->save();
		if(!empty($this->mirror))
		{
			$updateMirror = $this->mirror->find($id);
			$updateMirror->name = $name;
			$updateMirror->desc =$desc;
			$updateMirror->save();
		}
}
