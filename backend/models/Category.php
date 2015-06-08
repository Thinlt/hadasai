<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $icon
 * @property string $description
 * @property integer $status
 * @property string $user_create
 * @property integer $create_date
 * @property string $user_update
 * @property integer $update_date
 * @property string $intro
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'user_create', 'create_date', 'intro'], 'required'],
            [['description'], 'string'],
            [['status', 'create_date', 'update_date'], 'integer'],
            [['name', 'alias', 'icon', 'user_create', 'user_update'], 'string', 'max' => 255],
            [['intro'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'alias' => 'Alias',
            'icon' => 'Icon',
            'description' => 'Description',
            'status' => 'Status',
            'user_create' => 'User Create',
            'create_date' => 'Create Date',
            'user_update' => 'User Update',
            'update_date' => 'Update Date',
            'intro' => 'Intro',
        ];
    }
    
    public function getData($keyword, $page, $row_per_page) 
    {
        $connection = \Yii::$app->db;
        $str_sql = '';
        $str_order = '';
        if ($keyword != '' ) {
            $str_sql .= ' AND name LIKE  "%' . $keyword . '%"';
        }
        
        $str_order .= " ORDER BY id DESC";
        
        $sql = "SELECT id FROM category WHERE 1 " . $str_sql . "";
        $command = $connection->createCommand($sql);
        $command = $command->queryAll();
        $count = count($command);
        $max_page = ceil(intval($count) / $row_per_page);
        $first = ($page - 1) * $row_per_page;

        $sql = "SELECT * FROM category WHERE 1 " . $str_sql . " " . $str_order . " LIMIT " . $first . "," . $row_per_page . "";
        $command = $connection->createCommand($sql);
        $data = $command->queryAll();

        return array($max_page, intval($count), $data);
    }
}
