<?php

$registrationError = <<<EOD
            <div class="alert alert-danger" role="alert">There was an error registering your account.  Please try again.</div>
EOD;
$passwordMatchError = <<<EOD
            <div class="alert alert-danger" role="alert">The provided passwords do not match.</div>
EOD;
$usernameTakenError = <<<EOD
            <div class="alert alert-danger" role="alert">The username is already taken.</div>
EOD;
$userCreated = <<<EOD
            <div class="alert alert-success" role="alert">You've successfully created your account.  Proceed with login.</div>
EOD;
$loginError = <<<EOD
            <div class="alert alert-danger" role="alert">The provided credentials are incorrect.</div>
EOD;
$orderForm = <<<EOD
      <div class="top">
			<br><br><br>
			<img class="imgl" src="assets/bamboo.gif" alt="Bamboo">
			<img class="imgr" src="assets/bamboo.gif" alt="Bamboo">
			<h1><strong>一番</strong><br><em>Pizzeria</em></h1><br><hr>
		</div>
		
		<div id="side">
			<br><br>
			<h3>≈</h3>
			<h3><a href="?home">HOME</a></h3>
			<h3>≈</h3>
			<h3><a href="?register">REGISTER</a></h3>
			<h3>≈</h3>
			<h3><a href="?menu">MENU</a></h3>
			<h3>≈</h3>
			<h3><a href="?orderform">ORDER</a></h3>
			<h3>≈</h3>
			<h3><a href="#">LOCATIONS</a></h3>
			<h3>≈</h3>
			<br><br><br><br><br>
		</div>
		
		<div id="バカ外人">
			<br>
			<h3>私</h3>
			<h3>は</h3>
			<h3>バ</h3>
			<h3>か</h3>
			<h3>外</h3>
			<h3>人</h3>
			<h3>で</h3>
			<h3>す</h3>
			<br>
		</div>
		
		<div class="contents">
			<img class="logo" src="assets/logo.jpg" alt="Logo">
			<h2>Order Form</h2>
			<form action="submit.php" method="post">
EOD;

$loginNav = <<<EOT
        <div id="navbar" class="navbar-collapse collapse">
          <form action="pizza.php" method="post" class="navbar-form navbar-right">
            <div class="form-group">
              <input name="username" type="text" placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          <a href="?register" class="btn btn-primary">Register</a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
EOT;


$loggedInNav = <<<EOT
    <p class="navbar-text navbar-right" >Logged in as ${_SESSION['username']}</p>
    <br>
    <a href="?endsession" class="navbar-form navbar-center btn btn-warning">Sign Out</a>
EOT;


$navbarHeader = <<<EOT
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?home">Ichiban Pizzeria</a>
        </div>
EOT;
$navbarFooter = <<<EOT
      </div>
    </nav>
EOT;

$menu = <<<EOT
	<div class="top">
			<br><br><br>
			<img class="imgl" src="assets/bamboo.gif" alt="Bamboo">
			<img class="imgr" src="assets/bamboo.gif" alt="Bamboo">
			<h1><strong>一番</strong><br><em>Pizzeria</em></h1><br><hr>
		</div>
		
		<div id="side">
			<br><br>
			<h3>≈</h3>
			<h3><a href="?home">HOME</a></h3>
			<h3>≈</h3>
			<h3><a href="?register">REGISTER</a></h3>
			<h3>≈</h3>
			<h3><a href="?menu">MENU</a></h3>
			<h3>≈</h3>
			<h3><a href="?orderform">ORDER</a></h3>
			<h3>≈</h3>
			<h3><a href="#">LOCATIONS</a></h3>
			<h3>≈</h3>
			<br><br><br><br><br>
		</div>
		
		<div id="バカ外人">
			<br>
			<h3>私</h3>
			<h3>は</h3>
			<h3>バ</h3>
			<h3>か</h3>
			<h3>外</h3>
			<h3>人</h3>
			<h3>で</h3>
			<h3>す</h3>
			<br>
		</div>
		
		<div class="contents">
			<img class="logo" src="assets/logo.jpg" alt="Logo" style="width:160px;height:160px;">
			<h2>Menu</h2>
			<h3><em>full moon specials</em></h3>
			<img class="moonphases" src="assets/moonphases.jpg" alt="Moon Phases">
			<p>Gyūdon 牛丼 Pie - $14.99</p>
			<img class="specials" src="assets/Gyudon Pie.jpg" alt="Gyudon Pie"><br>
			<p>Shitake 椎茸 Circle - $11.99</p>
			<img class="specials" src="assets/Shitake Circle.jpg" alt="Shitake Circle"><br><br>
			<h3><em>pizza toppings</em></h3>
		
			<table>
				<tr>
					<td>Pepperoni<br><img class="imgstd" src="assets/pepperoni.jpg" alt="Pepperoni"></td>
					<td>Sliced Beef<br><img class="imgstd" src="assets/slicedbeef.jpg" alt="Sliced Beef"></td>
					<td>Shitake Mushrooms<br><img class="imgstd" src="assets/shitake.jpg" alt="Shitake"></td>
				</tr>
				<tr>
					<td>Jalapeño Peppers<br><img class="imgstd" src="assets/jalapeno.jpg" alt="Jalapeno"></td>
					<td>Banana Peppers<br><img class="imgstd" src="assets/bananapeppers.jpg" alt="Banana Peppers"></td>
					<td>Salmon<br><img class="imgstd" src="assets/salmon.jpg" alt="Salmon"></td>
				</tr>
				<tr>
					<td>Duck<br><img class="imgstd" src="assets/duck.jpg" alt="Duck"></td>
					<td>Spinach<br><img class="imgstd" src="assets/spinach.jpg" alt="Spinach"></td>
					<td>Apples<br><img class="imgstd" src="assets/apples.jpg" alt="Apples"></td>
				</tr>
			</table><br>
		
			<h3><em>subs</em></h3>
			<ul>
				<li>The Philly<br><img class="imgstd" src="assets/thephilly.jpg" alt="Philly"></li>
				<li>Meatball Hoagie<br><img class="imgstd" src="assets/meatballhoagie.jpg" alt="Meatball Hoagie"></li>
			</ul><br>
		
			<h3><em>salads</em></h3>
			<ul>
				<li>Caesar Salad<br><img class="imgstd" src="assets/caesarsalad.jpg" alt="Caesar Salad"></li>
				<li>Tilapia Salad<br><img class="imgstd" src="assets/tilapiasalad.jpg" alt="Tilapia Salad"></li>
			</ul><br>
		
			<h3><em>breadsticks</em></h3>
			<ul>
				<li>Garlic Twists<br><img class="imgstd" src="assets/garlictwists.jpg" alt="Garlic Twists"></li>
				<li>Chinese Doughnuts<br><img class="imgstd" src="assets/chinesedoughnuts.jpg" alt="Chinese Doughnuts"></li>
			</ul><br>
		
			<h3><em>drinks</em></h3>
			<ul>
				<li>Homemade Gourmet Cola<br><img class="imgstd" src="assets/cola.jpg" alt="Cola"></li>
				<li>Umeshu 梅酒<br><img class="imgstd" src="assets/umeshu.jpg" alt="Umeshu"></li>
			</ul><br>
		</div>
		
		<div class="bottom">
			<p><a href="?home">Ichiban Pizzeria</a><br>Xiangbala Ave, Shangri-La<br>+1 (630) 222-4444<br>ichibanpizzeria@gmail.com</p>
			<p><strong>Hours: </strong><em>11:00 - 24:00, Monday - Saturday</em></p>
		</div>
