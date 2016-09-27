<?php
$username = Yii::$app->admin->isGuest ? '' : Yii::$app->admin->identity->username;
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo $username; ?></p>
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
        <?= dmstr\widgets\Menu::widget([
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => '控制台', 'icon' => 'fa fa-home', 'url' => ['/admini']],
                    [
                        'label' => '商品、参数',
                        'icon' => 'fa fa-xing-square',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品分类', 'icon' => 'fa fa-hdd-o', 'url' => ['/admini/category']],
                            ['label' => '商品品牌', 'icon' => 'fa fa-comment-o', 'url' => ['/admini/brand']],
                            ['label' => '商品规格', 'icon' => 'fa fa-lemon-o', 'url' => ['/admini/spec']],
                            ['label' => '商品属性', 'icon' => 'fa fa-hdd-o', 'url' => ['/admini/attribute']],
                            ['label' => '商品列表', 'icon' => 'fa fa-circle-thin', 'url' => ['/admini/goods']],
                        ],
                    ],
                    [
                        'label' => '订单、物流',
                        'icon' => 'fa fa-truck',
                        'url' => '#',
                        'items' => [
                            ['label' => '订单总汇', 'icon' => 'fa fa-bell-o', 'url' => ['/admini/order']],
                            ['label' => '待发货单', 'icon' => 'fa fa-gg', 'url' => ['/admini/order/deliver']],
                            ['label' => '退货单', 'icon' => 'fa fa-folder-o', 'url' => ['/admini/order/return']],
                        ],
                    ],
                    [
                        'label' => '权限、用户',
                        'icon' => 'fa fa-legal',
                        'url' => '#',
                        'items' => [
                            ['label' => '管理员', 'icon' => 'fa fa-bell-o', 'url' => ['/admini/admin']],
                            ['label' => '管理角色', 'icon' => 'fa fa-bell-o', 'url' => ['/admini/role']],
                            ['label' => '操作日志', 'icon' => 'fa fa-folder-o', 'url' => ['/admini/logger']],
                            ['label' => '注册会员', 'icon' => 'fa fa-bell-o', 'url' => ['/admini/user']],
                        ],
                    ],
                ],
            ]
        ) ?>
    </section>
</aside>
