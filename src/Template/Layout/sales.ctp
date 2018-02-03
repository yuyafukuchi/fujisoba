<?php
use Cake\Core\Configure;

if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s">', Configure::read('App.language'));
    $this->end();
}

if (!$this->fetch('title') && Configure::read('App.title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}
// Always append App.title to current page title
elseif ($this->fetch('title') && Configure::read('App.title')) {
    $this->append('title', sprintf(' | %s', Configure::read('App.title')));
}

// Prepend some meta tags
$this->prepend('meta', $this->Html->meta('icon'));
$this->prepend('meta', $this->Html->meta('viewport', 'width=device-width, initial-scale=1'));
if (Configure::read('App.author')) {
    $this->prepend('meta', $this->Html->meta('author', null, [
        'name'    => 'author',
        'content' => Configure::read('App.author')
    ]));
}

// Prepend scripts required by the navbar
$this->prepend('script', $this->Html->script([
    '//code.jquery.com/jquery-2.1.1.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/js/jquery-ui-1.9.2.custom.min.js',
    '//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.4/moment.min.js',
    '/bootstrap/js/transition',
    '/bootstrap/js/collapse',
    '/bootstrap/js/dropdown',
    '/bootstrap/js/alert',
    'common',
]));
$this->prepend('css', $this->Html->css([
    '//cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/css/custom-theme/jquery-ui-1.9.2.custom.css',
]));
?>
<!DOCTYPE html>
<?= $this->fetch('html'); ?>
<head>
    <?= $this->Html->charset(); ?>
    <title>
        <?= $this->fetch('title'); ?>
    </title>
    <?php
        // Meta
        echo $this->fetch('meta');

        // Styles
        echo $this->Less->less([
            'Bootstrap.less/bootstrap.less',
            // 'Bootstrap.less/cakephp/styles.less',
            'less/styles.less',
        ]);
        echo $this->fetch('css');

        // Sometimes we'll want to send scripts to the top (rarely..)
        echo $this->fetch('script.top');
    ?>
    <?= $this->fetch('script'); ?>
</head>
<body class="sales">
    <header role="banner" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="col-md-2">
                <div class="navbar-header">
                    <?= $this->Html->link('売上管理システム', '/', ['class' => 'navbar-brand']); ?>
                </div>
            </div>
            <div class="col-md-10">
                <nav role="navigation" class="collapse navbar-collapse" id="navbar-top">
                    <ul class="nav navbar-nav">
                        <li><?= $this->Html->link('勤怠管理', '/', ['class' => 'navbar-brand']); ?></li>
                        <li><a href="/users/logout" class="btn_ btn-default_">ログアウト</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div id="content" class="row">
            <?= $this->Flash->render(); ?>
            <div class="col-md-2">
                <div class="nav-side-menu">
                    <div class="brand">
                        <a href="/"><img src="/img/logo-small.png" alt="富士そば" height="50"></a><br>
                        <?=h($data['name']) ?>
                    </div>
                    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

                    <div class="menu-list">
                        <ul id="menu-content" class="menu-content collapse out">
                            <?php if($data['type'] === 'H') : ?> <!-- 本社管理者 -->
                                <li  data-toggle="collapse" data-target="#sales-summary" class="collapsed active">
                                    売上日計表
                                </li>
                                <ul class="sub-menu collapse" id="sales-summary">
                                    <li><?= $this->Html->link('全店舗', ['prefix' => false, 'controller' => 'Sales/SalesTransactions','action' => 'index']) ?></li>
                                    <?php foreach ($stores as $store) : ?>
                                        <li><?= $this->Html->link($store->name, ['prefix' => false, 'controller' => 'Sales/SalesTransactions','action' => 'view', 'store' => $store->id]) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <li  data-toggle="collapse" data-target="#sales-list" class="collapsed">
                                    売上一覧表
                                </li>
                                <ul class="sub-menu collapse" id="sales-list">
                                     <li><?= $this->Html->link('売上集計表', ['prefix' => false, 'controller' => 'Sales/SalesTransactions', 'action' => 'all']) ?></li>
                                    <?php foreach ($stores as $store) : ?>
                                    <li><?= $this->Html->link($store->name, ['prefix' => false, 'controller' => 'Sales/SalesTransactions', 'action' => 'view', 'store' => $store->id]) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <li  data-toggle="collapse" data-target="#daily-stocks" class="collapsed">
                                    在庫日計表一覧
                                </li>
                                <ul class="sub-menu collapse" id="daily-stocks">
                                    <?php foreach ($stores as $store) : ?>
                                        <li><?= $this->Html->link($store->name, ['prefix' => false, 'controller' => 'Sales/InventoryPurchaseTransactions','action' => 'monthly', 'store' => $store->id]) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <li  data-toggle="collapse" data-target="#daily-outstocks" class="collapsed">
                                    出庫日計表一覧
                                </li>
                                <ul class="sub-menu collapse" id="daily-outstocks">
                                    <?php foreach ($stores as $store) : ?>
                                        <li><?= $this->Html->link($store->name, ['prefix' => false, 'controller' => 'Sales/SalesItemTransactions','action' => 'index', 'store' => $store->id]) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <li  data-toggle="collapse" data-target="#cash" class="collapsed">
                                    現金出納表一覧
                                </li>
                                <ul class="sub-menu collapse" id="cash">
                                    <?php foreach ($stores as $store) : ?>
                                        <li><?= $this->Html->link($store->name, ['prefix' => false, 'controller' => 'Sales/CashAccountTrans', 'action' => 'index', 'store' => $store->id]) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <li  data-toggle="collapse" data-target="#master-settings" class="collapsed">
                                    マスタ設定
                                </li>
                                <ul class="sub-menu collapse" id="master-settings">
                                    <li><?= $this->Html->link('マスタメニュー設定', ['prefix' => false, 'controller' => 'Sales/MenuHistories','action' => 'index']) ?></li>
                                    <li><?= $this->Html->link('マスタ在庫アイテム設定', ['prefix' => false, 'controller' => 'Sales/InventoryItemHistories','action' => 'index']) ?></li>
                                    <li><?= $this->Html->link('マスタ出庫アイテム設定', ['prefix' => false, 'controller' => 'Sales/SalesItemHistories','action' => 'index']) ?></li>

                                    <li  data-toggle="collapse" data-target="#master-settings-stores" class="collapsed"><?='店舗別' ?></li>
                                    <ul class="sub-menu collapse" id="master-settings-stores">
                                        <?php foreach ($stores as $store) : ?>
                                            <li  data-toggle="collapse" data-target="#master-settings-store-<?= $store->id ?>" class="collapsed"><?=$store->name ?></li>
                                            <ul class="sub-menu collapse" id="master-settings-store-<?= $store->id ?>">
                                                <li><?= $this->Html->link('在庫計算アイテム設定', ['prefix' => false, 'controller' => 'Sales/StoreInventoryItemHistories','action' => 'index', 'store' => $store->id]) ?></li>
                                                <li><?= $this->Html->link('店舗メニュー設定', ['prefix' => false, 'controller' => 'Sales/StoreMenuHistories','action' => 'index', 'store' => $store->id]) ?></li>
                                            </ul>
                                        <?php endforeach; ?>
                                    </ul>

                                    <li><?= $this->Html->link('ユーザパスワード設定', ['prefix' => false, 'controller' => 'Users', 'action' => 'list']) ?></li>
                                </ul>
                            <?php elseif ($data['type'] === 'M') : ?> <!--店舗管理者 -->
                                <li data-toggle="collapse" data-target="#store-menu" class="collapsed">
                                    店舗作業
                                </li>
                                <ul class="sub-menu collapse" id="store-menu">
                                    <li><?= $this->Html->link('仕入在庫入力', ['prefix' => false, 'controller' => 'Sales/InventoryPurchaseTransactions', 'action' => 'index', 'store' => $storeId]) ?></li>
                                    <li><?= $this->Html->link('現金出納入力', ['prefix' => false, 'controller' => 'Sales/CashAccountTrans', 'action' => 'add', 'store' => $storeId]) ?></li>
                                    <li><?= $this->Html->link('在庫日計表', ['prefix' => false, 'controller' => 'Sales/InventoryPurchaseTransactions', 'action' => 'monthly', 'store' => $storeId]) ?></li>
                                    <li><?= $this->Html->link('出庫日計表', ['prefix' => false, 'controller' => 'Sales/SalesItemTransactions', 'action' => 'index', 'store' => $storeId]) ?></li>
                                    <li><?= $this->Html->link('現金出納表', ['prefix' => false, 'controller' => 'Sales/CashAccountTrans', 'action' => 'index', 'store' => $storeId]) ?></li>
                                    <li><?= $this->Html->link('売上日計表', ['prefix' => false, 'controller' => 'Sales/SalesTransactions', 'action' => 'view', 'store' => $storeId]) ?></li>
                                </ul>
                            <?php endif; ?>
                        </ul>
                     </div>
                </div>
            </div>
            <div class="col-md-10 sales main">
            <?= $this->fetch('content'); ?>
            </div>
        </div>
    </div>
    <footer class="navbar navbar-inverse">
        <div class="container-fluid">
            <p class="text-center">Copyright &copy; 2017 powered by TRT Corp. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
