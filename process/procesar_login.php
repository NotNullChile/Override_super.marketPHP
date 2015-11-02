<?php
//Intancia de clases
//model.dal.ClientesDal clientesDal = new model.dal.ClientesDal();
//model.dal.AdministradorDal adminDal = new model.dal.AdministradorDal();
//model.business.Administrador admin = new model.business.Administrador();
//model.business.Clientes cliente = new model.business.Clientes();
////Get
//String user = request.getParameter("txt_rut");
//String password = request.getParameter("txt_password");
////SET Admin
//admin.getLogin().setUsername(Integer.parseInt(user));
//admin.getLogin().setPassword(password);  
////SET Cliente
//cliente.getLogin().setUsername(Integer.parseInt(user));
//cliente.getLogin().setPassword(password);
//
////Consulta si existe el cliente
//if (clientesDal.searchCliente(cliente) != null) 
//{
//    cliente = clientesDal.searchCliente(cliente);
//    if(cliente.getNombre() != null)
//    {
//     out.print("Si existe este cliente");
//    //Pagina 
//        request.getSession().setAttribute("cliente", cliente);
//        request.getSession().setAttribute("carrito", new ArrayList());
//        request.getRequestDispatcher("redirect_index_sesion_iniciada.jsp").forward(request, response); 
//    }
//}
//if(adminDal.searchAdmin(admin)!= null)
//{
//    admin = adminDal.searchAdmin(admin);
//    if (admin.getNombre() != null) 
//    {
//        out.print("Si existe este Admin");
//    //Pagina 
//        HttpSession sesionAdmin = request.getSession();
//        sesionAdmin.setAttribute("admin", admin);
//        request.getRequestDispatcher("redirect_index_intranet_sesion_iniciada.jsp").forward(request, response);
//    }
//}
//else
//{               
//    //Error login 
//    request.getRequestDispatcher("error_login.jsp").forward(request, response);
//}   