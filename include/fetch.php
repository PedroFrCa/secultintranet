<?php
//https://www.webslesson.info/2020/05/make-editable-datatable-using-jquery-tabledit-plugin-with-php-ajax.html

//fetch.php

    $tabela = $_POST['tabela'];
    include('database_connection.php');

    //criando o vetor column, que guarda os nomes das colunas da tabela
    $sql = "SHOW COLUMNS FROM $tabela";
    $result = $connect->query($sql);
    $column = array();
    while($row = mysqli_fetch_array($result)){
        array_push($column, $row['Field']);
    }
    $n_colunas = count($column);
    //$column = array("id", "posicao", "nome");

    $query = "SELECT * FROM $tabela ";
    
    // if(isset($_POST["search"]["value"])) {
    //     $query .= ' 
    //     WHERE posicao LIKE "%'.$_POST["search"]["value"].'%"   
    //     OR nome LIKE "%'.$_POST["search"]["value"].'%" 
    //     ';
    // }

    if(isset($_POST["search"]["value"])) {
        $query .= 'WHERE ';
        $i = 1;
        while($i < $n_colunas){
                $query .= $column["$i"] . " LIKE '%" . $_POST["search"]["value"] . "%' ";
                $i++;
                if($i == $n_colunas) {
                    break;
                }
                else
                    $query .= "OR ";
            }
    }

    if(isset($_POST["order"])) {
        $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    }
    else {
        $query .= "ORDER BY $column[1], $column[2] ASC ";
    }
    $query1 = '';

    // if($_POST["length"] != -1) {
    //     $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    // }

    $result = $connect->query($query);
    $number_filter_row = $result->num_rows;

    $result = $connect->query($query . $query1);
    
    $data = array();
    foreach($result as $row) {
        $sub_array = array();

        $n_colunas = count($column);
        $i = 0;
        for ($i = 0; $i < $n_colunas; $i++){
            $sub_array[] = preg_replace('/\n/', '\\n', $row[$column["$i"]]);
        }
        // $sub_array[] = $row['id'];
        // $sub_array[] = $row['ordem'];
        // $sub_array[] = $row['posicao'];
        // $sub_array[] = $row['nome'];
        $data[] = $sub_array;
    }

    function count_all_data($connect) {
        $tabela = $_POST['tabela'];
        $query = "SELECT * FROM $tabela ";
        $result = $connect->query($query);

        $total_rows = $result->num_rows;
        return $total_rows;
    }


    $output = array(
        'draw'   => intval($_POST['draw']),
        'recordsTotal' => count_all_data($connect),
        'recordsFiltered' => $number_filter_row,
        'data'   => $data
    );

    $connect->close();
    echo json_encode($output);

?>