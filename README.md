## 特征

* 可快速衍生多个后台系统
* 内置角色，权限，用户，菜单管理
* API 权限精确至路由，页面权限精确到按钮或链接
* 完善的PHPUnit测试
* 前后端分离
* 多标签页

## 要求

- Laravel  >= 7.0.0
- Vue >= 2.5.17
- Element >= 2.9.1

## 安装

首先安装laravel,并且确保你配置了正确的数据库连接。

```
composer require cherish/ly
```

然后运行下面的命令来发布资源:

```
php artisan ly:install
```

命令执行成功会生成配置文件，数据迁移和构建SPA的文件。

修改 `app/Http/Kernel.php` ：

```
class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        ...
        'ly.permission' => \Cherish\Ly\Http\Middleware\Authenticate::class,
    ];

    protected $middlewareGroups = [
            ...
            'api' => [
                ...
                \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            ],
        ];
}
```

执行数据迁移，数据填充

```
php artisan migrate

php artisan db:seed --class="Cherish\Ly\Database\MojitoTableSeeder"
```

安装 Javscript 依赖

```shell
npm install
npm install -D vue@^2.6.6 vuex@^3.0.1 vue-router@^3.0.1 vue-i18n@^8.1.0 localforage@^1.7.2 element-ui@^2.9.1
```

将 admin.js  添加到 webpack.mix.js 

```
mix.js('resources/js/admin.js', 'public/js');
```

运行 Mix

```
#npm run watch
npm run production
```

后台登陆地址为 `http://localhost/admin/login`， 账号 `admin@gmail.com` , 密码 `secret`




