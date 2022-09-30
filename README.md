<h2 align="center">
  <br>
  <a href=""><img src="https://raw.githubusercontent.com/derematevive/chicoauctions/main/resources_temp/logo_380x380.png" alt="Chico-Auctions" width="200"></a>
  <br>
  The e-commerce 💋 KISS! and DRY!
  <br>
</h2>
<h4 align="center">
<a href="https://es.wikipedia.org/wiki/Principio_KISS" target="_blank">KISS</a>
- <a href="https://es.wikipedia.org/wiki/No_te_repitas" target="_blank">DRY</a>
- Defensive Programming
</h4>


Marketplace auctions Open Sources

## 🤔 ¿Qué será Chico-Auctions?

```

Será una plataforma para lanzar sitios de compra y venta de productos online.
O sea, un Marketplace Multivendor Seller/Vendor.
Con unos simples pasos esta herramienta te permitirá conectar tu Market online 
a otros sistemas ampliamente utilizados por los usuarios.

```

## 🚩 Lista de contenido 🏗️

- [Diagrama DB](https://github.com/derematevive/db_chico_auctions)↗️
- [Estructura Directorios]()🏗️
- [Contribuir con el desarrollo](#)🏗️
- [Control y lógica de versiones](#)🏗️
- [Browser Support](#-browser-support)🏗️
- [Pull Request Steps](#-pull-request-steps)🏗️
- [Used By](#-used-by)
- [License](#id-license)🏗️

# 🚦 Control versiones

| Nombre | Descripción | Colaborativo 
| :---: | :---: | :---: |
| Main 🏠| Default cambios | Documental - Not clone
| Hot-child 🥵 | localhost | Dowlond - Not Clone
| ice-child 🥶 | test | clone    
| baby-talking 👶 | Inicial | Not Clone 

## 😎 ¿Quieres contribuir con el código? 

Para contribuir con el desarrollo, tienes que tener en cuenta los siguientes puntos:

* El código debe ser ordenado y entendible, usamos standard 
[`PSR-2.↗️`](https://www.php-fig.org/psr/psr-2/)
* Todo los archivos deben ser testeado por consola, en Dist. Linux es así:

```php

phpcs --standard=PSR2 /ruta absoluta/nombre-archivo.php

/**
 *
 * En Windows lo ignoro, núnca lo utilice :(
 * @SEE : https://pear.php.net/package/PHP_CodeSniffer/
 *
 */

```

* Tanto varibales, funciones, class, etc., deben estar en idioma Ingles. Esto también se aplica a los textos de mensajes para el usuario.

* Los textos en ingles de los archivos deben ser traducidos con la herramienta translate de chico-auctions e incorporar el archivo alfa **ISO-2**.php, debe existir siempre **es.php** !

* El estilo de escritura es **UpperCamelCase** - PascalCase -, **lowerCamelCas** - camelCase -. {#id-tipo}

| Tipos escritura | Uso | Descripción | Ejemplos 
|:---|:---:|:---:|---:|
| camelCase | function | Para representar a una función. | estoEsUnaFuncion
| UpperCamelCase | classes | para nombre de classes | SoyControllerClass

* Los nombres de variables deben ser representativas a su existencia. Todas se escriben en minusculas, puedes usar  guiones bajos.
ejemplo:

```php

$my_name_is_hook ✅ modo correcto!

$myNameIsHook ❌ modo incorrecto!

$MyNameIsHook ❌ modo incorrecto!

```

* No hacer include ni require en ningun archivo tpl o classe principal php. Chico-auctions gestionará cada petición de entorno desde el core, siempre que hayas declarado el OBJ debidamente.
Por ejemplo si vas a llamar a una function pulic static desde tu archivo basta con usarla, chico-auction y Smarty encontraran la classe o template conrrespondiente por si solos.

Ejemplo:

```php
/** 
 * @NOTE Siempre que sea posible y corresponda, útiliza el Operador de Resolución de Ámbito, también denominado Paamayim Nekudotayim.
 *
 */
ParentClass::functionParentClass

```

* Tienes que declarar correctamente las funciones y variables dentro de una classe, con sentido común.

Recuerda que visibilidad de una propiedad, un método o una constante en PHP 7.x se puede definir anteponiendo a su declaración una de las palabras reservadas public, protected o private. A los miembros de clase declarados como 'public' se puede acceder desde donde sea; a los miembros declarados como 'protected', solo desde la misma clase, mediante clases heredadas o desde la clase padre. A los miembros declarados como 'private' únicamente se puede acceder desde la clase que los definió. 

ejemplo:

```php

<?php
/**
 * Definición de MyClass
 * @SEE : https://www.php.net/manual/en/language.oop5.visibility.php
 */
class MyClass
{
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$obj = new MyClass();
echo $obj->public;    /** ✅ Funciona bien */
echo $obj->protected; /** ❌ Error Fatal */
echo $obj->private;   /** ❌ Error Fatal */
$obj->printHello();   /** ⁉️ Muestra Public, Protected y Private */

```
NO DECLARES una variable con la palabra clave **"var"**, esto indicaría es public!
su uso genera un "Warning **E_STRICT**" en PHP 7.x. 

* Ningún archivo PHP debe contener etiqueta de cierre **" ?> "**

* Los comentarios en archivos solo deben indicarse cuando sea necesario, no se recomienda utilizarlos.
Si tienes que comentar, piensa primero ¿por qué tíenes que explicar?.
En el caso y de necesitarlo debes usarlo asi:

```php
/**
 *
 * soy un comentario correcto!✅
 *
 */

// soy un comentario erroneo :( no esta permitido, está prohibido! ❌

/* soy otro comentario erroneo */  no está permitido ❌

/* 
 esto es un comentario erroneamente pensado! ❌
*/

/**
 *
 * @NOTE : ✅
 * @SEE : ✅
 * @TODO : ✅
 * @RUTE ❌
 *
 */

```

* No repitas fragmentos de códigos, si lo haces preguntate ¿Qué estás haciendo mal?.

* Los addons no pueden superar 6M de tamaño, si superas esto debes preguntarte que está de más!

* Los themes deben seguir la estructura lógica del theme default, no modifiques plantillas de los addons por defecto, si necesitas modificar una plantilla utiliza el directorio **override** de tu theme. 

ejemplo:

```

themes/tu_theme/templates/override/nombre_modulo/template/templante_a_modificar.tpl

/** chico-auctions tomará el cambio automáticamente e imprimirá el cambio en tu web */

```

# 🎨 Avances 
- Estructura MsQL Gral. 🏗️ ✅
- Tpl x Smarty  ✅
- Auto Translate core ✅
- Auto translate Tpl ✅
- Hooks system ✅
- Install addons ❌
- Geo localizador ✅
- Protección datos Ley 25326 (Argentina) ✅
- Addons Google Map 🏗️ ❌
- Addons Categorias ✅
- Auto gestions categorias vía Mercado Libre API ✅
- Create DIR install ❌
- Análisis PSR-2 todos los archivo ❌
- UML Final DB ❌ 🏗️
- 📂 Dir Back ❌
- 📂 Dir Front 🏗️


## 🌏 Browser Support

| <img src="https://user-images.githubusercontent.com/1215767/34348387-a2e64588-ea4d-11e7-8267-a43365103afe.png" alt="Chrome" width="16px" height="16px" /> Chrome | <img src="https://user-images.githubusercontent.com/1215767/34348590-250b3ca2-ea4f-11e7-9efb-da953359321f.png" alt="IE" width="16px" height="16px" /> Internet Explorer | <img src="https://user-images.githubusercontent.com/1215767/34348380-93e77ae8-ea4d-11e7-8696-9a989ddbbbf5.png" alt="Edge" width="16px" height="16px" /> Edge | <img src="https://user-images.githubusercontent.com/1215767/34348394-a981f892-ea4d-11e7-9156-d128d58386b9.png" alt="Safari" width="16px" height="16px" /> Safari | <img src="https://user-images.githubusercontent.com/1215767/34348383-9e7ed492-ea4d-11e7-910c-03b39d52f496.png" alt="Firefox" width="16px" height="16px" /> Firefox |
| :---------: | :---------: | :---------: | :---------: | :---------: |
| Si | 11+ | Si | Si | Si |


## Móvil Support 📱

| Movil | system | Version | Auto APK 
| :---: | :---: | :---: | :---: |
| LG | Android | > 6 | ✅

<div id="badges" align="center">
  <a href="https://www.facebook.com/DeremateVive" target="_blank">
    <img src="https://img.shields.io/badge/Facebook-blue?style=for-the-badge&logo=facebook&logoColor=white" alt="Facebook Badge"/>
  </a>
  <a href="https://www.youtube.com/channel/UCD_DM-g6K01U9b9J_056Hgg" target="_blank">
    <img src="https://img.shields.io/badge/YouTube-red?style=for-the-badge&logo=youtube&logoColor=white" alt="Youtube Badge"/>
  </a>
  <a href="https://twitter.com/DeremateVive" target="_blank">
    <img src="https://img.shields.io/badge/Twitter-blue?style=for-the-badge&logo=twitter&logoColor=white" alt="Twitter Badge"/>
  </a>
</div>

# 🙄 Support

<a href="https://www.buymeacoffee.com/derematevive" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>

### 📜 License

This software is subject to the Open Software License [OSL 3.0](https://opensource.org/licenses/OSL-3.0) © [DeRemateVive](https://derematevive.github.io/chicoauctions/).
