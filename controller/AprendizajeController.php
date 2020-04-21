<?php

class AprendizajeController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function aprendizajeView()
    {
        $this->view->show('aprendizajeView.php');
    }

    public function disc()
    {
        $consulta['Sexo'] = $_POST['sexoi'];
        $consulta['Promedio'] = $_POST['promedioi'];
        $consulta['Recinto'] = $_POST['recintoi'];

        require_once 'model/DefaultModel.php';
        $Default = new DefaultModel();
        $tabla = $Default->get_data('t1_estilosexopromediorecinto');

        require_once 'Distancia.php';
        $Distancia = new Distancia();

        foreach ($tabla as &$tupla) {
            $tupla['Sexo'] = $Distancia->tipoSexo($tupla['Sexo']);
            $tupla['Recinto'] = $Distancia->tipoRecinto($tupla['Recinto']);
        }

        $resultado = $Distancia->distancia($consulta, $tabla, ['Sexo', 'Recinto', 'Promedio']);
        $this->view->show('resultadoView.php', $resultado['Estilo']);
    }
}
