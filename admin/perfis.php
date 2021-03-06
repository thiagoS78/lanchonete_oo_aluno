<?php include './layout/header.php'; ?>
<?php include './layout/menu.php'; ?>
<?php 
$permissoes = retornaControle('perfil');
if(empty($permissoes)) {
	header("Location: administrativa.php?msg=Acesso negado.");
}
require 'classes/Perfil.php';
require 'classes/PerfilDAO.php';
$perfiDAO = new PerfilDAO();
$perfis = $perfiDAO->listar();

?>
<div class="row" style="margin-top:40px">
	<div class="col-10">
		<h2>Gerenciar perfis</h2>
	</div>
	<?php if($permissoes['insert']): ?>
	<div class="col-2">
		<a href="form_perfil.php" class="btn btn-success">Novo perfil</a>
	</div>
	<?php endif; ?>
</div>
<div class="row">
	<table class="table table-hover table-bordered table-striped table-responsive-lg">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Nome</th>
				<th>Status</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($perfis as $perfi){ ?>
			<tr>
				<td><?= $perfi->getId() ?></td>
				<td><?= $perfi->getDescricao() ?></td>
				<td><?= ($perfi->getStatus() == 1 ? 'Ativo' : 'Inativo') ?></td>
				<td>
					<?php if($permissoes['update'] || $permissoes['show']): ?>
					<a href="form_perfil.php?id=<?= $perfi->getId() ?>"  class="btn btn-warning" data-toggle="tooltip" title="Exibir/Editar perfil">
						<i class="fas fa-edit"></i>
					</a>
					<?php endif; ?>
					<?php if($permissoes['delete']): ?>
					<a href="controle_perfil.php?acao=deletar&id=<?= $perfi->getId() ?>" onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger" data-toggle="tooltip" title="Excluir perfil">
						<i class="fas fa-trash-alt"></i>
					</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php include './layout/footer.php'; ?>