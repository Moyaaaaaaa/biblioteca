<?php

class PrestamoController extends Controller
{

    public function __construct()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "AuthController/login");
            exit;
        }
    }


    public function misPrestamos()
    {

        $prestamoModel = $this->model('Prestamo');

        $prestamos = $prestamoModel->prestamosUsuario(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/prestamos', [
            'prestamos' => $prestamos
        ]);
    }



    public function crear()
    {

        if (!isset($_POST['id_libro'])) {
            header("Location: " . BASE_URL . "LibroController/catalogo");
            exit;
        }

        $id_libro = $_POST['id_libro'];
        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $rol = $_SESSION['usuario']['id_rol'];

        $prestamoModel = $this->model('Prestamo');

        /* VALIDAR LIMITE DE PRESTAMOS */

        $prestamos_activos = $prestamoModel->prestamosActivosUsuario($id_usuario);

        $limite = 0;

        switch ($rol) {

            case 2: // estudiante
                $limite = 3;
                break;

            case 3: // docente
                $limite = 5;
                break;

            case 4: // externo
                $limite = 2;
                break;

            default:
                $limite = 3;
        }

        if ($prestamos_activos >= $limite) {

            echo "Has alcanzado el número máximo de préstamos permitidos.";

            exit;
        }

        /* OBTENER LIBRO */

        $libroModel = $this->model('Libro');
        $libro = $libroModel->obtenerLibro($id_libro);

        $titulo = $libro['titulo'];

        /* CALCULAR FECHA LIMITE */

        $configModel = $this->model('Configuracion');
        $config = $configModel->obtener();

        $dias = $config['dias_prestamo'];

        $fecha_limite = date('Y-m-d', strtotime("+$dias days"));

        /* CREAR PRESTAMO */

        $resultado = $prestamoModel->crearPrestamo($id_usuario, $id_libro);

        if ($resultado === "multa_pendiente") {

            echo "No puedes solicitar préstamos hasta pagar tus multas.";

            exit;
        }

        if ($resultado) {

            $notificacion = $this->model('Notificacion');

            $mensaje = "Has solicitado el libro '" . $titulo .
                "' con fecha límite " . $fecha_limite;

            $notificacion->crear($id_usuario, $mensaje);
        }

        header("Location: " . BASE_URL . "PrestamoController/misPrestamos");
        exit;
    }
}