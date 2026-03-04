<?php

class Multa
{

    private $db;

    public function __construct()
    {

        $database = new Database();

        $this->db = $database->conn;

    }

    public function todas()
    {

        $sql = "SELECT
m.id_multa,
u.nombre,
l.titulo,
e.codigo_etiqueta,
GROUP_CONCAT(cm.descripcion SEPARATOR ', ') AS motivos,
m.monto_total,
m.pagada

FROM multa m

JOIN devolucion_multa dm
ON m.id_multa = dm.id_multa

JOIN devolucion d
ON dm.id_devolucion = d.id_devolucion

JOIN prestamo p
ON d.id_prestamo = p.id_prestamo

JOIN usuario u
ON p.id_usuario = u.id_usuario

JOIN ejemplar_prestamo ep
ON p.id_prestamo = ep.id_prestamo

JOIN ejemplar e
ON ep.id_ejemplar = e.id_ejemplar

JOIN libro l
ON e.id_libro = l.id_libro

LEFT JOIN multa_catalogo_multa mcm
ON m.id_multa = mcm.id_multa

LEFT JOIN catalogo_multa cm
ON mcm.id_catalogo_multa = cm.id_catalogo_multa

GROUP BY m.id_multa
ORDER BY m.id_multa DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function pagar($id)
    {

        $sql = "UPDATE multa
SET pagada=1
WHERE id_multa=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

    }

    public function multasUsuarioPendientes($id_usuario)
    {

        $sql = "SELECT
m.id_multa,
m.monto_total
FROM multa m

JOIN devolucion_multa dm
ON m.id_multa = dm.id_multa

JOIN devolucion d
ON dm.id_devolucion = d.id_devolucion

JOIN prestamo p
ON d.id_prestamo = p.id_prestamo

WHERE p.id_usuario = :usuario
AND m.pagada = 0";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':usuario' => $id_usuario
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function multasUsuario($id_usuario)
    {

        $sql = "SELECT
l.titulo,
GROUP_CONCAT(cm.descripcion SEPARATOR ', ') AS motivos,
m.monto_total,
m.pagada

FROM multa m

JOIN devolucion_multa dm
ON m.id_multa=dm.id_multa

JOIN devolucion d
ON dm.id_devolucion=d.id_devolucion

JOIN prestamo p
ON d.id_prestamo=p.id_prestamo

JOIN ejemplar_prestamo ep
ON p.id_prestamo=ep.id_prestamo

JOIN ejemplar e
ON ep.id_ejemplar=e.id_ejemplar

JOIN libro l
ON e.id_libro=l.id_libro

JOIN multa_catalogo_multa mcm
ON m.id_multa=mcm.id_multa

JOIN catalogo_multa cm
ON mcm.id_catalogo_multa=cm.id_catalogo_multa

WHERE p.id_usuario=:usuario

GROUP BY m.id_multa";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':usuario' => $id_usuario
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}