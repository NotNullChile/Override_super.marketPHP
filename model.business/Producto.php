<?php
require_once ('Marcas.php');
require_once ('TipoProductos.php');
class Producto 
{
    private $idProducto;
    private $nombreProducto;
    private $precioUnitario;
    private $stock;
    private $descripcion;
    private $tipoProducto;
    private $marca;
    private $urlFoto;
    private $estado;
    function __construct() 
    {
        $this->marca = new Marcas();
        $this->tipoProducto = new TipoProductos();
    }
    function getIdProducto() {
        return $this->idProducto;
    }

    function getNombreProducto() {
        return $this->nombreProducto;
    }

    function getPrecioUnitario() {
        return $this->precioUnitario;
    }

    function getStock() {
        return $this->stock;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getTipoProducto() {
        return $this->tipoProducto;
    }

    function getMarca() {
        return $this->marca;
    }

    function getUrlFoto() {
        return $this->urlFoto;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setNombreProducto($nombreProducto) {
        $this->nombreProducto = $nombreProducto;
    }

    function setPrecioUnitario($precioUnitario) {
        $this->precioUnitario = $precioUnitario;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setTipoProducto($tipoProducto) {
        $this->tipoProducto = $tipoProducto;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setUrlFoto($urlFoto) {
        $this->urlFoto = $urlFoto;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getDescripcionTipoP()
    {
        return $this->tipoProducto->getDescripcion();
    }
    function setDescripcionTipoP($desc){
        $this->tipoProducto->setDescripcion($desc);
    }
    function getDescripcionMarca()
    {
        return $this->marca->getDescripcion();
    }
    function setDescripcionMarca($desc){
        $this->marca->setDescripcion($desc);
    }

    public function subTotalCarro()
    {
        return ($stock * $precioUnitario);
    }
    
    public function subTotal()
    {
        return round(($this->getStock() * $this->getPrecioUnitario())/1.19);
    }
    
    public function oferta50()
    {
        $calculoOferta = (($this->getPrecioUnitario()*50)/100) + $this->getPrecioUnitario();
        return $calculoOferta;
    }
    public function calculoIva()
    {
        return round($this->subTotal() * 0.19);
    }
    public function calculoTotalAPagar()
    {
        return $this->subTotal() + $this->calculoIva();
    }
    
}
