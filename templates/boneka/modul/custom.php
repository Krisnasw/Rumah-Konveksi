<?php
include "function.php";
error_reporting(0);
$boneka = new Boneka();

if (isset($_POST["submit"])) {
    # code...
    $pengirim = $_POST["pengirim"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $telp = $_POST['telp'];
    $pesan = $_POST["pesan"];
    $gambar = mysql_escape_string($_FILES["image"]["name"]);
    $ext= pathinfo($gambar,PATHINFO_EXTENSION);
    $ukuran = $_FILES["image"]["size"];
    $lokasi = $_FILES["image"]["tmp_name"];

    $boneka->Custom($pengirim, $email, $alamat, $pesan, $telp, $gambar, $ext, $ukuran, $lokasi);
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
 
    <meta charset="UTF-8">
    
    <title>Boneka Indonesia | Custom</title> 

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo "$f[folder]/"; ?>assets/css/blueimp-gallery.min.css" rel="stylesheet"/>
    <link href="<?php echo "$f[folder]/"; ?>assets/css/jquery.fileupload.css" rel="stylesheet"/>
    <link href="<?php echo "$f[folder]/"; ?>assets/css/jquery.fileupload-ui.css" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES -->

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?php echo "$f[folder]/"; ?>assets/css/nicdark_style.css"> <!--style-->
    <link rel="stylesheet" href="<?php echo "$f[folder]/"; ?>assets/css/nicdark_responsive.css"> <!--nicdark_responsive-->
    
    <!--END CSS-->

    <!--[if lt IE 9]>  
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>  
    <![endif]-->  
    
    <!--FAVICONS-->
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <!--END FAVICONS-->
    
</head>  
<body id="start_nicdark_framework">

<div class="nicdark_site">
    <div class="nicdark_site_fullwidth nicdark_clearfix"><div class="nicdark_overlay"></div>
<!-- Log out Modal -->
<!-- Start body page -->

<!--start section-->
<section class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">


        <div class="nicdark_space50"></div>     

        <center>
        <div class="grid grid_12">
            <h1 class="grey2 center"><span class="grey">- </span>Custom Design<span class="grey"> -</span></h1>
            <div class="nicdark_space20"></div>
            <p class="grey2 center"><i>Silahkan upload gambar sketsa/foto yang ingin anda wujudkan</i></p>
            <div class="nicdark_focus center">
                <h2 class="nicdark_icon-dress2 grey"></h2>              
            </div>
        </div>
        </center>
        
        
   </div>
   <!--end nicdark_container-->
            
</section>
<!--end section-->


<!--start section-->
<section class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">
<!-- BEGIN PAGE CONTENT-->
            <div class="portlet light">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row">
                                    <div class="col-lg-8 col-lg-offset-2 ">
                                    <div class="form-group slct">
                                      <label>Nama Pengirim :</label>
                                      <input type="text" class="form-control" name="pengirim">
                                    </div>
                                    <div class="form-group slct">
                                      <label>Email :</label>
                                      <input type="text" class="form-control" name="email">
                                    </div>
                                    <div class="form-group slct">
                                      <label>Alamat :</label>
                                      <input type="text" class="form-control" name="alamat">
                                    </div>
                                    <div class="form-group slct">
                                      <label>Telp :</label>
                                      <input type="text" class="form-control" name="telp">
                                    </div>
                                    <div class="form-group slct">
                                      <label for="sel1">Pilih Tipe Pesanan:</label>
                                      <select class='form-control' id='sel1' name="pesan" required>
                                      <?php
                                        $q  = mysql_query("SELECT  * from  subkategori ORDER BY id_subkategori desc");
                                        while($f = mysql_fetch_array($q)) {
                                        echo "
                                        <option value='$f[id_kategori]'>$f[nama_sub]</option>
                                            ";
                                        }
                                        ?>
                                        </select>
                                    </div><br>
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <input type="file" class="btn fileinput-button" name="image"><br>

                                        <button type="submit" class="btn btn-default start" name="submit">
                                        <i class="fa fa-upload"></i>
                                        <span>
                                        Start upload </span>
                                        </button>
                                        <button type="reset" class="btn btn-danger cancel">
                                        <i class="fa fa-ban"></i>
                                        <span>
                                        Cancel upload </span>
                                        </button>
                                        
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process">
                                        </span>
                                    </div>
                                    <!-- The global progress information -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;">
                                            </div>
                                        </div>
                                        <!-- The extended global progress information -->
                                        <div class="progress-extended">
                                             &nbsp;
                                        </div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped clearfix">
                                <tbody class="files">
                                </tbody>
                                </table>
                            </form>

                            <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Notes</h3>
                                </div>
                                <div class="panel-body">
                                <center>
                                    <ul>
                                        <li>
                                             Silahkan pilih gambar yang ingin anda upload dengan klik Add Files, atau dengan drag & drop file tersebut.
                                        </li>
                                        <li>
                                             Maximum ukuran file yang bisa diterima adalah <strong>500 KB</strong>.
                                        </li>
                                        <li>
                                             Hanya file gambar berformat (<strong>JPG, JPEG, PNG</strong>) yang dapat kami terima, selain itu akan ditolak.
                                        </li>                                       
                                    </ul>
                                    </center>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        
   </div>
   <!--end nicdark_container-->
   <script>
        function goBack() {
            window.history.back();
        }
        </script>
    
    <div class="nicdark_space50"></div>
            
</section>
<!--end section-->      
<!-- end body page -->

<!--start section-->
<div class="nicdark_section">

    <div class="nicdark_section nicdark_bg_gradient2">

        <!--start nicdark_container-->
        <div class="nicdark_container nicdark_clearfix">

            
            <div class="grid grid_6 nicdark_bg_greydark2 percentage">
                
                <div class="nicdark_activity nicdark_bg_greendark nicdark_oblique_left" style="background:#d02662">
                    <div class="nicdark_space5"></div>
                    <p class="greydark">
                        <small><i class="icon-angle-left greendark" style="color:white"></i></small>
                    </p>
                    <div class="nicdark_space5"></div>
                </div>
                    
            </div>

        </div>
        <!--end nicdark_container-->

    </div>
            
</div>
<!--end section-->        </div>
    </div>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn blue start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn red cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="fa fa-trash-o"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn yellow cancel btn-sm">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>

<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/js/main.js"></script>
<script src="<?php echo "$f[folder]/"; ?>assets/js/jquery.fileupload-image.js"></script>
<script src="<?php echo "$f[folder]/"; ?>assets/js/formupload.js"></script>
<script>
        jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
                FormFileUpload.init();
                });
    </script>
<!-- END JAVASCRIPTS -->
<!--end preloader-->

</body>  
</html>