<?php
// Incluindo a biblioteca FPDF
require('fpdf.php'); // Altere o caminho para onde o fpdf.php está no seu projeto

// Conectando ao banco de dados (ajuste com suas credenciais)
$conn = mysqli_connect("localhost", "root", "", "desafio_php");

// Verificando a conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Criando o objeto FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Definindo o título
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'Lista de Funcionarios', 0, 1, 'C');

// Cabeçalho da tabela
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Nome', 1, 0, 'C');
$pdf->Cell(40, 10, 'CPF', 1, 0, 'C');
$pdf->Cell(40, 10, 'RG', 1, 0, 'C');
$pdf->Cell(40, 10, 'Email', 1, 0, 'C');
$pdf->Cell(40, 10, 'Empresa', 1, 0, 'C');
$pdf->Cell(40, 10, 'Salario', 1, 0, 'C');
$pdf->Cell(40, 10, 'Bonificacao', 1, 0, 'C');
$pdf->Cell(40, 10, 'Data Cadastro', 1, 1, 'C');

// Definindo a fonte para os dados
$pdf->SetFont('Arial', '', 12);

// Consultando a tabela de funcionários
$result = mysqli_query($conn, "SELECT nome, cpf, rg, email, id_empresa, salario, bonificacao, data_cadastro FROM funcionarios");

// Iterando sobre os dados e inserindo no PDF
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(40, 10, $row['nome'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['cpf'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['rg'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['email'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['id_empresa'], 1, 0, 'C');
    $pdf->Cell(40, 10, 'R$ ' . number_format($row['salario'], 2, ',', '.'), 1, 0, 'C');
    $pdf->Cell(40, 10, 'R$ ' . number_format($row['bonificacao'], 2, ',', '.'), 1, 0, 'C');
    $pdf->Cell(40, 10, date('d/m/Y', strtotime($row['data_cadastro'])), 1, 1, 'C');
}

// Gerando o PDF para download
$pdf->Output();
exit;
?>
