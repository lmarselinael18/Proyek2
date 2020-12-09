<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CV Birudeun - Beranda</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/homepage/css/sl-slide.css">
    <script src="<?php echo base_url(); ?>assets/homepage/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/homepage/images/Capture.jpg">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script type="text/javascript">

$(document).ready(function() {
    $('#Jumlah_peserta').on('change', (function() {
        var id_divisi = $('#divisi').val(),
            tgl_mulai = $('#tgl_mulai').val(),
            tgl_selesai = $('#tgl_selesai').val(),
            jumlahpkl = $('#Jumlah_peserta').val();

        $.ajax({
            method: 'GET',
            url: "<?php echo site_url('writer/hitung_sisa2/'); ?>" + id_divisi + "/" + tgl_mulai + "/" + tgl_selesai + "/" + jumlahpkl ,
            processData: false,
            dataType:"json",
            success: function(response) {
                 $("#sisakuota").html("");
                if(response[0].value === "Kuota Penuh"){
                    $("#sisakuota").html("<b>Kuota Penuh<b>");
                    response.map(d=>{
                     $("#sisakuota").append("<br><b>Bulan "+d.bulannama+"</b><br/>Pendaftar<input type='text' class='col-xs-10 col-sm-3' readonly value='"+d.pendaftar+"'/>")
                 })
                }else{
               response.map(d=>{
                 $("#sisakuota").append("<br><b>Bulan "+d.bulannama+"</b><br/>Kuota <input type='text' class='col-xs-10 col-sm-3' readonly value='"+d.value+"'/>Pendaftar <input type='text' class='col-xs-10 col-sm-3' readonly value='"+d.pendaftar+"'/>")
               })
                }
            }
        })
    }))
})
</script>
</head>

