<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        ### Se crea una variable $data con la variable title igual a Iniciar sesion ###
        $data['title'] = 'Iniciar sesión';
        ### Se llama a una vista que recibe 3 parametros la URL, nombre de la pagina, la variable data ###
        $this->views->getView('principal', 'index', $data);
    }

    ### LOGIN ###
    /* 
    Se crea la funcion validar, en la cual se crean las variables que almacenaran 
    la clave y correo, despues se crea otra variable $data la cual manda a llamar 
    a otra funcion llamada getUsuario con el parametro de correo en espera de una
    respuesta.
    El primer if lo que hace es verificar si existe algun dato con el correo y el 
    segundo verifica la contraseña, y si coincide la clave nos devolvera verdadero
    donde iniciaremos las sesiones.
    Usaremos session para poder traer el id, carreo y nombre de usuario.
    Si los datos son positivos se muestran una alerta de tipo success.
    En caso de que los datos sean erroneos se procede a crear la variable res donde
    crearemos un array con los valores que necesitamos para mostrar nuestra alerta 
    personalizada. La primera condicion negativa es para mostrar el mensaje de error
    de acuerdo a la contraseña y el segundo al correo.
    */
    public function validar()
    {
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $data = $this->model->getUsuario($correo);
        if (!empty($data)) {
            if (password_verify($clave, $data['clave'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['rol'] = $data['rol'];
                $res = array('tipo' => 'success', 'mensaje' => 'BIENVENIDO AL SISTEMA DE GESTOR DE ARCHIVOS');
            } else {
                $res = array('tipo' => 'warning', 'mensaje' => 'LA CONTRASEÑA INCORRECTA');
            }
        } else {
            $res = array('tipo' => 'warning', 'mensaje' => 'EL CORREO NO EXISTE');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    ## RESETEAR CLAVE
    public function enviarCorreo($correo)
    {
        $consulta = $this->model->getUsuario($correo);
        if (!empty($consulta)) {
            $mail = new PHPMailer(true);
            try {
                $token = md5(date('YmdHis'));
                $this->model->updateToken($token, $correo);
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = CLAVE_SMTP;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom(CORREO_FROM, TITLE);
                $mail->addAddress($correo);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Restablecer clave';
                $mail->Body    = 'has pedido restablecer tu contraseña, si no has sido tu omite este mensaje <br><a href="' . BASE_URL . 'principal/reset/' . $token . '">CLICK QUI PARA CAMBIAR</a>';

                $mail->send();
                $res = array('tipo' => 'success', 'mensaje' => 'CORREO ENVIADO CON UN TOKEN DE SEGURIDAD');
            } catch (Exception $e) {
                $res = array('tipo' => 'success', 'mensaje' => $mail->ErrorInfo);
            }
        } else {
            $res = array('tipo' => 'warning', 'mensaje' => 'EL CORREO NO EXISTE');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reset($token)
    {
        $data['title'] = 'Restablecer clave';
        $data['usuario'] = $this->model->getToken($token);
        if ($data['usuario']['token'] == $token) {
            $this->views->getView('principal', 'reset', $data);
        } else {
            header('Location: ' . BASE_URL . 'errors');
        }
    }

    public function cambiarPass()
    {
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['clave_confirmar'];
        $token = $_POST['token'];
        if (empty($nueva) || empty($confirmar) || empty($confirmar)) {
            $res = array('tipo' => 'warning', 'mensaje' => 'TODO LOS CAMPOS SON REQUERIDOS');
        } else {
            if ($nueva != $confirmar) {
                $res = array('tipo' => 'warning', 'mensaje' => 'LAS CONTRASEÑAS NO COINCIDEN');
            } else {
                $result = $this->model->getToken($token);
                if ($token == $result['token']) {
                    $hash = password_hash($nueva, PASSWORD_DEFAULT);
                    $data = $this->model->cambiarPass($hash, $token);
                    if ($data == 1) {
                        $res = array('tipo' => 'success', 'mensaje' => 'CONTRASEÑA RESTABLECIDA');
                    } else {
                        $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL RESTABLECER LAS CONTRASEÑA');
                    }
                }
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
