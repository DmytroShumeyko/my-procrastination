<?php

return array(

    //task:
    'task/updatedev/([0-9]+)' => 'task/updatedev/$1',
    'task/updatetask/([0-9]+)' => 'task/updatetask/$1',
    'task/updatedeal/([0-9]+)' => 'task/updateDealStatus/$1',
    'task/update_deal/([0-9]+)' => 'task/updateDeal/$1',
    'task/update_date/([0-9]+)' => 'task/updateDate/$1',
    'task/update/([0-9]+)' => 'task/update/$1',
    'task/delete/([0-9]+)' => 'task/delete/$1',
    'task/delete_deal/([0-9]+)' => 'task/deleteDeal/$1',
    'task/delete_date/([0-9]+)' => 'task/deleteDate/$1',
    'task/index/([0-9]+)' => 'task/index/$1',

    'director/create_task' => 'director/createTask',
    'director/create_deal' => 'director/createDeal',
    'director' => 'director/index',
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/output' => 'user/output',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet/tasks' => 'cabinet/tasks',
    'cabinet' => 'cabinet/index',
    '' => 'user/login', // actionIndex в SiteController
    '^(.*)$' => 'user/error',


);
