<?php

namespace App\Models;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
	protected $fillable = [
		'teacher_id',
		'title',
		'description',
		'price',
		'schedule',
		'max_students'
	];

	public function teacher()
	{
		return $this->belongsTo(User::class, 'teacher_id');
	}
	
	public function enrollments()
	{
		return $this->hasMany(Enrollment::class, 'class_model_id');
	}
	
	public function classes()
	{
		return $this->hasMany(ClassModel::class, 'teacher_id');
	}
	
	public function students()
	{
		return $this->belongsToMany(User::class, 'enrollments', 'class_model_id', 'user_id');
	}

}
