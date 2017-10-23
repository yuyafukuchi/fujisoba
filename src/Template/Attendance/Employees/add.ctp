<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <?php
            echo $this->Form->input('code',['type' => 'text','label' => '従業員コード']);
            echo $this->Form->input('name_last',['type' => 'text','label' => '姓(漢字）']);
            echo $this->Form->input('name_first',['type' => 'text','label' => '名（漢字）']);
            echo $this->Form->input('name_last_kana',['type' => 'text','label' => '姓（カナ）']);
            echo $this->Form->input('name_first_kana',['type' => 'text','label' => '名(カナ）']);
            echo $this -> Form -> input  ( "select3",
                                 [ "type" => "select",
                                   "options" => [ "one" => "ダイタン企画株式会社" ], 
                                   "label" => '会社名'] );
            echo $this -> Form -> input  ( "select3",
                                 [ "type" => "select",
                                   "options" => [ "one" => "" ], 
                                   "label" => '店舗名'] );
           echo $this -> Form -> input  ( "select3",
                                 [ "type" => "select",
                                   "options" => [ "one" => "" ], 
                                   "label" => '種別'] );
            echo $this->Form->input('joined', ['empty' => true,'label' => '入社年月日）']);
            echo $this->Form->input('retired', ['empty' => true,'label' => '退職年月日']);
            echo $this->Form->input('note',['type' => 'text','label' => '備考']);
            echo '職責';
            echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "社員" ] );
            echo '時給';
            echo $this->Form->input('regular_amount',['type' => 'text','label' => '通常']);
            echo $this->Form->input('midnight_amount',['type' => 'text','label' => '深夜']);
            echo $this->Form->input('other1_amount',['type' => 'text','label' => 'その他１']);
            echo $this->Form->input('other2_amount',['type' => 'text','label' => 'その他２']);
            echo $this->Form->radio(
                  'シフト',
                  [
                    ['value' => '1', 'text' => '中番'],
                    ['value' => '2', 'text' => '遅番'],
                    ['value' => '3', 'text' => 'その他'],
                  ]
                );
            echo $this->Form->input('othershift_start');
            echo '時~';
            echo $this->Form->input('othershift_end');
            echo '時';
            echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "この従業員を削除する" ] );
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->button(__('新規')) ?>
    <?= $this->Form->button(__('戻る')) ?>
    <?= $this->Form->end() ?>
</div>