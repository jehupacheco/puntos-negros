<?
namespace App\Models;

class BlackPoint {

    protected $guard = [];

    public function user()
    {
        return $this->belongsTo('User');
    }

}