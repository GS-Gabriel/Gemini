<?php
/**
 * MASTER LOGIN SYSTEM
 * @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
 * June 2013
 *
 */





    if(!isset($_SESSION['token']))
        $_SESSION['token'] = sha1(rand()); // random token

echo "
<hr>

<div class='modal hide' id='loginModal'>
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>✕</button>
        <h3>Login</h3>
    </div>
        <div class='modal-body' style='text-align:center;'>
        <div class='row-fluid'>
            <div class='span10 offset1'>
                <div id='modalTab'>
                    <div class='tab-content'>
                        <div class='tab-pane active' id='login'>
                            <form method='post' action='login.php' name='login_form'>
                                <p><input type='text' class='span12' name='name' placeholder='Username'></p>
                                <p><input type='password' class='span12' name='password' placeholder='Password'></p>
                                <p>
                                	<input class='pull-left' type='checkbox' name='r' value='1' id='rm'>  
                                	<label class='pull-left' for='rm'>Remember Me</label>
                                </p>
                                <div class='clearfix'></div>

                                <input type='hidden' name='token' value='".$_SESSION['token']."'>
                                
                                <p><button type='submit' class='btn btn-primary'>Sign in</button>
                   
                                </p>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";

?>




<div class="container">	
<div class="row-fluid">
				<div class="span12">
					<div class="span2" style="width: 15%;">
						<ul class="unstyled">
							<li>Gemini Inc V2<li>
							<li><a href="https://scriptkidd1e.wordpress.com">About us</a></li>
						</ul>
					</div>
					<div class="span2" style="width: 15%;">
						<ul class="unstyled">
							<li>Twitter<li>
							<li><a href="https://twitter.com/sec_9emin1">Contact</a></li>
						</ul>
					</div>

				</div>
			</div>
			<hr>
			<div class="row-fluid">
				<div class="span12">
					<div class="span8">
						<a href="#">Terms of Service</a>    
						<a href="#">Privacy</a>    
						<a href="#">Security</a>
					</div>
					<div class="span4">
						<p class="muted pull-right">© 2018 Gemini Inc V2. All rights reserved</p>
					</div>
				</div>
			</div>
  </div>    

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>
<script src='js/rsa_jsbn.js'></script>
<script src='js/gibberish-aes.js'></script>
<script src='js/cryptopost.js'></script>

<!-- Validate Plugin -->
<script src="js/vendor/jquery.validate.min.js"></script>

<script src="js/main.js"></script>

</body>
</html>
