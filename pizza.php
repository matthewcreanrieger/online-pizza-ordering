<?php

require('PasswordHash.php');
require('db.php');
require('functions.php');
$content = "";
$_SESSION['extrapizzas'] = "";
$aftercontent = "";
$_SESSION['i'] = 1;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br />";
    die();
}

session_start();

if (isset($_GET['endsession'])) {
	$_SESSION = array();
 	$params = session_get_cookie_params();
 	setcookie(session_name(), '', time() - 42000,
 	$params["path"],
 	$params["domain"], $params["secure"],
 	$params["httponly"]);
}
 
if(!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
    $_SESSION['username'] = '';
}

require('templates.php');


if (isset($_GET['register'])) {
    $content .= $registerForm;
    $_SESSION['extrapizzas'] = "";
$aftercontent = "";
} else if (isset($_POST['signup'])) {
    $_SESSION['extrapizzas'] = "";
$aftercontent = "";
    $errorFlag = false;
    if($_POST['password'] != $_POST['password2']) {
        $errorFlag = true;
        $content .= $passwordMatchError;
    }

    if(isUsernameTaken($_POST['username'])) {
        $errorFlag = true;
        $content .= $usernameTakenError;
    }

    if (!$errorFlag) {
        $errorFlag = !createUser($_POST['username'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['email'], $_POST['address']);

        if (!$errorFlag) {
            $content .= $userCreated;
        }
        else {
            $content .= $registrationError;
        }
    }

    if(!$errorFlag) 
        $content .= $mainContent;
    else
        $content .= $registerForm;
} else if (isset($_POST['username'])) {
    $_SESSION['extrapizzas'] = "";
$aftercontent = "";
    if (checkAuth($_POST['username'], $_POST['password'])) {
        $_SESSION['auth'] = true;
        $_SESSION['username'] = $_POST['username'];
        $content .= $mainContent;
    } else {
        $content .= $loginError;
        $content .= $mainContent;
    }

} else if (isset($_GET['menu'])) {
	$_SESSION['extrapizzas'] = "";
$aftercontent = "";
	$content .= $menu;
} else if (isset($_GET['orderform']) && $_SESSION['username'] != "") {
	$content .= $orderForm;

	//customer info
	$query = 'SELECT first_name, last_name, phone, email, address FROM customers WHERE username = "'.$_SESSION['username'].'"';
	$stmt = $pdo->prepare($query);
   $stmt->execute();
  	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
		$content .= '<label>Last Name: <input required type="text" name="last_name" value="'.$row["first_name"].'"></label><br><label>Phone Number: <input required type="text" name="phone" value="'.$row["last_name"].'"></label><br><label>E-mail: <input required type="text" name="email" value="'.$row['email'].'"></label><br><label>Address (Used For Deliveries Only): <input type="text" name="address" value="'.$row["address"].'"></label><br><br>';
	}
  	
  	//pizzas
  	$content .= '<div id="pizzas"><div id="pizza1"><p><strong>Pizza 1</strong></p><label>Pizza Size <select name="size1">';
	$query = 'SELECT name, price FROM products WHERE type = "Pizza"';
   $stmt = $pdo->prepare($query);
   $stmt->execute();
  	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
		$content .= '<option value="'.$row["name"].'">'.$row["name"].' $'.$row["price"].'</option>';
	}
	$content .= '</select></label>';
	$query = "SELECT name, type FROM ingredients ORDER BY type";
	$stmt = $pdo->prepare($query);
   $stmt->execute();
  	$currentType = "";
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   	if ($row['type'] != $currentType ) {
   		if ($row['type'] != 'Toppings') {
				$content .= "<br>${row['type']}";
				$currentType = $row['type'];
			}
			else
				$content .= '<br><label>'.$row["type"].' ($1/'.$row["type"].')<br><select name="'.$row["type"].'1[]" multiple=multiple>';
				$currentType = $row['type'];
		}
		if ( $row['type'] != 'Toppings' ) {
			$content .= ' <input type="radio" name="'.$row["type"].'1" value="'.$row["name"].'" required/>'.$row["name"].'';
		}
		else
			$content .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
	}
	$content .= '</select></label><br><label>Number Of Pizzas <input type="number" min="0" name="amount1" placeholder="0"/></label><br></div>';
	$aftercontent .= '</div><button type="button" class="add"><a href="?orderform&addPizza&'.++$_SESSION['i'].'">Add Pizza</a></button><br>';
	
	//Other Products
	$query = 'SELECT name, price, type FROM products WHERE type!="Pizza" ORDER BY id DESC';
   $stmt = $pdo->prepare($query);
   $stmt->execute();
   while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
		if ($row['type'] != $currentType ) {
   		$aftercontent .= '<br><p><strong>'.$row["type"].'</strong></p>';
			$currentType = $row['type'];
		}
		$aftercontent .= '<label>'.$row["name"].' ($'.$row["price"].') <input type="number" min="0" name="'.$row["name"].'" placeholder="0"/></label><br>';
		if ($row["type"] == 'Specials')
			$aftercontent .= '<img class="specials" src="assets/'.$row["name"].'.jpg" alt="'.$row["name"].'"><br><br>';
	}
	
	//Submit & Footer
	$aftercontent .= '<br><label><strong>Special Instructions</strong><br><textarea name="Special Instructions" cols=50 rows= 20></textarea></label><br><input type="submit" value="Submit"></form><br></div><div class="bottom"><p><a href="?home">Ichiban Pizzeria</a><br>Xiangbala Ave, Shangri-La<br>+1 (630) 222-4444<br>ichibanpizzeria@gmail.com</p><p><strong>Hours: </strong><em>11:00 - 24:00, Monday - Saturday</em></p></div>';
} else {
	$_SESSION['extrapizzas'] = "";
$aftercontent = "";
	$content .= $mainContent;
}

