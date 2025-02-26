<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Provider;
use Formacom\Models\Address;
use Formacom\Models\Phone;
class ProviderController extends Controller{
    public function index(...$params){
        $provider=Provider::all();
// Envía datos a la vista
//$data = ['mensaje' => '¡Bienvenido a la página de inicio!'];
$this->view('home', $provider);
}
public function show(...$params){
    if(isset($params[0])){
        $provider=Provider::find($params[0]);
        if($provider){
            $this->view('detail',$provider);
            exit();
        }
    }
    header("Location: ".base_url()."provider");
}


}
?>