<?php
namespace Formacom\models;
use Illuminate\Database\Eloquent\Model;
use Formacom\models\Address;
class Customer extends Model{
    protected $table="customer";
    protected $primaryKey = 'customer_id';
    public function addresses(){
        return $this->hasMany(Address::class,"customer_id");
    }
    public function phones(){
        return $this->hasMany(Phone::class,"customer_id");
    }
}

?>