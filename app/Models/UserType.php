<?

namespace App\Models;

class UserType {

    public function userType()
    {
        return $this->belongsTo('User');
    }

}