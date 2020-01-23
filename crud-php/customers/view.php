<?php 
	require_once('functions.php'); 
	view($_GET['id']);
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Cliente: <?php echo $customer['name']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome / Razão Social:</dt>
	<dd><?php echo $customer['name']; ?></dd>

	<dt>Email:</dt>
	<dd><?php echo $customer['email']; ?></dd>

	<dt>Telefone:</dt>
	<dd><?php echo $customer['phone']; ?></dd>

	<dt>Data de Nascimento:</dt>
	<dd><?php echo $customer['birthdate']; ?></dd>

	<dt>Endereço:</dt>
	<dd><?php echo $customer['address']; ?></dd>

	<dt>Data de Cadastro:</dt>
	<dd><?php echo $customer['created']; ?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
	  <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary">Editar</a>
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>