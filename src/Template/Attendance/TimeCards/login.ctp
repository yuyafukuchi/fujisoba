<?php
$this->append('heading', '<p>' . $store_name . '</p>');
// $this->append('breadcrumbs', '<p>トップ：管理者メニュー</p>');
?>

<div class="vertical-center">
    <?= $this->Form->create('Employees') ?>
        <div class="row">
            <div class="col-md-5 control-label text-right">従業員コード</div>
            <div class="col-md-4">
                <?= $this->Form->input("code", [
                    "type" => "text",
                    'label' => false,
                    'class' => 'input-lg',
                    'required' => true,
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 control-label text-right"></div>
            <div class="col-md-4">
                <?= $this->Form->submit("ログイン", ['class' => 'btn btn-lg btn-block', 'name' => 'loginButton'])?>
                <div class="row" style="margin-top: 15px; width: auto;">
                    <div class="col-md-6">
                        <?= $this->Form->submit("勤怠データ確認", ['class' => 'btn btn-lg btn-block', 'name' => 'loginButton'])?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->submit("別店舗応援", ['class' => 'btn btn-lg btn-block', 'name' => 'loginButton'])?>
                    </div>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
