<?php
require '../vendor/autoload.php';
require_once '../model/employeeModel.php';


use Dompdf\Dompdf;

// Instância do Dompdf
$dompdf = new Dompdf();

// Obter a lista de funcionários do modelo
$employeeModel = new EmployeeModel();
$funcionarios = $employeeModel->getAllEmployees();

// Criar o conteúdo HTML para o PDF
$html = '<h1>Lista de Funcionários</h1>';
$html .= '<table border="1" style="width: 100%; border-collapse: collapse;">';
$html .= '<thead style="background-color: #0056b3;">';
$html .= '<tr>';
$html .= '<th>Nome</th>';
$html .= '<th>CPF</th>';
$html .= '<th>RG</th>';
$html .= '<th>Email</th>';
$html .= '<th>Data Cadastro</th>';
$html .= '<th>Salário</th>';
$html .= '<th>Bonificação</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

foreach ($funcionarios as $funcionario) {
    // Calculando o tempo de empresa
    $data_cadastro = strtotime($funcionario['data_cadastro']);
    $anos_empresa = floor((time() - $data_cadastro) / (365 * 60 * 60 * 24));

    // Determinando a cor de fundo dependendo dos anos de empresa
    $cor_fundo = '';
    if ($anos_empresa > 5) {
        $cor_fundo = '#ffcccc';  // Cor para mais de 5 anos
    } elseif ($anos_empresa > 1) {
        $cor_fundo = '#cce5ff';  // Cor para mais de 1 ano
    }

    // Criando as linhas da tabela com a cor de fundo
    $html .= '<tr style="background-color:' . $cor_fundo . '">';
    $html .= '<td>' . $funcionario['nome'] . '</td>';
    $html .= '<td>' . $funcionario['cpf'] . '</td>';
    $html .= '<td>' . $funcionario['rg'] . '</td>';
    $html .= '<td>' . $funcionario['email'] . '</td>';
    $html .= '<td>' . date('d/m/Y', strtotime($funcionario['data_cadastro'])) . '</td>';
    $html .= '<td>' . number_format($funcionario['salario'], 2, ',', '.') . '</td>';
    $html .= '<td>' . number_format($funcionario['bonificacao'], 2, ',', '.') . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Carregar o HTML no Dompdf
$dompdf->loadHtml($html);

// (Opcional) Configurar o tamanho e a orientação do papel
$dompdf->setPaper('A4', 'portrait');

// Renderizar o PDF
$dompdf->render();

// Enviar o PDF para o navegador
$dompdf->stream('lista_funcionarios.pdf', ['Attachment' => true]);

?>
