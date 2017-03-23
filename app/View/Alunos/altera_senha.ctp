<div class="container-fluid">
	
	<ul class="breadcrumb" id="bread">
    <li><a href="../atividades/home_aluno">Início</a></li>
    <li><a href="meu_perfil">Meu Perfil</a></li>
    <li><a href="editar">Editar</a></li>
    <li class="active">Alterar Senha</li>
  </ul>   

  <div class="row">
		<div class="col-md-3">
      		<legend>Menu</legend>
		 	<ul class="nav nav-pills nav-stacked">
	    		<li><a href="../atividades/home_aluno">Início</a></li>
				<li><a href="../disciplinas/listar">Minhas Disciplinas</a></li>
				<li><a href="../atividades/listar">Minhas Atividades</a></li>
        		<li><a href="../atividades/historico">Histórico de Atividades</a></li>
	  		</ul>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-4">

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>	

			<legend>Alterar Senha:</legend>
			
			<?php 
				echo $this->Form->create('Aluno', array('controller' => 'alunos', 'action' => 'altera'));

				echo $this->Form->input('old_password', array('label'=>'Senha Atual', 'class' => 'form-control', 'type' => 'password', 'autofocus')) . '<br />';

				echo $this->Form->input('new_password', array('label'=>'Nova Senha', 'class' => 'form-control', 'type' => 'password')) . '<br />';

				echo $this->Form->input('confirm_password', array('label'=>'Confirme a Nova Senha', 'class' => 'form-control', 'type' => 'password')) . '<br />';

				//botões
				echo $this->Form->button('Alterar', array('type' => 'submit', 'class' => 'btn btn-primary', 'label' => '')) . ' ';
			
				echo $this->Html->link('Cancelar', array('action' => 'editar'), array('class' => 'btn btn-danger', 'target' => '_self'));

				
			?>
		</div>
	</div><br />	
</div>