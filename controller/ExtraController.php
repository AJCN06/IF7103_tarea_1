<?php

class ExtraController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function ExtraView()
    {
        $k = 10; // Cantidad de chunks con los que se va trabajar 

        require_once 'model/DefaultModel.php';
        $Default = new DefaultModel(); // conexion de la base de datos
        $tabla = $Default->get_data('t1_recintoestilo');

        require_once 'Distancia.php';
        $Distancia = new Distancia(); // obj para realizar la distancia de euclides

        require_once 'Cv.php';
        $Cv = new CvController($k, $tabla); //obj que aplica el Cv

        //ciclo que realiza cada iteracion 
        for ($i = 0; $i < $k; $i++) {
            $datos['aciertos'] = 0;
            $datos['errores'] = 0;
            $set = $Cv->getData(); /* generamos un chunk nuevo como test
                                    dejando los demas como training */


            /* compara cada consulta de test contra training y suma sus 
            aproximaciones NOTA: parte del algoritmo que no tenia clara */

            foreach ($set['test'] as $consulta) {
                $resultado = $Distancia->distancia($consulta, $set['training'], ['EC', 'OR', 'CA', 'EA']);
                if ($resultado['Estilo'] == $consulta['Estilo']) {
                    $datos['aciertos']++;
                } else {
                    $datos['errores']++;
                }
            }
            /*Guardamos el resultado de esta iteracion despues de calcular su 
             porcentaje de error*/
            $Cv->saveItaration($datos);
        }//termino de calcular iteraciones

        //calculamos el error
        $err = $Cv->err();

        $this->view->show('ExtraView.php', $err);
    }
}
