<?php
require_once '../db_connection.php';  

class EmployeeModel {

    public function createEmployee($nome, $cpf, $rg, $email, $id_empresa, $salario, $bonificacao, $data_entrada) {
        global $conn;

        try {
            $data_cadastro = $data_entrada;

            $sql = "INSERT INTO tbl_funcionario (nome, cpf, rg, email, id_empresa, salario, bonificacao, data_cadastro) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssssddss", $nome, $cpf, $rg, $email, $id_empresa, $salario, $bonificacao, $data_cadastro);
                $stmt->execute();
                $stmt->close();
                return true;
            } else {
                $errorMessage = "Erro na preparação da query: " . $conn->error;
                error_log($errorMessage);
                throw new Exception($errorMessage);
            }
        } catch (mysqli_sql_exception $e) {
            error_log("Erro ao inserir funcionário: " . $e->getMessage());
            throw new Exception("Erro ao cadastrar o funcionário. Por favor, verifique os dados e tente novamente.");
        } catch (Exception $e) {
            error_log("Erro inesperado: " . $e->getMessage());
            throw $e; 
        }
    }

    public function getAllCompanies() {
        global $conn;

        try {
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
                $errorMessage = "Erro na preparação da query: " . $conn->error;
                error_log($errorMessage);
                throw new Exception($errorMessage);
            }
        } catch (Exception $e) {
            error_log("Erro ao buscar empresas: " . $e->getMessage());
            return [];
        }
    }

    public function getAllEmployees() {
        global $conn;

        try {
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
                $errorMessage = "Erro na preparação da query: " . $conn->error;
                error_log($errorMessage);
                throw new Exception($errorMessage);
            }
        } catch (Exception $e) {
            error_log("Erro ao buscar funcionários: " . $e->getMessage());
            return [];
        }
    }

    public function getEmployeeById($id) {
        global $conn;

        try {
            $sql = "SELECT * FROM tbl_funcionario WHERE id_funcionario = ?";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $employee = $result->fetch_assoc();
                $stmt->close();
                return $employee;
            } else {
                $errorMessage = "Erro na preparação da query: " . $conn->error;
                error_log($errorMessage);
                throw new Exception($errorMessage);
            }
        } catch (Exception $e) {
            error_log("Erro ao buscar funcionário por ID: " . $e->getMessage());
            return null;
        }
    }

    public function updateEmployee($id, $nome, $cpf, $rg, $email, $salario, $data_cadastro) {
        global $conn;

        try {
            $bonificacao = 0;
            $anos_empresa = floor((time() - strtotime($data_cadastro)) / (365 * 60 * 60 * 24));

            error_log("Anos de empresa calculados: " . $anos_empresa);

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
                    $errorMessage = "Erro ao executar o update: " . $stmt->error;
                    error_log($errorMessage);
                    throw new Exception($errorMessage);
                }
            } else {
                $errorMessage = "Erro na preparação da query: " . $conn->error;
                error_log($errorMessage);
                throw new Exception($errorMessage);
            }
        } catch (Exception $e) {
            error_log("Erro ao atualizar funcionário: " . $e->getMessage());
            return false;
        }
    }

    public function deleteEmployee($id) {
        global $conn;

        try {
            $sql = "DELETE FROM tbl_funcionario WHERE id_funcionario = ?";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    $stmt->close();
                    return true;
                } else {
                    $errorMessage = "Erro ao executar o delete: " . $stmt->error;
                    error_log($errorMessage);
                    throw new Exception($errorMessage);
                }
            } else {
                $errorMessage = "Erro na preparação da query: " . $conn->error;
                error_log($errorMessage);
                throw new Exception($errorMessage);
            }
        } catch (Exception $e) {
            error_log("Erro ao deletar funcionário: " . $e->getMessage());
            return false;
        }
    }
}
?>
