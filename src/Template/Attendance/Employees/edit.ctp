<?php
$this->append('heading', '<p>' . $data['name'] . '</p>');
$this->append('breadcrumbs', '<p>トップ＞従業員マスタ検索＞従業員登録</p>');
?>

<?php // debug($employee); ?>

<?= $this->Form->create($employee) ?>
    <div class="row" style="margin: 0">
        <div class="col-sm-6 text-left">
            <h3>従業員情報</h3>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-3"><label>従業員コード</label></div>
                <div class="col-md-3">
                    <?= $this->Form->input('code',['type' => 'text', 'label' => false, 'required' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-3"><label>フルネーム (漢字）</label></div>
                <div class="col-md-3">
                    <?= $this->Form->input('name_last', ['type' => 'text', 'label' => false, 'required' => true, 'placeholder' => '姓 (漢字)']) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Form->input('name_first', ['type' => 'text', 'label' => false, 'required' => true, 'placeholder' => '名 (漢字)']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-3"><label>フルネーム (カナ）</label></div>
                <div class="col-md-3">
                    <?= $this->Form->input('name_last_kana', ['type' => 'text', 'label' => false, 'required' => true, 'placeholder' => '姓 (カナ)']) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Form->input('name_first_kana', ['type' => 'text', 'label' => false, 'required' => true, 'placeholder' => '名 (カナ)']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label><?= ($data['type']==='M') ? '＊' : null ?></label></div>
                <div class="col-md-3"><label>会社名</label></div>
                <div class="col-md-6">
                    <?php if ($data['type']==='M'): ?>
                        <?= $this->Form->input('company_id', ['options' => $companies, "label" => false, 'required' => true]) ?>
                    <?php else: ?>
                        <?= $this->Form->input('company_id', ['options' => $companies,'empty' => true, "label" => false]) ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label><?= ($data['type']==='M') ? '＊' : null ?></label></div>
                <div class="col-md-3"><label>店舗名</label></div>
                <div class="col-md-6">
                    <?php if ($data['type']==='M'): ?>
                        <?= $this->Form->input('store_id', ['options' => $stores, "label" => false, 'required' => true]) ?>
                    <?php else: ?>
                        <?= $this->Form->input('store_id', ['options' => $stores, 'empty' => true, "label" => false]) ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-3"><label>種別</label></div>
                <div class="col-md-3">
                    <?= $this->Form->input("contact_type", ["type" => "select", "options" => [ "P" => "正社員","C" => "契約社員","A" => "アルバイト" ], "label" => false, 'required' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-3"><label>入社年月日</label></div>
                <div class="col-md-3">
                    <?= $this->Form->input('joined', ['empty' => true,'label' => false, 'type' => "text", 'placeholder' => '入力形式: '.date('Y-m-d'), 'required' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label></label></div>
                <div class="col-md-3"><label>退職年月日</label></div>
                <div class="col-md-3">
                    <?= $this->Form->input('retired', ['empty' => true,'label' => false, 'type' => "text", 'placeholder' => '入力形式: '.date('Y-m-d')]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label></label></div>
                <div class="col-md-3"><label>備考</label></div>
                <div class="col-md-6">
                    <?= $this->Form->input('note',['type' => 'textarea','label' => false]) ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <h3>職責</h3>

            <div class="row">
                <div class="col-md-1 text-right"><label></label></div>
                <div class="col-md-11">
                    <?= $this->Form->input("check", ["type" => "checkbox", "value" => "check2", "label" => "社員"]) ?>
                </div>
            </div>

            <h3>時給</h3>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-2"><label>通常</label></div>
                <div class="col-md-4">
                    <?= $this->Form->input('regular_amount',['type' => 'number', 'label' => false, 'required' => true, 'default' => 1100]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-2"><label>深夜</label></div>
                <div class="col-md-4">
                    <?= $this->Form->input('midnight_amount',['type' => 'number', 'label' => false, 'required' => true, 'default' => 1375]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label></label></div>
                <div class="col-md-2"><label>その他１</label></div>
                <div class="col-md-4">
                    <?= $this->Form->input('other1_amount',['type' => 'number', 'label' => false]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label></label></div>
                <div class="col-md-2"><label>その他２</label></div>
                <div class="col-md-4">
                    <?= $this->Form->input('other2_amount',['type' => 'number', 'label' => false]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1 text-right"><label>＊</label></div>
                <div class="col-md-2"><label>シフト</label></div>
                <div class="col-md-9">
                    <?= $this->Form->radio(
                        'シフト',
                        [
                            ['value' => '0', 'text' => '早番'],
                            ['value' => '1', 'text' => '中番'],
                            ['value' => '2', 'text' => '遅番'],
                            ['value' => '3', 'text' => 'その他'],
                        ]
                    ) ?>

                    <div class="form-inline">
                        <?= $this->Form->input('othershift_start', ['label' => false, 'style' => 'width: 4em;']) ?> 時~
                        <?= $this->Form->input('othershift_end', ['label' => false, 'style' => 'width: 4em;']) ?> 時
                    </div>
                </div>
            </div>

            <h3>その他</h3>

            <div class="row">
                <div class="col-md-1 text-right"><label></label></div>
                <div class="col-md-11">
                    <?= $this->Form->input("check", [
                        "type" => "checkbox",
                        "value" => "check2",
                        "label" => "この従業員を削除する"
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-right" style="margin: 0">
        <div class="col-sm-12">
            <div style="display: inline-block;"><?= $this->Form->submit('登録', ['class' => 'btn btn-default btn-lg']) ?></div>
            <?= $this->Html->link('新規', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'btn btn-default btn-lg']) ?>
            <?= $this->Html->link('戻る', ['controller'=>'Employees', 'action'=>'index'], ['class' => 'btn btn-default btn-lg']) ?>
        </div>
    </div>
<?= $this->Form->end() ?>

<style>
    h3 {
        margin: 40px 0;
        font-weight: bold;
    }
    label {
        font-size: large !important;
        font-weight: normal !important;
    }
    .col-md-9 label {
        display: inline-block;
        margin-right: 15px;
    }
</style>