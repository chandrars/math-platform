<?php

namespace App\Models;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['user_id', 'class_model_id'];
	
	public function student()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function class()
	{
		return $this->belongsTo(ClassModel::class, 'class_model_id');
	}
}
