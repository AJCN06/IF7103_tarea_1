<?php

class RecintoController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function recintoView()
    {
        $this->view->show('recintoView.php');
    }

    public function disc()
    {
        $consulta['Sexo'] = $_POST['sexoi'];
        $consulta['Promedio'] = $_POST['promedioi'];
        $consulta['Estilo'] = $_POST['estiloi'];

        require_once 'model/DefaultModel.php';
        $Default = new DefaultModel();
        $tabla = $Default->get_data('t1_estilosexopromediorecinto');

        require_once 'Distancia.php';
        $Distancia = new Distancia();

        foreach ($tabla as &$tupla) {
            $tupla['Sexo'] = $Distancia->tipoSexo($tupla['Sexo']);
            $tupla['Estilo'] = $Distancia->tipoEstilo($tupla['Estilo']);
        }

        $resultado = $Distancia->distancia($consulta, $tabla, ['Sexo', 'Estilo', 'Promedio']);
        $this->view->show('resultadoView.php', $resultado['Recinto']);
    }
}
