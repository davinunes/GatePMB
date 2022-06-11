<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Visitantes</title>
  <link rel="stylesheet" href="bulma.min.css">
  <link rel="stylesheet" href="materialize.min.css">
  <script defer src="all.js"></script>
</head>

<body>

  <section class="section">
  
<div class="container">
	<div class="card ">
		<div class="card-content">
		
		<h1 class="card-title title">Controle de Visitantes</h1>
		<p>Insira os dados e, por ultimo, posicione a camera e clique em salvar (também pode pausar o video antes de clicar em salvar)</p><br>
							  
			<div class="row">
				  <div class="col s4 column is-four-fifths">
				   
				   <br><video autoplay id="video" width="400"></video>

				  </div>
				  <div class="col s8">
					  <div class="input-field col s6">
						  <input placeholder="Digite o nome" id="nome" type="text" class="validate">
						  <label for="nome">Nome</label>
					  </div>
					  <div class="input-field col s6">
						  <input pattern="[0-9]+$" minlength="11" maxlength="11" placeholder="CPF" data-mask="000.000.000-00" id="cpf" type="text" class="validate">
						  <label for="cpf" data-error="Preencha o campo CPF">CPF</label>
					  </div>
					  <div class="input-field col s4">
						  <input placeholder="Organização Militar" id="om" type="text" class="validate">
						  <label for="om">OM</label>
					  </div>
					  <div class="input-field col s4">
						  <input placeholder="Onde vai?" id="destino" type="text" class="validate">
						  <label for="destino">Destino</label>
					  </div>
					  <div class="input-field col s4">
						  <input placeholder="Placa do Carro" id="placa" type="text" class="validate">
						  <label for="placa">Placa</label>
					  </div>
					  <div class="input-field col s12">
						  <input placeholder="Digite quaisquer informações complementares" id="obs" type="text" class="">
						  <label for="obs">Observações</label>
					  </div>
				  </div>

		  
			</div>
		</div>
		<div class="card-action">
			  <button class="button is-hidden" id="btnPlay">
				<span class="icon is-small">
				  <i class="fas fa-play"></i>
				</span>
				<span>Filmar</span>
			  </button>
			  <button class="button" id="btnPause">
				<span class="icon is-small">
				  <i class="fas fa-pause"></i>
				</span>
				<span>Pausar</span>
			  </button>
			  <button disabled class="button is-success" id="btnScreenshot">
				<span class="icon is-small">
				  <i class="fas fa-camera"></i>
				</span>
				<span>Salvar</span>
			  </button>
			  

			  <button class="button" id="btnChangeCamera">
				<span class="icon">
				  <i class="fas fa-sync-alt"></i>
				</span>
				<span>Mudar Camera</span>
			  </button>
		</div>
	</div>
	<div class="row">
		<div class="card ">
			<div class="card-content">
				<h2 class="card-title title">Histórico</h2>
				<div id="screenshots">
				</div>
		  
			<?php
			require 'database.php';
			if (empty($_SERVER['HTTPS'])) {
				header("Location: https://$_SERVER[HTTP_HOST]");
				exit;
			}

			lista(3);


			?>
			</div>
		</div>
    </div>
</div>
	
  </section>

  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <a class="btn red" target="blank" href="/phpmyadmin">Avançado</a>
		<a class="btn" href="/pesquisa.php">Pesquisar no Histórico</a>
      </p>
    </div>
  </footer>

  <canvas class="is-hidden" id="canvas"></canvas>
  
  <script src="materialize.min.js"></script>
  <script
  src="jquery-3.4.1.min.js"></script>
  <script src="script.js"></script>
</body>

</html>