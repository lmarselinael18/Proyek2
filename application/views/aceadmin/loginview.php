<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('aceadmin/headerlogin'); ?>

<!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><a href="<?php echo site_url('homepage/index/'); ?>"></a></figure>
                        <a href="<?php echo site_url('register/index/'); ?>" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form"> 
                        <h2 class="form-title">LOGIN</h2>
               <!--          <form method="POST" class="register-form" id="login-form"> -->
	              				 <div class="container" id="notif">
								<?php if ($this->session->flashdata('msg')) : ?>
									<div class="alert alert-warning">
									<?php echo $this->session->flashdata('msg') ?>	
									<br>
                                    <br>
									</div>
								<?php endif; ?>
								</div>								
								<?php 
								if(validation_errors())
								{ ?>
									<div class="container-fluid">
										<div class="alert alert-succes">
										<?php echo validation_errors();?> 
										<br>
										</div>
                                        <br>
									</div>
								<?php	} ?>
							<?php echo form_open('controllerlogin/login'); ?>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="input_username" id="your_name" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="Password" name="input_password" id="your_pass" placeholder="Password"/>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signin" class="form-submit" value="Log in"/>
                            </div>
                            <?php echo form_close(); ?> 
                      <!--   </form> -->
                        <!-- <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

        <script type="text/javascript">
			$(document).ready(function() {
				$('#tabelbarang').DataTable();
			});

			$('#notif').slideDown('slow').delay(3000).slideUp('slow');
		</script>
