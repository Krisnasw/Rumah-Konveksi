<script language="javascript">
function validasi(form){
 if (form.email.value == ""){
    alert("Anda belum mengisikan Email");
    form.email.focus();
    return (false);
  }
  else {
	return (true);
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
					<li> Forget Password </li>
				</ul>
			</div>	
	<div class="main-page">
		<h1 class="page-title">Forget Your Password ?</h1>
			<div class="page-content">
		    	<div class="row">
		        	<div class="col-sm-12">
		            	<div class="box-border">
		            		<h4> Forget Password </h4>
							<small> &nbsp; </small>
								<form action="cek_mail.php" method="post" onSubmit='return validasi(this)'>
		            			<p>
		            				<label>Email</label>
		            				<input type="text" name="email" autocomplete="off">
		            			</p>
		            			<p>
		            				<button class="button"><i class="fa fa-key"></i> &nbsp;Forget Password </button>
		            			</p>
								</form>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
