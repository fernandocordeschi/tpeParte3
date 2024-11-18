<?php
require_once './config.php';

class ModelConectDB { 

    protected $db; 

    public function __construct() {
        try {
            
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
                MYSQL_USER,
                MYSQL_PASS
            );

            
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_deploy();
        } 
        
        catch (PDOException $e) {
            
            echo "Error de conexión: " . $e->getMessage();
            exit; 
        }
    }

    private function _deploy() {

    $pass = '$2y$10$KRzkpwvb7sBn389por.7oOewkyw1KEJuqylEiF26PnEGSHYJXta8K';
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();

    if (count($tables) == 0) {
        $sql = "
            SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
            START TRANSACTION;
            SET time_zone = '+00:00';

            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;

            CREATE TABLE IF NOT EXISTS `duenios` (
                `id_duenio` int(11) NOT NULL,
                `nombre_duenio` varchar(50) NOT NULL,
                `apellido_duenio` varchar(50) NOT NULL,
                `email_duenio` varchar(50) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            INSERT INTO `duenios` (`id_duenio`, `nombre_duenio`, `apellido_duenio`, `email_duenio`) VALUES
            (1, 'Pepe', 'Gomez', 'pepegomez@gmail.com'),
            (2, 'Loro', 'Pepe', 'loropepe@gmail.com'),
            (3, 'josee', 'garcia', 'josegarcia@gmail.com');

            CREATE TABLE IF NOT EXISTS `propiedades` (
                `id_propiedad` int(11) NOT NULL,
                `direccion` varchar(100) NOT NULL,
                `estado_propiedad` varchar(50) NOT NULL,
                `ambientes` int(2) NOT NULL,
                `duenio` int(4) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            INSERT INTO `propiedades` (`id_propiedad`, `direccion`, `estado_propiedad`, `ambientes`, `duenio`) VALUES
            (1, 'reforma universitaria 858', 'VENTA', 100, 1),
            (3, 'hola 5436', 'venta', 100, 3),
            (5, '9 de julio 800', 'alquiler', 5, 2);

            CREATE TABLE IF NOT EXISTS `users` (
                `username` varchar(20) NOT NULL,
                `password` varchar(60) NOT NULL,
                `id_user` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            ALTER TABLE `duenios`
                ADD PRIMARY KEY (`id_duenio`),
                ADD UNIQUE KEY `email_duenio` (`email_duenio`);

            ALTER TABLE `propiedades`
                ADD PRIMARY KEY (`id_propiedad`),
                ADD KEY `Usuario_FK` (`duenio`);

            ALTER TABLE `users`
                ADD PRIMARY KEY (`id_user`);

            ALTER TABLE `duenios`
                MODIFY `id_duenio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

            ALTER TABLE `propiedades`
                MODIFY `id_propiedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

            ALTER TABLE `users`
                MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

            ALTER TABLE `propiedades`
                ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`duenio`) REFERENCES `duenios` (`id_duenio`);

            COMMIT;
        ";

          $this->db->query($sql);
      }
  }
}
