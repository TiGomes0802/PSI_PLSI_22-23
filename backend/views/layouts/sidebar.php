
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="../web/img/EcstasyClubLogo.png" alt="Ecstasy Club Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ecstasy Club</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="./index.php?r=userprofile%2Fupdate&id=2" class="d-block"><?php echo Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Empregados', 'icon' => 'fa fa-id-badge', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['userprofile/index']],
                    ['label' => 'Noticias', 'icon' => 'far fa-newspaper', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['noticias/index']],
                    ['label' => 'Eventos', 'icon' => 'far fa-newspaper', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['eventos/index']],
                    ['label' => 'Bebidas', 'icon' => 'far fa-newspaper', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['bebidas/index']],
                    ['label' => 'VIP', 'icon' => 'fa-thin fa-party-horn', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['VIP/index']],
                ],   
            ]);
            if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'admin') {
                echo \hail812\adminlte\widgets\Menu::widget([
                    'items' => [
                        ['label' => 'Disco', 'icon' => 'far fa-newspaper', 'badge' => '<span class="right badge badge-danger"></span>', 'url' => ['disco/index']],
                    ],
                ]);
            }
            ?>
        </nav>
    </div>
</aside>