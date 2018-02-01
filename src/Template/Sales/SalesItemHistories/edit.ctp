<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryItemHistory[]|\Cake\Collection\CollectionInterface $inventoryItemHistories
 */
?>
<div class="salesHistories index large-9 medium-8 columns content">
    マスタ出庫アイテム変更<br>
    新しい品名を入力してください
    <?=$this->Form->create(null) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>番号</td>
                <td><?=h($salesItemHistory->sales_item->sales_item_number)?></td>
            </tr>
            <tr>
                <td>品名</td>
                <td><?=h($salesItemHistory->sales_item_name)?></td>
            </tr>
            <tr>
                <td>新品名</td>
                <td><?= $this->Form->control('name',['label' => '', 'rows'=>1,'type'=>'text'])?></td>
            </tr>
        </tbody>
    </table>
    <?= $this->Form->submit("キャンセル",['name'=>'button']) ?>
    <?= $this->Form->submit("変更",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
</div>
