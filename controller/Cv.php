<?php

class CvController
{
    private $k; // cantidad de bloques con que se va evaluar
    private $chunk_count; // contador para saber que bloque se usa como test
    private $chunks; //tabla dividida en k bloques 
    private $iteractionResult; //almacena todos los resultados de las iteracines


    /*recibe la cantidad de bloques y la tabla para poder utilizar un objeto por 
    tabla en caso de ser necesario testear alguna otra tabla */
    public function __construct($k, $table)
    {
        $this->k = $k;
        $this->chunk_count = 0;
        $this->chunks = array_chunk($table, count($table) / $this->k);
        $this->iteractionResult = [];
    }

    /* Retorna un un arreglo donde en la primer entrada va el bloque de prueba 
    y en la segunda el resto de los chunks como uno solo, cada vez que se llama
    al metodo mientras este exista devolver el siguiente chunk */
    public function getData()
    {

        $test = $this->chunks[$this->chunk_count];
        $training = [];

        /* Genera un arreglo con los demas chunks excluyendo a test */
        for ($i = 0; $i < $this->k; $i++) {
            if ($i != $this->chunk_count) {
                foreach ($this->chunks[$i] as $chunk) {
                    array_push($training, $chunk);
                }
            }
        }

        /* Aumenta al siguiente chunk en caso que estos se acaben vuelve al 
        valor inicial */
        $this->chunk_count++;
        $this->chunk_count = $this->chunk_count % $this->k;

        $result['test'] = $test;
        $result['training'] = $training;
        return $result;
    }
    /* Guarda el porcentaje de error cada de iteracion en la posicion del bloque 
    al que corresponde, en este caso inicia en uno ya que la formula es una 
    sumatoria de i = 1 hasta k */
    public function saveItaration($result)
    {
        $total = $result['errores'] + $result['aciertos'];
        $porcErr = ($result['errores'] * 100) / $total;
        $this->iteractionResult[$this->chunk_count] = $porcErr;
    }

    /* Aplica la formula del error, la sumatoria de cada resultado de las 
    iteraciones entre 1/k */
    public function err()
    {
        $sumatoria = 0;
        foreach ($this->iteractionResult as $result) {
            $sumatoria += $result;
        }
        $err['iteraciones'] = $this->iteractionResult;
        $err['total'] = $sumatoria / $this->k;

        return $err;
    }

}
