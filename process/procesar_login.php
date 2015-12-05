<?php
session_start();
require_once '../model.dal/ClientesDal.php';
require_once '../model.dal/AdministradorDal.php';
require_once '../model.dal/GerenteDal.php';
require_once '../model.business/Cliente.php';
require_once '../model.business/Persona.php';
require_once '../model.business/Administrador.php';
require_once '../model.business/Gerente.php';
//Intancia de clases
$clientesDal = new ClientesDal();
$adminDal = new AdministradorDal();
$gerenteDal = new GerenteDal();
$admin = new Administrador();
$cliente = new Cliente();
$gerente = new Gerente();
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
$admin->setPassword(crypt($password, $adminDal->passwordAdmin($username)));

////SET Cliente
$cliente->setUsername($username);
$cliente->setPassword(crypt($password, $clientesDal->passwordClient($username)));

////SET Gerente
$gerente->setUsername($username);
$gerente->setPassword(crypt($password, $gerenteDal->passwordGerente($username)));
////Consulta si existe el cliente

if ($clientesDal->searchClient($cliente)!= NULL || $esIgual == TRUE) 
{    
        $cliente = $clientesDal->searchClient($cliente);
        $admin = $adminDal->searchAdmin($admin);
        $gerente = $gerenteDal->searchGerente($gerente);
        if($cliente->getNombre() != null)
        {
        //Pagina 
            $nombre = $cliente->getNombre() . ' </br> ' . $cliente->getApellido();
            $nombreReporte = $cliente->getNombre() . ' ' . $cliente->getApellido();
            $arrayCliente = array('nombre' => $nombre, 'rut' => $cliente->getRut(),
                                  'email' => $cliente->getEmail(), 'telefono' => $cliente->getTelefono(), 'nombreReporte' => $nombreReporte );
            $_SESSION['cliente'] = $arrayCliente;
            //$_SESSION['carro'] = array();
            header("Location: ../redirect_index_sesion_iniciada.php");
        }
        else if ($admin->getNombre() != null) 
        {
        //Pagina 
            $nombre = $admin->getNombre() . ' </br> ' . $admin->getApellido();
            $nombreReporteAdmin = $admin->getNombre() . ' ' . $admin->getApellido();
            $arrayAdmin = array('nombre' => $nombre, 'nombreReporte' => $nombreReporteAdmin, 'rut' => $admin->getRut());
            $_SESSION['administrador'] = $arrayAdmin;
            header("Location: ../access/redirect_index_intranet_sesion_iniciada.php");
        }
        else if($gerente->getNombre() != null)
        {
            $nombre = $gerente->getNombre() . ' </br> ' . $gerente->getApellido();
            $arrayGerente = array('nombre' => $nombre);
            $_SESSION['gerente'] = $arrayGerente;
            header("Location: ../intranet/index_gerente.php");
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

