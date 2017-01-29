<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "updateUser" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update user';
        $auth->add($updateUser);

        // add "createCatalog" permission
        $createCatalog = $auth->createPermission('createCatalog');
        $createCatalog->description = 'Create a catalog';
        $auth->add($createCatalog);

        // add "updateCatalog" permission
        $updateCatalog = $auth->createPermission('updateCatalog');
        $updateCatalog->description = 'Update catalog';
        $auth->add($updateCatalog);

        // add "catalogManager" role and give this role the "createCatalog" permission
        $catalogManager = $auth->createRole('catalogManager');
        $auth->add($catalogManager);
        $auth->addChild($catalogManager, $createCatalog);
        $auth->addChild($catalogManager, $updateCatalog);

        // add "admin" role and give this role the "updateCatalog" permission
        // as well as the permissions of the "catalogManager" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $catalogManager);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($catalogManager, 2);
        $auth->assign($admin, 1);
    }
}