if ($_SESSION['auth'] === true)
    $login = $loggedInNav;
else
    $login = $loginNav;

if (isset($_GET['addPizza'])) {
	global $pdo;
	$_SESSION['extrapizzas'] .= '<div id="pizza'.$_SESSION['i'].'"><p><strong>Pizza '.$_SESSION['i'].'</strong></p><label>Pizza Size <select name="size'.$_SESSION['i'].'">';
	$query = 'SELECT name, price FROM products WHERE type = "Pizza"';
   $stmt = $pdo->prepare($query);
   $stmt->execute();
  	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
		$_SESSION['extrapizzas'] .= '<option value="'.$row["name"].'">'.$row["name"].' $'.$row["price"].'</option>';
	}
	$_SESSION['extrapizzas'] .= '</select></label>';
	$query = "SELECT name, type FROM ingredients ORDER BY type";
	$stmt = $pdo->prepare($query);
   $stmt->execute();
  	$currentType = "";
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   	if ($row['type'] != $currentType ) {
   		if ($row['type'] != 'Toppings') {
				$_SESSION['extrapizzas'] .= "<br>${row['type']}";
				$currentType = $row['type'];
			}
			else
				$_SESSION['extrapizzas'] .= '<br><label>'.$row["type"].' ($1/'.$row["type"].')<br><select name="'.$row["type"].''.$_SESSION['i'].'[]" multiple=multiple>';
				$currentType = $row['type'];
		}
		if ( $row['type'] != 'Toppings' ) {
			$_SESSION['extrapizzas'] .= ' <input type="radio" name="'.$row["type"].''.$_SESSION['i'].'" value="'.$row["name"].'" required/>'.$row["name"].'';
		}
		else
			$_SESSION['extrapizzas'] .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
	}
	$_SESSION['extrapizzas'] .= '</select></label><br><label>Number Of Pizzas <input type="number" min="0" name="amount'.$_SESSION['i'].'" placeholder="0"/></label><br></label><br><button type="button" onclick="deletePizza(this.parentNode)" class="delete">Remove</button><br></div>';
}

if (isset($_GET['orderform']) && $_SESSION['username'] == "") {
	echo '<script language="javascript">alert("You must log in to order!")</script>';
}
$ep = $_SESSION['extrapizzas'];
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Ichiban Pizzeria</title>
        <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="style.css" type="text/css" rel="stylesheet">
        <style>
        body {
          padding-top: 50px;
          padding-bottom: 20px;
        }
        </style>
    </head>
<body>
<?=$navbarHeader?>
<?=$login?>
<?=$navbarFooter?>
<?=$content?>
<?=$ep?>
<?=$aftercontent?>

<script src="order.js"></script>
<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
