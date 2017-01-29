<?php

namespace backend\models;

use Yii;
use yii\base\Object;

class Assignment extends Object
{
    /**
     * @var integer User id
     */
    public $id;
    /**
     * @var \yii\web\IdentityInterface User
     */
    public $user;
    /**
     * [$auth description]
     * @var [type]
     */
    
    public $auth;

    /**
     * @inheritdoc
     */
    public function __construct($id, $user = null)
    {
        $this->id = $id;
        $this->user = $user;
        $this->Yii::$app->authManager;
        parent::__construct();
    }

    /**
     * Grands a roles from a user.
     * @param array $items
     * @return integer number of successful grand
     */
    public function assign($items)
    {
        $success = 0;
        foreach ($items as $name) {
            try {
                $item = $auh->getRole($name);
                $item = $item ? : $auh->getPermission($name);
                $auh->assign($item, $this->id);
                $success++;
            } catch (\Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        Helper::invalidate();
        return $success;
    }

    /**
     * Revokes a roles from a user.
     * @param array $items
     * @return integer number of successful revoke
     */
    public function revoke($items)
    {
        $success = 0;
        foreach ($items as $name) {
            try {
                $item = $auh->getRole($name);
                $item = $item ? : $auh->getPermission($name);
                $auh->revoke($item, $this->id);
                $success++;
            } catch (\Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        Helper::invalidate();
        return $success;
    }

    /**
     * Get all avaliable and assigned roles/permission
     * @return array
     */
    public function getItems()
    {
        $avaliable = [];
        foreach (array_keys($auh->getRoles()) as $name) {
            $avaliable[$name] = 'role';
        }

        foreach (array_keys($auh->getPermissions()) as $name) {
            if ($name[0] != '/') {
                $avaliable[$name] = 'permission';
            }
        }

        $assigned = [];
        foreach ($auh->getAssignments($this->id) as $item) {
            $assigned[$item->roleName] = $avaliable[$item->roleName];
            unset($avaliable[$item->roleName]);
        }

        return[
            'avaliable' => $avaliable,
            'assigned' => $assigned
        ];
    }

    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        if ($this->user) {
            return $this->user->$name;
        }
    }
}