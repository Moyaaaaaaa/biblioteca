<?php

class MultaController extends Controller
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


    public function index()
    {

        if ($_SESSION['usuario']['id_rol'] != 5 && $_SESSION['usuario']['id_rol'] != 1) {
            echo "Acceso denegado";
            exit;
        }

        $multaModel = $this->model('Multa');

        $multas = $multaModel->todas();

        $this->view('bibliotecario/multas', [
            'multas' => $multas
        ]);
    }


    public function pagar()
    {

        if ($_SESSION['usuario']['id_rol'] != 5 && $_SESSION['usuario']['id_rol'] != 1) {
            echo "Acceso denegado";
            exit;
        }

        $id_multa = $_POST['id_multa'];

        $multaModel = $this->model('Multa');


        $db = new Database();
        $conn = $db->conn;

        $sql = "SELECT u.username
                FROM multa m
                JOIN devolucion_multa dm ON m.id_multa = dm.id_multa
                JOIN devolucion d ON dm.id_devolucion = d.id_devolucion
                JOIN prestamo p ON d.id_prestamo = p.id_prestamo
                JOIN usuario u ON p.id_usuario = u.id_usuario
                WHERE m.id_multa = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => $id_multa
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $username = $user['username'];


        $multaModel->pagar($id_multa);


        $bitacora = $this->model('Bitacora');

        $bitacora->registrar(
            8,
            "Pago de multa del usuario " . $username .
            " registrado por " . $_SESSION['usuario']['username']
        );

        header("Location: " . BASE_URL . "MultaController/index");
    }


    public function misMultas()
    {

        $multaModel = $this->model('Multa');

        $multas = $multaModel->multasUsuario(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/multas', [
            'multas' => $multas
        ]);
    }

}