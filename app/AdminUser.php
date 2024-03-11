<?php


namespace App;


use App\Models\Hrm\Employee;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'admin_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password','avatar','employee_id','required_login','enable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function searchableAs()
    {
        return 'admin_users';
    }
    public function getTopicAttribute()
    {
        return "singae.hrm.".$this->attributes['username'];
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
