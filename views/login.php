<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="https://api.themoviedb.org/3/movie/2?api_key=<<api_key>>&language=en-US" method="$_GET">

        

        <pre>
            <?php 
                $date = 
                var_dump($data); 
            ?>
        </pre>
    
    </form> -->

    <form action="" method="$_GET">

        <pre>
            <?php 

                $key = "c058df23ba034ee1884bbf9cb41ffd30";

                $url = "https://api.themoviedb.org/3/movie/now_playing?api_key=" .$key. "&language=en-US&page=1";

                $json = file_get_contents($url);

                $data = json_decode($json, true);

                /* var_dump($data); */

                for($i=0; $i<20; $i++){

                    $title = $data['results'][$i]['title'];
                    var_dump($title);
                }
            ?>
        </pre>

    </form>
</body>
</html>



<!-- 1 Revisión1.1 - Administrar Cines (A- Item b, con dao en memoria)1.2 - Consulta de películas actuales (C- Item a - get de la api)
a) Consultar películas por fecha y/o categoría.
b)Administrar cines.Cada registro debe tener el nombre del cine,su capacidad total,dirección y valor único de entrada.
c) Consultar cantidades vendidas y remanentes de las proyecciones (Película, Cine, Turno). -->