<?php
require_once '../model.business/Cliente.php';
require_once '../model.dal/ClientesDal.php';
require_once '../model.dal/LoginDal.php';
require_once '../conexion.php';
//Clases
$clientes = new Cliente();
$clientesDal = new ClientesDal();
$loginDal = new LoginDal();
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
$clientes->setPassword($passwordDefinitiva);          
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
                //request.getRequestDispatcher("redirect_index_cliente_creado.jsp").forward(request, response);
                break;
            //Si retorna 23000 Cliente ya registrado
            case 23000:
                //Pagina a redirigir Cliente ya registrado
                echo "cliente creado";
                //request.getRequestDispatcher("error_signup_userexists.jsp").forward(request, response);
                break;
            //Error desconocido
            default: 
                //out.print("Contáctese con el administrador de la pagina");
                //Pagina a redirigir errorDesconocido
                echo "error Desconocido";
                //request.getRequestDispatcher("redirect_index_error.jsp").forward(request, response);
                break;
        }

    }
    else
    {
        //request.getRequestDispatcher("error_signup_differentpasswords.jsp").forward(request, response);
    }


