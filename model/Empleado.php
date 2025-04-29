<?php
class Empleado {
    public $nombre;
    public $salario_mensual;
    public $dias_laborados;
    public $total_salario;
    public $valor_horas_extras;
    public $comisiones;
    public $total_devengado;
    public $total_deducido;
    public $neto_pagar;

    public function __construct($nombre, $salario_mensual, $dias_laborados, $total_salario, $valor_horas_extras, $comisiones, $total_devengado, $total_deducido, $neto_pagar) {
        $this->nombre = $nombre;
        $this->salario_mensual = $salario_mensual;
        $this->dias_laborados = $dias_laborados;
        $this->total_salario = $total_salario;
        $this->valor_horas_extras = $valor_horas_extras;
        $this->comisiones = $comisiones;
        $this->total_devengado = $total_devengado;
        $this->total_deducido = $total_deducido;
        $this->neto_pagar = $neto_pagar;
    }

    public function toArray() {
        return [
            "nombre" => $this->nombre,
            "salario_mensual" => $this->salario_mensual,
            "dias_laborados" => $this->dias_laborados,
            "total_salario" => $this->total_salario,
            "valor_horas_extras" => $this->valor_horas_extras,
            "comisiones" => $this->comisiones,
            "total_devengado" => $this->total_devengado,
            "total_deducido" => $this->total_deducido,
            "neto_pagar" => $this->neto_pagar
        ];
    }
}
?>
