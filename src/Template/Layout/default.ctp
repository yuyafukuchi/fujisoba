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
    '/bootstrap/js/transition',
    '/bootstrap/js/collapse',
    '/bootstrap/js/dropdown',
    '/bootstrap/js/alert'
]));

// Append logout menu
if (
    // ($this->request->controller == 'Users' && ($this->request->action == 'index' || $this->request->action == 'login')) ||
    ($this->request->controller == 'TimeCards' && ($this->request->action == 'emboss' || $this->request->action == 'confirm'))
) {
    //
} else {
    $this->append('menu', '<li><a href="/users/logout" class="btn_ btn-default_">ログアウト</a></li>');
}

// Set mode
if (!isset($mode)) {
    $mode = 'sales';
}
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
</head>
<body class="<?= $mode ?>">
    <?php if ($mode === 'sales'): ?>
        <header role="banner" class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <?php if ($this->fetch('menu')): ?>
                    <button data-target="#navbar-top" data-toggle="collapse" type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php endif; ?>
                    <?php if (!$this->fetch('menu')): ?>
                        <?= $this->Html->link('売上・勤怠管理システム', '/', ['class' => 'navbar-brand']); ?>
                    <?php endif; ?>
                </div>
                <?php if ($this->fetch('menu')): ?>
                <nav role="navigation" class="collapse navbar-collapse" id="navbar-top">
                    <ul class="nav navbar-nav">
                        <?= $this->fetch('menu'); ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </header>

        <div class="container-fluid">
            <p><a href="/"><img src="/img/logo-small.png" alt="富士そば" height="50"></a></p>
        </div>
    <?php else: ?>
        <header role="banner" class="navbar navbar-outverse">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="/"><img src="/img/logo-small.png" alt="富士そば" height="50"></a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h1>勤怠管理システム</h1>
                    </div>
                    <div class="col-sm-4">
                        <?php if ($this->fetch('menu')): ?>
                        <nav role="navigation" class="collapse navbar-collapse" id="navbar-top">
                            <ul class="nav navbar-nav">
                                <?= $this->fetch('menu'); ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
        <header role="banner" class="navbar navbar-inverse heading">
            <div class="container-fluid">
                <?= $this->fetch('heading'); ?>
            </div>
        </header>
        <?php if ($this->fetch('breadcrumbs')): ?>
            <header role="banner" class="navbar breadcrumbs">
                <div class="container-fluid">
                    <?= $this->fetch('breadcrumbs'); ?>
                </div>
            </header>
        <?php endif; ?>
    <?php endif; ?>

    <div class="container-fluid">
        <div id="content" class="row">
            <?= $this->Flash->render(); ?>
            <?= $this->fetch('content'); ?>
        </div>
    </div>
    <footer class="navbar navbar-inverse">
        <div class="container-fluid">
            <p class="text-center">Copyright &copy; 2017 powered by TRT Corp. All rights reserved.</p>
        </div>
    </footer>
    <?= $this->fetch('script'); ?>
</body>
</html>