EOT;


$mainContent = <<<EOT
	<div class="top">
			<br><br><br>
			<img class="imgl" src="assets/bamboo.gif" alt="Bamboo">
			<img class="imgr" src="assets/bamboo.gif" alt="Bamboo">
			<h1><strong>一番</strong><br><em>Pizzeria</em></h1><br><hr>
		</div>
		
		<div id="side">
			<br><br>
			<h3>≈</h3>
			<h3><a href="?home">HOME</a></h3>
			<h3>≈</h3>
			<h3><a href="?register">REGISTER</a></h3>
			<h3>≈</h3>
			<h3><a href="?menu">MENU</a></h3>
			<h3>≈</h3>
			<h3><a href="?orderform">ORDER</a></h3>
			<h3>≈</h3>
			<h3><a href="#">LOCATIONS</a></h3>
			<h3>≈</h3>
			<br><br><br><br><br>
		</div>
		
		<div id="バカ外人">
			<br>
			<h3>私</h3>
			<h3>は</h3>
			<h3>バ</h3>
			<h3>か</h3>
			<h3>外</h3>
			<h3>人</h3>
			<h3>で</h3>
			<h3>す</h3>
			<br>
		</div>
		
		<div class="contents">
			<img class="logo" src="assets/logo.jpg" alt="Logo">
			<h2>Ichiban Pizzeria</h2>
			<h3><em>full moon specials</em></h3>
			<img class="moonphases" src="assets/moonphases.jpg" alt="Moon Phases">
			<p>Gyūdon 牛丼 Pie - $14.99</p>
			<img class="specials" src="assets/Gyudon Pie.jpg" alt="assets/Gyudon Pie"><br>
			<p>Shitake 椎茸 Circle - $11.99</p>
			<img class="specials" src="assets/Shitake Circle.jpg" alt="assets/Shitake Circle"><br><br>
			<h3><em>about ichiban</em></h3>
			<p>Ichiban Pizzeria is <em>small, locally-owned</em> pizza joint<br>famous for <em>combining</em> palettes and <em>blending</em> cuisines<br>from <em>around the globe</em>.<br><br><a href="?menu">Try our one-of-a-kind pizza pies or a globally-inspired entrée today!</a></p><br>
		</div>
		
		<div class="bottom">
			<p><a href="?home">Ichiban Pizzeria</a><br>Xiangbala Ave, Shangri-La<br>+1 (630) 222-4444<br>ichibanpizzeria@gmail.com</p>
			<p><strong>Hours: </strong><em>11:00 - 24:00, Monday - Saturday</em></p>
		</div>
EOT;

$registerForm = <<<EOD
    <div class="container">
        <h1>Customer Registration Form</h1>
            <form action="pizza.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input class="form-control" type="text" name="firstName" id="firstName">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input class="form-control" type="text" name="lastName" id="lastName">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input class="form-control" type="text" name="phone" id="phone">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" type="text" name="address" id="address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Enter password">
                    <input class="form-control" type="password" name="password2" id="password2" placeholder="Re-enter password">
                </div>
                <input class="btn btn-default" type="submit" name="signup" value="Register">
            </form>
    </div>
EOD;
