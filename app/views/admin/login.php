<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Polling Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">

<!--Error Message-->
<?php
	if (isset($data['message']))
	{?>
	<ul>
		<?php
		foreach($data['message'] as $message)
		{?>
			<li> <?php echo $message; ?> </li>
		<?php } ?>
	</ul>

	<?php } ?>
 
<form role="form" action="" method="post" autocomplete="off">
 <h2 class="text-center">Log in</h2>       
        <div class="form-group">	
			<input  id="username" value="admin@gmail.com" name="username" class="form-control" placeholder="Username" required="required" type="email">
		</div>
        <div class="form-group">
        
			<input  id="password" name="password" class="form-control" placeholder="Password" value="admin" required="required" type="password">
		</div>
        <div class="form-group">

			<button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
		</div>
        <div class="clearfix">
            
            
        </div>       
</form>
    
</div>
</body>
</html>                                		                            