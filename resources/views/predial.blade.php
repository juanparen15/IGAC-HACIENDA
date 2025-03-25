<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Citybook -Directory Listing Template</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="assets/css/reset.css">
    <link type="text/css" rel="stylesheet" href="assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="assets/css/color.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
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
        </header> <!--  header end -->
        <!-- wrapper -->
        <div id="wrapper">
            <!--  content  -->
            <div class="content">
                <!--  section  -->
                <section class="parallax-section single-par list-single-section" data-scrollax-parent="true"
                    id="sec1">
                    <div class="bg par-elem " data-bg="{{ $prediosAnteriores->foto_url }}"
                        data-scrollax="properties: { translateY: '50%' }"></div>
                    <div class="overlay"></div>
                    <div class="bubble-bg"></div>
                    <div class="list-single-header absolute-header fl-wrap">
                        <div class="container">
                            <div class="list-single-header-item">
                                <div class="list-single-header-item-opt fl-wrap">
                                    <div class="list-single-header-cat fl-wrap">
                                        <a>{{ $prediosAnteriores->estado_predio ?? 'Estado no disponible' }}</a>
                                    </div>
                                </div>
                                @php
                                    function ocultarNombre($nombre)
                                    {
                                        if (!$nombre || $nombre === 'Propietario no disponible') {
                                            return 'Propietario no disponible';
                                        }
                                        $longitud = mb_strlen($nombre);
                                        if ($longitud <= 4) {
                                            return str_repeat('*', $longitud);
                                        }
                                        return mb_substr($nombre, 0, 4) .
                                            str_repeat('*', $longitud - 8) .
                                            mb_substr($nombre, -4);
                                    }

                                    $nombreOculto = ocultarNombre($predio->propietario ?? 'Propietario no disponible');
                                @endphp

                                <!-- Mostrar la calificación en estrellas -->
                                <h2>{{ $nombreOculto }}</h2>
                                <span class="section-separator"></span>


                                {{-- <div class="listing-rating card-popup-rainingvis"
                                    data-starrating2="{{ $predio->rating ?? 0 }}">
                                    <span>({{ $predio->reviews_count ?? 0 }} reviews)</span>
                                </div> --}}

                                <!-- Contador de Likes -->
                                {{-- <div class="list-post-counter single-list-post-counter">
                                    <span class="like-count"
                                        data-id="{{ $predio->id }}">{{ $predio->likes ?? 0 }}</span>
                                    <i class="fa fa-heart like-button" data-id="{{ $predio->id }}"
                                        style="cursor: pointer; color: white;"></i>
                                </div> --}}

                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="list-single-header-contacts fl-wrap">
                                            <ul>
                                                <li><i class="fa fa-map-marker"></i><a href="#">Dirección:
                                                        {{ $predio->direccion ?? 'Dirección no disponible' }}</a>
                                                </li>
                                                <li><i class="fa fa-id-card"></i><a href="#">Referencia:
                                                        {{ $predio->referencia ?? 'Referencia no disponible' }}</a>
                                                </li>
                                                <li><i class="fa fa-list-alt"></i><a href="#">Matricula:
                                                        {{ $predio->matricula ?? 'Matricula no disponible' }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="fl-wrap list-single-header-column">
                                            <div class="share-holder hid-share">
                                                {{-- <div class="showshare"><span>Compartir </span><i
                                                        class="fa fa-share"></i></div>
                                                <div class="share-container isShare"></div> --}}
                                                <div><a class="join-wrap-btn" target="_blank"
                                                        href="https://puertoboyaca-boyaca.softwaretributario.com/impuestos.portal.wpninformacionipu.aspx?IPU,{{ $predio->referencia }}">Pagar
                                                        Predial<i class="fa fa-credit-card"></i></a>
                                                </div>
                                            </div>
                                            <span class="viewed-counter like-button" data-id="{{ $predio->id }}">
                                                <i class="fa fa-heart" style="color:red"
                                                    data-id="{{ $predio->id }}"></i>
                                                {{ $predio->likes ?? 0 }} Me Gusta
                                            </span>
                                            <span class="viewed-counter"><i class="fa fa-eye"></i> Visto -
                                                {{ $predio->views ?? 0 }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--  section end -->
                <div class="scroll-nav-wrapper fl-wrap">
                    <div class="container">
                        <nav class="scroll-nav scroll-init">
                            <ul>
                                <li><a class="act-scrlink" href="#sec1">Propietario</a></li>
                                <li><a href="#sec2">Detalles</a></li>
                                {{-- <li><a href="#sec3">Gallery</a></li> --}}
                                {{-- <li><a href="#sec4">Reviews</a></li> --}}
                            </ul>
                        </nav>
                        {{-- <a href="#" class="save-btn"> <i class="fa fa-heart"></i> Save </a> --}}
                    </div>
                </div>
                <!--  section  -->
                <section class="gray-section no-top-padding" id="sec2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="list-single-main-wrapper fl-wrap">
                                    <div class="list-single-main-img fl-wrap">
                                        <img src="{{ $prediosAnteriores->foto_url }}" alt="Imagen del predio">
                                    </div>

                                    {{-- <div class="list-single-main-img fl-wrap">
                                        <img src="{{ asset('storage/' . $predio->foto) ? 'assets/images/all/1.jpg' }}">
                                        <img src="{{ asset('storage/' . $predio->foto) ? 'assets/images/all/1.jpg' }}"
                                            class="respimg" alt="Imagen del predio">
                                            <img src="assets/images/all/1.jpg" class="respimg" alt="">
                                        <a href="https://vimeo.com/70851162"
                                            class="promo-link gradient-bg image-popup"><i
                                                class="fa fa-play"></i><span>Promo Video</span></a>
                                    </div> --}}
                                    <!--box-widget-item -->
                                    <div class="box-widget-item fl-wrap">
                                        <div class="box-widget-item-header">
                                            <h3>Detalles Anteriores: </h3>
                                        </div>
                                        <div class="box-widget opening-hours">
                                            <div class="box-widget-content">
                                                <ul>
                                                    @php
                                                        use Illuminate\Support\Str;
                                                        $nombre = $prediosAnteriores->propietario ?? 'Propietario no disponible';
                                                        $nombreOculto =
                                                            $nombre !== 'Propietario no disponible'
                                                                ? Str::mask($nombre, '*', 4, -4)
                                                                : $nombre;
                                                    @endphp

                                                    <li>
                                                        <span class="opening-hours-day">Propietario: </span>
                                                        <span class="opening-hours-time">{{ $nombreOculto }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Número de Documento: </span>
                                                        <span
                                                            class="opening-hours-time">{{ isset($prediosAnteriores->numero_documento) ? substr($prediosAnteriores->numero_documento, 0, -4) . '****' : 'Número de Documento no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Referencia Catastral:
                                                        </span><span
                                                            class="opening-hours-time">{{ $prediosAnteriores->referencia ?? 'Referencia Catastral no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Dirección:
                                                        </span><span
                                                            class="opening-hours-time">{{ $prediosAnteriores->direccion ?? 'Dirección no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Matricula Inmobiliaria:
                                                        </span><span
                                                            class="opening-hours-time">{{ $prediosAnteriores->matricula ?? 'Matricula Inmobiliaria no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Tipo de Predio: </span><span
                                                            class="opening-hours-time">{{ $prediosAnteriores->tipo_predio ?? 'Tipo Predio no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Destino Económico </span><span
                                                            class="opening-hours-time">{{ $prediosAnteriores->destino_economico ?? 'Destino Económico no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Clase: </span><span
                                                            class="opening-hours-time">{{ $prediosAnteriores->clase ?? 'Clase no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Estrato Social: </span><span
                                                            class="opening-hours-time">{{ $prediosAnteriores->estrato_social ?? 'Estato Social no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Área de Terreno: </span>
                                                        <span class="opening-hours-time">
                                                            {{ isset($prediosAnteriores->area_terreno) ? number_format($prediosAnteriores->area_terreno, 2, ',', '.') . ' m²' : 'Área de Terreno no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Área Edificada: </span>
                                                        <span class="opening-hours-time">
                                                            {{ isset($prediosAnteriores->area_edificada) ? number_format($prediosAnteriores->area_edificada, 2, ',', '.') . ' m²' : 'Área Edificada no disponible' }}
                                                        </span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Avalúo: </span><span
                                                            class="opening-hours-time">{{ isset($prediosAnteriores->avaluo) ? '$' . number_format($prediosAnteriores->avaluo, 2, ',', '.') : 'Avalúo no disponible' }}</span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="list-single-main-wrapper fl-wrap">
                                    <div class="list-single-main-img fl-wrap">
                                        <img src="{{ $predio->foto_url }}" alt="Imagen del predio">
                                    </div>
                                    <!--box-widget-item -->
                                    <div class="box-widget-item fl-wrap">
                                        <div class="box-widget-item-header">
                                            <h3>Detalles Actualizados: </h3>
                                        </div>
                                        <div class="box-widget opening-hours">
                                            <div class="box-widget-content">
                                                <ul>
                                                    @php
                                                        // use Illuminate\Support\Str;
                                                        $nombre = $predio->propietario ?? 'Propietario no disponible';
                                                        $nombreOculto =
                                                            $nombre !== 'Propietario no disponible'
                                                                ? Str::mask($nombre, '*', 4, -4)
                                                                : $nombre;
                                                    @endphp

                                                    <li>
                                                        <span class="opening-hours-day">Propietario: </span>
                                                        <span class="opening-hours-time">{{ $nombreOculto }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Número de Documento: </span>
                                                        <span
                                                            class="opening-hours-time">{{ isset($predio->numero_documento) ? substr($predio->numero_documento, 0, -4) . '****' : 'Número de Documento no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Referencia Catastral:
                                                        </span><span
                                                            class="opening-hours-time">{{ $predio->referencia ?? 'Referencia Catastral no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Dirección:
                                                        </span><span
                                                            class="opening-hours-time">{{ $predio->direccion ?? 'Dirección no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Matricula Inmobiliaria:
                                                        </span><span
                                                            class="opening-hours-time">{{ $predio->matricula ?? 'Matricula Inmobiliaria no disponible' }}</span>
                                                    </li>

                                                    <li><span class="opening-hours-day">Tipo de Predio: </span><span
                                                            class="opening-hours-time">{{ $predio->tipo_predio ?? 'Tipo Predio no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Destino Económico </span><span
                                                            class="opening-hours-time">{{ $predio->destino_economico ?? 'Destino Económico no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Clase: </span><span
                                                            class="opening-hours-time">{{ $predio->clase ?? 'Clase no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Estrato Social: </span><span
                                                            class="opening-hours-time">{{ $predio->estrato_social ?? 'Estato Social no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Área de Terreno: </span>
                                                        <span class="opening-hours-time">
                                                            {{ isset($predio->area_terreno) ? number_format($predio->area_terreno, 2, ',', '.') . ' m²' : 'Área de Terreno no disponible' }}</span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Área Edificada: </span>
                                                        <span class="opening-hours-time">
                                                            {{ isset($predio->area_edificada) ? number_format($predio->area_edificada, 2, ',', '.') . ' m²' : 'Área Edificada no disponible' }}
                                                        </span>
                                                    </li>
                                                    <li><span class="opening-hours-day">Avalúo: </span><span
                                                            class="opening-hours-time">{{ isset($predio->avaluo) ? '$' . number_format($predio->avaluo, 2, ',', '.') : 'Avalúo no disponible' }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--box-widget-item end -->

                                    {{-- <div class="accordion">
                                        <a class="toggle act-accordion" href="#"> Details option <i
                                                class="fa fa-angle-down"></i></a>
                                        <div class="accordion-inner visible">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in
                                                pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur
                                                nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi
                                                tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed
                                                aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum
                                                facilisis massa, a consequat purus viverra.</p>
                                        </div>
                                        <a class="toggle" href="#"> Details option 2 <i
                                                class="fa fa-angle-down"></i></a>
                                        <div class="accordion-inner">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in
                                                pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur
                                                nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi
                                                tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed
                                                aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum
                                                facilisis massa, a consequat purus viverra.</p>
                                        </div>
                                        <a class="toggle" href="#"> Details option 3 <i
                                                class="fa fa-angle-down"></i></a>
                                        <div class="accordion-inner">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in
                                                pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur
                                                nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi
                                                tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed
                                                aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum
                                                facilisis massa, a consequat purus viverra.</p>
                                        </div>
                                    </div>
                                    <div class="list-single-facts fl-wrap gradient-bg">
                                        <!-- inline-facts -->
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fa fa-male"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        <div class="num" data-content="0" data-num="154">0</div>
                                                    </div>
                                                </div>
                                                <h6>New Visiters Every Week</h6>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                        <!-- inline-facts  -->
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fa fa-hand-peace-o"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        <div class="num" data-content="0" data-num="12168">0</div>
                                                    </div>
                                                </div>
                                                <h6>Happy customers every year</h6>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                        <!-- inline-facts  -->
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fa fa-trophy"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        <div class="num" data-content="0" data-num="72">0</div>
                                                    </div>
                                                </div>
                                                <h6>Won Awards</h6>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                    </div> --}}
                                    {{-- <div class="list-single-main-item fl-wrap" id="sec3">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Gallery - Photos</h3>
                                        </div> --}}
                                    <!-- gallery-items   -->
                                    {{-- <div
                                            class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">
                                            <!-- 1 -->
                                            <div class="gallery-item">
                                                <div class="grid-item-holder">
                                                    <div class="box-item">
                                                        <img src="assets/assets/images/all/single/1.jpg"
                                                            alt="">
                                                        <a href="images/all/single/1.jpg"
                                                            class="gal-link popup-image"><i
                                                                class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 1 end -->
                                            <!-- 2 -->
                                            <div class="gallery-item">
                                                <div class="grid-item-holder">
                                                    <div class="box-item">
                                                        <img src="assets/assets/images/all/single/1.jpg"
                                                            alt="">
                                                        <a href="images/all/single/1.jpg"
                                                            class="gal-link popup-image"><i
                                                                class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 2 end -->
                                            <!-- 3 -->
                                            <div class="gallery-item">
                                                <div class="grid-item-holder">
                                                    <div class="box-item">
                                                        <img src="assets/assets/images/all/single/1.jpg"
                                                            alt="">
                                                        <a href="images/all/single/1.jpg"
                                                            class="gal-link popup-image"><i
                                                                class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 3 end -->
                                            <!-- 4 -->
                                            <div class="gallery-item">
                                                <div class="grid-item-holder">
                                                    <div class="box-item">
                                                        <img src="assets/assets/images/all/single/1.jpg"
                                                            alt="">
                                                        <a href="images/all/single/1.jpg"
                                                            class="gal-link popup-image"><i
                                                                class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 4 end -->
                                            <!-- 5 -->
                                            <div class="gallery-item">
                                                <div class="grid-item-holder">
                                                    <div class="box-item">
                                                        <img src="assets/assets/images/all/single/1.jpg"
                                                            alt="">
                                                        <a href="images/all/single/1.jpg"
                                                            class="gal-link popup-image"><i
                                                                class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 5 end -->
                                            <!-- 7 -->
                                            <div class="gallery-item">
                                                <div class="grid-item-holder">
                                                    <div class="box-item">
                                                        <img src="assets/assets/images/all/single/1.jpg"
                                                            alt="">
                                                        <a href="images/all/single/1.jpg"
                                                            class="gal-link popup-image"><i
                                                                class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 7 end -->
                                        </div> --}}
                                    <!-- end gallery items -->
                                    {{-- </div> --}}
                                </div>
                            </div>

                        </div>
                </section>
                <!--  section end -->
                <div class="limit-box fl-wrap"></div>
                <!--  section  -->
                <section class="gradient-bg">
                    <div class="cirle-bg">
                        <div class="bg" data-bg="images/bg/circle.png"></div>
                    </div>
                    <div class="container">
                        <div class="join-wrap fl-wrap">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3>Realiza tu reclamo en línea</h3>
                                    <p>Regístrate con tu número de identificación, completa tus datos y envía tu reclamo
                                        exitosamente.</p>
                                </div>
                                <div class="col-md-4"><a class="join-wrap-btn"
                                        href="{{ route('register') }}">Registrate <i class="fa fa-sign-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--  section  end-->
            </div>
            <!--  content end  -->
        </div>
        <div class="sub-footer fl-wrap">
            <div class="items-center">
                <div class="">
                    <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                    <img src="{{ Voyager::image($admin_logo_img) }}" style="height:100px!important;" class=""
                        alt="Logo Icon">
                </div>

                {{-- <div class="">
                        <p class="mb-0">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> IGAC - HACIENDA. Hecho con <i class="fa fa-heart"></i> por
                            la
                            <a href="https://www.puertoboyaca-boyaca.gov.co/Paginas/default.aspx" target="_blank"
                                class="text-reset">ALCALDIA DE PUERTO BOYACÁ ®</a>
                        </p>
                    </div> --}}
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="about-widget">
                                {{-- <img src="assets/images/logo.png" alt=""> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="copyright"> &#169; ALCALDIA DE PUERTO BOYACÁ ®</div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fa fa-facebook-official"></i></a>
                                    </li>
                                    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="#" target="_blank"><i class="fa fa-chrome"></i></a>
                                    </li>
                                    <li><a href="#" target="_blank"><i class="fa fa-vk"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <ul class="lg:col-span-4 list-none md:text-end text-center mt-6 md:mt-0"> --}}
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
                {{-- </ul><!--end icon--> --}}
            </div><!--end grid-->
        </div><!--end grid-->
    </div><!--end container-->

    </footer><!--end footer-->
    <!-- Footer End -->
    <!--footer -->
    {{-- <footer class="main-footer dark-footer  ">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-widget fl-wrap">
                            <h3>About Us</h3>
                            <div class="footer-contacts-widget fl-wrap">
                                <p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus.
                                    Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit, sed diam. </p>
                                <ul class="footer-contacts fl-wrap">
                                    <li><span><i class="fa fa-envelope-o"></i> Mail :</span><a href="#"
                                            target="_blank">yourmail@domain.com</a></li>
                                    <li> <span><i class="fa fa-map-marker"></i> Adress :</span><a href="#"
                                            target="_blank">USA 27TH Brooklyn NY</a></li>
                                    <li><span><i class="fa fa-phone"></i> Phone :</span><a
                                            href="#">+7(111)123456789</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget fl-wrap">
                            <h3>Our Last News</h3>
                            <div class="widget-posts fl-wrap">
                                <ul>
                                    <li class="clearfix">
                                        <a href="#" class="widget-posts-img"><img src="assets/images/all/1.jpg"
                                                class="respimg" alt=""></a>
                                        <div class="widget-posts-descr">
                                            <a href="#" title="">Vivamus dapibus rutrum</a>
                                            <span class="widget-posts-date"> 21 Mar 09.05 </span>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#" class="widget-posts-img"><img src="assets/images/all/1.jpg"
                                                class="respimg" alt=""></a>
                                        <div class="widget-posts-descr">
                                            <a href="#" title=""> In hac habitasse platea</a>
                                            <span class="widget-posts-date"> 7 Mar 18.21 </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer-menu fl-wrap">
                                <ul>
                                    <li><a href="#" style="color:#4DB7FE">Read All News</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget fl-wrap">
                            <h3>Subscribe</h3>
                            <div class="subscribe-widget fl-wrap">
                                <p>Want to be notified when we launch a new template or an udpate. Just sign up and
                                    we'll send you a notification by email.</p>
                                <div class="subcribe-form">
                                    <form id="subscribe">
                                        <input class="enteremail" name="email" id="subscribe-email"
                                            placeholder="Email" spellcheck="false" type="text">
                                        <button type="submit" id="subscribe-button" class="subscribe-button"><i
                                                class="fa fa-rss"></i> Subscribe</button>
                                        <label for="subscribe-email" class="subscribe-message"></label>
                                    </form>
                                </div>
                            </div>
                            <div class="footer-widget fl-wrap">
                                <div class="footer-menu fl-wrap">
                                    <ul>
                                        <li><a href="#">Home </a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Listing</a></li>
                                        <li><a href="#">Contacts</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-footer fl-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="about-widget">
                                <img src="assets/images/logo.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="copyright"> &#169; CityBook 2018 . All rights reserved.</div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fa fa-facebook-official"></i></a>
                                    </li>
                                    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-chrome"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-vk"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}
    <!--footer end  -->
    <!--booking-modal-wrap -->
    <div class="booking-modal-wrap">
        <div class="booking-modal-container">
            <div class="booking-modal-content fl-wrap">
                <div class="booking-modal-info">
                    <div class="booking-modal-close color-bg"><i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                    <div class="bg" data-bg="images/bg/1.jpg"></div>
                    <div class="overlay"></div>
                    <div class="booking-modal-info_content fl-wrap">
                        <h4>Luxury Hotel Spa</h4>
                        <ul>
                            <li>Date : <span>05.05.2020</span></li>
                            <li>Persons : <span>2</span></li>
                            <li>Price : <span>$120</span> </li>
                        </ul>
                    </div>
                </div>
                <div class="bookiing-form-wrap">
                    <ul id="progressbar">
                        <li class="active"><span>01.</span>Personal Info</li>
                        <li><span>02.</span>Billing Address</li>
                        <li><span>03.</span>Payment Method</li>
                        <li><span>04.</span>Confirm</li>
                    </ul>
                    <!--   list-single-main-item -->
                    <div class="list-single-main-item fl-wrap hidden-section tr-sec">
                        <div class="profile-edit-container">
                            <div class="custom-form">
                                <form>
                                    <fieldset class="fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Your personal Information</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name <i class="fa fa-user"></i></label>
                                                <input type="text" placeholder="Your Name" value="" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Last Name <i class="fa fa-user"></i></label>
                                                <input type="text" placeholder="Your Last Name" value="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Email Address<i class="fa fa-envelope"></i> </label>
                                                <input type="text" placeholder="yourmail@domain.com"
                                                    value="" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Phone<i class="fa fa-phone"></i> </label>
                                                <input type="text" placeholder="87945612233" value="" />
                                            </div>
                                        </div>
                                        <div class="log-massage">Existing Customer? <a href="#"
                                                class="modal-open">Click here to login</a></div>
                                        <div class="log-separator fl-wrap"><span>or</span></div>
                                        <div class="soc-log fl-wrap">
                                            <p>For faster login or register use your social account.</p>
                                            <a href="#" class="facebook-log"><i
                                                    class="fa fa-facebook-f"></i>Connect with Facebook</a>
                                        </div>
                                        <div class="filter-tags">
                                            <input id="check-ac" type="checkbox" name="check">
                                            <label for="check-ac">By continuing, you agree to the<a href="#"
                                                    target="_blank">Terms and Conditions</a>.</label>
                                        </div>
                                        <span class="fw-separator"></span>
                                        <a href="#"
                                            class="next-form back-form action-button btn  big-btn  color-bg flat-btn">Payment
                                            Step
                                            <i class="fa fa-angle-right"></i></a>
                                    </fieldset>
                                    <fieldset class="fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Billing Address</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>City <i class="fa fa-globe"></i></label>
                                                <input type="text" placeholder="Your city" value="" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Country </label>
                                                <select data-placeholder="Your Country"
                                                    class="chosen-select no-search-select">
                                                    <option>United states</option>
                                                    <option>Asia</option>
                                                    <option>Australia</option>
                                                    <option>Europe</option>
                                                    <option>South America</option>
                                                    <option>Africa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Street <i class="fa fa-road"></i> </label>
                                                <input type="text" placeholder="Your Street" value="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label>State<i class="fa fa-street-view"></i></label>
                                                <input type="text" placeholder="Your State" value="" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Postal code<i class="fa fa-barcode"></i> </label>
                                                <input type="text" placeholder="123456" value="" />
                                            </div>
                                        </div>
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Addtional Notes</h3>
                                        </div>
                                        <textarea cols="40" rows="3" placeholder="Notes"></textarea>
                                        <span class="fw-separator"></span>
                                        <a href="#" class="previous-form action-button back-form   color-bg"><i
                                                class="fa fa-angle-left"></i> Back</a>
                                        <a href="#"
                                            class="next-form back-form action-button btn  big-btn  color-bg flat-btn">Payment
                                            Step
                                            <i class="fa fa-angle-right"></i></a>
                                    </fieldset>
                                    <fieldset class="fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Payment method</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Cardholder's Name<i class="fa fa-user"></i></label>
                                                <input type="text" placeholder="" value="Adam Kowalsky" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Card Number <i class="fa fa-credit-card"></i></label>
                                                <input type="text" placeholder="xxxx-xxxx-xxxx-xxxx"
                                                    value="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label>Expiry Month<i class="fa fa-calendar"></i></label>
                                                <input type="text" placeholder="MM" value="" />
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Expiry Year<i class="fa fa-calendar"></i></label>
                                                <input type="text" placeholder="YY" value="" />
                                            </div>
                                            <div class="col-sm-3">
                                                <label>CVV / CVC *<i class="fa fa-credit-card"></i></label>
                                                <input type="password" placeholder="***" value="" />
                                            </div>
                                            <div class="col-sm-3">
                                                <p style="padding-top:20px;">*3 digits number on the back of your
                                                    card</p>
                                            </div>
                                        </div>
                                        <div class="log-separator fl-wrap"><span>or</span></div>
                                        <div class="soc-log fl-wrap">
                                            <p>Select Other Payment Method</p>
                                            <a href="#" class="paypal-log"><i class="fa fa-paypal"></i>Pay
                                                With Paypal</a>
                                        </div>
                                        <span class="fw-separator"></span>
                                        <a href="#"
                                            class="previous-form  back-form action-button    color-bg"><i
                                                class="fa fa-angle-left"></i> Back</a>
                                        <a href="#"
                                            class="next-form back-form action-button btn  big-btn  color-bg flat-btn">Payment
                                            Step
                                            <i class="fa fa-angle-right"></i></a>
                                    </fieldset>
                                    <fieldset class="fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Confirmation</h3>
                                        </div>
                                        <div class="success-table-container">
                                            <div class="success-table-header fl-wrap">
                                                <i class="fa fa-check-circle decsth"></i>
                                                <h4>Thank you. Your reservation has been received.</h4>
                                                <div class="clearfix"></div>
                                                <p>Your payment has been processed successfully.</p>
                                                <a href="invoice.html" target="_blank" class="color-bg">View
                                                    Invoice</a>
                                            </div>
                                        </div>
                                        <span class="fw-separator"></span>
                                        <a href="#" class="previous-form action-button  back-form   color-bg"><i
                                                class="fa fa-angle-left"></i> Back</a>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--   list-single-main-item end -->
                </div>
            </div>
        </div>
    </div>
    <div class="bmw-overlay"></div>
    <!--booking-modal-wrap end -->
    <!--register form -->
    {{-- <div class="main-register-wrap modal">
            <div class="main-overlay"></div>
            <div class="main-register-holder">
                <div class="main-register fl-wrap">
                    <div class="close-reg"><i class="fa fa-times"></i></div>
                    <h3>Sign In <span>City<strong>Book</strong></span></h3>
                    <div class="soc-log fl-wrap">
                        <p>For faster login or register use your social account.</p>
                        <a href="#" class="facebook-log"><i class="fa fa-facebook-official"></i>Log in with
                            Facebook</a>
                        <a href="#" class="twitter-log"><i class="fa fa-twitter"></i> Log in with Twitter</a>
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
                                        <input name="email" type="text" onClick="this.select()" value="">
                                        <label>Password * </label>
                                        <input name="password" type="password" onClick="this.select()"
                                            value="">
                                        <button type="submit" class="log-submit-btn"><span>Log In</span></button>
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
        </div> --}}
    <!--register form end -->
    <a class="to-top"><i class="fa fa-angle-up"></i></a>
    <!--chat-widget -->
    {{-- <div class="chat-widget-button"><i class="fa fa-comments-o"></i><span>Chat With Owner</span></div>
        <div class="chat-widget_wrap not-vis-chat">
            <div class="chat-widget_header color-bg">
                <h3>Chat with <a href="author-single.html"> Alisa Noory</a></h3>
                <div class="status st_online"><span></span>Online</div>
            </div>
            <div class="chat-body">
                <!-- message-->
                <div class="chat-message chat-message_guest fl-wrap">
                    <div class="dashboard-message-avatar">
                        <img src="assets/images/avatar/1.jpg" alt="">
                    </div>
                    <span class="chat-message-user-name">Jessie</span>
                    <span class="massage-date">25 may 2018 <span>7.51 PM</span></span>
                    <p>Vivamus lobortis vel nibh nec maximus. Donec dolor erat, rutrum ut feugiat sed, ornare vitae
                        nunc. </p>
                </div>
                <!-- message end-->
                <!-- message-->
                <div class="chat-message chat-message_user fl-wrap">
                    <div class="dashboard-message-avatar">
                        <img src="assets/images/avatar/1.jpg" alt="">
                    </div>
                    <span class="chat-message-user-name">Alica</span>
                    <span class="massage-date">25 may 2018 <span>7.51 PM</span></span>
                    <p>Nulla eget erat consequat quam feugiat dapibus eget sed mauris.</p>
                </div>
                <!-- message end-->
                <!-- message-->
                <div class="chat-message chat-message_guest fl-wrap">
                    <div class="dashboard-message-avatar">
                        <img src="assets/images/avatar/1.jpg" alt="">
                    </div>
                    <span class="chat-message-user-name">Jessie</span>
                    <span class="massage-date">25 may 2018 <span>7.51 PM</span></span>
                    <p>Sed non neque faucibus, condimentum lectus at, accumsan enim. Fusce pretium egestas cursus..</p>
                </div>
                <!-- message end-->
            </div>
            <div class="chat-widget_input fl-wrap">
                <textarea placeholder="Type Message"></textarea>
                <button type="submit"><i class="fa fa-paper-plane-o"></i></button>
            </div>
        </div> --}}
    <!--chat-widget end -->
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins.js"></script>
    <script type="text/javascript" src="assets/js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOURAPIKEYHERE&libraries=places&callback=initAutocomplete">
    </script>
    <script type="text/javascript" src="assets/js/map_infobox.js"></script>
    <script type="text/javascript" src="assets/js/markerclusterer.js"></script>
    <script type="text/javascript" src="assets/js/maps.js"></script>
    {{-- <script>
    $(document).ready(function() {
        $(".listing-rating").on("click", ".star-rating", function() {
            let selectedRating = $(this).data("rating");
            let predioId = $(this).data("id");
    
            // Verificar si ya calificó antes
            if (localStorage.getItem("rated_predio_" + predioId)) {
                Swal.fire("¡Ya calificaste este predio!", "Solo puedes calificar una vez.", "warning");
                return;
            }
    
            $.ajax({
                url: "{{ route('predio.rate') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    predio_id: predioId,
                    rating: selectedRating
                },
                success: function(response) {
                    Swal.fire("¡Calificación guardada!", "Gracias por tu valoración.", "success");
    
                    // Actualizar la vista sin recargar
                    $(".listing-rating[data-id='" + predioId + "']").data("starrating2", response.rating);
                    $(".listing-rating[data-id='" + predioId + "']").html(renderStars(response.rating) + ` <span>(${response.reviews_count} reviews)</span>`);
    
                    // Guardar en localStorage para evitar calificaciones duplicadas
                    localStorage.setItem("rated_predio_" + predioId, true);
                },
                error: function() {
                    Swal.fire("Error", "No se pudo guardar la calificación.", "error");
                }
            });
        });
    
        function renderStars(rating) {
            let stars = "";
            for (let i = 1; i <= 5; i++) {
                stars += `<i class="fa fa-star" style="color: ${i <= rating ? 'gold' : 'gray'};"></i>`;
            }
            return stars;
        }
    });
</script>     --}}
    {{-- <script>
        $(document).ready(function() {
            // Generar estrellas dinámicamente con opción de calificación
            $(".listing-rating").each(function() {
                let rating = $(this).data("starrating2") || 0; // Valor por defecto si no hay rating
                let predioId = $(this).data("id");
                let userRating = localStorage.getItem("rated_predio_" + predioId) || 0;
                let reviewsCount = $(this).find(".reviews-count").text();

                let stars = "";
                for (let i = 1; i <= 5; i++) {
                    stars += `<i class="fa fa-star star-rating" data-rating="${i}" data-id="${predioId}" 
                               style="cursor: pointer; color: ${i <= rating ? 'gold' : 'gray'};"></i>`;
                }
                $(this).html(stars + ` <span class="reviews-count">(${reviewsCount} reviews)</span>`);
            });

            // Manejo de calificación
            $(".listing-rating").on("click", ".star-rating", function() {
                let selectedRating = $(this).data("rating");
                let predioId = $(this).data("id");

                // Verificar si ya calificó
                if (localStorage.getItem("rated_predio_" + predioId)) {
                    Swal.fire({
                        title: "¡Ya calificaste!",
                        text: "No puedes cambiar tu calificación.",
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('predio.rate') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        predio_id: predioId,
                        rating: selectedRating
                    },
                    success: function(response) {
                        console.log("Respuesta del servidor:", response);

                        if (response.success) {
                            // Guardar en localStorage
                            localStorage.setItem("rated_predio_" + predioId, selectedRating);

                            // Actualizar visualmente la calificación sin recargar
                            let starsContainer = $(".listing-rating[data-id='" + predioId +
                                "']");
                            let reviewsSpan = starsContainer.find(".reviews-count");
                            let newReviewsCount = parseInt(reviewsSpan.text().match(/\d+/)[0]) +
                                1; // Extraer número y sumar

                            let newStars = "";
                            for (let i = 1; i <= 5; i++) {
                                newStars +=
                                    `<i class="fa fa-star star-rating" data-rating="${i}" data-id="${predioId}" 
                                               style="cursor: pointer; color: ${i <= response.new_rating ? 'gold' : 'gray'};"></i>`;
                            }

                            starsContainer.html(newStars +
                                ` <span class="reviews-count">(${newReviewsCount} reviews)</span>`
                                );

                            Swal.fire({
                                title: "¡Gracias por calificar!",
                                text: "Tu calificación ha sido guardada con éxito.",
                                icon: "success",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: response.message ||
                                    "No se pudo guardar la calificación.",
                                icon: "error",
                                confirmButtonText: "Intentar de nuevo"
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error("Error en la solicitud AJAX:", xhr);

                        Swal.fire({
                            title: "Error",
                            text: "No se pudo guardar la calificación. Inténtalo de nuevo.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Manejo de "Like"
            $(".like-button").each(function() {
                let predioId = $(this).data("id");

                // Verificar si el usuario ya ha dado like en LocalStorage
                if (localStorage.getItem("liked_predio_" + predioId)) {
                    $(this).css("color", "black"), $(this).css("background", "white");
                }
            });

            $(".like-button").click(function() {
                let predioId = $(this).data("id");
                let likeButton = $(this);
                let likeCounter = $("#like-count");

                // Verificar si ya dio like
                if (localStorage.getItem("liked_predio_" + predioId)) {
                    Swal.fire({
                        title: "¡Ya diste like!",
                        text: "Solo puedes dar like una vez a este predio.",
                        icon: "warning",
                        confirmButtonText: "Entendido"
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('predio.like') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        predio_id: predioId
                    },
                    success: function(response) {
                        likeCounter.text(response.likes);
                        likeButton.css("color", "red"); // Cambia el color al dar like
                        localStorage.setItem("liked_predio_" + predioId, true);

                        Swal.fire({
                            title: "¡Gracias por tu like!",
                            text: "Tu like ha sido registrado.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error",
                            text: "No se pudo registrar el like.",
                            icon: "error",
                            confirmButtonText: "Intentar de nuevo"
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let predioId = "{{ $predio->id }}"; // Obtener el ID del predio

            // Registrar la visita solo si no se ha registrado antes en esta sesión
            if (!sessionStorage.getItem("viewed_predio_" + predioId)) {
                $.ajax({
                    url: "{{ route('predio.view') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        predio_id: predioId
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".viewed-counter .fa-eye").next().text("Visto - " + response.views);
                            sessionStorage.setItem("viewed_predio_" + predioId, true);
                        }
                    },
                    error: function(xhr) {
                        console.error("Error al registrar la visita:", xhr);
                    }
                });
            }
        });
    </script>

</body>

</html>
