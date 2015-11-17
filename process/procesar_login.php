<?php
session_start();
require_once '../model.dal/ClientesDal.php';
require_once '../model.dal/AdministradorDal.php';
require_once '../model.business/Cliente.php';
require_once '../model.business/Persona.php';
require_once '../model.business/Administrador.php';
//Intancia de clases
$clientesDal = new ClientesDal();
$adminDal = new AdministradorDal();
$admin = new Administrador();
$cliente = new Cliente();
////Get
$username = $_POST["txt_rut"];
$password = $_POST["txt_password"];
if(crypt($password, $clientesDal->passwordClient($username)) == $clientesDal->passwordClient($username)) 
{
    $esIgual = TRUE;
}
else
{
    $esIgual = FALSE;
}
////SET Admin
$admin->setUsername($username);
$admin->setPassword($password);

////SET Cliente
$cliente->setUsername($username);
$cliente->setPassword(crypt($password, $clientesDal->passwordClient($username)));
////Consulta si existe el cliente

if ($clientesDal->searchClient($cliente)!= NULL || $esIgual == TRUE) 
{    
        $cliente = $clientesDal->searchClient($cliente);
        $admin = $adminDal->searchAdmin($admin);
        if($cliente->getNombre() != null)
        {
        //Pagina 
            $nombre = $cliente->getNombre() . ' </br> ' . $cliente->getApellido();
            $arrayCliente = array('nombre' => $nombre, 'rut' => $cliente->getRut(),
                                  'email' => $cliente->getEmail(), 'telefono' => $cliente->getTelefono());
            $_SESSION['cliente'] = $arrayCliente;
            //$_SESSION['carro'] = array();
            header("Location: ../redirect_index_sesion_iniciada.php");
        }
        else if ($admin->getNombre() != null) 
        {
        //Pagina 
            $nombre = $admin->getNombre() . ' </br> ' . $admin->getApellido();
            $arrayAdmin = array('nombre' => $nombre);
            $_SESSION['administrador'] = $arrayAdmin;
            echo "admin encontrado";
            //request.getRequestDispatcher("redirect_index_intranet_sesion_iniciada.jsp").forward(request, response);
        }
        else
        {
            header("Location: ../access/error_login.php");
        }
    }
    else
    {
        header("Location: ../access/error_login.php");
    }

