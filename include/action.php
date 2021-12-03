<?php
//https://www.webslesson.info/2020/05/make-editable-datatable-using-jquery-tabledit-plugin-with-php-ajax.html
//action.php

$tabela = $_POST["tabela"];

include('database_connection.php');

$error = "";

if($_POST['action'] == 'edit') {

    //guardando os nomes das colunas da tabela num vetor columns
    $sql = "SHOW COLUMNS FROM $tabela";
    $result = $connect->query($sql);
    $columns = array();
    while($row = mysqli_fetch_array($result)){
        array_push($columns, $row['Field']);
    }

    //guardando os valores da linha i que se deseja editar num vetor valor_coluna
    $i = 0;
    $n_colunas = count($columns);
    $coluna_erro = "";
    for ( $i; $i < $n_colunas; $i++) {
        $valor_coluna["$i"] = $_POST[$columns["$i"]];
        //checagem de coluna vazia
        if ($valor_coluna["$i"] == "") {
            $coluna_erro = $columns["$i"];
            $error = "Coluna $coluna_erro nao preenchida.";
            $_POST["error"] = $error;
            echo (json_encode($_POST));
            die("");
        }
    }
    //assemelha-se a
    // $ordem    = $_POST['ordem'];
    // $posicao  = $_POST['posicao'];
    // $nome     = $_POST['nome'];
    // $id       = $_POST['id'];
    //para a tabela equipe

    //criando o query, do tipo 
    //INSERT INTO $tabela ($columns[0], columns[1], columns[2], columns[3]) VALUES('$valor_coluna[0]', '$valor_coluna[1]', 'valor_coluna[2]', 'valor_coluna[3]') ON DUPLICATE KEY UPDATE columns[0]="valor_coluna[0]" etc..
    
    $query = "INSERT INTO $tabela (";
    $i = 0;
    while($i < $n_colunas){
        $query .= $columns["$i"];
        $i++;
        if($i == $n_colunas) {
            break;
        }
        else
            $query .= ", ";
    }
    $query .= ") VALUES(";
    $i = 0;
    while($i < $n_colunas){
        $query .= "'" . $valor_coluna["$i"] . "'";
        $i++;
        if($i == $n_colunas) {
            break;
        }
        else
            $query .= ", ";
    }
    $query .= ") ON DUPLICATE KEY UPDATE ";
    $i = 1;
    while($i < $n_colunas){
        $query .= $columns["$i"] . "='" . $valor_coluna["$i"] . "'";
        $i++;
        if($i == $n_colunas) {
            break;
        }
        else
            $query .= ", ";
    }
    //executa o query
    $connect->query($query);

    if ($connect->error)
        $error = $connect->error;
        
}

if($_POST['action'] == 'delete') {
    $query = "DELETE FROM $tabela WHERE id = '".$_POST["id"]."'";
    $connect->query($query);
    if ($connect->error)
        $error = $connect->error;
    else if (!($connect->affected_rows))
        $error = "Elemento nao esta salvo no banco de dados";
}

$connect->close();

$_POST["error"] = $error;

echo (json_encode($_POST));

?>