<?php namespace config;

    class Router {

        /**
         * Se encarga de direccionar a la pagina solicitada
         *
         * @param Request
         */

        public function __construct()
        {
            # code...
        }
        
        public static function direccionar(Request $request) {

            /**
             *  
             */
            $controlador = $request->getControlador();

            // UsuariosControlador

            /**
             * 
             */
            $metodo = $request->getMetodo();

            // add

            /**
             * 
             */
            $parametros = $request->getParametros();

            // Array
            // (
            //     [nombre] => Prueba
            //     [email] => nose@asd
            //     [pass] => asd
            // )


            /**
             * 
             */
            $mostrar = "controllers\\". $controlador;

            // Controladores\Usuarios

            /**
             * 
             */
            $controlador = new $mostrar;

            /**
             * 
             */
            if(!isset($parametros)) {
                call_user_func(array($controlador, $metodo));
            } else {
                call_user_func_array(array($controlador, $metodo), $parametros);
            }
        }
    }

?>