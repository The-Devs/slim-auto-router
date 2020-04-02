<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php call_analytics(); ?>
	<?php call_default(); ?>
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo IMAGES_PATH; ?>logo.png" type="image/png">

	<title>The Devs - Desenvolvimento de Software</title>

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

				<form action="/mailer" method="POST" class="my-auto">
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
				<div class="col-12">
					<div class="d-flex flex-column flex-sm-row justify-content-center">
						<div class="my-auto px-sm-1">
							<a href="#equipe" class="btn btn-block btn-lg btn-outline-info">
								<span>
									<i class="fas fa-users"></i>
								</span>
								<span class="mx-1">
									Quem somos
								</span>
							</a>
						</div>
						<div class="py-2 px-sm-1 my-auto">
							<a href="/utils/" class="btn btn-block btn-lg btn-success">
								<span>
									<i class="fas fa-tools"></i>
								</span>
								<span class="mx-1">
									Utilitários
								</span>
							</a>
						</div>
					</div>
				</div>
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
						Alguns trabalhos
					</h2>
				</div>
			</div>

			<div class="row py-4">
				<div class="col-sm-6 col-md-4 p-5">
					<article class="card h-100">
						<img
							class="card-img-top"
							src="<?php echo IMAGES_PATH; ?>luz-camera-pet-ampliado.jpg"
							alt="Luz, Câmera, Pet!"
						/>
						<div class="card-body">
							<h5 class="card-title">Site</h5>
							<p class="card-text">Apresentação de serviços, portfólio e seção de contato.</p>
							<div class="d-flex">
								<a href="https://luzcamerapet.com.br" target="_blank" class="btn btn-link m-auto">
									<span class="mr-1">
										<i class="fas fa-link"></i>
									</span>
									Visitar site
								</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-sm-6 col-md-4 p-5">
					<article class="card h-100">
						<img
							class="card-img-top"
							src="<?php echo IMAGES_PATH; ?>lavajato-autofacil.jpg"
							alt="Lavajato Auto Fácil"
						/>
						<div class="card-body">
							<h5 class="card-title">Mobile</h5>
							<p class="card-text">Apicativo para dispositivo mais utilizado no dias de hoje.</p>
							<div class="d-flex">
								<a href="https://play.google.com/store/apps/details?id=br.com.lavajatoautofacil" target="_blank" class="btn btn-link m-auto">
									<span class="mr-1">
										<i class="fas fa-link"></i>
									</span>
									Ver na Play Store
								</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-sm-6 col-md-4 p-5">
					<article class="card h-100">
						<img
							class="card-img-top"
							src="<?php echo IMAGES_PATH; ?>artesanatoecologico.jpg"
							alt="Card image cap"
						/>
						<div class="card-body">
							<h5 class="card-title">eCommerce</h5>
							<p class="card-text">Apresentação de produtos e módulos de pagamentos online.</p>
							<div class="d-flex">
								<a href="https://artesanatoecologico.com.br" target="_blank" class="btn btn-link m-auto">
									<span class="mr-1">
										<i class="fas fa-link"></i>
									</span>
									Visitar loja virtual
								</a>
							</div>
						</div>
					</article>
				</div>
			</div>
			
			<div class="row no-gutters bg-whatsapp-section text-white py-5">
				<div 
					class="col-12 py-5 text-center"
				>
					<h2>
						Ferramentas de utilidades
					</h2>
					<p class="my-5 mx-auto mw-xs p-2">
						A The Devs oferece gratuitamente utilitários para uso público. Cada utilitário possui sua descrição e uma breve explicação de como utilizar, o que motiva seu uso, onde aplicar e como pode ser útil no dia a dia. Sinta-se livre para utilizá-las para benefíciar seu negócio, sua comunidade ou a si mesmo. Se beneficiando da utilidade, considere uma doação voluntária para nos ajudar a manter o desenvolvimento e manutenção dos sistemas.
					</p>
					<div class="d-flex flex-column flex-sm-row justify-content-center">
						<div class="p-2">
							<a
								href=""
								target="_blank"
								class="btn btn-lg btn-outline-warning"
							>
								<span>
									<i class="fas fa-hand-holding-heart"></i>
								</span>
								<span class="mx-1">
									Doação voluntária
								</span>
							</a>
						</div>
						<div class="p-2">
							<a
								href="/utils/"
								class="btn btn-lg btn-success"
							>
								<span>
									<i class="fas fa-tools"></i>
								</span>
								<span class="mx-1">
									Listar utilitários
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Testimonials -->
	<section id="equipe" class="testimonials text-center bg-light">
		<div class="container">
			<h2 class="mb-5">Quem Somos</h2>
			<p class="text-muted">
				Devs é um termo utilizado na comunidade de programadores que significa Desenvolvedores(as), vindo do inglês Developers. A The Devs é uma organização de trabalhadores autônomos da área de desenvolvimento de software, identidade visual, design gráfico e publicidade. Desenvolvemos projetos sob demanda e os ganhos são dividos entre os participantes que atuaram no projeto. Desenvolvemos sistemas web e mobile, jogos, servidores, logotipo, sites e lojas virtuais, entre outros tipos de projetos voltados para nossos <a href="/utils/">utilitários públicos</a>. Para desenvolvedores ou para aquelas pessoas que desejam iniciar uma carreira no desenvolvimento web disponibilizamos projetos opensource, basta acessar nossos <a href="https://github.com/The-Devs/" target="_blank">repositórios no GitHub</a>.
			</p>
			<!--div class="">
				<a href="" class="btn btn-link">
					Conheça as pessoas
				</a>
			</div-->
			<div class="row">
				<div class="col-sm-6 col-md-4 px-4 py-3">
					<div class="testimonial-item mx-auto my-2 mb-lg-0">
						<a href="/equipe/enriquerene" class="d-block">
							<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>enriquerene.jpg" alt="Enrique René" width="100">
							<h5>
								Enrique René
								<br />
								<small class="text-muted">Desenvolvedor Web</small>
							</h5>
						</a>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 px-4 py-2">
					<div class="testimonial-item mx-auto my-2 mb-lg-0">
						<a href="/equipe/yagomes" class="d-block">
							<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>yagomes.jpg" alt="Yago Gomes" width="100">
							<h5>
								Yago Gomes
								<br />
								<small class="text-muted">Desenvolvedor de Jogos</small>
							</h5>
						</a>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 px-4 py-2">
					<div class="testimonial-item mx-auto my-2 mb-lg-0">
						<a href="/equipe/gabeauxis" class="d-block">
							<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>gabeauxis.jpg" alt="Gabriel Beauxis" width="100">
							<h5>
								Gabriel Beauxis
								<br />
								<small class="text-muted">Designer Gráfico e Mídia Social</small>
							</h5>
						</a>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 px-4 py-2">
					<div class="testimonial-item mx-auto my-2 mb-lg-0">
						<a href="/equipe/gcarocha" class="d-block">
							<img class="img-fluid rounded-circle mb-3" src="<?php echo IMAGES_PATH; ?>gcarocha.jpg" alt="Gabriel Carocha" width="100">
							<h5>
								Gabriel Carocha
								<br />
								<small class="text-muted">Desenvolvedor Frontend</small>
							</h5>
						</a>
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
						Se você é desenvolvedor(a) ou quer iniciar uma carreira na programação, The Devs disponibiliza projetos utilitários opensource para desenvolvimento.
					</p>
					<a href="https://github.com/The-Devs/" class="btn btn-lg btn-outline-info my-3" target="_blank">
						<span>
							<i class="fab fa-github"></i>
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
