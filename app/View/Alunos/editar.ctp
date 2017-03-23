
<div class="container-fluid">
	<ul class="breadcrumb" id="bread">
	    <li><a href="../atividades/home_aluno">Início</a></li>
	    <li><a href="meu_perfil">Meu Perfil</a></li>
	    <li class="active">Editar</li>
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
		<div class="col-md-5">

			<div class="col-md-12">
  				<?php echo $this->Session->flash(); ?>
  			</div>	

			<legend>Editar Dados:</legend>

			<?php

				echo $this->Form->create('Aluno', array('class' => 'pull-left horizontal-form'));

				echo $this->Form->input('id', array('class' => 'form-control'));
				
				echo '<div class="col-xs-6">';
					echo $this->Form->input('nome', array('class' => 'form-control')). '<br>';
				echo '</div>';

				echo '<div class="col-xs-6">';
					echo $this->Form->input('sobrenome', array('class' => 'form-control')). '<br>';
				echo '</div>';

				echo '<div class="col-xs-12">';
					echo $this->Form->input('email', array('class' => 'form-control', 'readonly'=>'readonly'));
				echo '</div>';

				//botões
				echo '<div class="col-md-12"><br />';
					echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-primary', 'label' => '')) . ' ';
					echo $this->Html->link('Alterar Senha', array('action' => 'altera_senha'), array('class' => 'btn btn-primary', 'target' => '_self')) . ' ';

					echo $this->Html->link('Cancelar', array('controller' => 'alunos', 'action' => 'meu_perfil'), array('class' => 'btn btn-danger', 'target' => '_self')) . ' ';
				echo '</div>';
			?>
		</div>
	</div>
</div>