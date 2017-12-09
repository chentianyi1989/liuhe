<?php

return [
    'page-size' => 15,
    /* 上传文件配置 */
    'uploads'                      => [
        'mimes'     => [],
        'storage'   => 'local',
        'max_size'  => 10 * 1024 * 1024,
        'extension' => ['jpg', 'gif', 'png', 'jpeg', 'zip', 'rar', 'tar', 'gz', '7z', 'doc', 'docx', 'txt', 'xml'],
        'save_path' => date('Y-m-d') . '/' . sha1(time()),
    ],
    'state'=>[
        "1"=>'启用',
        "0"=>"停用"
    ],
    'pingma_odds'=>6.8,
    'tema_odds'=>46,
    'kill'=>0.2,
    
    'log_member_moneny'=>[
        'type'=>
            ['recharge'=>'1','withdrawal'=>'2','payout'=>'3','sysUpdate'=>'4']
        
    ]
    
];