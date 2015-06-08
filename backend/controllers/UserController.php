<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\AuthAssignment;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use backend\models\LoginForm;

class UserController extends Controller
{
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->urlManager->createUrl("user"));
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->urlManager->createUrl("user/login"));
    }
    
    /**
     * action index
     * @return type
     */
    public function actionIndex() {
        
        $page = Yii::$app->request->get('page', 1);
        $row_per_page = Yii::$app->request->get('row_per_page', 10);
        $keyword = Yii::$app->request->get('keyword', '');
        $user = new User();
        list($max_page, $count, $data) = $user->getData($keyword, $page, $row_per_page);
        $router = 'user/index';
        return $this->render('index', [
                    'max_page' => $max_page,
                    'count' => $count,
                    'row_per_page' => $row_per_page,
                    'page' => $page,
                    'data' => $data,
                    'router' => $router,
                    'keyword' => $keyword
        ]);
    }
    
    public function actionCreate() {
        $error = '';
        $model = new User();
        $data['_csrf'] = Yii::$app->request->post('_csrf', '');
        $data['User'] = Yii::$app->request->post();
        if (isset($data['User']['submit'])) {
            $error .= empty($data['User']['username']) ? '<p> - Username không được bỏ trống </p>' : '';
            $error .= empty($data['User']['full_name']) ? '<p> - Full_name không được bỏ trống </p>' : '';
            $error .= empty($data['User']['password']) ? '<p> - Password không được bỏ trống </p>' : '';
            $error .= empty($data['User']['re-password']) ? '<p> - Re-password không được bỏ trống </p>' : '';
            $error .= empty($data['User']['email']) ? '<p> - Email không được bỏ trống </p>' : '';
            if (!empty($data['User']['password']) && !empty($data['User']['re-password'])) {
                $error .= ($data['User']['password'] != $data['User']['re-password']) ? '<p> - Password nhập lại không chính xác' : '';
            }
            $checkUsername = $model->findByUsername($data['User']['username']);
            $checkEmail = $model->findByEmail($data['User']['email']);
            $error .= !empty($checkUsername) ? '<p> - Username đã tồn tại </p>' : '';
            $error .= !empty($checkEmail) ? '<p> - Email đã được sử dụng </p>' : '';

            $data['User']['create_date'] = time();
            $data['User']['user_create'] = \Yii::$app->user->id;
            $data['User']['password'] = md5(md5($data['User']['password']).'cinefun2015');
        }
        if (empty($error) && $model->load($data) && $model->save()) {
            $user = $model->findByUsername($data['User']['username']);
            $id = $user->id;
            $auth = new AuthAssignment();
            $dataAuth['_csrf'] = $data['_csrf'];
            $dataAuth['AuthAssignment']['item_name'] = $data['User']['group'];
            $dataAuth['AuthAssignment']['user_id'] = $id;
            $dataAuth['AuthAssignment']['created_at'] = time();
            $auth->load($dataAuth);
            $auth->save();
            return $this->redirect(['index']);
        } else {
            $group = $model->getGroup();
            return $this->render('create', [
                'group' => $group,
                'error' => $error
            ]);
        }
    }
    
    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id', 0);
        $error = '';
        $user = new User();
        $model = $this->findModel($id);
        $data['_csrf'] = Yii::$app->request->post('_csrf', '');
        $data['User'] = Yii::$app->request->post();
        if (isset($data['User']['submit'])) {
            $data['User']['update_date'] = time();
            $data['User']['user_update'] = \Yii::$app->user->id;
            if ($model->load($data) && $model->save()) {
                $this->findAuth($id)->delete();
                $auth = new AuthAssignment();
                $dataAuth['_csrf'] = $data['_csrf'];
                $dataAuth['AuthAssignment']['item_name'] = $data['User']['group'];
                $dataAuth['AuthAssignment']['user_id'] = $id;
                $dataAuth['AuthAssignment']['created_at'] = time();
                $auth->load($dataAuth);
                $auth->save();
                return $this->redirect(['index']);
            } 
        } else {
            $group = $user->getGroup();
            return $this->render('update', [
                'model' => $model,
                'error' => $error,
                'group' => $group
            ]);
        }
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
        $this->findAuth($id)->delete();
        
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
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Find the AuthAssighment model based on its user_id value
     * @param type $user_id
     * @return type
     * @throws NotFoundHttpException
     */
    protected function findAuth($user_id)
    {
        if (($auth = AuthAssignment::findOne(['user_id' => $user_id])) !== null) {
            return $auth;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
