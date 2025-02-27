<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Customer;
use Formacom\Models\Address;
use Formacom\Models\Phone;
class CustomerController extends Controller
{
    public function index(...$params)
    {
        $customers = Customer::all();
        // Envía datos a la vista
//$data = ['mensaje' => '¡Bienvenido a la página de inicio!'];
        $this->view('home', $customers);
    }
    public function show(...$params)
    {
        if (isset($params[0])) {
            $customer = Customer::find($params[0]);
            if ($customer) {
                $this->view('detail', $customer);
                exit();
            }
        }
        header("Location: " . base_url() . "customer");
    }

    // CustomerController.php



    public function new()
    {
        if (isset($_POST["name"])) {
            $customer = new Customer();
            $customer->name = $_POST["name"];
            $customer->save();
            if (isset($_POST["street"]) && $_POST["street"] != "") {
                $address = new Address();
                $address->street = $_POST["street"];
                $address->zip_code = $_POST["zip_code"];
                $address->city = $_POST["city"];
                $address->country = $_POST["country"];
                $customer->addresses()->save($address);
            }
            if (isset($_POST["phonenumber"]) && $_POST["phonenumber"] != "") {
                $phone = new Phone();
                $phone->number = $_POST["phonenumber"];
                $customer->phones()->save($phone);
            }
            header("Location: " . base_url() . "customer");


        }
        $this->view("new");
    }

    public function edit($id)
    {
        // Obtener el cliente con la relación de direcciones y teléfonos
        $customer = Customer::with(['addresses', 'phones'])->find($id);

        // Si el cliente no existe, redirigir
        if (!$customer) {
            header("Location: " . base_url() . "customer");
            exit();
        }

        // Si el formulario se ha enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Actualizar el nombre del cliente
            if (isset($_POST["name"])) {
                $customer->name = $_POST["name"];
            }

            // Actualizar dirección si se proporciona una nueva
            if (isset($_POST["street"]) && $_POST["street"] !== "") {
                // Aquí actualizamos la primera dirección asociada al cliente
                $address = $customer->addresses()->first();
                if ($address) {
                    $address->street = $_POST["street"];
                    $address->zip_code = $_POST["zip_code"];
                    $address->city = $_POST["city"];
                    $address->country = $_POST["country"];
                    $address->save(); // Guardamos los cambios en la dirección existente
                } else {
                    // Si no hay dirección, se crea una nueva
                    $address = new Address();
                    $address->street = $_POST["street"];
                    $address->zip_code = $_POST["zip_code"];
                    $address->city = $_POST["city"];
                    $address->country = $_POST["country"];
                    $customer->addresses()->save($address);
                }
            }

            // Actualizar teléfono si se proporciona un nuevo teléfono
            if (isset($_POST["number"]) && $_POST["number"] !== "") {
                // Aquí actualizamos el primer teléfono asociado al cliente
                $phone = $customer->phones()->first();
                if ($phone) {
                    $phone->number = $_POST["number"];
                    $phone->save(); // Guardamos los cambios en el teléfono existente
                } else {
                    // Si no hay teléfono, se crea uno nuevo
                    $phone = new Phone();
                    $phone->number = $_POST["number"];
                    $customer->phones()->save($phone);
                }
            }

            // Guardar los cambios del cliente
            $customer->save();

            // Redirigir a la página de detalle del cliente
            header("Location: " . base_url() . "customer");
            exit();
        }

        // Pasar los datos del cliente a la vista para editar
        $this->view('edit', $customer);
    }

    public function delete($id)
    {
        // Buscar el cliente por ID
        $customer = Customer::find($id);

        // Si el cliente no existe, redirigimos
        if (!$customer) {
            header("Location: " . base_url() . "customer");
            exit();
        }

        // Eliminar las relaciones de direcciones y teléfonos asociados
        foreach ($customer->addresses as $address) {
            $address->delete(); // Eliminar la dirección
        }

        foreach ($customer->phones as $phone) {
            $phone->delete(); // Eliminar los teléfonos
        }

        // Eliminar el cliente
        $customer->delete();

        // Redirigir a la lista de clientes después de eliminar
        header("Location: " . base_url() . "customer");
        exit();
    }


}




?>