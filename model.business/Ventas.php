<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ventas
 *
 * @author Ricardo
 */
class Ventas 
{
    private $idVenta;
    private $subTotal;
    private $iva;
    private $Total;
    private $metodosDePago;
    private $fecha;
    private $cliente;
    private $carrito;
    private $despacho;
    function __construct() 
    {
        
    }
    function getIdVenta() {
        return $this->idVenta;
    }

    function getSubTotal() {
        return $this->subTotal;
    }

    function getIva() {
        return $this->iva;
    }

    function getTotal() {
        return $this->Total;
    }

    function getMetodosDePago() {
        return $this->metodosDePago;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getCarrito() {
        return $this->carrito;
    }

    function getDespacho() {
        return $this->despacho;
    }

    function setIdVenta($idVenta) {
        $this->idVenta = $idVenta;
    }

    function setSubTotal($subTotal) {
        $this->subTotal = $subTotal;
    }

    function setIva($iva) {
        $this->iva = $iva;
    }

    function setTotal($Total) {
        $this->Total = $Total;
    }

    function setMetodosDePago($metodosDePago) {
        $this->metodosDePago = $metodosDePago;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setCarrito($carrito) {
        $this->carrito = $carrito;
    }

    function setDespacho($despacho) {
        $this->despacho = $despacho;
    }



}
