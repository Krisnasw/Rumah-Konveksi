<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script language="javascript">
$(document).ready(function(){
	$("#validasi-form").submit(function(e){
		var wesPodo = validasi($(this));

		if (!wesPodo)
			e.preventDefault();
	})
});

function validasi(form){
	var pass = $("input[name=new_pass]").val();
	var confirmation = $("input[name=re_pass]").val();

	console.log("password => "+pass);
	console.log("password confirmation => "+confirmation);

	if(pass != confirmation){
		alert('Password is not match.');
		$("input[name=re_pass]").val("");
		return false;
	}
	else{
		return true;
	}
}
</script>
<div class="container">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="#"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<li> <a href="login">Login</a> <span></span></li>
					<li> Reset Password </li>
				</ul>
			</div>
	<div class="main-page">
		<h1 class="page-title">Reset Your Password</h1>
			<div class="page-content">
		    	<div class="row">
		        	<div class="col-sm-12">
		            	<div class="box-border">
		            		<h4> Reset Password </h4>
							<small> &nbsp; </small>
								<form id="validasi-form" action="proses_repass.php" method="post">
		            			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		            			<p>
		            				<label>New Password</label>
		            				<input type="password" name="new_pass" autocomplete="off">
		            			</p>
		            			<p>
		            				<label>Re-type Password</label>
		            				<input type="password" name="re_pass" autocomplete="off">
		            			</p>
		            			<p>
		            				<button class="button"t><i class="fa fa-key"></i> &nbsp;Reset Password </button>
									<input type="hidden" name="submitreset" id="submitreset" value="true" />
									
		            			</p>
								</form>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
