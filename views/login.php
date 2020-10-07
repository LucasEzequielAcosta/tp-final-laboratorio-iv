<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="https://api.themoviedb.org/3/movie/2?api_key=<<api_key>>&language=en-US" method="$_GET">

        <?php $data = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/550?api_key=c058df23ba034ee1884bbf9cb41ffd30'), true);?>

        <pre>
            <?php 
                $date = 
                var_dump($data); 
            ?>
        </pre>
    
    </form> -->

    <form action="" method="$_GET">

        <?php $data = json_decode(file_get_contents('https://api.themoviedb.org/3/movies?api_key=c058df23ba034ee1884bbf9cb41ffd30'), true);?>

        <pre>
            <?php 
                $date = 
                var_dump($data); 
            ?>
        </pre>

    </form>
</body>
</html>



<!-- 1 Revisión1.1 - Administrar Cines (A- Item b, con dao en memoria)1.2 - Consulta de películas actuales (C- Item a - get de la api)
a) Consultar películas por fecha y/o categoría.
b)Administrar cines.Cada registro debe tener el nombre del cine,su capacidad total,dirección y valor único de entrada.
c) Consultar cantidades vendidas y remanentes de las proyecciones (Película, Cine, Turno). -->