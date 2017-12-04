<div class="vertical-center">
    <?= $this->Form->create('Users') ?>
        <div class="row">
            <div class="col-md-5 control-label text-right">ユーザ</div>
            <div class="col-md-4">
                <?= $this->Form->input("name", [
                    "type" => "text",
                    'label' => false,
                    'class' => 'input-lg',
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 control-label text-right">パスワード</div>
            <div class="col-md-4">
                <?= $this->Form->input("password", [
                    "type" => "password",
                    'label' => false,
                    'class' => 'input-lg',
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 control-label text-right"></div>
            <div class="col-md-4">
                <?= $this->Form->submit("ログイン", ['class' => 'btn btn-lg btn-block'])?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>