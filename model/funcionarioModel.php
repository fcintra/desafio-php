// /models/funcionarioModel.php
<?php
require_once '../db_connection.php';

function getFuncionarios() {
    global $conn;
    $sql = "SELECT * FROM tbl_funcionario";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function calcularBonificacao($data_cadastro, $salario) {
    $data_cadastro = new DateTime($data_cadastro);
    $hoje = new DateTime();
    $intervalo = $hoje->diff($data_cadastro);

    if ($intervalo->y > 5) {
        return $salario * 0.20;
    } 
    
    if ($intervalo->y > 1) {
        return $salario * 0.10;
    }

    return 0;
}
?>
