<?php
namespace Formacom\models;
use Illuminate\Database\Eloquent\Model;
use Formacom\models\Address;
class Provider extends Model{
    protected $table="provider";
    protected $primaryKey = 'provider_id';
    public function addresses(){
        return $this->hasMany(Address::class,"provider_id");
    }
    public function phones(){
        return $this->hasMany(Phone::class,"provider _id");
    }
}

?>