<?php

class RedesController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function RedesView()
    {
        $this->view->show('RedesView.php');
    }

    public function disc()
    {
        $consulta['Reliability (R)'] = $_POST['Rei'];
        $consulta['Number of links (L)'] = $_POST['Lii'];
        $consulta['Capacity (Ca)'] = $_POST['Cai'];
        $consulta['Costo (Co)'] = $_POST['Coi'];

        require_once 'model/DefaultModel.php';
        $Default = new DefaultModel();
        $tabla = $Default->get_data('t1_redes');

        require_once 'Distancia.php';
        $Distancia = new Distancia();

        foreach ($tabla as &$tupla) {
            $tupla['Capacity (Ca)'] = $Distancia->tipoCa($tupla['Capacity (Ca)']);
            $tupla['Costo (Co)'] = $Distancia->tipoCo($tupla['Costo (Co)']);
        }
        $resultado = $Distancia->distancia($consulta, $tabla, ['Reliability (R)', 'Number of links (L)', 'Capacity (Ca)', 'Costo (Co)']);
        $this->view->show('resultadoView.php', $resultado['Class']);
    }
}
