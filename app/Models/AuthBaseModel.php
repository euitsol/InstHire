<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthBaseModel extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public function created_admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function updated_admin()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
    public function deleted_admin()
    {
        return $this->belongsTo(Admin::class, 'deleted_by');
    }

    public function creater()
    {
        return $this->morphTo();
    }
    public function updater()
    {
        return $this->morphTo();
    }
    public function deleter()
    {
        return $this->morphTo();
    }
}
