<?php
class Empleado {
    public $id;
    public $nombre;
    public $cargo;
    public $salario;

    public function __construct($id, $nombre, $cargo, $salario) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->cargo = $cargo;
        $this->salario = $salario;
    }

    public function toArray() {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "cargo" => $this->cargo,
            "salario" => $this->salario
        ];
    }
}
?>
