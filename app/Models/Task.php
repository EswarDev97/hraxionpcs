<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'resource_assigned_to', 'task_name', 'task_description',
        'priority', 'status', 'expected_completion_date', 'efforts_estimate',
        'actual_efforts', 'assignee_id', 'work_start_date', 'work_complete_date',
        'completed_status', 'comments'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(Employee::class, 'assignee_id');
    }

    public function resourceAssignedTo()
    {
        return $this->belongsTo(Employee::class, 'resource_assigned_to');
    }
}