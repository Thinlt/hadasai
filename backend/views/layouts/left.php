<?php
use yii\bootstrap\Nav;
$currentController = Yii::$app->controller->id;
$currentAction = Yii::$app->controller->action->id;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Hello, <?= @Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Menu Yii2</li>',
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug']],
                    [
                        'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sing in</span>', //for basic
                        'url' => ['/user/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>

        <ul class="sidebar-menu">
            <li class="treeview <?php if ($currentController == 'category') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Content</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($currentController == 'category' && $currentAction == 'index') echo 'class="active"'; ?>>
                        <a href="<?php echo \Yii::$app->urlManager->createUrl('category/index');?>"><i class="fa fa-angle-double-right"></i> Category</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Same tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/gii']) ?>"><span class="fa fa-file-code-o"></span> Gii</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/debug']) ?>"><span class="fa fa-dashboard"></span> Debug</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php if ($currentController == 'role' || $currentController == 'permission' || $currentController == 'route' || $currentController == 'rule' || $currentController == 'user') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Admin Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if ($currentController == 'user') echo 'class="active"'; ?>>
                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['user/index'])?>"><i class="fa fa-angle-double-right"></i> Admin</a>
                    </li>
                    <li <?php if ($currentController == 'role') echo 'class="active"'; ?>>
                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['admin/role'])?>"><i class="fa fa-angle-double-right"></i> Roles </a>
                    </li>
                    <li <?php if ($currentController == 'permission') echo 'class="active"'; ?>>
                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['admin/permission'])?>"><i class="fa fa-angle-double-right"></i> Permissions </a>
                    </li>
                    <li <?php if ($currentController == 'route') echo 'class="active"'; ?>>
                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['admin/route'])?>"><i class="fa fa-angle-double-right"></i> Routes </a>
                    </li>
                    <li <?php if ($currentController == 'rule') echo 'class="active"'; ?>>
                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['admin/rule'])?>"><i class="fa fa-angle-double-right"></i> Rules </a>
                    </li>
                </ul>
            </li>
        </ul>

    </section>

</aside>
