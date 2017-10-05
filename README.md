# Herramientas
Mi objetivo es crear una clase la cual contenga varios metodos utiles los cuales por no tener a la mano debemos buscar crearlos y a veces consultar en internet.
## Metodos
**1. memoryUsage**,  nos ayudará a consultar el consumo de memoria de un método, el cual debemos llamar tanto al inicio como al final de nuestro código para ver con cuanto inicia nuestra memoria y en cuanto quedara después de la ejecución de nuestro código:
```
    echo $var->memoryUsage();
    ---Nuestro Código
    echo $var->memoryUsage();
```
**2. setCookie**, este método en conjunto con el método **expirationDate()** nos ayuda a establecer el tiempo que durara las *COOKIE*, al cual le pasaremos un arreglo*(array)* con él índice y el valor que tendrá:
```
	$Cookies = array( 'correo'=>'jorge@live.com' , 'contrasena'=>'x1a2s3');
	$var->setCookie($Cookies);
```
**3. expirationDate**, este método nos ayuda a establecer el tiempo que durara las *COOKIE*, solamente debemos pasarle el tiempo que queremos que dure, diario(daily), mensualmente(monthly), anualmente(anually).

**4. cleanInput**, nos sirve para limpiar nuestro formulario de caracteres especiales. 
```
	$var->cleanInput($_POST)
```

**5. cedula**, este método es solamente para Republica Domincana ya que valida mediante una fórmula si la cédula dominicana es valida.

**6. sendMessageJson**, método que devuelve una respuesta por *json*, este fue diseñado para dar varios tipos de respuestas en conjunto con javascript ya sea por error o éxito. La variable *$bool* por defecto *false* hace referencia a que se devolvera un error si fuera *true* se devolvera un error con exito, la variable *$category* fue diseñada para guardar el nivel de alerta del mensaje ya sea que queramos usar el mismo codigo de javascript para hacer diferentes eventos dependiendo de la categoria del mensaje, la variable *$message* es el mensaje que aparecera y por ultimo *$redirect* es donde redirigiremos al usuario. 
```
//Mensaje Error
$var->sendMessageJson(false,"El usuario o la contraseña estan incorrecto.", 1);
//Mensaje Exito
$var->sendMessageJson(true,"Bienvenido", 1,"perfil.php");
```
