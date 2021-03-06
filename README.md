Repositorio de las Fuentes de la Entrevista Tecnica en la compañia Pixarron
![N|Solid](https://www.pixarron.com/wp-content/uploads/2020/07/Pixa-logo.png)![N|Solid](https://laravel.com/assets/img/components/logo-laravel.svg)![N|Solid](https://vuejs.org/images/icons/apple-icon-57x57.png)

### Descripcion de Solicitud

    --->  Considera un sistema simple de compra, en el que existen dos tipos de usuario: administrador y
          cliente. 
          
    --->  Además, ten en cuenta, que los clientes deben estar registrados para generar órdenes de compra,
          que dichas compras pueden incluir uno o varios productos. 
    
    ----> El usuario debe tener almacenada una dirección de envió antes de poder generar la compra. 

### Stack

    ---> Se realizo lo solicitado utilizando Laravel ( Dashboard - BackEnd), Vue.js ( Front - Client)  

### Consideraciones
    --->  Tener composer instalado ( Administrador de paquetes basado en php)
            Enlace para instalacion de no tenerlo. 
                https://getcomposer.org/download/
     ----> Tener node instalado. De no poseer proceder a instalarlo
            Enlace para node
               https://nodejs.org/es/
### Pasos
 
    I) Clonar el repositorio
 
        git clone https://github.com/fericell2909/PixarronPruebaTecnica.git
        
    II) Ubicarse en la raiz del proyecto y ejecutar
        
        composer install
    
    III) Crear el archivo :  .env  ( Puede tomar como base .env.example) el cual
         ya viene con credenciales. Si es que no sea ejecutar migraciones 
        
    III) Crear un base de datos . Por ejemplo : desafiopixarron y asignar
         un usuario con permisos globales en esta base de datos y reemplazar
         en los parametros en el archivo .env ( creado en el paso III)
         
            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=desafiopixarron
            DB_USERNAME=root
            DB_PASSWORD=
    
    IV) Ejecutar el siguiente comando.
    
          php artisan migrate.
    
        
    V) Ejecutar el comando de npm    
        
        npm install
    
    VI) Ejecutar el comando de artisan de migraciones    
        
        php artisan migrate
    
    VII) Ejecutar los siguientes comandos
      
         php artisan serve    ----> localhost de web en Laravel

         npm run dev /  npm run prod npm run watch  ------>  para los archivos de vue.js
         
    VIII)  Ingresar a la aplicacion en la url proporcionada por artisan serve.

    IX) En el carpeta readme_files/backup/backup.sql ... se proporcion un backup si es que no desea ejecutar migraciones.
    
    X) Usuarios 
        
         email:  info@devmarcoestrada.com   
         pass:  secret
         rol:   cliente

         email:  admin@devmarcoestrada.com   
         pass:  secret
         rol:   administrador
         
    XI) api_register.postman_collection.json --- archivos para testing de las api en postman.

### Imagenes

Tienda
<img src="/readme_files/images/captura_tienda.PNG" alt="Tienda"/>

Tienda Checkout
<img src="/readme_files/images/captura_tienda_checkout.PNG" alt="Tienda CheckOut"/>

DashBoard
<img src="/readme_files/images/captura_dashboard_admin.PNG" alt="DashBoard"/>
