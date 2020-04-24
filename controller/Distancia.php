<?php

class Distancia
{
    public function __construct()
    {
    }

    /* consulta = datos proporsionados por el usuario para buscar
    tabla = datos de la base de datos, es la tabla con la que se va a comparar
    datosEvaluar = nombre de las columanas de la tabla con la que se va aplicar 
    el algorimo*/
    public function distancia($consulta, $tabla, $datosEvaluar)
    {

        // √( (a0 – b0)^2 + (a1 – b1)^2 + (a2 – b2)^2)

        $tuplaMenor = [];       // tupla que se vaya acercando a la consulta
        $result = 1000000;      // resultado mas aproximado a la consulta 


        // recorre cada tupla de la tabla y evalua cada una
        foreach ($tabla as $tupla) {
            $sum = 0;

            // esta es la suma de las restas al cuadrado de cada valor a evaluar
            // a0 – b0)^2 + (a1 – b1)^2 + (a2 – b2)^2 por ejemplo
            foreach ($datosEvaluar as $col) {
                $sum += pow(($consulta[$col] - $tupla[$col]), 2);
            }
            $temp = sqrt($sum); //la raiz de esa sumatoria

            // si el resultado de esa raiz es menor al resutado mas proximo a la 
            // consulta, se actualiza con ese pque esta mas proximo y se guarda 
            // los datos de esa tupla para retornar lo solicitado
            if ($temp < $result) {
                $result = $temp;
                $tuplaMenor = $tupla;
            }
        }
        return $tuplaMenor;
    }

    /* antes de sacar la distancia, (este metodo de arriba) para por la funcion
     disc de cada controlador que recoge los datos de la base de datos y de la 
     consulta, les da el formato de acuerdo a lo que se necesite modificar con 
     lo metodos de aqui abajo y lo envia a sacar la distancia   */



    // Cambio de datos de string a un valor int para ser procesados
    public function tipoSexo($val)
    {
        if ($val == 'M')
            return 1;
        return 0; //f
    }

    public function tipoRecinto($val)
    {
        if ($val == 'Turrialba')
            return 1;
        return 0; //paraiso
    }

    public function tipoEstilo($val)
    {
        if ($val == 'ACOMODADOR')
            return 1;
        else if ($val == 'DIVERGENTE')
            return 2;
        else if ($val == 'CONVERGENTE')
            return 3;
        return 0; //asimilador
    }

    public function tipoB($val)
    {
        if ($val == 'F')
            return 1;
        else if ($val == 'M')
            return 2;
        return 0; //na
    }

    public function tipoC($val)
    {
        if ($val == 'B')
            return 1;
        else if ($val == 'I')
            return 2;
        return 0; //a
    }

    public function tipoE($val)
    {
        if ($val == 'DM')
            return 1;
        else if ($val == 'ND')
            return 2;
        return 0; //o
    }

    public function tipoF($val)
    {
        if ($val == 'H')
            return 1;
        else if ($val == 'A')
            return 2;
        return 0; //l
    }
    public function tipoG($val)
    {
        if ($val == 'S')
            return 1;
        else if ($val == 'N')
            return 2;
        return 0; //o
    }

    public function tipoH($val)
    {
        if ($val == 'S')
            return 1;
        else if ($val == 'N')
            return 2;
        return 0; //o
    }

    public function tipoCa($val)
    {
        if ($val == 'M')
            return 1;
        else if ($val == 'H')
            return 2;
        return 0; //l
    }

    public function tipoCo($val)
    {
        if ($val == 'M')
            return 1;
        else if ($val == 'H')
            return 2;
        return 0; //l
    }
}
