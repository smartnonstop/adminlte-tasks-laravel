<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Project extends Model
{
    use HasFactory;

    private $status = "";

    public function tasks()
    {
        if($this->status === "") {
          return $this->hasMany(Task::class);
        }

        return $this->hasMany(Task::class)->where('status', $this->status);
    }

    public function setStatus($status) {
      $this->status = $status;
    }

}
