<?php

class Reporte
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function inventario()
    {

        $sql = "SELECT
        l.titulo,
        COUNT(e.id_ejemplar) as total
        FROM libro l
        JOIN ejemplar e
        ON l.id_libro = e.id_libro
        GROUP BY l.titulo";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function librosMasPrestados()
    {

        $sql = "SELECT
        l.titulo,
        COUNT(*) as prestamos
        FROM prestamo p
        JOIN ejemplar e
        ON p.id_ejemplar = e.id_ejemplar
        JOIN libro l
        ON e.id_libro = l.id_libro
        GROUP BY l.titulo
        ORDER BY prestamos DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function prestamosVencidos()
    {

        $sql = "SELECT
        u.username,
        l.titulo,
        p.fecha_limite
        FROM prestamo p
        JOIN usuario u
        ON p.id_usuario = u.id_usuario
        JOIN ejemplar e
        ON p.id_ejemplar = e.id_ejemplar
        JOIN libro l
        ON e.id_libro = l.id_libro
        LEFT JOIN devolucion d
        ON p.id_prestamo = d.id_prestamo
        WHERE d.id_devolucion IS NULL
        AND p.fecha_limite < CURDATE()";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usuariosMulta()
    {

        $sql = "SELECT
        u.username,
        m.monto_total
        FROM multa m
        JOIN devolucion_multa dm
        ON m.id_multa = dm.id_multa
        JOIN devolucion d
        ON dm.id_devolucion = d.id_devolucion
        JOIN prestamo p
        ON d.id_prestamo = p.id_prestamo
        JOIN usuario u
        ON p.id_usuario = u.id_usuario
        WHERE m.pagada = 0";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}