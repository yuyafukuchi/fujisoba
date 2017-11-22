<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?=$data['name']?>
<?=$this->Html->link('ログアウト', [ 'controller'=>'/../Users', 'action'=>'logout'], ['class' => 'logout'])?>
<div class="form-table">
<?php
echo $this -> Form -> create (null);
?>
<div class="form-cell">
<?php
echo $this->Form->input( "employees_code", [
    "type" => "text",
    "size" => 10,
    "label" => "従業員コード",
    "default" => "",
]);
echo $this->Form->input( "employees_name", [
    "type" => "text",
    "size" => 10,
    "label" => "従業員名",
    "default" => "",
]);
?>
</div>

<div class="form-cell">
<?php 
if($data['type']==='M'){
                echo $this->Form->input('company_id', ['options' => $companies, "label" => '会社名']);
                echo $this->Form->input('store_id', ['options' => $stores, "label" => '店舗名']);
            }else{
                echo $this->Form->input('company_id', ['options' => $companies, 'empty' => true, "label" => '会社名']);
                echo $this->Form->input('store_id', ['options' => $stores, 'empty' => true, "label" => '店舗名']);
            }
?>
</div>

<div class="form-cell">
<?php 
echo $this -> Form -> input ( "retired", [ "type" => "checkbox",
                                          "value" => "1",
                                          "label" => "退職者も表示" ] );
                                         
echo $this -> Form -> submit ( "検索",['type' => 'submit']);

?>
</div>
<?php
echo $this -> Form -> end ();
?>
</div>

<div class="employees index">
    <h3><?= __('Employees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="number">NO</th>  
                <th scope="col"><?= $this->Paginator->sort('コード') ?></th>
                <th scope="col"><?= $this->Paginator->sort('氏名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('会社名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('店舗名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('種別') ?></th>
                <th scope="col"><?= $this->Paginator->sort('備考') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                 foreach ($employees as $employee): ?>
            <tr>
                <td><?= h($i) ?></td>
                <td><?= h($employee->code) ?></td>
                <td><?= $this->Html->link(h($employee->name_last.' '.$employee->name_first), ['action' => 'edit', $employee->id])?></td>
                <td><?= $employee->has('company') ? h($employee->company->name) : '' ?></td>
                <td><?= $employee->has('store') ? h($employee->store->name) : '' ?></td>
                <td><?= h($employee->contact_type.$employee->retired) ?></td>
                <td><?= h($employee->note) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    echo  $this->Paginator->counter(['format' => __('検索結果は{{count}}件です')]);
    echo nl2br("\n");
    // echo nl2br("\n");
    echo $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'attendance'], ['class' => 'return-link']);
    echo $this->Html->link('新規', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'add-link']);

    ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <!--<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>-->
    </div>
</div>
