<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 *
 * @package App
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
*/
class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email','visitor_per_hour','start_time','work_hour','lunch_start_time','finish_time','lunch_finish_time'];
    
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }
    
    public function provides_service($service)
	{
		return $this->services()->where('service_id', $service)->exists();
	}
}
