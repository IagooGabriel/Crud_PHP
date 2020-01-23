<?php 
    //desse modo é só alterar as configs. do banco no arquivo config.php sem precisar alterar para cada arquivo que usar a conexao.
    mysqli_report(MYSQLI_REPORT_STRICT);
    function abrir_conexao(){ //abrir conexao
        try { //tenta conectar, se der erro vai pro catch e retorna null.
            $conexao = new mysqli(DB_NAME, DB_USER, DB_PASSWORD, DB_HOST);
            return $conexao;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return null;
        }

    }

    function fechar_conexao($conexao){ //fechar conexao
        try {
            mysqli_close($conexao);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

?>

<?php

 // Pesquisa um Registro pelo ID em uma Tabela

function find( $table = null, $id = null ) {
  
	$database = abrir_conexao();
	$found = null;

	try {
	  if ($id) { //Se não for passado o id, a consulta retornará todos os registros da tabela.
	   
      $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
      $result = $database->query($sql);
	    
	    if ($result->num_rows > 0) {
	      $found = $result->fetch_assoc();
	    }
	  } else {
	    $sql = "SELECT * FROM " . $table;
        $result = $database->query($sql);
	    if ($result->num_rows > 0) {
	      $found = $result->fetch_all(MYSQLI_ASSOC);
	    }
	  }
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }
	fechar_conexao($database);
	return $found;
}

function find_all( $table ){ //retorna todos os registros de uma tabela.
    return find($table);
}
?>

<?php

// Insere um registro no BD
function save($table = null, $data = null) {

    $database = abrir_conexao();
    session_start();
    $columns = null;
    $values = null;
  
    //print_r($data);
  
    foreach ($data as $key => $value) {
      $columns .= trim($key, "'") . ",";
      $values .= "'$value',";
    }
  
    // remove a ultima virgula
    $columns = rtrim($columns, ',');
    $values = rtrim($values, ',');
    
    $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
    
    try {
      $database->query($sql);
  
      $_SESSION['message'] = 'Registro cadastrado com sucesso.';
      $_SESSION['type'] = 'success';
    
    } catch (Exception $e) { 
    
      $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
      $_SESSION['type'] = 'danger';
    } 
  
    fechar_conexao($database);
  }
 // Atualiza um registro em uma tabela, por ID
function update($table = null, $id = 0, $data = null) {

  $database = abrir_conexao();

  $items = null;

  foreach ($data as $key => $value) {
    $items .= trim($key, "'") . "='$value',";
  }

  // remove a ultima virgula
  $items = rtrim($items, ',');

  $sql  = "UPDATE " . $table;
  $sql .= " SET $items";
  $sql .= " WHERE id=" . $id . ";";

  try {
    $database->query($sql);

    $_SESSION['message'] = 'Registro atualizado com sucesso.';
    $_SESSION['type'] = 'success';

  } catch (Exception $e) { 

    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 

  fechar_conexao($database);
}

//Deletar pelo ID

function remove( $table = null, $id = null ) {

  $database = abrir_conexao();
	
  try {
    if ($id) {

      $sql = "DELETE FROM " . $table . " WHERE id = " . $id;
      $result = $database->query($sql);

      if ($result = $database->query($sql)) {   	
        $_SESSION['message'] = "Registro Removido com Sucesso.";
        $_SESSION['type'] = 'success';
      }
    }
  } catch (Exception $e) { 

    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
  }

  fechar_conexao($database);
}

?>
