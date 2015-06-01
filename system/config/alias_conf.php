<?php
//这里添加别名到实际类名的映射, 供注册器使用
//这个数组会逐渐变得庞大，因为每个被register支持的类，其别名到类名的映射都要在这个数组中先行登记
return array (
    //系统类库
    'IntelliPHP' => 'IntelliPHP',
    'Filter' => 'Filter',
    'DB' => 'DB',
    'Render' => 'Render',
    'Router' => 'Router',
    'Register' => 'Register',
    'Configure' => 'Configure',
    'Algorithm' => 'Algorithm',
    'Captcha' => 'Captcha',
    //app类库
    'Portal' => "Portal",
    'PortalIndex'=>"PortalIndex",
);