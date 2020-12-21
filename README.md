Repositorio de las Fuentes de la Entrevista Tecnica en la compañia Pixarron
![N|Solid](https://brandfood.com.pe/static/favicon.png)![N|Solid](https://laravel.com/assets/img/components/logo-laravel.svg)![N|Solid](https://vuejs.org/images/icons/apple-icon-57x57.png)

### Descripcion de Solicitud

    Realizar una pequeña aplicación en Laravel (mínimo) y VueJS (opcional) que permita crear órdenes en tiempo
    real usando Laravel Echo

### Stack

    ---> Se realizo lo solicitado utilizando Laravel , Vue.js , Pusher. 

### Consideraciones
    --->  Las fuentes se encuentran en el framework laravel version 7
    --->  Se requiere php version 7.2.5 o superior
    --->  Tener composer instalado ( Administrador de paquetes basado en php)
            Enlace para instalacion de no tenerlo. 
                https://getcomposer.org/download/
    ----> Tener una cuenta en pusher. De no poseer crearse una
           Enlace para crear cuenta en pusher.
               https://dashboard.pusher.com/accounts/sign_up
     ----> Tener node instalado. De no poseer proceder a instalarlo
            Enlace para node
               https://nodejs.org/es/
### Pasos
 
    I) Clonar el repositorio
 
        git clone https://github.com/fericell2909/BrandFoodPruebaTecnica.git
        
    II) Ubicarse en la raiz del proyecto y ejecutar
        
        composer install
    
    III) Crear el archivo :  .env  ( Puede tomar como base .env.example) el cual
         ya viene con credenciales de pusher y base de datos. 
        
    III) Crear un base de datos . Por ejemplo : testbrandfood y asignar
         un usuario con permisos globales en esta base de datos y reemplazar
         en los parametros en el archivo .env ( creado en el paso III)
         
            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=testbrandfood
            DB_USERNAME=root
            DB_PASSWORD=
    
    IV) Ejecutar el siguiente comando.
    
          php artisan migrate.
    
    V) Ingresar las Credenciales creadas en la cuenta de pusher en el archivo .env
    
        BROADCAST_DRIVER=pusher
        PUSHER_APP_ID=1041013
        PUSHER_APP_KEY=575fe64b2d524f039927
        PUSHER_APP_SECRET=ad090699776a228b3ebd
        PUSHER_APP_CLUSTER=us2
        MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
        MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
        
    V) Ejecutar el comando de npm    
        
        npm install
    
    VI) Abrir dos consolas en la misma ubicacion raiz del proyecto.
    
    VII) Ejecutar los siguientes comandos
      
         php artisan serve    ----> localhost de web en Laravel
         
         npm run watch   ------>  para los archivos de vue.js
         
    VIII)  Ingresar a la aplicacion en la url proporcionada por artisan serve.
    

### Imagenes

Inicio
<img src="/imagesrepo/inicio.png" alt="Bienvenido"/>

Login
<img src="/imagesrepo/login.png" alt="Iniciar Sesion"/>

Aplicacion
<img src="/imagesrepo/aplicacion.png" alt="Aplicacion"/>
