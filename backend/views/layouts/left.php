<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
        </div>

        <?= backend\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Admin', 'options' => ['class' => 'header']],
                    ['label' => 'Users', 'icon' => 'fa fa-dashboard', 'url' => ['/user']],
                    ['label' => 'Catalogs', 'options' => ['class' => 'header']],
                    ['label' => 'Categories', 'icon' => 'fa fa-file-code-o', 'url' => ['/catalog/category'],],
                    ['label' => 'Comapnies', 'icon' => 'fa fa-file-code-o', 'url' => ['/catalog/company'],],
                    ['label' => 'Guides', 'icon' => 'fa fa-file-code-o', 'url' => ['/catalog/guide'],],
                    ['label' => 'Setting', 'options' => ['class' => 'header']],
                    ['label' => 'Regulations', 'icon' => 'fa fa-gear', 'url' => ['/regulation']],
                    [
                        'label' => 'Pages',
                        'icon' => 'fa fa-book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Home', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/home'],],
                            ['label' => 'Categories', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'categories','type' => 2],],
                            ['label' => 'Reviews', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'reviews','type' => 2],],
                            ['label' => 'News', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'news','type' => 2],],
                            ['label' => 'About', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'about', 'type' => 1],],
                            ['label' => 'Privacy', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'privacy', 'type' => 1],],
                            ['label' => 'Tos', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'tos', 'type' => 1],],
                            ['label' => 'Disclaimer', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'disclaimer', 'type' => 1],],
                            ['label' => 'Contact', 'icon' => 'fa fa-file-code-o', 'url' => ['/page/view','id'=>'contact','type' => 1],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
