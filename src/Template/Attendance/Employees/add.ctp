<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="employees form">
    <?=$data['name']?>
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <div class="add-employees left">
            <?php
            echo $this->Form->input('code',['type' => 'text','label' => '従業員コード']);
            echo $this->Form->input('name_last',['type' => 'text','label' => '姓(漢字）']);
            echo $this->Form->input('name_first',['type' => 'text','label' => '名（漢字）']);
            echo $this->Form->input('name_last_kana',['type' => 'text','label' => '姓（カナ）']);
            echo $this->Form->input('name_first_kana',['type' => 'text','label' => '名(カナ）']);
            if($data['type']==='M'){
                echo $this->Form->input('company_id', ['options' => $companies, "label" => '会社名']);
                echo $this->Form->input('store_id', ['options' => $stores,"label" => '店舗名']);
            }else{
                echo $this->Form->input('company_id', ['options' => $companies,'empty' => true, "label" => '会社名']);
                echo $this->Form->input('store_id', ['options' => $stores, 'empty' => true,"label" => '店舗名']);
            }
           echo $this -> Form -> input  ( "contact_type",
                                 [ "type" => "select",
                                   "options" => [ "P" => "正社員","C" => "契約社員","A" => "アルバイト" ], 
                                   "label" => '種別'] );
            echo $this->Form->input('joined', ['empty' => true,'label' => '入社年月日）']);
            echo $this->Form->input('retired', ['empty' => true,'label' => '退職年月日']);
            echo $this->Form->input('note',['type' => 'text','label' => '備考']);
        ?>
        </div>
        <div class="add-employees right">
            <?php
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
        </div>
        
        
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->button(__('新規')) ?>
    <?= $this->Form->button(__('戻る')) ?>
    <?= $this->Form->end() ?>
</div>
