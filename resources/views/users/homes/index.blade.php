<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title> {{"Tobazone"}}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon  -->
    <link rel="shortcut icon" href="/images/assets/icon_1.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="/user-assets/css/core-style.css">
    <link rel="stylesheet" href="/user-assets/style.css">

    <link rel="stylesheet" href="/user-assets/new-css.css">

    <!-- <link rel="stylesheet" href="/user-assets/normalize.css"> -->
    <!-- <link rel="stylesheet" href="/user-assets/webflow.css"> -->
    <link rel="stylesheet" href="/user-assets/test-page-gridstyle.css">


    <link rel="stylesheet" href="/user-assets/css/header.css">

    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>


<div id="app">
    @include('users.layouts.header')
    <div class="container-fluid">

        <div class="row mt-3" style="background-color : white ">
            <div class="col-md-8" style="padding-right:1.8rem;">
                <carousel></carousel>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="row">
                    <div class="col-md-12" style="padding-left:0.5rem">
                        <a href="/search">
                            <img class="img-besidecar" src="{{ url("/images/carousels/carouselsamping1.png" )}}"
                            alt="Card image cap test" style="height: 100%; width : 100%">
                        </a>
                    </div>
                </div>

                <div class="row pt-2 pr-0">
                    <div class="col-md-12" style="padding-left:0.5rem">
                        <a href="/product/ulos">
                            <img class="img-besidecar" src="{{ url("/images/carousels/carouselsamping2.png" )}}"
                            alt="Card image cap test" style="height:100%; width : 100%; background-color:
                            black!important">
                        </a>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="row justify-content-center mb-5">--}}
{{--            <a href="#"><div class="card shadow rounded-5" style="width:6rem; height:8.5rem">--}}
{{--                    <img class="card-img-top m-auto" src="images/kategori_produk/fashion.png" alt="Card image cap">--}}
{{--                    <p class="card-text text-center">Fashion</p>--}}
{{--                </div></a>--}}
{{--            <a href="#"><div class="card shadow rounded-5 ml-4" style="width:6rem; height:8.5rem">--}}
{{--                    <img class="card-img-top m-auto" src="images/kategori_produk/tenun.png" style="width:60px; height:90px" alt="Card image cap">--}}
{{--                    <p class="card-text text-center">Tenun</p>--}}
{{--                </div></a>--}}
{{--            <a href="#"><div class="card shadow rounded-5 ml-4 " style="width:6rem; height:8.5rem">--}}
{{--                    <img class="card-img-top m-auto pt-1" src="images/kategori_produk/kesehatan.png" style="width:60px; height:75px" alt="Card image cap">--}}
{{--                    <p class="card-text text-center mb-2" style="line-height: 100%">Kesehatan & Kecantikan</p>--}}
{{--                </div></a>--}}
{{--            <a href="#"><div class="card shadow rounded-5 ml-4 " style="width:6rem; height:8.5rem">--}}
{{--                    <img class="card-img-top mt-4 mb-3" src="images/kategori_produk/kuliner.png" alt="Card image cap">--}}
{{--                    <p class="card-text text-center">Kuliner</p>--}}
{{--                </div></a>--}}
{{--            <a href="#"><div class="card shadow rounded-5 ml-4 " style="width:6rem; height:8.5rem">--}}
{{--                    <img class="card-img-top mt-4 mb-2" src="images/kategori_produk/aksesoris.png" alt="Card image cap">--}}
{{--                    <p class="card-text text-center">Aksesoris</p>--}}
{{--                </div></a>--}}
{{--            <a href="#"><div class="card shadow rounded-5 ml-4 " style="width:6rem; height:8.5rem">--}}
{{--                    <img class="card-img-top m-auto" src="images/kategori_produk/penginapan.png"  style="width:70px; height:70px" alt="Card image cap">--}}
{{--                    <p class="card-text text-center">Penginapan</p>--}}
{{--                </div></a>--}}
{{--            <a href="#"><div class="card shadow rounded-5 ml-3 " style="width:6rem; height:8.5rem">--}}
{{--                    <img class="card-img-top m-auto" src="images/kategori_produk/paket_wisata.jpg" style="width:85px; height:85px" alt="Card image cap">--}}
{{--                    <p class="card-text text-center">Paket Wisata</p>--}}
{{--                </div></a>--}}
{{--        </div>--}}

        <div class="row" id="product-terlaris">
            <produk-terlaris/>
        </div>

        <div id="new-product">
            @if(Auth::check())
            <new-products :user-id="{{Auth::user()->id}}" :title="'Produk Terbaru'"/>
            @else
            <new-products :title="'Produk Terbaru'"/>
            @endif
        </div>

{{--        <div class="container-fluid mt-7" id="informasi-pariwisata">--}}
{{--            <informasi-dicari />--}}
{{--        </div>--}}

{{--        <div class="container-fluid mt-7" id="komunitas-paket-wisata">--}}
{{--            <komunitas-paket-wisata />--}}
{{--        </div>--}}

        <!-- <div id="banner">
            <banner/>
        </div> -->
    </div>
    @include('users.layouts.footer')
</div>
@include('users.layouts.script')
<script>
    $(document).ready(function () {
        $("#sidebar1Collapse").on("click", function () {
            $("#sidebar1").addClass("active");
            console.log("a!");
        });

        $("#sidebar1CollapseX").on("click", function () {
            $("#sidebar1").removeClass("active");
            console.log("b!");
        });

        $("#sidebar1Collapse").on("click", function () {
            if ($("#sidebar1").hasClass("active")) {
                $(".overlay").addClass("visible");
                console.log("c!");
            }
        });

        $("#sidebar1CollapseX").on("click", function () {
            $(".overlay").removeClass("visible");
            console.log("d!");
        });

        $("#butMasuk").on("click", function () {
            $("#sidebar1").removeClass("active");
            $(".overlay").removeClass("visible");
        });

        $("#butDaftar").on("click", function () {
            $("#sidebar1").removeClass("active");
            $(".overlay").removeClass("visible");
        });

    });

</script>
</body>

</html>
<script>
    import ProdukTerlaris from "../../../js/components/homes/ProdukTerlaris";
    import KomunitasPaketWisata from "../../../js/components/homes/KomunitasPaketWisata";

    export default {
        components: {ProdukTerlaris, KomunitasPaketWisata}
    }
</script>
