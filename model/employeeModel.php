<?php
require_once '../db_connection.php';  

class EmployeeModel {

    public function createEmployee($nome, $cpf, $rg, $email, $id_empresa, $salario, $bonificacao, $data_entrada) {
        global $conn;
    
        $data_cadastro = $data_entrada;
    
        $sql = "INSERT INTO tbl_funcionario (nome, cpf, rg, email, id_empresa, salario, bonificacao, data_cadastro) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssddss", $nome, $cpf, $rg, $email, $id_empresa, $salario, $bonificacao, $data_cadastro);
    
            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Erro ao executar a query: " . $stmt->error);
                return false;
            }
    
            $stmt->close();
        } else {
            error_log("Erro na preparação da query: " . $conn->error);
            return false;
        }
    }
    

    public function getAllCompanies() {
        global $conn;

        $sql = "SELECT id_empresa, nome FROM tbl_empresa";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->execute();
            $result = $stmt->get_result();

            $companies = [];
            while ($row = $result->fetch_assoc()) {
                $companies[] = $row;
            }

            $stmt->close();

            return $companies;
        } else {
            error_log("Erro na preparação da query: " . $conn->error);
            return [];
        }
    }

    public function getAllEmployees() {
        global $conn;
    
        $sql = "SELECT * FROM tbl_funcionario";
    
        if ($stmt = $conn->prepare($sql)) {
            $stmt->execute();
            
            $result = $stmt->get_result();
    
            $employees = [];
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
    
            $stmt->close();
    
            return $employees;
        } else {
            error_log("Erro na preparação da query: " . $conn->error);
            return [];
        }
    }
    
    public function getEmployeeById($id) {
        global $conn;
    
        $sql = "SELECT * FROM tbl_funcionario WHERE id_funcionario = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $employee = $result->fetch_assoc();
            $stmt->close();
            return $employee;
        } else {
            return null;
        }
    }
    
    public function updateEmployee($id, $nome, $cpf, $rg, $email, $salario, $data_cadastro) {
        global $conn;
    
        $bonificacao = 0;
        $anos_empresa = floor((time() - strtotime($data_cadastro)) / (365 * 60 * 60 * 24));
    
        if ($anos_empresa > 5) {
            $bonificacao = 0.20 * $salario;  
        } elseif ($anos_empresa > 1) {
            $bonificacao = 0.10 * $salario;  
        }
    
        $sql = "UPDATE tbl_funcionario SET nome = ?, cpf = ?, rg = ?, email = ?, salario = ?, bonificacao = ?, data_cadastro = ? WHERE id_funcionario = ?";
    
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssdisi", $nome, $cpf, $rg, $email, $salario, $bonificacao, $data_cadastro, $id);
    
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        return false;
    }


    public function deleteEmployee($id) {
        global $conn;
    
        $sql = "DELETE FROM tbl_funcionario WHERE id_funcionario = ?";
    
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
    
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        return false;
    }
    
    
}
?>
