<?php
require_once '../model.business/Cliente.php';
require_once '../model.dal/ClientesDal.php';
require_once '../model.dal/LoginDal.php';
require_once '../conexion.php';
//Clases
$clientes = new Cliente();
$clientesDal = new ClientesDal();
$loginDal = new LoginDal();
if(isset($_POST["txt_nuevo_rut"]))
{
//Set Class
$clientes->setRut($_POST["txt_nuevo_rut"]);
$clientes->setNombre($_POST["txt_nuevo_nombre"]);
$clientes->setApellido($_POST["txt_nuevo_apellido"]);
$clientes->setEmail($_POST["txt_nuevo_email"]);
$clientes->setTelefono($_POST["txt_nuevo_telefono"]);
$clientes->setUsername($_POST["txt_nuevo_rut"]);
$password1 = $_POST["txt_nuevo_password_1"];
$password2 = $_POST["txt_nuevo_password_2"];
$passwordDefinitiva = NULL;
if ($password1 == $password2) 
{
    $passwordDefinitiva = $password1;
}
$password = $clientes->crypt_blowfish_bydinvaders($passwordDefinitiva);
$clientes->setPassword($password); 
//Nos retornará un numero la consulta
$resultado = $loginDal->insertLogin($clientes); 

    if ($passwordDefinitiva != null) 
    {
        switch($resultado)
        {
            //Si retorna 1 todo Ok
            case 1 : 
                echo 'cliente creado';
                $clientesDal->insertCliente($clientes);
                header("Location: ../access/redirect_index_cliente_creado.php");
                break;
            //Si retorna 23000 Cliente ya registrado
            case 23000:
                //Pagina a redirigir Cliente ya registrado
                echo "cliente creado";
                header("Location: ../access/error_signup_userexists.php");
                break;
            //Error desconocido
            default: 
                //Pagina a redirigir errorDesconocido
                echo $clientesDal->insertCliente($clientes);
                header("Location: ../access/error_login.php");
                break;
        }

    }
    else
    {
        header("Location: ../access/error_login.php");
    }
}
else
{
    header("Location: ../index.php");
}
    


