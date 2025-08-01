<?php

$host_aceptados = array('localhost','127.0.0.1');
$metodo_aceptado = 'POST';
$usuario_correcto = "Admin";
$password_correcto = "Admin";
$txt_usuario = $_POST["txt_usuario"];
$txt_password = $_POST["txt_password"];
$token = "";

if( in_array($_SERVER["HTTP_HOST"],$host_aceptados) ){
    //La dirección ip es aceptada
    if($_SERVER["REQUEST_METHOD"] == $metodo_aceptado){
        //Se acepta el método usado por el usuario
        if(isset($txt_usuario) && !empty($txt_usuario)){
            //Sí se enviaron valores en el campo usuario.
            if(isset($txt_password) && !empty($txt_password)){
                //Sí se envió el valor de la contraseña
                if($txt_usuario==$usuario_correcto){
                    //El valor ingresado del campo usuario es correcto
                    if($txt_password==$password_correcto){
                        //El valor ingresado del campo password es correcto
                        $ruta = "welcome.php";
                        $msg = "";
                        $codigo_estado = 200;
                        $texto_estado = "Ok";
                        list($usec,$sec) = explode(' ',microtime());
                        $token = base64_encode(date("Y-m-d H:i:s",$sec).substr($usec,1));
                    }else{
                        //El valor ingresado del campo password no es correcto
                        $ruta = "";
                        $msg = "SU CONTRASEÑA ES INCORRECTA";
                        $codigo_estado = 400;
                        $texto_estado = "Bad Request";
                        $token = "";
                    }
                }else{
                    //El valor ingresado del campo usuario no es correcto
                    $ruta = "";
                    $msg = "NO SE RECONOCE EL USUARIO DIGITADO";
                    $codigo_estado = 401;
                    $texto_estado = "Unauthorized";
                    $token = "";
                }
            }else{
                //El campo password está vacío
                $ruta = "";
                $msg = "EL CAMPO DE CONTRASEÑA ESTÁ VACÍO";
                $codigo_estado = 401;
                $texto_estado = "Unauthorized";
                $token = "";
            }
        }else{
            //El campo usuario está vacío
            $ruta = "";
                $msg = "EL CAMPO DE USUARIO ESTÁ VACÍO";
                $codigo_estado = 401;
                $texto_estado = "Unauthorized";
                $token = "";
        }
    }else{
        //El método usado por el usuario no es aceptado
        $ruta = "";
        $msg = "EL CAMPO DE CONTRASEÑA ESTÁ VACÍO";
        $codigo_estado = 405;
        $texto_estado = "Method Not Allowed";
        $token = "";
    }
}else{
    //La dirección IP no es aceptada
    $ruta = "";
    $msg = "SU EQUIPO NO ESTÁ AUTORIZADO PARA REALIZAR ESTA PETICIÓN";
    $codigo_estado = 403;
    $texto_estado = "Forbidden";
    $token = "";
}

$arreglo_respuesta = array(
    "status" => (   (intval($codigo_estado) == 200) ? "Ok": "Error" ),
    "error" => (   (intval($codigo_estado) == 200) ? "" : array("code"=>$codigo_estado,"message"=>$msg) ),
    "data" => array(
        "url"=>$ruta,
        "token"=>$token
    ),
    "count"=>1
);

header("HTTP/1.1 ".$codigo_estado." ".$texto_estado);
header("Content-Type: Application/json");
echo(json_encode($arreglo_respuesta));

?>