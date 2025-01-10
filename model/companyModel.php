<?php
require_once '../db_connection.php';  

class CompanyModel {
    
    public function createCompany($nome_empresa) {
        global $conn;  

        $sql = "INSERT INTO tbl_empresa (nome) VALUES (?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $nome_empresa);
            
            if ($stmt->execute()) {
                return true;  
            } else {
                return false; 
            }

            $stmt->close();
        } else {
            return false;
        }
    }
}
?>
