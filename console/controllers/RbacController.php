<?php
namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $user = $auth->createRole(User::ROLE_USER);
        $auth->add($user);

        $manager = $auth->createRole(User::ROLE_MANAGER);
        $auth->add($manager);
        $auth->addChild($manager, $user);

        $loginToBackend = $auth->createPermission('loginToBackend');
        $auth->add($loginToBackend);
        $auth->addChild($manager, $loginToBackend);

        $publisher = $auth->createRole(User::ROLE_PUBLISHER);
        $auth->add($publisher);
        $auth->addChild($publisher,$loginToBackend);

        $advertiser = $auth->createRole(User::ROLE_ADVERTISER);
        $auth->add($advertiser);
        $auth->addChild($advertiser,$loginToBackend);

        $admin = $auth->createRole(User::ROLE_ADMINISTRATOR);
        $auth->add($admin);
        $auth->addChild($admin, $manager);

        $auth->assign($admin, 1);
        $auth->assign($manager, 2);
        $auth->assign($user, 3);
        $auth->assign($publisher, 4);
        $auth->assign($advertiser, 5);

        Console::output('Success! RBAC roles has been added.');
    }
}
