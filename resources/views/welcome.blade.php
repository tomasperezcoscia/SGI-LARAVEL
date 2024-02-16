<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BasisConstrucciones') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Scripts -->
    <link rel="stylesheet" href="/SGI-LARAVEL/public/build/assets/app-lhA9k1qk.css">
    <script src="/SGI-LARAVEL/public/build/assets/app-Sy-x52Gu.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



</head>

<body>
    <style>
        .gallery-image {
            transition: transform 0.7s ease-in-out, box-shadow 0.7s ease-in-out;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(0.9);
        }

        .gallery-image:hover {
            transform: scale(1.1);
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.7);
        }

        p {
            font-size: 1.2rem;
        }
    </style>



    <!-- Hero Image with Title -->
    <div class="jumbotron text-center" style="position: relative; height: 500px;">
        <div
            style="position: absolute; top: 0; left: -15%; width: 70%; height: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 1; margin-left: 30%">
        </div>
        <h1 class="display-4"
            style="position: absolute; top: 50%; left: 60%; transform: translate(-50%, -50%); z-index: 2; font-size: 4.4rem; color: white; font-family: 'Arial', sans-serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
            Basis Construcciones S.R.L</h1>
        <img src="/SGI-LARAVEL/public/img/logo.svg" alt="logo" class="img-fluid"
            style="position: absolute; top: 47%; left: 28%; transform: translate(-50%, -50%); z-index: 2; width: 250px;">
        <img src="/SGI-LARAVEL/public/img/hero.jpeg" alt="Construction Hero Image" class="img-fluid"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; padding-left: 15%; padding-right: 15%">
    </div>

    <!-- Description Section -->
    <div class="container my-5">
        <h2>Acerca de <strong>Basis Construcciones</strong></h2>
        <p><strong>Basis Construcciones S.R.L</strong> es una empresa constructora radicada en <em>Olavarría, Argentina</em>. Nos especializamos
            en la construcción tanto de edificios como de instalaciones industriales, ofreciendo soluciones integrales
            para proyectos de gran envergadura en ambos sectores. Nuestro compromiso con la excelencia y la calidad nos
            ha permitido consolidarnos como líderes en el mercado local.</p>

        <p>Contamos con un equipo altamente capacitado de ingenieros, arquitectos y técnicos especializados que
            garantizan la ejecución eficiente y precisa de cada proyecto. Desde la planificación inicial hasta la
            entrega final, nos comprometemos a brindar un servicio personalizado, adaptado a las necesidades y
            requerimientos específicos de cada cliente.</p>

        <p>Nuestra experiencia abarca una amplia gama de proyectos, incluyendo la construcción de edificios
            residenciales, comerciales, de oficinas, así como también la construcción de naves industriales, plantas de
            producción, almacenes, centros logísticos y más. Trabajamos en estrecha colaboración con nuestros clientes
            para asegurarnos de cumplir con sus expectativas y superar sus objetivos en ambos ámbitos.</p>

        <p>Además de nuestra experiencia en la construcción de edificios e instalaciones industriales, también ofrecemos
            servicios complementarios, como diseño arquitectónico, planificación urbana y gestión de proyectos,
            brindando soluciones innovadoras y de calidad para proyectos de cualquier escala en ambos sectores.</p>

        <p>En <strong>Basis Construcciones S.R.L</strong>, nos enorgullece nuestro compromiso con la <em>seguridad</em>, la <em>sustentabilidad</em> y la
            <em>responsabilidad social</em> en todas nuestras operaciones. Valoramos la confianza que nuestros clientes depositan
            en nosotros y nos esforzamos por mantener los más altos estándares de profesionalismo y ética en todo
            momento.</p>
    </div>









    <!-- Gallery Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipMQN9YT2WPLEeo4xre9NB5YqEGqWdm7C5d0LRKd"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipMQN9YT2WPLEeo4xre9NB5YqEGqWdm7C5d0LRKd=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipMQN9YT2WPLEeo4xre9NB5YqEGqWdm7C5d0LRKd=w240-h240-n-o-v1"
                            data-atf="false" data-iml="976">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipNDfhMl6IHIHi3VE1QVQa8ureNHaqAiFM-b7S44"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipNDfhMl6IHIHi3VE1QVQa8ureNHaqAiFM-b7S44=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipNDfhMl6IHIHi3VE1QVQa8ureNHaqAiFM-b7S44=w240-h240-n-o-v1"
                            data-atf="true" data-iml="930">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipMMz4YyDAR07SBl8dpCpZqwntg3ejHbt_IRPeYZ"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipMMz4YyDAR07SBl8dpCpZqwntg3ejHbt_IRPeYZ=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipMMz4YyDAR07SBl8dpCpZqwntg3ejHbt_IRPeYZ=w240-h240-n-o-v1"
                            data-atf="true" data-iml="896">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipMjtupDP2WfBzW3qoQvUrP3jDm4BnHnuqAS4Wrc"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipMjtupDP2WfBzW3qoQvUrP3jDm4BnHnuqAS4Wrc=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipMjtupDP2WfBzW3qoQvUrP3jDm4BnHnuqAS4Wrc=w240-h240-n-o-v1"
                            data-atf="false" data-iml="896">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipMZAmKzTM7jI_hgnSaILaFEgXhOnuPwP1q7asrw"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipMZAmKzTM7jI_hgnSaILaFEgXhOnuPwP1q7asrw=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipMZAmKzTM7jI_hgnSaILaFEgXhOnuPwP1q7asrw=w240-h240-n-o-v1"
                            data-atf="false" data-iml="967">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipP-Gly3rwuplsMPzy2uQqnC3MpWOwrAQ7X0-POP"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipP-Gly3rwuplsMPzy2uQqnC3MpWOwrAQ7X0-POP=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipP-Gly3rwuplsMPzy2uQqnC3MpWOwrAQ7X0-POP=w240-h240-n-o-v1"
                            data-atf="false" data-iml="967">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipNXE3BkafpzbPoOMEvY5_D0t81rRIpSuaERKFCm"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipNXE3BkafpzbPoOMEvY5_D0t81rRIpSuaERKFCm=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipNXE3BkafpzbPoOMEvY5_D0t81rRIpSuaERKFCm=w240-h240-n-o-v1"
                            data-atf="false" data-iml="981">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipOcJNvaaHl-uuUy6JONsevNxbeapjO6Jr7CRoSB"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipOcJNvaaHl-uuUy6JONsevNxbeapjO6Jr7CRoSB=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipOcJNvaaHl-uuUy6JONsevNxbeapjO6Jr7CRoSB=w240-h240-n-o-v1"
                            data-atf="false" data-iml="972">
                    </picture>
                </a></div>
            <div class="col-md-4 col-sm-6"><a
                    href="//www.google.com/maps/uv?pb=!1s0x9594459c39335fad:0x51a76e1e9aaaa3ec!3m1!7e131!4s!5sConstrucción&amp;hl=es-419&amp;imagekey=!1e10!2sAF1QipPPZghywDVdfDmjoXilRFIxpjvPnbLCSbkbrTJr"
                    target="_blank">
                    <picture aria-label="Foto de la empresa">
                        <source media="(min-width: 768px)"
                            srcset="https://lh3.googleusercontent.com/p/AF1QipPPZghywDVdfDmjoXilRFIxpjvPnbLCSbkbrTJr=w480-h480-n-o-v1">
                        <img class="gallery-image"
                            src="https://lh3.googleusercontent.com/p/AF1QipPPZghywDVdfDmjoXilRFIxpjvPnbLCSbkbrTJr=w240-h240-n-o-v1"
                            data-atf="false" data-iml="927">
                    </picture>
                </a></div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="container my-5">
        <div id="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3191.254340538564!2d-60.321942!3d-36.8842633!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sar!4v1708050603381!5m2!1ses-419!2sar"
                width="1300" height="600" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="container my-5">
        <h2>Contactanos</h2>
        <form class="mx-auto px-4">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="message">Mensaje</label>
                <textarea class="form-control" id="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>