<body>
    <!--Header-->
    <header class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a id="logo2" class="pull-left"></a>
                <div class="nav-collapse collapse pull-right">
                    <ul class="nav">
                        <li class="active"><a href="<?=base_url()?>index.php/homepage/index">BERANDA</a></li>
                        <li><a href="<?=base_url()?>index.php/homepage/loadprofil">PROFIL</a></li>
                        <li><a href="<?=base_url()?>index.php/homepage/loadcarapemesanan">CARA PEMESANAN</a></li>
                        <li><a href="<?=base_url()?>index.php/controllerlogin/index">LOGIN</a></li>
                    </ul>        
                </div>
            </div>
        </div>
    </header>
    <!-- /header -->

    <!--Slider-->
    <section id="slide-show">
        <div id="slider" class="sl-slider-wrapper">
            <!--Slider Items-->    
            <div class="sl-slider">
                
                <!--Slider Item2-->
                <div class="sl-slide item2" data-orientation="horizontal" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                    <div class="sl-slide-inner">
                        <div class="container">
                            <img class="pull-right" src="<?php echo base_url(); ?>" alt="" />
                            <h2>CV Birudeun Creative Agency</h2>
                            <h3 class="gap">Jl.Teluk Bayur Selatan</h3>
                            <a class="btn btn-large btn-transparent" href="">View More</a>
                        </div>
                    </div>
                </div>
                <!--Slider Item2-->
                <!--Slider Item2-->
                <div class="sl-slide item3" data-orientation="horizontal" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                    <div class="sl-slide-inner">
                        <div class="container">
                            <img class="pull-right" src="<?php echo base_url(); ?>" alt="" />
                            <h2>Menerimaan Mahasiswa Magang Sebagai</h2>
                            <h3 class="gap">Copy Writer, Desain Grafis, Percetakan</h3>
                            <a class="btn btn-large btn-transparent" href="<?=base_url()?>">View More</a>
                        </div>
                    </div>
                </div>
                <!--Slider Item2-->
            </div>
            <!--/Slider Items-->
            <!--Slider Next Prev button-->
            <nav id="nav-arrows" class="nav-arrows">
                <span class="nav-arrow-prev"><i class="icon-angle-left"></i></span>
                <span class="nav-arrow-next"><i class="icon-angle-right"></i></span> 
            </nav>
            <!--/Slider Next Prev button-->
        </div>
        <!-- /slider-wrapper -->           
    </section>
    <!--/Slider-->

    <section class="main-info">
        <div class="container">
            <div class="row-fluid">

                <div class="span12">
                    <label class="col-sm-12 control-label no-padding-right" for="form-field-1"><h2>Pilih tujuan untuk cek kuota Magang</h2></label>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tujuan</label>
                        <div class="col-sm-9">
                            <select name="id_divisi" id="divisi" required >
                                <option value="0" >-- Pilih Tujuan --</option>
                                <?php foreach($divisi as $key):?> 
                                <option value="<?php echo $key['id_divisi'];?>"><?php echo $key['nama_divisi'];?></option>
                                <?php endforeach;?>
                            </select>
                            &nbsp;
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Mulai</label>

                        <div class="col-sm-5">
                            <input type="date" id="tgl_mulai" name="tgl_mulai" class="col-xs-10 col-sm-3" min="<?php echo date('Y-m-d', time()); ?>" required />
                            <label class="col-xs-10 col-sm-3">* Minimal 1 bulan pemesanan</label>
                        </div>


                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Selesai</label>

                        <div class="col-sm-5">
                            <input type="date" id="tgl_selesai" name="tgl_selesai" class="col-xs-10 col-sm-3" min="<?php echo date('Y-m-d', time()); ?>" required />
                            <label class="col-xs-10 col-sm-3">* Maksimal 1 tahun pemesanan</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jumlah Peserta </label>
                            <input type="text" min="1" step="1" id="Jumlah_peserta" class="col-xs-10 col-sm-3" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4">
                        <label id="sisakuota" class="col-sm-3  control-label no-padding-right" for="form-field-1"> </label>
                           
                        </div>
                    </div>

                </div>

                <div class="span9">
                <br>
                    <b><h4>Siap Membantu anda melihat kuota Magang dengan Mudah , Cepat dan Praktis</h4></b>
                    <p class="no-margin"></p>
                </div>
                <div class="span3">
                    <a class="btn btn-success btn-large pull-right" href="<?=base_url()?>index.php/controllerlogin/index">CEK</a>
                </div>
            </div>
        </div>
    </section>
     
    <!--Bottom-->
    <section id="bottom" class="main">
        <!--Container-->
        <div class="container">
            <!--row-fluids-->
            <div class="row-fluid">
                <!--Contact Info-->
                <div class="span3">
                    <h4>KONTAK</h4>
                    <ul class="unstyled address">
                        <li>
                            <i class="icon-envelope"></i>
                            <strong>Email: </strong> <a href="mailto:derisareta12@gmail.com">Birudeun@gmail.com</a>
                        </li>
                        <li>
                            <i class="icon-phone"></i>
                            <strong>WA Phone:</strong> 085755966780
                        </li>
                    </ul>
                </div>
                <!--End Contact Info-->
                <!--Important Links-->
                <div id="tweets" class="span3">
                    <h4>Alamat CV Birudeun Creative Agensi</h4>
                    <div>
                        <ul class="arrow">
                            <li>
                            Jalan Teluk Bayur Selatan (Sebelah Perumahan ARAYA)
                            </li>
                        </ul>
                    </div>  
                </div>
                <!--Important Links-->

                <!-- <div id="archives" class="span2">
                    <h4>ARCHIVES</h4>
                    <div>
                        <ul class="arrow">
                            <li><a href="#">Link No. 1</a></li>
                            <li><a href="#">Link No. 2</a></li>
                            <li><a href="#">Link No. 3</a></li>
                            <li><a href="#">Link No. 4</a></li>
                            <li><a href="#">Link No. 5</a></li>
                            <li><a href="#">Link No. 6</a></li>
                        </ul>
                    </div>
                </div> -->
                <!--End Links-->
            </div>
            <!--/row-fluid-->
        </div>
        <!--/container-->
    </section>
    <!--/bottom-->

    <!--Footer-->
    <footer id="footer">
        <div class="container">
            <div class="row-fluid">
                <div class="span5 cp">
                    &copy; 2020 <a target="_blank" href="">Magang CV Birudeun</a>. All Rights Reserved.
                </div>
                <div class="span6">
                    <!-- <ul class="social pull-right">
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-google-plus"></i></a></li>                       
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                        <li><a href="#"><i class="icon-instagram"></i></a></li>                   
                    </ul> -->
                </div>
                <div class="span1">
                    <a id="gototop" class="gototop pull-right" href="#"><i class="icon-angle-up"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->

    <script src="<?php echo base_url(); ?>assets/homepage/js/vendor/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/homepage/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/homepage/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/homepage/js/jquery.ba-cond.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/homepage/js/jquery.slitslider.js"></script>
    <!-- Slider -->
    <script type="text/javascript"> 
    $(function() {
        var Page = (function() {
            var $navArrows = $( '#nav-arrows' ),
            slitslider = $( '#slider' ).slitslider( {
                autoplay : true
            } ),
            init = function() {
                initEvents();
            },
            initEvents = function() {
                $navArrows.children( ':last' ).on( 'click', function() {
                    slitslider.next();
                    return false;
                });
                $navArrows.children( ':first' ).on( 'click', function() {
                    slitslider.previous();
                    return false;
                });
            };
            return { init : init };
        })();
        Page.init();

        getMonthName = function(month) {
          switch(month) {
            case "Jan":
                return "01";
                break;
            case "Feb":
                return "02";
                break;
            case "Mar":
                return "03";
                break;
            case "Apr":
                return "04";
                break;
            case "May":
                return "05";
                break;
            case "Jun":
                return "06";
                break;
            case "Jul":
                return "07";
                break;
            case "Aug":
                return "08";
                break;
            case "Sep":
                return "09";
                break;
            case "Oct":
                return "10";
                break;
            case "Nov":
                return "11";
                break;
            case "Des":
                return "12";
                break;
          }
        }

        $('#tgl_mulai').on('change', (function() {
            var tgl_mulai = $(this).val();

            var min = new Date(tgl_mulai);
            min.setDate(min.getDate() + 30);

            var max = new Date(tgl_mulai);
            max.setDate(max.getDate() + 365);


            var s = min.toString().split(" ");
            var s2 = max.toString().split(" ");
            // var array = str.split(" ");

            $('#tgl_selesai').attr('min', s[3] + "-" + getMonthName(s[1]) + "-" + s[2]);
            $('#tgl_selesai').attr('max', s2[3] + "-" + getMonthName(s2[1]) + "-" + s2[2]);
        }))
    });
    </script>
    <!-- /Slider -->
</body>

</html>