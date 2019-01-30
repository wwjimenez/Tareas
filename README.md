<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.


Instalación:
0)previamente tener instalador composer
1) desde consola en la raiz del proyecto ejecutar init y seleccionar modo desarrollador "0"
2) Crear bd desde su manejador preferido (este proyecto esta en mysql), una vez creada la bd, ir a 
"common\config\main-local.php" y agregar los parametros de su conexion a la bd.
3) Instalar los siguientes componentes desde la raiz del sitio utilizando composer:

 a)composer require --prefer-dist johnitvn/yii2-user-plus

 b)composer require --prefer-dist johnitvn/yii2-rbac-plus "*"

4) ir a common/config/main-local.php y agregar lo siguientes

'modules' => 

    [ 
        'user' => 
        [ 
            'class' => 'johnitvn\userplus\basic\Module', 
        ],
    ],

5) consola dede raiz del proyecto ejecutar 

php yii migrate

responder yes

6)modificar backend/config/main-local en componentes

'user' => 
[

    'class'=>'yii\web\User',

    'identityClass' => 'johnitvn\userplus\basic\models\UserAccounts',

    'loginUrl'=>'index.php?r=/user/security/login'

],

Despues de componentes agregar:

'modules' => 
[

    'user' => 
    [

    'class' => 'johnitvn\userplus\basic\Module',

    ],
],

7) Probar el aplicativo con el siguiente enlace

http://127.0.0.1/Tareas/backend/web/index.php?r=/user/security/login

usuario=walter86.79@gmail.com

clave=868935