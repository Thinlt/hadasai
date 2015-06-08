<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "admin".
 *
 * @property string $userid
 * @property string $username
 * @property string $password
 */
class User extends \yii\db\ActiveRecord  implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }
    
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'full_name', 'password', 'email', 'group', 'user_create', 'create_date', 'status'], 'required'],
            [['sex', 'age', 'user_create', 'user_update', 'create_date', 'update_date', 'status'], 'integer'],
            [['username','group', 'full_name', 'password', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'full_name' => 'Full Name',
            'password' => 'Password',
            'email' => 'Email',
            'sex' => 'Sex',
            'age' => 'Age',
            'group' => 'Group',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
            'create_date' => 'Create Date',
            'upatde_date' => 'Upatde Date',
            'status' => 'Status',
        ];
    }
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }
    */
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Find user by email
     * 
     * @param type $email
     * @return type
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
//        return $this->auth_key;
        return 'findnex';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
//        return $this->getAuthKey() === $authKey;
        return true;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public static function validatePassword($password,$inputPass)
    {
        return $password === md5(md5($inputPass).'cinefun2015');
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public function getData($keyword, $page, $row_per_page) 
    {
        $connection = \Yii::$app->db;
        $str_sql = '';
        $str_order = '';
        if ($keyword != '' ) {
            $str_sql .= ' AND username LIKE  "%' . $keyword . '%"';
        }
        
        $str_order .= " ORDER BY id DESC";
        
        $sql = "SELECT id FROM admin WHERE 1 " . $str_sql . "";
        $command = $connection->createCommand($sql);
        $command = $command->queryAll();
        $count = count($command);
        $max_page = ceil(intval($count) / $row_per_page);
        $first = ($page - 1) * $row_per_page;

        $sql = "SELECT * FROM admin WHERE 1 " . $str_sql . " " . $str_order . " LIMIT " . $first . "," . $row_per_page . "";
        $command = $connection->createCommand($sql);
        $data = $command->queryAll();

        return array($max_page, intval($count), $data);
    }
    
    public function getGroup()
    {
        $table='auth_item';
        $query = (new \yii\db\Query())
                ->select('name')
                ->where('type=:type')
                ->addParams([':type' => 1])
                ->from($table);
        
        $command = $query->createCommand($this->getDb());
        $data = $command->queryAll();
        
        return $data;
    }

}