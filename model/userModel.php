<?php
// model/UserModel.php
class UserModel {
    // Função para validar o login
    public function validateUser($login, $senha) {
        require_once '../db_connection.php';  

        //Prevenir SQL Injection
        $login = mysqli_real_escape_string($conn, $login);
        $senha = md5(mysqli_real_escape_string($conn, $senha));

        $query = "SELECT * FROM tbl_usuario WHERE login = '$login' AND senha = '$senha'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            return true;  //Usuário encontrado, login válido
        } else {
            return false; //Usuário não encontrado, login inválido
        }
    }
}
?>
