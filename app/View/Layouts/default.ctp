<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'PlanejAí');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('estilo');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap.icon-large');
		echo $this->Html->css('bootstrap.icon-large.min');

		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery.scrollUp.min');
		echo $this->Html->script('bootstrap-datetimepicker.min');
		echo $this->Html->script('bootstrap'); 

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

	<script>


		function sair() {
		     var resposta = confirm("Você realmente deseja sair do sistema?");
		 
		     if (resposta == true) {
		          window.location.href = "logout";
		     }
		}

		//script voltar ao topo
		$(function () {
	    	$.scrollUp();
		}); 

		//script redimensionar rodapé de acordo com a página
		function sticky_footer() {
			var mFoo = $("footer");
			if ((($(document.body).height() + mFoo.outerHeight()) < $(window).height() && mFoo.css("position") == "fixed") || ($(document.body).height() < $(window).height() && mFoo.css("position") != "fixed")) {
				mFoo.css({ position: "fixed", bottom: "0px", left: "0px", right: "0px"});

			} else {
				mFoo.css({ position: "static"});
			}
		}
		jQuery(document).ready(function($){
			sticky_footer();
			$(window).scroll(sticky_footer);
			$(window).resize(sticky_footer);
			$(window).load(sticky_footer);
		});

		jQuery('ul.nav li.dropdown').hover(function() {
                 jQuery(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();
         }, function() {
                 jQuery(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut();
         });
	</script>

</head>

<body>

	<?php if($this->Session->Check('Aluno') and ('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) != ('http://' . $_SERVER['HTTP_HOST'] . '/Planejamento/')) { ?>
	<div id="header">
    	<header class="row" id="menu">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="../atividades/home_aluno" title="Home">planejAí</a>
			</div>	

			<div class="collapse navbar-collapse" id="myNavbar">

				<div class="col-xs-5">
				  	<ul class="nav navbar-nav">						    
					    <li><?php echo $this->Html->link('Informações', array('controller' => 'alunos', 'action' => 'info')); ?></li>
						<li><?php echo $this->Html->link('Contato', array('controller' => 'alunos', 'action' => 'contato')); ?></li> 
				  	</ul>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-12">
			  	
			  </div>
		  	<div class="col-md-6 col-sm-6 col-xs-12 pull-right">
		  		<ul class="nav navbar-nav pull-right">	

		  			<li><?php echo $this->Html->link($aluno['Aluno']['nome'], array('controller' => 'alunos', 'action' => 'meu_perfil'), array('class' => 'glyphicon glyphicon-user btn btn-primary', 'title' => 'Ver Meu Perfil')); ?>
		  			</li>
		  			<li><?php echo $this->Html->link('Sair',
						    array('controller' => 'alunos', 'action' => 'logout'),
						    array('class' => 'glyphicon glyphicon-log-out btn btn-primary', 'confirm' => 'Tem certeza que deseja sair do sistema? ', 'title' => 'Sair', 'escape' => false)
						); ?>
		  			</li>
		  		</ul>
		  	</div>
			</div>
	  	</nav>
		</header>
	</div>

	<?php } echo $content_for_layout; //parte para conteúdo?> 

	<div>
		<div>
			<footer id="footer">
				<div class="col-md-6">
					PlanejAí © Sistema para Planejamento de Alunos<br />Universidade Federal de Ouro Preto        
				</div>	

				<div class="col-md-6">
					Guilherme Silva Felix<br />guilhermesfelix@gmail.com
				</div>
			</footer>
		</div>
	</div>

	<?php //echo $this->element('sql_dump'); ?>
	
</body>
</html>
