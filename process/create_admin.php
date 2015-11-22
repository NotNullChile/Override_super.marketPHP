<?php
require_once '../model.business/Administrador.php';
require_once '../model.dal/AdministradorDal.php';
require_once '../model.dal/LoginDal.php';
require_once '../conexion.php';
//Clases
$admin = new Administrador();
$adminDal = new AdministradorDal();
$loginDal = new LoginDal();
if(isset($_POST["txt_nuevo_rut"]))
{
//Set Class
$admin->setRut($_POST["txt_nuevo_rut"]);
$admin->setNombre($_POST["txt_nuevo_nombre"]);
$admin->setApellido($_POST["txt_nuevo_apellido"]);
$admin->setEmail($_POST["txt_nuevo_email"]);
$admin->setTelefono($_POST["txt_nuevo_telefono"]);
$admin->setUsername($_POST["txt_nuevo_rut"]);
$password1 = $_POST["txt_nuevo_password_1"];
$password2 = $_POST["txt_nuevo_password_2"];
$passwordDefinitiva = NULL;
if ($password1 == $password2) 
{
    $passwordDefinitiva = $password1;
}
$password = $admin->crypt_blowfish_bydinvaders($passwordDefinitiva);
$admin->setPassword($password); 
//Nos retornará un numero la consulta
$resultado = $loginDal->insertLoginAdmin($admin); 

    if ($passwordDefinitiva != null) 
    {
        switch($resultado)
        {
            //Si retorna 1 todo Ok
            case 1 : 
                $adminDal->insertAdmin($admin);
                header("Location: ../intranet/redirect_index_intranet_admin_creado.php");
                break;
            //Si retorna 23000 admin ya registrado
            case 23000:
                //Pagina a redirigir admin ya registrado
                header("Location: ../intranet/redirect_index_intranet_error");
                break;
            //Error desconocido
            default: 
                //Pagina a redirigir errorDesconocido
                header("Location: ../intranet/redirect_index_intranet_error");
                break;
        }

    }
    else
    {
        header("Location: ../intranet/redirect_index_intranet_error_admin_differentpasswords.php");
    }
}
else
{
    header("Location: ../intranet/index_administrador.php");
}
