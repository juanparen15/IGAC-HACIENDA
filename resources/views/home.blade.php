<!DOCTYPE HTML>
<html lang="es">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>IGAC -ALCALDIA DE PUERTO BOYACÁ</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/color.css') }}">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <style>
        #suggestions {
            max-height: 250px;
            /* Limita la altura para evitar que sea muy larga */
            overflow-y: auto;
            /* Agrega scroll si hay muchas opciones */
            border: 1px solid #ddd;
            /* Borde sutil */
            background: white;
            /* Fondo blanco */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Sombra para destacar */
            border-radius: 5px;
            /* Bordes redondeados */
            padding: 5px 0;
        }

        #suggestions .suggestion-item {
            padding: 10px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: bold;
            color: #333;
        }

        #suggestions .suggestion-item:hover {
            background: #007bff;
            /* Color de resaltado */
            color: white;
        }
    </style>

</head>

<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="pin"></div>
        <div class="pulse"></div>
    </div>
    <!--loader end-->
    <!-- Main  -->
    <div id="main">
        <!-- header-->
        <header class="main-header dark-header fs-header sticky">
            <div class="header-inner">
                <div class="logo-holder">
                    <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                    <img src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">

                </div>
                <!-- nav-button-wrap-->
                <div class="nav-button-wrap color-bg">
                    <div class="nav-button">
                        <span></span><span></span><span></span>
                    </div>
                </div>
                <!-- nav-button-wrap end-->
                <!--  navigation -->
                <div class="nav-holder main-menu">
                    <nav>
                        <ul>
                            @if (Route::has('login'))
                                <li>
                                    @auth
                                        <a href="{{ url('/admin/edit-profile') }}">Dashboard</a>
                                    @else
                                        <a href="{{ route('register') }}">Registro</a>
                                    </li>
                                    <li>
                                        @if (Route::has('login'))
                                            <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Iniciar
                                                Sesión</a>
                                        @endif
                                    </li>
                                @endauth
                            @endif
                        </ul>
                    </nav>
                </div>
                <!-- navigation  end -->
            </div>
        </header>
        <!--  header end -->
        <!-- wrapper -->
        <div id="wrapper">
            <!-- Content-->
            <div class="content">
                <!--section -->
                <section class="scroll-con-sec hero-section" data-scrollax-parent="true" id="sec1">
                    <div class="media-container video-parallax" data-scrollax="properties: { translateY: '200px' }">
                        {{-- <div class="bg mob-bg" style="background-image: url(assets/images/bg/1.png)"></div> --}}
                        {{-- <div class="bg mob-bg"><img src="assets/images/bg/1.png"></div> --}}
                        {{-- <div class="bg mob-bg" style="background-image: url('{{ asset('assets/images/bg/2.jpg') }}');"></div> --}}
                        <div class="bg mob-bg"
                            style="background-image: url('{{ asset('assets/images/bg/fondo_azul.jpg') }}');">
                        </div>


                        <div class="video-container">
                            <video autoplay loop muted class="bgvid">
                                <source src="assets/video/2.mp4" type="video/mp4">
                            </video>
                        </div>
                        <!--
                                    Vimeo code
                                    
                                     <div  class="background-vimeo" data-vim="97871257"> </div> -->
                        <!--
                                    Youtube code
                                    
                                     <div  class="background-youtube-wrapper" data-vid="Hg5iNVSp2z8" data-mv="1"> </div> -->

                    </div>
                    <div class="overlay"></div>
                    <div class="hero-section-wrap fl-wrap">
                        <div class="container">
                            <div class="intro-item fl-wrap">
                                <h2>{{ Voyager::setting('home.titulo1') }}</h2>

                            </div>
                            <div class="color-bg-text">
                                <h2>{{ Voyager::setting('home.subtitulo1') }}</h2>
                            </div>
                            <div class="main-search-input-wrap">
                                {{-- <form action="{{ route('consulta.predial') }}" method="GET">
                                    <div class="main-search-input fl-wrap">
                                        <div class="main-search-input-item">
                                            <input required="true" type="text" class="form-control" id="referencia"
                                                name="referencia"
                                                placeholder="{{ __('DIGITA TU REFERENCIA CATASTRAL') }}"
                                                value="{{ old('referencia', $dataTypeContent->referencia ?? '') }}">
                                            <ul id="suggestions" class="list-group"></ul>
                                            <!-- Aquí se mostrarán las sugerencias -->
                                        </div>
                                        @php
                                            if (isset($dataTypeContent->tipo_consulta)) {
                                                $selected_tipo_consulta = $dataTypeContent->tipo_consulta;
                                            } else {
                                                $selected_tipo_consulta = null; // Cambia '' por null
                                            }
                                        @endphp
                                        <div class="main-search-input-item">
                                            <select required class="chosen-select" id="tipo_consulta"
                                                name="tipo_consulta">
                                                <option value="" disabled selected>SELECCIONES UN TIPO DE CONSULTA
                                                </option>
                                                @foreach (Voyager::tipo_consulta() as $tipo_consulta)
                                                    <option value="{{ $tipo_consulta->id }}"
                                                        {{ $tipo_consulta->id == $selected_tipo_consulta ? 'selected' : '' }}>
                                                        {{ $tipo_consulta->tipo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="main-search-button">Consultar</button>
                                    </div>
                                </form> --}}
                                <form action="{{ route('consulta.predial') }}" method="GET">
                                    <div class="main-search-input fl-wrap">
                                        <div class="main-search-input-item">
                                            <select required class="chosen-select" id="tipo_consulta"
                                                name="tipo_consulta">
                                                <option value="" disabled selected>SELECCIONES UN TIPO DE CONSULTA
                                                </option>
                                                @foreach (Voyager::tipo_consulta() as $tipo_consulta)
                                                    <option value="{{ $tipo_consulta->id }}">
                                                        {{ $tipo_consulta->tipo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="main-search-input-item">
                                            <input required type="text" class="form-control" id="referencia"
                                                name="referencia" placeholder="DIGITA TU REFERENCIA CATASTRAL">
                                            <ul id="suggestions" class="list-group position-absolute w-100"
                                                style="z-index: 1000;"></ul>
                                            {{-- <ul id="suggestions" class="list-group-item"></ul> --}}
                                            <!-- Aquí se mostrarán las sugerencias -->
                                        </div>
                                        <button type="submit" class="main-search-button">Consultar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="bubble-bg"> </div>
                    <div class="header-sec-link">
                        <div class="container"><a href="{{ route('register') }}"
                                class="custom-scroll-link">RECLAMAR</a></div>
                    </div>
                </section>
                <!-- section end -->
                <!-- Content end-->
                <!-- wrapper -->
                <div id="wrapper" class="no-padding">
                    <!-- Content-->
                    <div class="content">
                        <!--section -->
                        <section class="color-bg">
                            <div class="shapes-bg-big"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="images-collage fl-wrap">
                                            {{-- <div class="images-collage-title">IGAC<span> HACIENDA</span></div> --}}
                                            <div class="col-md-10">

                                                <div class="list-single-main-media fl-wrap">
                                                    <img src="assets/images/avatar/bg_1.png" class="respimg">
                                                    {{-- <img src="{{ $admin_logo_img ? Voyager::image($admin_logo_img) : voyager_asset('images/fedetiro.png') }}"
                                                    alt="Logo"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="color-bg-text">
                                            <h3>¿Deseas realizar un reclamo?</h3>
                                        </div>
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>El Instituto Geográfico Agustín Codazzi (IGAC) es la entidad encargada
                                                de la producción y administración de información cartográfica,
                                                geográfica,
                                                catastral y agrológica en Colombia. Nuestro compromiso es brindarte
                                                acceso a información confiable y actualizada, garantizando transparencia
                                                y eficiencia en nuestros servicios.
                                            </h3>
                                            <h3>
                                                Si necesitas presentar un reclamo relacionado con nuestros servicios, te
                                                invitamos a registrarte y enviarnos tu solicitud. Nuestro equipo
                                                revisará tu caso y te brindará una respuesta oportuna.</h3>
                                        </div>
                                        {{-- <a href="#" class="color-bg-link modal-open">Sign In Now</a> --}}
                                        <a class="color-bg-link" href="{{ route('register') }}">Registrate</a>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--section   end -->
                        <!--section -->
                        <section>
                            <div class="container">
                                <div class="section-title">
                                    <h2>Cómo Trabajamos</h2>
                                    <div class="section-subtitle">Descubre y Conecta</div>
                                    <span class="section-separator"></span>
                                    <p>Consulta tu predio con nuestro sistema de visualización predial.</p>
                                </div>
                                <!--process-wrap  -->
                                <div class="process-wrap fl-wrap">
                                    <ul>
                                        <li>
                                            <div class="process-item">
                                                <span class="process-count">01 . </span>
                                                <div class="time-line-icon"><i class="fa fa-map-o"></i></div>
                                                <h4> Encuentra tu predial</h4>
                                                <p>Ingresa una de las tres opciones disponibles para buscar tu predial y
                                                    consulta tu información catastral.</p>
                                            </div>
                                            <span class="pr-dec"></span>
                                        </li>
                                        <li>
                                            <div class="process-item">
                                                <span class="process-count">02 .</span>
                                                <div class="time-line-icon"><i class="fa fa-envelope-open-o"></i>
                                                </div>
                                                <h4> Póngase en contacto con nosotros</h4>
                                                <p>Si requiere de un reclamo acerca de tu predial registrate y realiza
                                                    la solicitud.</p>
                                            </div>
                                            <span class="pr-dec"></span>
                                        </li>
                                        <li>
                                            <div class="process-item">
                                                <span class="process-count">03 .</span>
                                                <div class="time-line-icon"><i class="fa fa-hand-peace-o"></i></div>
                                                <h4> Califica nuestros servicios</h4>
                                                <p>Calificanos sobre nuestro sistema de transparencia a la comunidad.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="process-end"><i class="fa fa-check"></i></div>
                                </div>
                                <!--process-wrap   end-->
                            </div>
                        </section>
                        {{-- <section class="parallax-section" data-scrollax-parent="true">
                            <div class="bg" data-bg="images/bg/1.jpg"
                                data-scrollax="properties: { translateY: '100px' }"></div>
                            <div class="overlay co lor-overlay"></div>
                            <!--container-->
                            <div class="container">
                                <div class="intro-item fl-wrap">
                                    <h2>Lorem ipsum dolor sit amet consectetur</h2>
                                    <h3>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</h3>
                                    <a class="trs-btn" href="#">Add Listing + </a>
                                </div>
                            </div>
                        </section> --}}
                        <!-- section end -->
                        <!--section -->
                        <section class="color-bg">
                            <div class="shapes-bg-big"></div>
                            <div class="container">
                                <div class=" single-facts fl-wrap">
                                    <!-- inline-facts -->
                                    @php
                                        $totalPredios = \App\Models\PrediosActualizados2025::count();
                                    @endphp

                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <div class="milestone-counter">
                                                <div class="stats animaper">
                                                    <div class="num" data-content="0"
                                                        data-num="{{ $totalPredios }}">{{ $totalPredios }}</div>
                                                </div>
                                            </div>
                                            <h6>Predios Registrados</h6>
                                        </div>
                                    </div>

                                    @php
                                        $totalPredios = \App\Models\PrediosActualizados::where(
                                            'estado_predio',
                                            'INACTIVO',
                                        )->count();
                                    @endphp

                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <div class="milestone-counter">
                                                <div class="stats animaper">
                                                    <div class="num" data-content="0"
                                                        data-num="{{ $totalPredios }}">{{ $totalPredios }}</div>
                                                </div>
                                            </div>
                                            <h6>Predios Inactivos</h6>
                                        </div>
                                    </div>

                                    @php
                                        $totalPredios = \App\Models\PrediosActualizados::where(
                                            'views',
                                            '>=',
                                            1,
                                        )->count();
                                    @endphp

                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <div class="milestone-counter">
                                                <div class="stats animaper">
                                                    <div class="num" data-content="0"
                                                        data-num="{{ $totalPredios }}">{{ $totalPredios }}</div>
                                                </div>
                                            </div>
                                            <h6>Visitas</h6>
                                        </div>
                                    </div>

                                    <!-- inline-facts end -->
                                    <!-- inline-facts  -->
                                    @php
                                        $totalPredios = \App\Models\PrediosActualizados::where(
                                            'likes',
                                            '>=',
                                            1,
                                        )->count();
                                    @endphp

                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <div class="milestone-counter">
                                                <div class="stats animaper">
                                                    <div class="num" data-content="0"
                                                        data-num="{{ $totalPredios }}">{{ $totalPredios }}</div>
                                                </div>
                                            </div>
                                            <h6>Me Gusta</h6>
                                        </div>
                                    </div>
                                    <!-- inline-facts end -->
                                </div>
                            </div>
                        </section>
                        <section id="sec1">
                            <div class="container">
                                <div class="section-title">
                                    <h2>CONTÁCTANOS</h2>
                                    <div class="section-subtitle">PUERTO BOYACÁ TIENE FUTURO</div>
                                    <span class="section-separator"></span>
                                    <p>Explore la informacion de su predio.</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="list-single-main-item fl-wrap">

                                            <div class="list-single-main-media fl-wrap">
                                                {{-- <img src="assets/images/all/1.jpg" class="respimg" alt=""> --}}
                                                <img src="{{ $admin_logo_img ? Voyager::image($admin_logo_img) : voyager_asset('images/fedetiro.png') }}"
                                                    alt="Logo">
                                            </div>
                                            <div class="list-author-widget-contacts">
                                                <ul>
                                                    <li><span><i class="fa fa-map-marker"></i> Dirección :</span>
                                                        <a>{{ Voyager::setting('home.direccion_entidad') }}</a>
                                                    </li>
                                                    <li><span><i class="fa fa-clock-o"></i> Horario :</span>
                                                        <a>{{ Voyager::setting('home.horario') }}</a>
                                                    </li>
                                                    <li><span><i class="fa fa-envelope-o"></i> Correo :</span> <a
                                                            href="mailto:{{ Voyager::setting('home.email_entidad') }}">{{ Voyager::setting('home.email_entidad') }}</a>
                                                    </li>
                                                    <li><span><i class="fa fa-globe"></i> Sitio Web :</span> <a
                                                            href="{{ Voyager::setting('home.pagina_entidad') }}">{{ Voyager::setting('home.pagina_entidad') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            {{-- <div class="list-widget-social">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li><a href="#" target="_blank"><i class="fa fa-vk"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="list-single-main-wrapper fl-wrap">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Nuestra ubicación</h3>
                                            </div>
                                            <div class="map-container">
                                                <div id="singleMap">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12686.397786448264!2d-74.5845306127725!3d5.9828409779489435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e414281fc422649%3A0x41157911fd69e0d9!2sAlcald%C3%ADa%20Municipal!5e0!3m2!1ses-419!2sco!4v1739846080202!5m2!1ses-419!2sco"
                                                        width="600" height="450" style="border:0;"
                                                        allowfullscreen="" loading="lazy"
                                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                </div>
                                                {{-- <div id="singleMap" data-latitude="40.7427837"
                                            data-longitude="-73.11445617675781"></div> --}}
                                            </div>
                                            {{-- <div class="list-single-main-item-title fl-wrap">
                                        <h3>Get In Touch</h3>
                                    </div> --}}
                                            {{-- <div id="contact-form">
                                        <div id="message"></div>
                                        <form  class="custom-form" action="php/contact.php" name="contactform" id="contactform">
                                            <fieldset>
                                                <label><i class="fa fa-user-o"></i></label>
                                                <input type="text" name="name" id="name" placeholder="Your Name *" value=""/>
                                                <div class="clearfix"></div>
                                                <label><i class="fa fa-envelope-o"></i>  </label>
                                                <input type="text"  name="email" id="email" placeholder="Email Address*" value=""/>
                                                <div class="clearfix"></div>
                                                <label><i class="fa fa-phone"></i>  </label>
                                                <input type="text"  name="phone" id="phone" placeholder="Phone *" value=""/>
                                                <textarea name="comments"  id="comments" onClick="this.select()" >Message</textarea>
                                                <div class="verify-wrap">
                                                    <span class="verify-text"> How many gnomes were in the story about the "Snow-white" ?</span>
                                                    <input name="verify" type="text" id="verify" onClick="this.select()" value="0" >
                                                </div>
                                            </fieldset>
                                            <button class="btn  big-btn  color-bg flat-btn" id="submit">Send<i class="fa fa-angle-right"></i></button>
                                        </form>
                                    </div> --}}
                                            <!-- contact form  end-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- section end -->
                        {{-- <section id="contact">
                    <div class="container">
                        <div class="section-title">
                            <h2>CONTÁCTANOS</h2>
                            <div class="section-subtitle">Descubrir y conectar </div>
                            <span class="section-separator"></span>
                            <p>Explore la informacion de su predio.</p>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-6">
                            <!-- Información de contacto -->
                            <div class="md:col-span-6">
                                <div class="lg:me-8">
                                    <div
                                        class="relative p-6 bg-white dark:bg-slate-900 rounded-md shadow dark:shadow-gray-700">
                                        <h4 class="font-semibold text-xl mb-4">Información de contacto</h4>
                                        <ul class="space-y-2 text-left text-slate-600 dark:text-slate-400">
                                            <li><strong>Horario de atención:</strong>
                                                {{ Voyager::setting('home.horario') }}</li>
                                            <li><strong>Dirección:</strong>
                                                {{ Voyager::setting('home.direccion_entidad') }}</li>
                                            <li><strong>Email:</strong> {{ Voyager::setting('home.email_entidad') }}
                                            </li>
                                            <li><strong>Teléfono:</strong>
                                                {{ Voyager::setting('home.telefono_entidad') }}</li>
                                        </ul>
                                        <div class="text-center mt-4">
                                            <a>
                                                <img src="{{ $admin_logo_img ? Voyager::image($admin_logo_img) : voyager_asset('images/fedetiro.png') }}"
                                                    alt="VENTANILLA Logo">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                        {{-- <!-- Formulario de contacto -->
                            <div class="lg:col-span-5 md:col-span-6">
                                <div class="lg:ms-5">
                                    <div class="bg-white dark:bg-slate-900 rounded-md shadow dark:shadow-gray-700 p-6">
                                        <form method="POST" action="{{ route('contact.send') }}" id="myForm">
                                            @csrf
                                            <div class="grid lg:grid-cols-12 grid-cols-1 gap-3">
                                                <div class="lg:col-span-6">
                                                    <label for="name" class="font-semibold">Tu Nombre:</label>
                                                    <input name="name" id="name" type="text"
                                                        class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                                        placeholder="Nombre :">
                                                </div>
            
                                                <div class="lg:col-span-6">
                                                    <label for="email" class="font-semibold">Tu Correo:</label>
                                                    <input name="email" id="email" type="email"
                                                        class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                                        placeholder="Correo :">
                                                </div>
            
                                                <div class="lg:col-span-12">
                                                    <label for="subject" class="font-semibold">Asunto:</label>
                                                    <input name="subject" id="subject"
                                                        class="mt-2 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                                        placeholder="Asunto :">
                                                </div>
            
                                                <div class="lg:col-span-12">
                                                    <label for="comments" class="font-semibold">Mensaje:</label>
                                                    <textarea name="comments" id="comments"
                                                        class="mt-2 w-full py-2 px-3 h-28 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                                        placeholder="Mensaje :"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" id="submit" name="send"
                                                class="h-10 px-6 tracking-wide inline-flex items-center justify-center font-medium rounded-md bg-teal-500 text-white mt-2">Enviar
                                                Mensaje</button>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                        {{-- </div>
                    </div>
                </section> --}}



                    </div>
                    <!-- Content end -->
                </div>
                <!-- wrapper end -->
                <!--footer -->


                <!-- Footer Start -->
                <footer class="main-footer dark-footer">
                    <div class="container">
                        <div class="items-center">
                            <div class="">
                                <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                                <img src="{{ Voyager::image($admin_logo_img) }}" style="height:100px!important;"
                                    class="" alt="Logo Icon">
                            </div>

                            <div class="">
                                <p class="mb-0">©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> IGAC - HACIENDA. Hecho con <i class="fa fa-heart"></i> por
                                    la
                                    <a href="https://www.puertoboyaca-boyaca.gov.co/Paginas/default.aspx"
                                        target="_blank" class="text-reset">ALCALDIA DE PUERTO BOYACÁ ®</a>
                                </p>
                            </div>

                            <ul class="lg:col-span-4 list-none md:text-end text-center mt-6 md:mt-0">
                                {{-- <li class="inline"><a href="https://www.facebook.com/Fedetirocol?mibextid=ibOpuV"
                                target="_blank"
                                class="size-8 inline-flex justify-center items-center border border-gray-800 rounded-md hover:border-teal-500 dark:hover:border-teal-500 hover:bg-teal-500 dark:hover:bg-teal-500"><i
                                    data-feather="facebook" class="size-4 align-middle" title="facebook"></i></a>
                        </li>
                        <li class="inline"><a href="https://www.instagram.com/fedetirocol/" target="_blank"
                                class="size-8 inline-flex justify-center items-center border border-gray-800 rounded-md hover:border-teal-500 dark:hover:border-teal-500 hover:bg-teal-500 dark:hover:bg-teal-500"><i
                                    data-feather="instagram" class="size-4 align-middle" title="instagram"></i></a>
                        </li>
                        <li class="inline"><a href="https://x.com/fedetirocol?s=21" target="_blank"
                                class="size-8 inline-flex justify-center items-center border border-gray-800 rounded-md hover:border-teal-500 dark:hover:border-teal-500 hover:bg-teal-500 dark:hover:bg-teal-500"><i
                                    data-feather="twitter" class="size-4 align-middle" title="twitter"></i></a></li>
                        <li class="inline"><a href="https://www.youtube.com/@eventosfedetiro" target="_blank"
                                class="size-8 inline-flex justify-center items-center border border-gray-800 rounded-md hover:border-teal-500 dark:hover:border-teal-500 hover:bg-teal-500 dark:hover:bg-teal-500"><i
                                    data-feather="youtube" class="size-4 align-middle" title="youtube"></i></a></li>
                        <li class="inline"><a href="mailto:info@fedetirocol.com"
                                class="size-8 inline-flex justify-center items-center border border-gray-800 rounded-md hover:border-teal-500 dark:hover:border-teal-500 hover:bg-teal-500 dark:hover:bg-teal-500"><i
                                    data-feather="mail" class="size-4 align-middle" title="email"></i></a></li> --}}
                            </ul><!--end icon-->
                        </div><!--end grid-->
                    </div><!--end container-->

                </footer><!--end footer-->
                <!-- Footer End -->
                <!--register form -->
                <div class="main-register-wrap modal">
                    <div class="main-overlay"></div>
                    <div class="main-register-holder">
                        <div class="main-register fl-wrap">
                            <div class="close-reg"><i class="fa fa-times"></i></div>
                            <h3>Sign In <span>City<strong>Book</strong></span></h3>
                            <div class="soc-log fl-wrap">
                                <p>For faster login or register use your social account.</p>
                                <a href="#" class="facebook-log"><i class="fa fa-facebook-official"></i>Log in
                                    with
                                    Facebook</a>
                                <a href="#" class="twitter-log"><i class="fa fa-twitter"></i> Log in with
                                    Twitter</a>
                            </div>
                            <div class="log-separator fl-wrap"><span>or</span></div>
                            <div id="tabs-container">
                                <ul class="tabs-menu">
                                    <li class="current"><a href="#tab-1">Login</a></li>
                                    <li><a href="#tab-2">Register</a></li>
                                </ul>
                                <div class="tab">
                                    <div id="tab-1" class="tab-content">
                                        <div class="custom-form">
                                            <form method="post" name="registerform">
                                                <label>Username or Email Address * </label>
                                                <input name="email" type="text" onClick="this.select()"
                                                    value="">
                                                <label>Password * </label>
                                                <input name="password" type="password" onClick="this.select()"
                                                    value="">
                                                <button type="submit" class="log-submit-btn"><span>Log
                                                        In</span></button>
                                                <div class="clearfix"></div>
                                                <div class="filter-tags">
                                                    <input id="check-a" type="checkbox" name="check">
                                                    <label for="check-a">Remember me</label>
                                                </div>
                                            </form>
                                            <div class="lost_password">
                                                <a href="#">Lost Your Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <div id="tab-2" class="tab-content">
                                            <div class="custom-form">
                                                <form method="post" name="registerform" class="main-register-form"
                                                    id="main-register-form2">
                                                    <label>First Name * </label>
                                                    <input name="name" type="text" onClick="this.select()"
                                                        value="">
                                                    <label>Second Name *</label>
                                                    <input name="name2" type="text" onClick="this.select()"
                                                        value="">
                                                    <label>Email Address *</label>
                                                    <input name="email" type="text" onClick="this.select()"
                                                        value="">
                                                    <label>Password *</label>
                                                    <input name="password" type="password" onClick="this.select()"
                                                        value="">
                                                    <button type="submit"
                                                        class="log-submit-btn"><span>Register</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--register form end -->
                <a class="to-top"><i class="fa fa-angle-up"></i></a>
            </div>
            <!-- Main end -->
            <!--=============== scripts  ===============-->
            <script type="text/javascript" src="assets/js/jquery.min.js"></script>
            <script type="text/javascript" src="assets/js/plugins.js"></script>
            <script type="text/javascript" src="assets/js/scripts.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=YOURAPIKEYHERE&libraries=places&callback=initAutocomplete">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                $(document).ready(function() {
                    let hasResults = false; // Variable para controlar si hay resultados

                    $("#suggestions").hide();

                    $("#referencia").on("input", function() {
                        let query = $(this).val();
                        let tipoConsulta = $("#tipo_consulta").val();

                        if (query.length > 2 && tipoConsulta) {
                            $.ajax({
                                url: "{{ route('buscar.predios') }}",
                                method: "GET",
                                data: {
                                    query: query,
                                    tipo_consulta: tipoConsulta
                                },
                                success: function(data) {
                                    let suggestions = $("#suggestions");
                                    suggestions.empty();

                                    if (data.length > 0) {
                                        hasResults = true; // Marcar que hay resultados
                                        data.forEach(function(item) {
                                            suggestions.append(
                                                `<li class="list-group-item suggestion-item">${item.nombre}</li>`
                                            );
                                        });

                                        suggestions.show(); // Mostrar la lista solo si hay resultados
                                    } else {
                                        hasResults = false; // No hay resultados
                                        suggestions.hide();
                                    }

                                    // Ocultar la lista cuando se selecciona una sugerencia
                                    $(".suggestion-item").click(function() {
                                        $("#referencia").val($(this).text());
                                        suggestions.empty().hide();
                                        hasResults =
                                            true; // Si selecciona algo, debe haber coincidencia
                                    });
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error en la consulta",
                                        text: "Hubo un problema al buscar los datos. Inténtalo de nuevo más tarde.",
                                        confirmButtonText: "Aceptar"
                                    });
                                }
                            });
                        } else {
                            $("#suggestions").empty().hide();
                            hasResults = false; // Si se borra el input, marcar como sin resultados
                        }
                    });

                    // Cuando cambia el tipo de consulta, limpiar input y ocultar la lista
                    $("#tipo_consulta").on("change", function() {
                        $("#referencia").val(""); // Limpia el input
                        $("#suggestions").empty().hide(); // Oculta la lista
                        hasResults = false; // Reiniciar validación
                    });

                    // Interceptar el envío del formulario
                    $("form").on("submit", function(e) {
                        if (!hasResults) {
                            e.preventDefault(); // Evitar la redirección

                            Swal.fire({
                                icon: "warning",
                                title: "Dato no encontrado",
                                text: "No se encontraron coincidencias. Verifica la información ingresada.",
                                confirmButtonText: "Aceptar"
                            });
                        }
                    });

                    // Ocultar la lista si el usuario hace clic fuera
                    $(document).on("mousedown", function(event) {
                        if (!$(event.target).closest("#referencia, #suggestions").length) {
                            $("#suggestions").hide();
                        }
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $("#tipo_consulta").on("change", function() {
                        $("#referencia").val(""); // Limpia el input
                        $("#suggestions").empty().hide(); // Oculta la lista

                        // Obtener el valor seleccionado (ID de la base de datos)
                        let selectedOption = $(this).val();

                        // Definir los placeholders según el ID de la base de datos
                        let placeholders = {
                            "1": "DIGITA TU REFERENCIA CATASTRAL",
                            "2": "DIGITA LA DIRECCIÓN DEL PREDIO",
                            "3": "DIGITA EL NÚMERO DE MATRÍCULA DEL PREDIO"
                        };

                        console.log("Tipo de consulta seleccionada:", selectedOption); // Verificar en consola

                        // Actualizar el placeholder según la opción seleccionada
                        $("#referencia").attr("placeholder", placeholders[selectedOption] ||
                            "DIGITA TU REFERENCIA");
                    });
                });
            </script>
</body>

</html>
