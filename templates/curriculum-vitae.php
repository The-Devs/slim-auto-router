<html>
    <head>
		<?php //call_analytics(); ?>
		<?php call_default(); ?>
        <link rel="shortcut icon" href="<?php echo IMAGES_PATH; ?>logo.png" type="image/png">

        <title>The Devs - Enrique René</title>

		<link rel="stylesheet" href="<?php echo STYLES_PATH; ?>curriculum-vitae.css" />
		
		<script>
			function setAnchor ( ev ) {
				const id = ev.getAttribute( "name" );
				window.location.hash = id;
			}
		</script>
    </head>
    <body class="d-flex">

        <aside class="bg-secondary p-3">
            <figure class="p-3 m-auto text-center">
                <img
                    src="<?php echo IMAGES_PATH . $user; ?>.jpg"
                    alt=""
					class="mw-100 rounded-circle m-auto"
					width="120"
                />
            </figure>

            <ul class="list-unstyled">
                <li class="pr-2 py-2 d-flex" name="apresentacao" onClick="setAnchor( this )">
					<span class="px-3 py-1 my-auto">
						<i class="fas fa-male"></i>
					</span>
                    <div class="content">
                        <div class="header">
                            Apresentação
                        </div>
                        <div class="description">Um pouco sobre mim.</div>
                    </div>
				</li>
                <li class="p-1 py-2 d-flex" name="portfolio" onClick="setAnchor( this )">
					<span class="p-1 my-auto">
						<i class="far fa-images"></i>
					</span>
                    <div class="content">
                        <div class="header">
                            Portfólio
                        </div>
                        <div class="description">Trabalhos que participei.</div>
                    </div>
				</li>
                <li class="p-1 py-2 d-flex" name="contribuicoes" onClick="setAnchor( this )">
					<span class="p-1 my-auto">
						<i class="far fa-handshake"></i>
					</span>
                    <div class="content">
                        <div class="header">
                            Contribuições
                        </div>
                        <div class="description">Feito para a comunidade.</div>
                    </div>
				</li>
                <li class="p-1 py-2 d-flex" name="interesses" onClick="setAnchor( this )">
					<span class="p-1 my-auto">
						<i class="fas fa-heartbeat"></i>
					</span>
                    <div class="content">
                        <div class="header">
                            Interesses
                        </div>
                        <div class="description">Interesses principais.</div>
                    </div>
				</li>
                <li class="p-1 py-2 d-flex" name="contato" onClick="setAnchor( this )">
					<span class="p-1 my-auto">
						<i class="far fa-comments"></i>
					</span>
                    <div class="content">
                        <div class="header">
                            Contato
                        </div>
                        <div class="description">Canais para contato.</div>
                    </div>
				</li>
            </ul>
        </aside>

        <main class="container">

            <section id="apresentacao" class="row">
				<div class="col-12 p-5">
					<div class="mw-sm m-auto">
						<h2 class="my-4">
							<i class="male large icon"></i>
							<span class="content border-bottom border-primary text-primary">
								Aprensetação
							</span>
						</h2>
						<div>
							<p class="text-muted text-justify my-5">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. In turpis ex, varius quis bibendum malesuada, hendrerit nec arcu. Ut ut magna vitae magna tempus finibus in nec dolor. Donec a neque nulla. Integer id interdum magna, in facilisis purus. Quisque rutrum hendrerit faucibus. Phasellus nec euismod tortor. In in ante et tortor maximus ultricies. Fusce velit ligula, viverra commodo malesuada et, maximus et ipsum. Nullam sed nibh vitae est euismod imperdiet quis quis risus. Etiam tristique, quam nec molestie tempor, elit magna dictum nulla, a vehicula neque felis quis lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
							</p>
							<p class="text-muted text-justify my-5">
								Donec a neque nulla. Integer id interdum magna, in facilisis purus. Quisque rutrum hendrerit faucibus. Phasellus nec euismod tortor. In in ante et tortor maximus ultricies. Fusce velit ligula, viverra commodo malesuada et, maximus et ipsum.
							</p>
						</div>
					</div>
				</div>
			</section>
			
			<section id="portfolio" class="row">
				<div class="col-12 p-5">
					<div class="mw-sm m-auto">
						<h2 class="my-4">
							<i class="male large icon"></i>
							<span class="content border-bottom border-primary text-primary">
								Portfólio
							</span>
						</h2>
						<div>
							<p class="text-muted text-justify my-5">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. In turpis ex, varius quis bibendum malesuada, hendrerit nec arcu. Ut ut magna vitae magna tempus finibus in nec dolor. Donec a neque nulla.
							</p>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex">
									<span class="px-3 py-1 my-auto">
										<img
											src="<?php echo IMAGES_PATH; ?>logo.png"
											width="50"
										/>
									</span>
									<div class="content">
										<div class="header">
											The Devs - Desenvolvedor Web
										</div>
										<div class="description">Donec a neque nulla. Integer id interdum magna, in facilisis purus. Quisque rutrum hendrerit faucibus. <a href="/" target="_blank" rel="noopener noreferrer">Saiba mais</a>.</div>
									</div>
								</li>
								<li class="list-group-item d-flex">
									<span class="px-3 py-1 my-auto">
										<img
											src="<?php echo IMAGES_PATH; ?>novap.logo.png"
											width="50"
										/>
									</span>
									<div class="content">
										<div class="header">
											Novo Aprendizado - Desenvolvedor Web
										</div>
										<div class="description">Donec a neque nulla. Integer id interdum magna, in facilisis purus. Quisque rutrum hendrerit faucibus. <a href="http://novoaprendizado.com.br" target="_blank" rel="noopener noreferrer">Saiba mais</a>.</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			
			<section id="contribuicoes" class="row">
				<div class="col-12 p-5">
					<div class="mw-sm m-auto">
						<h2 class="my-4">
							<i class="male large icon"></i>
							<span class="content border-bottom border-primary text-primary">
								Contribuições
							</span>
						</h2>
						<div>
							<p class="text-muted text-justify my-5">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. In turpis ex, varius quis bibendum malesuada, hendrerit nec arcu. Ut ut magna vitae magna tempus finibus in nec dolor. Donec a neque nulla. Integer id interdum magna, in facilisis purus.
							</p>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex">
									<span class="px-3 py-1 my-auto">
										<img
											src="<?php echo IMAGES_PATH; ?>logo.png"
											width="50"
										/>
									</span>
									<div class="content">
										<div class="header">
											The Devs
										</div>
										<div class="description">Tutor em programação. The Devs funciona como preparatório para a profissão no desenvolvimento web. <a href="/" target="_blank" rel="noopener noreferrer">Saiba mais</a>.</div>
									</div>
								</li>
								<li class="list-group-item d-flex">
									<span class="px-3 py-1 my-auto">
										<img
											src="<?php echo IMAGES_PATH; ?>novap.logo.png"
											width="50"
										/>
									</span>
									<div class="content">
										<div class="header">
											Novo Aprendizado
										</div>
										<div class="description">Conhecimento escolar fora da escola. Conteúdo disponibilizado no GitHub, Instagram, Google Fotos e web site. <a href="http://novoaprendizado.com.br" target="_blank" rel="noopener noreferrer">Saiba mais</a>.</div>
									</div>
								</li>
								<li class="list-group-item d-flex">
									<span class="px-3 py-1 my-auto">
										<i class="fab fa-2x fa-github"></i>
									</span>
									<div class="content ml-3">
										<div class="header">
											GitHub
										</div>
										<div class="description">Desenvolvimentos importantes para melhoria da produtividade ou com objetivo didático são disponibilizados no GitHub. <a href="https://github.com/enriquerene" target="_blank" rel="noopener noreferrer">Saiba mais</a>.</div>
									</div>
								</li>
								<li class="list-group-item d-flex">
									<span class="px-3 py-1 my-auto text-warning">
										<i class="fab fa-2x fa-stack-overflow"></i>
									</span>
									<div class="content ml-3">
										<div class="header">
											Stack Overflow
										</div>
										<div class="description">Fórum de dúvidas, respostas e discussões na área de desenvolvimento de software. <a href="https://stackoverflow.com/users/5382576/enrique-ren%c3%a9" target="_blank" rel="noopener noreferrer">Saiba mais</a>.</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<section id="interesses" class="row">
				<div class="col-12 p-5">
					<div class="mw-sm m-auto">
						<h2 class="my-4">
							<i class="male large icon"></i>
							<span class="content border-bottom border-primary text-primary">
								Interesses
							</span>
						</h2>
						<div>
							<p class="text-muted text-justify my-5">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. In turpis ex, varius quis bibendum malesuada, hendrerit nec arcu. Ut ut magna vitae magna tempus finibus in nec dolor. Donec a neque nulla. Integer id interdum magna, in facilisis purus. Quisque rutrum hendrerit faucibus. Phasellus nec euismod tortor. In in ante et tortor maximus ultricies. Fusce velit ligula, viverra commodo malesuada et, maximus et ipsum. Nullam sed nibh vitae est euismod imperdiet quis quis risus. Etiam tristique, quam nec molestie tempor, elit magna dictum nulla, a vehicula neque felis quis lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
							</p>
							<p class="text-muted text-justify my-5">
								Donec a neque nulla. Integer id interdum magna, in facilisis purus. Quisque rutrum hendrerit faucibus. Phasellus nec euismod tortor. In in ante et tortor maximus ultricies. Fusce velit ligula, viverra commodo malesuada et, maximus et ipsum.
							</p>
						</div>
					</div>
				</div>
			</section>

			<section id="contato" class="row">
				<div class="col-12 p-5">
					<div class="mw-sm m-auto">
						<h2 class="my-4">
							<i class="male large icon"></i>
							<span class="content border-bottom border-primary text-primary">
								Contato
							</span>
						</h2>
						<div>
							<form action="" method="post"></form>
							<p class="text-muted text-justify my-5">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. In turpis ex, varius quis bibendum malesuada, hendrerit nec arcu. Ut ut magna vitae magna tempus finibus in nec dolor. Donec a neque nulla. Integer id interdum magna, in facilisis purus. Quisque rutrum hendrerit faucibus. Phasellus nec euismod tortor. In in ante et tortor maximus ultricies. Fusce velit ligula, viverra commodo malesuada et, maximus et ipsum. Nullam sed nibh vitae est euismod imperdiet quis quis risus. Etiam tristique, quam nec molestie tempor, elit magna dictum nulla, a vehicula neque felis quis lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
							</p>
							<ul class="list-unstyled d-flex justify-content-center m-auto">
								<li class="p-3">
									<a href="" class="d-block">
										<i class="fab fa-2x fa-github"></i>
									</a>
								</li>
								<li class="p-3">
									<a href="" class="d-block">
										<i class="fab fa-2x fa-stack-overflow"></i>
									</a>
								</li>
								<li class="p-3">
									<a href="" class="d-block">
										<i class="fab fa-2x fa-whatsapp"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>

        </main>

		<script>
			document.querySelector( "main" ).style.maxHeight = document.body.clientHeight + "px";
		</script>
    </body>
</html>