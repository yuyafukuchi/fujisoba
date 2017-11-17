<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItem $salesItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Item'), ['action' => 'edit', $salesItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Item'), ['action' => 'delete', $salesItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Item Assign Histories'), ['controller' => 'SalesItemAssignHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item Assign History'), ['controller' => 'SalesItemAssignHistories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Item Histories'), ['controller' => 'SalesItemHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item History'), ['controller' => 'SalesItemHistories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Item Transactions'), ['controller' => 'SalesItemTransactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['controller' => 'SalesItemTransactions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesItems view large-9 medium-8 columns content">
    <h3><?= h($salesItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item Number') ?></th>
            <td><?= $this->Number->format($salesItem->sales_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($salesItem->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($salesItem->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($salesItem->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($salesItem->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sales Item Assign Histories') ?></h4>
        <?php if (!empty($salesItem->sales_item_assign_histories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Menu Item Id') ?></th>
                <th scope="col"><?= __('Sales Item Id') ?></th>
                <th scope="col"><?= __('Start') ?></th>
                <th scope="col"><?= __('End') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($salesItem->sales_item_assign_histories as $salesItemAssignHistories): ?>
            <tr>
                <td><?= h($salesItemAssignHistories->id) ?></td>
                <td><?= h($salesItemAssignHistories->menu_item_id) ?></td>
                <td><?= h($salesItemAssignHistories->sales_item_id) ?></td>
                <td><?= h($salesItemAssignHistories->start) ?></td>
                <td><?= h($salesItemAssignHistories->end) ?></td>
                <td><?= h($salesItemAssignHistories->created) ?></td>
                <td><?= h($salesItemAssignHistories->created_by) ?></td>
                <td><?= h($salesItemAssignHistories->modified) ?></td>
                <td><?= h($salesItemAssignHistories->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SalesItemAssignHistories', 'action' => 'view', $salesItemAssignHistories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SalesItemAssignHistories', 'action' => 'edit', $salesItemAssignHistories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SalesItemAssignHistories', 'action' => 'delete', $salesItemAssignHistories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemAssignHistories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sales Item Histories') ?></h4>
        <?php if (!empty($salesItem->sales_item_histories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Sales Item Id') ?></th>
                <th scope="col"><?= __('Sales Item Name') ?></th>
                <th scope="col"><?= __('Start') ?></th>
                <th scope="col"><?= __('End') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($salesItem->sales_item_histories as $salesItemHistories): ?>
            <tr>
                <td><?= h($salesItemHistories->id) ?></td>
                <td><?= h($salesItemHistories->sales_item_id) ?></td>
                <td><?= h($salesItemHistories->sales_item_name) ?></td>
                <td><?= h($salesItemHistories->start) ?></td>
                <td><?= h($salesItemHistories->end) ?></td>
                <td><?= h($salesItemHistories->deleted) ?></td>
                <td><?= h($salesItemHistories->created) ?></td>
                <td><?= h($salesItemHistories->created_by) ?></td>
                <td><?= h($salesItemHistories->modified) ?></td>
                <td><?= h($salesItemHistories->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SalesItemHistories', 'action' => 'view', $salesItemHistories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SalesItemHistories', 'action' => 'edit', $salesItemHistories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SalesItemHistories', 'action' => 'delete', $salesItemHistories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemHistories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sales Item Transactions') ?></h4>
        <?php if (!empty($salesItem->sales_item_transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Sales Transaction Id') ?></th>
                <th scope="col"><?= __('Sales Item Id') ?></th>
                <th scope="col"><?= __('Qty') ?></th>
                <th scope="col"><?= __('Sales Item Price') ?></th>
                <th scope="col"><?= __('Sales Item Cost') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($salesItem->sales_item_transactions as $salesItemTransactions): ?>
            <tr>
                <td><?= h($salesItemTransactions->id) ?></td>
                <td><?= h($salesItemTransactions->sales_transaction_id) ?></td>
                <td><?= h($salesItemTransactions->sales_item_id) ?></td>
                <td><?= h($salesItemTransactions->qty) ?></td>
                <td><?= h($salesItemTransactions->sales_item_price) ?></td>
                <td><?= h($salesItemTransactions->sales_item_cost) ?></td>
                <td><?= h($salesItemTransactions->created) ?></td>
                <td><?= h($salesItemTransactions->created_by) ?></td>
                <td><?= h($salesItemTransactions->modified) ?></td>
                <td><?= h($salesItemTransactions->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SalesItemTransactions', 'action' => 'view', $salesItemTransactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SalesItemTransactions', 'action' => 'edit', $salesItemTransactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SalesItemTransactions', 'action' => 'delete', $salesItemTransactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemTransactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
