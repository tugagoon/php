<!DOCTYPE html>
<html lang="en">
<head>
  <title>Formulario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<?php
// define variables and set to empty values
$assuntoErr = $tipoContactoErr = $descricaoErr = $metodoErr = "";
$assunto = $tipoContacto = $descricao = $metodo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["assunto"])) {
    $assuntoErr = "Tem de introduzir um assunto";
  } else {
    $assunto = test_input($_POST["assunto"]);
  }
  
  if (empty($_POST["tipoContacto"])) {
    $tipoContactoErr = "Tem de escolher um tipo";
  } else {
    $tipoContacto = test_input($_POST["tipoContacto"]);
  }
    
  if (empty($_POST["descricao"])) {
    $descricaoErr = "Tem de introduzir uma descricao";
  } else {
    $descricao = test_input($_POST["descricao"]);
  }

  if (empty($_POST["metodo"])) {
    $metodoErr = "Tem de escolher um metodo";
  } else {
  	if(strcmp($metodo, "Outro") == 0){
  		$metodo= test_input($_POST["metodo"]);
  	}
  	else{
  		$metodo = test_input($_POST["metodo"]);
  	}
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="container">
  	<h2>Formulario</h2>
  	<p><span class="error">* required field.</span></p>
  	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  	<form role="form">
	    <div class="form-group">
	      	<label for="assunto">Assunto:</label>
	    	<span class="error">* <?php echo $assuntoErr;?></span>
		    <input type="assunto" name="assunto" class="form-control" id="assunto" placeholder="Introduza assunto">
	    </div>
		<dt>Tipo de Contacto: <span class="error">* <?php echo $tipoContactoErr;?></span></dt>
	    <div class="radio">
	      	<label><input type="radio" name="tipoContacto">Profissional</label>
	    </div>
	    <div class="radio">
	      	<label><input type="radio" name="tipoContacto">Académico</label>
	    </div>
	    <div class="radio">
	      	<label><input type="radio" name="tipoContacto">Outro</label>
	    </div>
		<div class="form-group">
		    <label for="desc">Descricao</label>
		    <span class="error">* <?php echo $descricaoErr;?></span>
			<textarea class="form-control" rows="3" name="descricao" id="desc" placeholder="Introduza descrição"></textarea>
	    </div>
		<dt>Metodo de contacto preferencial: <span class="error">* <?php echo $metodoErr;?></span></dt>
	    <div class="radio">
	      	<label><input type="radio" name="metodo">Telemovel</label>
	    </div>
	    <div class="radio">
	      	<label><input type="radio" name="metodo">Email</label>
	    </div>
	    <div class="radio">
	      	<label><input type="radio" name="metodo">Outro</label>
			<input type="Outro" class="form-control" name="outro" id="outro" placeholder="Qual?">
	    </div>
	    <br>
		<label class="btn btn-default btn-file">
		    Browse PDF <input type="file" style="display: none;">
		</label>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>

<?php
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO Formulario (assunto, tipoContacto, descricao, metodo)
	VALUES ('"+$assunto+"', '"+$tipoContacto+"', '"+$descricao+"','"+$metodo+"')";

	if ($conn->query($sql) === TRUE) {
	    echo "Adicao feita com sucesso";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>

</body>
</html>
