<?php

class SexoController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function sexoView()
    {
        $this->view->show('sexoView.php');
    }

    public function disc()
    {
        $consulta['Recinto'] = $_POST['recintoi'];
        $consulta['Promedio'] = $_POST['promedioi'];
        $consulta['Estilo'] = $_POST['estiloi'];

        require_once 'model/DefaultModel.php';
        $Default = new DefaultModel();
        $tabla = $Default->get_data('t1_estilosexopromediorecinto');

        require_once 'Distancia.php';
        $Distancia = new Distancia();

        foreach ($tabla as &$tupla) {
            $tupla['Recinto'] = $Distancia->tipoRecinto($tupla['Recinto']);
            $tupla['Estilo'] = $Distancia->tipoEstilo($tupla['Estilo']);
        }

        $resultado = $Distancia->distancia($consulta, $tabla, ['Recinto', 'Estilo', 'Promedio']);
        if ($resultado['Sexo'] == 'F')
            $this->view->show('resultadoView.php', 'Femenino');
        else
            $this->view->show('resultadoView.php', 'Masculino');
    }
}
