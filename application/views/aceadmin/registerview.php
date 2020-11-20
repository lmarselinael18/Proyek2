<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('aceadmin/headerlogin'); ?>

<div class="container" id="notif">
    <?php if ($this->session->flashdata('msg')) : ?>
    <div class="alert alert-warning"> 
    <?php echo $this->session->flashdata('msg') ?>  
    <br>
    </div>
    <?php endif; ?>
</div>

<section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form"> 
                        <h2 class="form-title">REGISTER</h2>
                        <form action="<?php echo site_url(); ?>/register/index" enctype="multipart/form-data" method="post" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama_user" id="name" placeholder="Nama Lengkap" required />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Username" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="notelp"><i class="zmdi zmdi-code-smartphone"></i></label>
                                <input type="number" name="no_telpon" id="name" placeholder="No Telepon" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-graduation-cap"></i></label>
                                <input type="text" name="asal" id="name" placeholder="Asal" required/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-layers"></i></label>
                                <input type="text" name="jurusan" id="name" placeholder="Jurusan" required/>
                            </div>
                            
                            <div class="form-group" <label><b> Unggah File Pas FOTO : </b> </label> 
                                <label for="name"><i class="zmdi zmdi-image"></i></label>
                                <input type="file" name="photo" id="name" placeholder="Photo"/> (File Foto .jpg .png .jpeg max size 2MB)
                            </div>
                            
                            <!-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Register" />
                                <!-- <button class="group btn btn-warning ">
                                    <a href="<?php echo site_url(); ?>/controllerlogin/index" >Back</a>
                                </button> -->
                            </div>
                           
                        </form>
                    </div>
                    
                </div>
            </div>
        </section>

    <script type="text/javascript">
            $('#notif').slideDown('slow').delay(3000).slideUp('slow');
        </script>