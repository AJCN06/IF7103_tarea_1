<?php

class ProfesorController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function ProfesorView()
    {
        $this->view->show('ProfesorView.php');
    }

    public function disc()
    {
        $consulta['A'] = $_POST['ai'];
        $consulta['B'] = $_POST['bi'];
        $consulta['C'] = $_POST['ci'];
        $consulta['D'] = $_POST['di'];
        $consulta['E'] = $_POST['ei'];
        $consulta['F'] = $_POST['fi'];
        $consulta['G'] = $_POST['gi'];
        $consulta['H'] = $_POST['hi'];

        require_once 'model/DefaultModel.php';
        $Default = new DefaultModel();
        $tabla = $Default->get_data('t1_profesores');

        require_once 'Distancia.php';
        $Distancia = new Distancia();

        foreach ($tabla as &$tupla) {
            $tupla['B'] = $Distancia->tipoB($tupla['B']);
            $tupla['C'] = $Distancia->tipoC($tupla['C']);
            $tupla['E'] = $Distancia->tipoE($tupla['E']);
            $tupla['F'] = $Distancia->tipoF($tupla['F']);
            $tupla['G'] = $Distancia->tipoG($tupla['G']);
            $tupla['H'] = $Distancia->tipoH($tupla['H']);
        }


        $resultado = $Distancia->distancia($consulta, $tabla, ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']);
        $this->view->show('resultadoView.php', $resultado['CLASS']);
    }
}
