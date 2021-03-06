<!-- Otro formulario para adivinar el recinto de origen de un estudiante 
(Paraíso o Turrialba), donde el usuario podrá seleccionar su estilo de 
aprendizaje de los cuatro usados (divergente, convergente, asimilador, 
acomodador), su último promedio para matrícula y su sexo. -->

<?php require_once 'public/header.php' ?>
<div class="container">
    <h1>Recinto de origen</h1>

    <form method="post" action="?controlador=Recinto&accion=disc">
        <div class="form-group col-lg-6 col-md-8 col-sm-12">
            <label for="Estiloi">Estilo de aprendizaje</label>
            <select id="Estiloi" class="form-control" name="estiloi">
                <option value="0">Asimilador</option>
                <option value="1">Acomodador</option>
                <option value="2">Divergente</option>
                <option value="3">Convergente</option>
            </select>
        </div>
        <div class="form-group col-lg-6 col-md-8 col-sm-12">
            <label for="promedioi">Ultimo promedio de matricula</label>
            <input type="text" class="form-control" id="promedioi" placeholder="Digite solo numeros" name="promedioi">
        </div>
        <div class="form-group col-lg-6 col-md-8 col-sm-12">
            <label for="Sexoi">Sexo</label>
            <select id="Sexoi" class="form-control" name="sexoi">
                <option value="1">Masculino</option>
                <option value="0">Femenino</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

</div>

<?php require_once 'public/footer.php' ?>