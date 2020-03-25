<!DOCTYPE html>
<html lang="pt-br">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>The Devs - Desenvolvimento de Software</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo STYLES_PATH; ?>bootstrap.min.css" rel="stylesheet">

	<!-- Custom fonts for this template -->
	<script src="https://kit.fontawesome.com/e1df53984c.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<!-- Custom styles for this template -->
	<link href="<?php echo STYLES_PATH; ?>landing-page.css" rel="stylesheet">

	<script>
		let last_known_scroll_position = 0;
		let ticking = false;

		function handleClasses ( node, className = null ) {
			node.classList.remove( "bg-grad-white-100" );
			node.classList.remove( "bg-grad-white-90" );
			node.classList.remove( "bg-grad-white-80" );
			node.classList.remove( "bg-grad-white-70" );
			node.classList.remove( "bg-grad-white-60" );
			node.classList.remove( "bg-grad-white-50" );
			node.classList.remove( "bg-grad-white-40" );
			node.classList.remove( "bg-grad-white-30" );
			node.classList.remove( "bg-grad-white-20" );
			node.classList.remove( "bg-grad-white-10" );
			node.classList.remove( "bg-white" );
			if ( className ) {
				node.classList.add( className );
			}
		} 

		function doSomething(scroll_pos) {
			let nav = document.querySelector( "nav" );
			if ( scroll_pos < 56 ) {
				handleClasses( nav );
			}
			else if ( scroll_pos >= 56 && scroll_pos < 112 ) {
				handleClasses( nav, "bg-grad-white-10" );
			}
			else if ( scroll_pos >= 112 && scroll_pos < 168 ) {
				handleClasses( nav, "bg-grad-white-20" );
			}
			else if ( scroll_pos >= 168 && scroll_pos < 224 ) {
				handleClasses( nav, "bg-grad-white-30" );
			}
			else if ( scroll_pos >= 224 && scroll_pos < 280 ) {
				handleClasses( nav, "bg-grad-white-40" );
			}
			else if ( scroll_pos >= 280 && scroll_pos < 336 ) {
				handleClasses( nav, "bg-grad-white-50" );
			}
			else if ( scroll_pos >= 336 && scroll_pos < 392 ) {
				handleClasses( nav, "bg-grad-white-60" );
			}
			else if ( scroll_pos >= 392 && scroll_pos < 448 ) {
				handleClasses( nav, "bg-grad-white-70" );
			}
			else if ( scroll_pos >= 448 && scroll_pos < 504 ) {
				handleClasses( nav, "bg-grad-white-80" );
			}
			else if ( scroll_pos >= 504 && scroll_pos < 504 ) {
				handleClasses( nav, "bg-grad-white-90" );
			}
			else if ( scroll_pos >= 504 && scroll_pos < 560 ) {
				handleClasses( nav, "bg-grad-white-100" );
			}
			else if ( scroll_pos >= 600 ) {
				handleClasses( nav, "bg-white" );
			}
		}

		window.addEventListener('scroll', function(e) {
		last_known_scroll_position = window.scrollY;
		if (!ticking) {
			window.requestAnimationFrame(function() {
			doSomething(last_known_scroll_position);
			ticking = false;
			});
		}
		ticking = true;
		});
	</script>
