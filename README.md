# Clases PHP para enviar y recibir REST

## Introducción

1. El cliente realiza una petición a un servidor.
2. El servidor recibe la petición y manda una respuesta al cliente.
3. El cliente finalmente recibe la respueta del servidor.

### Índice

- Clase RestClient
- Clase RestServer
- Clases de la carpeta network
- Clases para datos con formato
- Pruebas
- Enlaces

<hr>

## Clase "RestClient"

Envía una petición al servidor y recibe su respuesta

### 1) Constructor

Método                | Descripción
----------------------|------------
`__construct(Format)` | Establece el formato.<br>Instancia ClientRequest y ClientResponse

### 2) Construye la petición

Método                          | Descripción
--------------------------------|------------
`setServer`                     | Dirección URL del servidor
`setUri`                        | Parámetros por URI "/uno/dos/..."
`setQuery`<br> `setQueryString` | Parámetros por GET "?name=value&..."
`setMethod`                     | Método: GET, POST, PUT, DELETE, ...
`setMime`                       | Tipo de formato en el mensaje
`setContent`<br> `setData`      | Contenido del mensaje

### 3) Envío la petición

Método                  | Descripción
------------------------|------------
`send():ClientResponse` | Envía la petición al servidor

### 4) Obtiene la respuesta

Método                     | Descripción
---------------------------|------------
`getCode`                  | El código HTTP: 200, 404, ...
`getMime`                  | El tipo MIME de la respuesta
`getContent`<br> `getData` | El mensaje de respuesta

### Clases hijas

- `RestClientJSON`
- `RestClientXML`

<hr>

## Clase "RestServer"

Recibe la petición del cliente y da una respuesta

### 1) Constructor

Método         | Descripción
---------------|------------
 `__construct` | Instancia ServerRequest y ServerResponse

### 2) Recibe la petición

Método                           | Descripción
---------------------------------|------------
`getRequest`                     | Clase ServerRequest
`getUri`                         | Datos por URI "/uno/dos/..."
`getQuery`<br> `getQueryString`  | Datos por GET "?name=value&..."
`getMime`                        | Tipo MIME del mensaje
`getMethod`                      | Método: GET, POST, PUT, DELETE, ...
`getContent`<br> `getData`       | Contenido del mensaje

### 3) Construye la respuesta

Método                     | Descripción
---------------------------|------------
`setResponse`              | Clase ServerResponse
`setCode`                  | Código HTTP: 200, 404, ...
`setMime`                  | Formato del mensaje
`setContent`<br> `setData` | Establece el mensaje de respuesta

### 4) Envía la respuesta

Método    | Descripción
----------|------------
`send`    | Respuesta al cliente

<hr>

## Clases de la carpeta network

### De uso general

Clase        | Descripción
-------------|------------
`Constants`  | Constantes de METHODS, MIMES y CODES
`Header`     | Tratamiento de las líneas de una cabecera HTTP
`URL`        | Normaliza una dirección URL

### Petición del cliente al servidor

Clase           | Descripción
----------------|------------
`Request`       | Clase base que almacena los datos de una petición
`ClientRequest` | Agrega el método `getURL` a la clase Request
`ServerRequest` | Recupera la petición a partir de `$_SERVER` y `php://input`

### Respuesta del servidor al cliente

Clase            | Descripción
-----------------|------------
`Response`       | Clase base que almacena los datos de una respuesta
`ClientResponse` | Hereda de Response
`ServerResponse` | Hereda de Response

<hr>

## Clases para datos con formato JSON, XML, etc.

### Clase "format/Data"

Almacena datos en el formato especificado

Método1     | Método2     | Descripción
------------|-------------|------------
`getFormat` | `setFormat` | Formato de datos con la clase Format
`getData`   | `setData`   | Datos en crudo almacenados en array
`getText`   | `setText`   | Datos string codificados según el formato
`encode`    | `decode`    | Implementación de la clase Format

### Clase abstracta "format/Format"

Método                 | Descripción
-----------------------|------------
`mime():string`        | Retorna el tipo MIME
`header`               | Escribe el encabezado de respuesta
`encode(array):string` | Codifica al formato
`decode(string):array` | Decodifica el formato

#### Clases hijas (mime):

- `FormatJSON` &mdash; application/json
- `FormatXML`  &mdash; application/xml
- `FormatURL`  &mdash; application/x-www-form-urlencoded
- `FormatText` &mdash; text/plain
- `FormatHTML` &mdash; text/html
- `FormatYAML` &mdash; text/x-yaml

<hr>

## Pruebas

### Con formulario

- form/[sender](form/sender.php?server=receiver.php&uri=&query=) echo
- form/[sender](form/sender.php?server=http%3A%2F%2Fmaps.google.com&uri=%2Fmaps%2Fapi%2Fgeocode%2Fjson&query=address%3DBarcelona%26sensor%3Dfalse) Google geocode

### Tests

- rest/network/[test_URL](rest/network/test_URL.php)
- rest/network/[test_URI](rest/network/test_URI.php)
- rest/network/[test_Header](rest/network/test_Header.php)
- rest/network/[test_ServerRequest](rest/network/test_ServerRequest.php/uno/dos/tres?abc=123&def=456)
- rest/network/[test_Server](rest/network/test_Server.php)
- rest/network/[**test_Client**](rest/network/test_Client.php)
- rest/format/[test_Data](rest/format/test_Data.php)
- rest/[test_JSON](rest/test_JSON.php)
- rest/[test_RestServer](rest/test_RestServer.php)
- rest/[**test_RestClient**](rest/test_RestClient.php)

<hr>

## Enlaces

- [Creating a RESTful API with PHP](http://coreymaynard.com/blog/creating-a-restful-api-with-php/) &mdash; Corey Maynard
- [Accessing Incoming PUT Data from PHP](https://lornajane.net/posts/2008/accessing-incoming-put-data-from-php) &mdash; LORNAJANE blog
- [Servicios web (2): ¿Qué es REST?](https://eamodeorubio.wordpress.com/2010/07/26/servicios-web-2-%c2%bfque-es-rest/) &mdash;
- [API REST: qué es y cuáles son sus ventajas en el desarrollo de proyectos](https://bbvaopen4u.com/es/actualidad/api-rest-que-es-y-cuales-son-sus-ventajas-en-el-desarrollo-de-proyectos) &mdash;

### Qué es una REST API

- [REST API concepts and examples ](https://youtu.be/7YcW25PHnAA) &mdash; YouTube
- [Using REST APIs in a web application](https://youtu.be/RTjd1nwvlj4) &mdash; YouTube
