<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesquisa Visitante</title>
  <link rel="stylesheet" href="bulma.min.css">
  <link rel="stylesheet" href="materialize.min.css">
  <script defer src="all.js"></script>
</head>

<body>

  <section class="section">
  
<div class="container">
	<div class="card ">
		<div class="card-content">
		
		<h1 class="card-title title">Consulta de Visitantes</h1>
							  
			<div class="row">

				  <div class="col s8">
					  <div class="input-field col s7">
						  <input placeholder="Pesquise Nome, CPF ou Placa" id="termo" type="text" class="validate">
						  <label for="nome">Pesquise Nome, CPF, data ou Placa</label>
					  </div>
				  </div>

		  
			</div>
		</div>

	</div>
	<div class="row">
		<div class="card ">
			<div class="card-content">
				<h2 class="card-title title">Resultado da Busca</h2>
				<div id="relatorio">
				</div>
			</div>
		</div>
    </div>
</div>
	
  </section>

  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <a class="btn" href="/index.php">Voltar</a>
      </p>
    </div>
  </footer>

  <canvas class="is-hidden" id="canvas"></canvas>
  
  <script src="materialize.min.js"></script>
  <script
  src="jquery-3.4.1.min.js"></script>
  <script src="pesquisa.js"></script>
</body>

</html>