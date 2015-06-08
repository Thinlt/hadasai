<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Category;

class CategoryController extends Controller {

    /**
     * List food
     * @return type
     */
    public function actionIndex() {
        $page = Yii::$app->request->get('page', 1);
        $row_per_page = Yii::$app->request->get('row_per_page', 10);
        $keyword = Yii::$app->request->get('keyword', '');
        $food = new Category();
        list($max_page, $count, $data) = $food->getData($keyword, $page, $row_per_page);
        $router = 'category/index';
        
        return $this->render('index', [
                    'max_page' => $max_page,
                    'count' => $count,
                    'row_per_page' => $row_per_page,
                    'page' => $page,
                    'data' => $data,
                    'router' => $router,
                    'keyword' => $keyword,
        ]);
    }
    
    public function actionCreate() {
        $error = '';
        $model = new Category();
        $data['csrf'] = Yii::$app->request->post('_csrf');
        $data['Category'] = Yii::$app->request->post();
        if (isset($data['Category']['submit'])) {
            $data['Category']['create_date'] = time();
            $data['Category']['user_create'] = \Yii::$app->user->id;
            $data['Category']['intro'] = $data['Category']['editor1'];
            if ($model->load($data) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                $error = $model->getErrors();
                return $this->render('create',['error' => $error]);
            }
        }
        return $this->render('create',['error' => $error]);
    }
    
    public function actionDetail() {
        $id = Yii::$app->request->get('id', 0);

        $customer = new \app\models\Customer;
        $user = $customer->getCustomerById($id);

        return $this->render('detail', ['user' => $user]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $create_date
     * @return mixed
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id', 0);
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $create_date
     * @return GwTransactionLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Food::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