</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-light fixed-top">
		<div class="container">
			<div class="d-flex flex-row w-100">
				<figure class="my-auto mr-auto d-none d-sm-block">
					<img 
						src="<?php echo IMAGES_PATH; ?>logo.png"
						width="80"
						alt="The Devs - Desenvolvimento de Software"
						title="The Devs - Desenvolvimento de Software"
					/>
				</figure>

				<!-- vue -->
				<form action="https://thedevs.com.br/mailer" class="my-auto">
					<label class="my-auto">
						<small class="text-muted">
							Serviço
						</small>
						<select class="form-control form-control-sm" name="service" id="">
							<option value="Site Institucional">Site Institucional</option>
							<option value="Loja Virtual">Loja Virtual</option>
							<option value="Aplicativo Mobile">Aplicativo Mobile</option>
							<option value="Identidade Digital">Identidade Digital</option>
							<option value="Promover Marca">Promover Marca</option>
							<option value="Desenvolver Sistema">Desenvolver Sistema</option>
						</select>
					</label>
					<label class="my-auto">
						<small class="text-muted">
							Email
						</small>
						<input type="email" class="form-control form-control-sm" placeholder="Seu email aqui..." />
					</label>
					<div class="my-2">
						<button class="btn btn-block btn-sm btn-primary">Conheça nossas propostas comerciais</button>
					</div>
				</form>
			</div>
		</div>
	</nav>

	<!-- Masthead -->
	<header class="masthead text-white text-center mh-hero">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-12 mx-auto">
					<h1 class="td-hero">
						<small class="">
							Desenvolvimento de
						</small>
						<br />
						<span class="text-uppercase">
							Software
						</span>
					</h1>
					<p class="mb-5 mt-3 mw-xs text-justify mx-auto">
						Criação de Logo, Site, eCommerce, Sistema Interno, Aplicativo Mobile, Aplicativo Desktop, Aplicativo Web, Web Service, Integração de Sistemas, Banco de Dados, Análise Estatística, Estatística Computacional, Alta Performance, Automação de Processos.
					</p>
				</div>
				<!--div class="col-12">
					<div class="d-flex flex-column flex-sm-row justify-content-center">
						<div class="my-auto px-sm-1">
							<a href="https://www.facebook.com/thefulldevs/" class="btn btn-block btn-lg btn-primary" target="_blank">
								<span>
									<i class="fab fa-facebook-messenger"></i>
								</span>
								<span class="mx-1">
									Contato por Facebook
								</span>
							</a>
						</div>
						<div class="py-2 px-sm-1 my-auto">
							<a href="https://wa.me/+5521964470631/?text=Oi.%20Vi%20esse%20contato%20na%20The%20Devs%20-%20Desenvolvimento%20de%20Software.%20https%3A%2F%2Fthedevs.com.br" class="btn btn-block btn-lg btn-success">
								<span>
									<i class="fas fa-whatsapp"></i>
								</span>
								<span class="mx-1">
									Contato por WhatsApp
								</span>
							</a>
						</div>
					</div>
				</div-->
			</div>
		</div>
	</header>

	<!-- Icons Grid -->
	<section class="features-icons bg-light text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<div class="features-icons-item mx-auto my-3">
						<div class="features-icons-icon d-flex">
							<i class="fas fa-fingerprint m-auto text-primary"></i>
						</div>
						<h3>Identidade Digital</h3>
						<p class="lead mb-0">Desenvolvimento de Logo Marca, paleta de cores para identificar sua marca apenas ao passar dos olhos.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="features-icons-item mx-auto my-3">
						<div class="features-icons-icon d-flex">
							<i class="fas fa-share-alt m-auto text-primary"></i>
						</div>
						<h3>Mídia Social</h3>
						<p class="lead mb-0">Promoção nas redes sociais, gereniamento e desenvolvimento de artes e vídeos para divulgação.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="features-icons-item mx-auto my-3">
						<div class="features-icons-icon d-flex">
							<i class="fas fa-layer-group m-auto text-primary"></i>
						</div>
						<h3>Módulo a Módulo</h3>
						<p class="lead mb-0">Desenvolvimento em módulos de fácil manutenção, acompanhando sua empresa passo a passo.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="features-icons-item mx-auto my-3">
						<div class="features-icons-icon d-flex">
							<i class="fas fa-credit-card m-auto text-primary"></i>
						</div>
						<h3>eCommerce</h3>
						<p class="lead mb-0">Adicione módulo de pagamento online ao seu site ou aplicativo. Agilize sua vida financeira.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="features-icons-item mx-auto my-3">
						<div class="features-icons-icon d-flex">
							<i class="fas fa-wifi m-auto text-primary"></i>
						</div>
						<h3>Sistemas Web</h3>
						<p class="lead mb-0">Seu negócio acessível em qualquer dispositivo, em qualquer lugar a qualquer hora.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="features-icons-item mx-auto my-3">
						<div class="features-icons-icon d-flex">
							<i class="fas fa-mobile-alt m-auto text-primary"></i>
						</div>
						<h3>Para Mobile</h3>
						<p class="lead mb-0">Sua marca no bolso das pessoas. Mantenha contato com seu cliente pelo dispositvo mais utilizado hoje.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Image Showcases -->
	<section id="portfolio" class="showcase">
		<div class="container-fluid p-0">
			<div class="row bg-light">
				<div class="col-12">
					<h2 class="text-center my-4 py-3">
						Trabalhos em destaque
					</h2>
				</div>
			</div>
			<!--div class="row no-gutters bg-grad-gray-blue">
				<div 
					class="col-lg-6 order-lg-2 text-white showcase-img" 
				>
					<a
						href="admin-app/"
						class="m-auto"
					>
						<img
							src="<?php echo IMAGES_PATH; ?>localsystem.png"
							alt="Sistema Administrativo"
							class="mw-100"
						/>
					</a>
				</div>
				<div class="col-lg-6 order-lg-1 my-auto showcase-text">
					<h2>Sistema Administrativo</h2>
					<p class="lead mb-0">
						Nada melhor do que ao precisar de uma informação ela estar disponível ali ao clique do mouse... 5 segundos e a informação está toda lá. Você não fica esperando dados carregarem, não perde o foco do que está fazendo por conta da espera e o trabalho flui bem melhor. Eleve a produtividade da sua empresa com um sistema administrativo <a href="admin-app/" >(experimente clicando aqui)</a>.
					</p>
				</div>
			</div-->
			<div class="row no-gutters py-4">
				<div 
					class="col-lg-6 order-lg-2 text-white showcase-img" 
				>
					<a href="https://luzcamerapet.com.br" target="_blank">
						<img
							src="<?php echo IMAGES_PATH; ?>luz-camera-pet-ampliado.jpg"
							alt="Luz, Câmera, Pet!"
							class="mw-100"
						/>
					</a>
				</div>
				<div class="col-lg-6 order-lg-1 my-auto showcase-text">
					<h2>Design Destacando Imagens</h2>
					<p class="lead mb-0">
						Uma imagem fala mais que mil palavras. Melhor forma de capturar os olhos de alguém é com uma imagem bem bonita, chamativa, que represente seu negócio e valorize a qualidade dos seus serviços e produtos. Ideal para apresentar o seu negócio e causar uma boa primeira impressão. Visite o site <a href="https://luzcamerapet.com.br" target="_blank" rel="noopener noreferrer">Luz, Câmera, Pet!</a> para ver um exemplo de site institucional.
					</p>
				</div>
			</div>
			<div class="row no-gutters py-4" style="background-color: #EEEEEE;">
				<div 
					class="col-lg-6 text-white" 
				>
					<a href="https://play.google.com/store/apps/details?id=br.com.lavajatoautofacil" target="_blank">
						<img
							src="<?php echo IMAGES_PATH; ?>lavajato-autofacil.jpg"
							alt="Lavajato Auto Fácil"
							class="mw-100 showcase-img"
						/>
					</a>
				</div>
				<div class="col-lg-6 my-auto showcase-text">
					<h2>Aplicativo Mobile</h2>
					<p class="lead mb-0">Certos modelos de negócio se encaixam melhor em um aplicativo mobile do que em um site. É o caso da <a href="https://play.google.com/store/apps/details?id=br.com.lavajatoautofacil" target="_blank" rel="noopener noreferrer">Lava Jato Auto Fácil</a>. A tecnologia principal é o aplicativo para smartphones <small><a href="https://play.google.com/store/apps/details?id=br.com.lavajatoautofacil" target="_blank" rel="noopener noreferrer">(ver app)</a></small> e um site para apresentação do aplicativo e da empresa <small><a href="https://lavajatoautofacil.com.br" target="_blank" rel="noopener noreferrer">(ver site)</a></small></p>
				</div>
			</div>
			<div class="row no-gutters py-4">
				<div 
					class="col-lg-6 text-white" 
				>
					<a href="https://play.google.com/store/apps/details?id=br.com.lavajatoautofacil" target="_blank">
						<img
							src="<?php echo IMAGES_PATH; ?>brigidos.jpg"
							alt="Brigidos Construção Inovadora"
							class="mw-100 showcase-img"
						/>
					</a>
				</div>
				<div class="col-lg-6 my-auto showcase-text">
					<h2>eCommerce</h2>
					<p class="lead mb-0">eCommerces permitem pagamentos online, por boleto, cartão de crédito ou débito. <a href="https://brigidos.com.br" target="_blank" rel="noopener noreferrer">Brigido's</a> traz esse conceito com um módulo de autorização de pedidos. Antes de um pedido ser efetivado de fato, ele é redirecionado para um setor de vendas que entra em contato por telefone ou whatsapp com o cliente para completar o registro do pedido. Essa estratégia permite uma venda ativa por parte da empresa, um diálogo direto com o cliente apresentando a imagem de uma venda segura em uma empresa comprometida em servir.</p>
				</div>
			</div>
			<div class="row no-gutters bg-whatsapp-section text-white py-5">
				<div 
					class="col-12 py-5 text-center"
				>
					<h2>
						Vamos falar de negócios?
					</h2>
					<p class="my-5 mx-auto mw-xs p-2">
						Tire suas dúvidas, faça uma consulta sem compromisso. Preencha o formulário na barra de topo ou entre em contato via whatsapp.
					</p>
					<div>
						<a
							href="https://wa.me/+5521964470631/?text=Oi.%20Vi%20esse%20contato%20na%20The%20Devs%20-%20Desenvolvimento%20de%20Software.%20https%3A%2F%2Fthedevs.com.br"
							target="_blank"
							class="btn btn-lg btn-success"
						>
							<span>
								<i class="fab fa-whatsapp"></i>
							</span>
							<span class="mx-1">
								Entre em contato agora!
							</span>
						</a>
						<p>
							<small>21 9 6447 0631</small>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Testimonials -->
	<section id="equipe" class="testimonials text-center bg-light">
		<div class="container">
			<h2 class="mb-5">Conheça a Equipe</h2>
			<div class="row">
				<div class="col-md-6 p-2">
					<div class="testimonial-item mx-auto my-5 mb-lg-0">
						<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>enriquerene.jpg" alt="Enrique René">
						<h5>
							Enrique René
							<br />
							<small class="text-muted">Desenvolvedor Full Stack</small>
						</h5>
						<p class="font-weight-light my-3">Bacharel em Física capaz de modelar matematicamente regras de negócio. Confortável em lidar com tratamentos estatísticos e análises gráficas. Desenvolvimento para Desktop, Web e Mobile.</p>
					</div>
				</div>
				<div class="col-md-6 p-2">
					<div class="testimonial-item mx-auto my-5 mb-lg-0">
						<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>yagogomes.jpg" alt="Yago Gomes">
						<h5>
							Yago Gomes
							<br />
							<small class="text-muted">Game Developer</small>
						</h5>
						<p class="font-weight-light my-3">Experiente em análise de jogos, seu interesse principal é o desenvolvimento de jogos estilo MMORPG. Facilidade em enxergar padrões e capaz de programá-los de forma ágil. Configuração de servidores para jogos.</p>
					</div>
				</div>
				<div class="col-md-6 p-2">
					<div class="testimonial-item mx-auto my-5 mb-lg-0">
						<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>gabrielcarocha.jpg" alt="Gabriel Carocha">
						<h5>
							Gabriel Carocha
							<br />
							<small class="text-muted">Desenvolvedor Frontend</small>
						</h5>
						<p class="font-weight-light my-3">Foco no visual, trabalha principalmente no desenvolvimento UI e UX apoiado sobre sua criatividade e ampla visão de negócio. Capaz de traduzir aspectos comerciais em componentes atrativos na tela. Seu interesse principal é o desenvolvimento Frontend.</p>
					</div>
				</div>
				<div class="col-md-6 p-2">
					<div class="testimonial-item mx-auto my-5 mb-lg-0">
						<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>gabrielbeauxis.jpg" alt="Gabriel Beauxis">
						<h5>
							Gabriel Beauxis
							<br />
							<small class="text-muted">Designer Gráfico e Mídia Social</small>
						</h5>
						<p class="font-weight-light my-3">Criatividade e olhar aguçado aos detalhes o fazem capaz de criar belas artes e vídeos para apresentação e divulgação de projetos. Seu entendimento das redes sociais permitem um forte impulsionamento para a visibilidade do negócio.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Call to Action -->
	<section class="text-white text-center bg-opensource py-5">
		<div class="overlay"></div>
		<div class="container my-5">
			<div class="row">
				<div class="col-12 mx-auto">
					<h2 class="mb-4">Projetos OpenSource</h2>
				</div>
				<div class="col-12 mx-auto">
					<p class="text-center mw-xs mx-auto">
						Se você é um desenvolvedor ou quer iniciar uma carreira na programação, The Devs disponibiliza projetos utilitários para desenvolvimento.
					</p>
					<a href="https://github.com/The-Devs/" class="btn btn-lg btn-outline-info my-3" target="_blank">
						<span>
							<i class="fas fa-github"></i>
						</span>
						<span class="mx-1">
							Visitar repositórios
						</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<?php call_footer(); ?>

</body>

</html>
