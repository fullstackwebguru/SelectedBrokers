<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;
use common\models\ProductImage;

class SuperController extends Controller
{
    public function actionInit()
    {
        $adminEmail = Yii::$app->params["adminEmail"] ? Yii::$app->params["adminEmail"] : "admin@Top5BestOnlineCasinos";
        $supportEmail = Yii::$app->params["supportEmail"] ? Yii::$app->params["supportEmail"] : "support@Top5BestOnlineCasinos";

        $user = User::findByUsername("admin");
        if (!$user) {
            $user = new User(); 
        }
        
        $user->username = "admin";
        $user->email = $adminEmail;
        $user->setPassword("qpwoei00");
        $user->generateAuthKey();
        $user->save(false);
        
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->getId());    

        $user = User::findByUsername("support");
        if (!$user) {
            $user = new User();    
        }
        
        $user->username = "support";
        $user->email = $supportEmail;
        $user->setPassword("qpwoei00");
        $user->generateAuthKey();
        $user->save(false);
        
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('catalogManager');
        $auth->assign($authorRole, $user->getId());    
        
    }

    public function actionImage() {
        $model = ProductImage::findOne(14);
        $srcPath = Yii::getAlias('@mainUpload/' . $model->image_url);
        echo "src path ---- " . $srcPath . "\n";
        echo "cache Path  ---- " . yii::$app->imageCache->cachePath . "\n";
        echo "cache URL ---- " . yii::$app->imageCache->cacheUrl . "\n";
        echo Yii::$app->imageCache->img($srcPath, '130x130', ['class' => 'file-preview-image']) . "\n";
    }
}
