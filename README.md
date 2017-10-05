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
	$var->crearCookies($Cookies);
```
**3. expirationDate**, este método nos ayuda a establecer el tiempo que durara las *COOKIE*, solamente debemos pasarle el tiempo que queremos que dure, diario*(daily)*, mensualmente*(monthly)*, anualmente*(anually)*.