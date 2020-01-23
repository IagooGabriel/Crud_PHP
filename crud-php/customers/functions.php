<?php

require_once('../config.php');
require_once(DBAPI);

$customers = null; //irá guardar um conjunto de registros de clientes
$customer = null; //guardará um único cliente, para os casos de inserção e atualização (CREATE e UPDATE).

 //Listagem de Clientes

function index() {
	global $customers;
	$customers = find_all('customers'); //funcao encontrarTudo() traz os dados
}

// Cadastro de Clientes
function add() {

	if (!empty($_POST['customer'])) {
		
		$today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

		$customer = $_POST['customer'];
		$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
		echo $customer['modified'];
		save('customers', $customer);
		header('location: index.php');
	}
}

//Atualizacao/Edicao de Cliente
function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_POST['customer'])) {

      $customer = $_POST['customer'];
      $customer['modified'] = $now->format("Y-m-d H:i:s");

      update('customers', $id, $customer);
      header('location: index.php');
    } else {

      global $customer;
      $customer = find('customers', $id);
    } 
  } else {
    header('location: index.php');
  }
}

//Visualizacao de um CLiente

function view($id = null) {
	global $customer;
	$customer = find('customers', $id);	
}

//Excluir Cliente

function delete($id = null) {

  global $customer;
  $customer = remove('customers', $id);

  header('location: index.php');
}