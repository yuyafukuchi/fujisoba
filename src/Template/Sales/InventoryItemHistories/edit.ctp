<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryItemHistory[]|\Cake\Collection\CollectionInterface $inventoryItemHistories
 */
?>
<div class="inventoryItemHistories index large-9 medium-8 columns content">
    マスタ在庫アイテム変更<br>
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
                <td>品名</td>
                <td><?=h($inventoryItemHistory->item_name)?></td>
            </tr>
            <tr>
                <td>新品名</td>
                <td><?= $this->Form->control('item_name',['label' => '', 'rows'=>1,'type'=>'text'])?></td>
            </tr>
        </tbody>
    </table>
    <?= $this->Form->submit("キャンセル",['name'=>'button']) ?>
    <?= $this->Form->submit("変更",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
</div>
