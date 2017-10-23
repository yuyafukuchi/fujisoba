<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Store'), ['action' => 'edit', $store->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Store'), ['action' => 'delete', $store->id], ['confirm' => __('Are you sure you want to delete # {0}?', $store->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cash Account Trans'), ['controller' => 'CashAccountTrans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cash Account Tran'), ['controller' => 'CashAccountTrans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Purchase Transactions'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Purchase Transaction'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Store Account Infos'), ['controller' => 'StoreAccountInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store Account Info'), ['controller' => 'StoreAccountInfos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Store Inventory Item Histories'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store Inventory Item History'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Time Cards'), ['controller' => 'TimeCards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Time Card'), ['controller' => 'TimeCards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stores view large-9 medium-8 columns content">
    <h3><?= h($store->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($store->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($store->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $store->has('company') ? $this->Html->link($store->company->name, ['controller' => 'Companies', 'action' => 'view', $store->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pay Department Code') ?></th>
            <td><?= h($store->pay_department_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fin Department Code') ?></th>
            <td><?= h($store->fin_department_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($store->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Regular Start Time') ?></th>
            <td><?= $this->Number->format($store->regular_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Regular End Time') ?></th>
            <td><?= $this->Number->format($store->regular_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midnight Start Time') ?></th>
            <td><?= $this->Number->format($store->midnight_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midnight End Time') ?></th>
            <td><?= $this->Number->format($store->midnight_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other1 Start Time') ?></th>
            <td><?= $this->Number->format($store->other1_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other1 End Time') ?></th>
            <td><?= $this->Number->format($store->other1_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other2 Start Time') ?></th>
            <td><?= $this->Number->format($store->other2_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other2 End Time') ?></th>
            <td><?= $this->Number->format($store->other2_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Early Start Time') ?></th>
            <td><?= $this->Number->format($store->early_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Early End Time') ?></th>
            <td><?= $this->Number->format($store->early_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Middle Start Time') ?></th>
            <td><?= $this->Number->format($store->middle_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Middle End Time') ?></th>
            <td><?= $this->Number->format($store->middle_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Late Start Time') ?></th>
            <td><?= $this->Number->format($store->late_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Late End Time') ?></th>
            <td><?= $this->Number->format($store->late_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($store->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($store->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($store->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($store->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($store->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($store->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Cash Account Trans') ?></h4>
        <?php if (!empty($store->cash_account_trans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Cash Account Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->cash_account_trans as $cashAccountTrans): ?>
            <tr>
                <td><?= h($cashAccountTrans->id) ?></td>
                <td><?= h($cashAccountTrans->store_id) ?></td>
                <td><?= h($cashAccountTrans->transaction_date) ?></td>
                <td><?= h($cashAccountTrans->cash_account_id) ?></td>
                <td><?= h($cashAccountTrans->amount) ?></td>
                <td><?= h($cashAccountTrans->note) ?></td>
                <td><?= h($cashAccountTrans->created) ?></td>
                <td><?= h($cashAccountTrans->created_by) ?></td>
                <td><?= h($cashAccountTrans->modified) ?></td>
                <td><?= h($cashAccountTrans->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CashAccountTrans', 'action' => 'view', $cashAccountTrans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CashAccountTrans', 'action' => 'edit', $cashAccountTrans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CashAccountTrans', 'action' => 'delete', $cashAccountTrans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashAccountTrans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($store->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name Last') ?></th>
                <th scope="col"><?= __('Name First') ?></th>
                <th scope="col"><?= __('Name Last Kana') ?></th>
                <th scope="col"><?= __('Name First Kana') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Contact Type') ?></th>
                <th scope="col"><?= __('Joined') ?></th>
                <th scope="col"><?= __('Retired') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Flag') ?></th>
                <th scope="col"><?= __('Regular Amount') ?></th>
                <th scope="col"><?= __('Midnight Amount') ?></th>
                <th scope="col"><?= __('Other1 Amount') ?></th>
                <th scope="col"><?= __('Other2 Amount') ?></th>
                <th scope="col"><?= __('Employee Shift') ?></th>
                <th scope="col"><?= __('Othershift Start') ?></th>
                <th scope="col"><?= __('Othershift End') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->employees as $employees): ?>
            <tr>
                <td><?= h($employees->id) ?></td>
                <td><?= h($employees->code) ?></td>
                <td><?= h($employees->name_last) ?></td>
                <td><?= h($employees->name_first) ?></td>
                <td><?= h($employees->name_last_kana) ?></td>
                <td><?= h($employees->name_first_kana) ?></td>
                <td><?= h($employees->company_id) ?></td>
                <td><?= h($employees->store_id) ?></td>
                <td><?= h($employees->contact_type) ?></td>
                <td><?= h($employees->joined) ?></td>
                <td><?= h($employees->retired) ?></td>
                <td><?= h($employees->deleted) ?></td>
                <td><?= h($employees->note) ?></td>
                <td><?= h($employees->flag) ?></td>
                <td><?= h($employees->regular_amount) ?></td>
                <td><?= h($employees->midnight_amount) ?></td>
                <td><?= h($employees->other1_amount) ?></td>
                <td><?= h($employees->other2_amount) ?></td>
                <td><?= h($employees->employee_shift) ?></td>
                <td><?= h($employees->othershift_start) ?></td>
                <td><?= h($employees->othershift_end) ?></td>
                <td><?= h($employees->created) ?></td>
                <td><?= h($employees->created_by) ?></td>
                <td><?= h($employees->modified) ?></td>
                <td><?= h($employees->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Inventory Purchase Transactions') ?></h4>
        <?php if (!empty($store->inventory_purchase_transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Inventory Item Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Purchase Qty') ?></th>
                <th scope="col"><?= __('Loss Qty') ?></th>
                <th scope="col"><?= __('Count Qty') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->inventory_purchase_transactions as $inventoryPurchaseTransactions): ?>
            <tr>
                <td><?= h($inventoryPurchaseTransactions->id) ?></td>
                <td><?= h($inventoryPurchaseTransactions->inventory_item_id) ?></td>
                <td><?= h($inventoryPurchaseTransactions->store_id) ?></td>
                <td><?= h($inventoryPurchaseTransactions->transaction_date) ?></td>
                <td><?= h($inventoryPurchaseTransactions->purchase_qty) ?></td>
                <td><?= h($inventoryPurchaseTransactions->loss_qty) ?></td>
                <td><?= h($inventoryPurchaseTransactions->count_qty) ?></td>
                <td><?= h($inventoryPurchaseTransactions->created) ?></td>
                <td><?= h($inventoryPurchaseTransactions->created_by) ?></td>
                <td><?= h($inventoryPurchaseTransactions->modified) ?></td>
                <td><?= h($inventoryPurchaseTransactions->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'view', $inventoryPurchaseTransactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'edit', $inventoryPurchaseTransactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'delete', $inventoryPurchaseTransactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryPurchaseTransactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sales Transactions') ?></h4>
        <?php if (!empty($store->sales_transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Menu Id') ?></th>
                <th scope="col"><?= __('Menu Number') ?></th>
                <th scope="col"><?= __('Menu Name') ?></th>
                <th scope="col"><?= __('Qty') ?></th>
                <th scope="col"><?= __('Cash Sales Amount') ?></th>
                <th scope="col"><?= __('Pasmo Sales Amount') ?></th>
                <th scope="col"><?= __('Sales Amount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->sales_transactions as $salesTransactions): ?>
            <tr>
                <td><?= h($salesTransactions->id) ?></td>
                <td><?= h($salesTransactions->store_id) ?></td>
                <td><?= h($salesTransactions->transaction_date) ?></td>
                <td><?= h($salesTransactions->menu_id) ?></td>
                <td><?= h($salesTransactions->menu_number) ?></td>
                <td><?= h($salesTransactions->menu_name) ?></td>
                <td><?= h($salesTransactions->qty) ?></td>
                <td><?= h($salesTransactions->cash_sales_amount) ?></td>
                <td><?= h($salesTransactions->pasmo_sales_amount) ?></td>
                <td><?= h($salesTransactions->sales_amount) ?></td>
                <td><?= h($salesTransactions->created) ?></td>
                <td><?= h($salesTransactions->created_by) ?></td>
                <td><?= h($salesTransactions->modified) ?></td>
                <td><?= h($salesTransactions->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SalesTransactions', 'action' => 'view', $salesTransactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SalesTransactions', 'action' => 'edit', $salesTransactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SalesTransactions', 'action' => 'delete', $salesTransactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesTransactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Store Account Infos') ?></h4>
        <?php if (!empty($store->store_account_infos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Account Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Need Debit Department Code') ?></th>
                <th scope="col"><?= __('Need Credit Department Code') ?></th>
                <th scope="col"><?= __('Debit Category Id') ?></th>
                <th scope="col"><?= __('Credit Category Id') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Note Monthly') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->store_account_infos as $storeAccountInfos): ?>
            <tr>
                <td><?= h($storeAccountInfos->id) ?></td>
                <td><?= h($storeAccountInfos->account_id) ?></td>
                <td><?= h($storeAccountInfos->store_id) ?></td>
                <td><?= h($storeAccountInfos->need_debit_department_code) ?></td>
                <td><?= h($storeAccountInfos->need_credit_department_code) ?></td>
                <td><?= h($storeAccountInfos->debit_category_id) ?></td>
                <td><?= h($storeAccountInfos->credit_category_id) ?></td>
                <td><?= h($storeAccountInfos->note) ?></td>
                <td><?= h($storeAccountInfos->note_monthly) ?></td>
                <td><?= h($storeAccountInfos->created) ?></td>
                <td><?= h($storeAccountInfos->created_by) ?></td>
                <td><?= h($storeAccountInfos->modified) ?></td>
                <td><?= h($storeAccountInfos->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StoreAccountInfos', 'action' => 'view', $storeAccountInfos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StoreAccountInfos', 'action' => 'edit', $storeAccountInfos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StoreAccountInfos', 'action' => 'delete', $storeAccountInfos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storeAccountInfos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Store Inventory Item Histories') ?></h4>
        <?php if (!empty($store->store_inventory_item_histories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Inventory Item Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Cost') ?></th>
                <th scope="col"><?= __('Start') ?></th>
                <th scope="col"><?= __('End') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->store_inventory_item_histories as $storeInventoryItemHistories): ?>
            <tr>
                <td><?= h($storeInventoryItemHistories->id) ?></td>
                <td><?= h($storeInventoryItemHistories->inventory_item_id) ?></td>
                <td><?= h($storeInventoryItemHistories->store_id) ?></td>
                <td><?= h($storeInventoryItemHistories->price) ?></td>
                <td><?= h($storeInventoryItemHistories->cost) ?></td>
                <td><?= h($storeInventoryItemHistories->start) ?></td>
                <td><?= h($storeInventoryItemHistories->end) ?></td>
                <td><?= h($storeInventoryItemHistories->deleted) ?></td>
                <td><?= h($storeInventoryItemHistories->created) ?></td>
                <td><?= h($storeInventoryItemHistories->created_by) ?></td>
                <td><?= h($storeInventoryItemHistories->modified) ?></td>
                <td><?= h($storeInventoryItemHistories->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'view', $storeInventoryItemHistories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'edit', $storeInventoryItemHistories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'delete', $storeInventoryItemHistories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storeInventoryItemHistories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Time Cards') ?></h4>
        <?php if (!empty($store->time_cards)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                <th scope="col"><?= __('Out Time') ?></th>
                <th scope="col"><?= __('In Time2') ?></th>
                <th scope="col"><?= __('Out Time2') ?></th>
                <th scope="col"><?= __('Schedules In Time') ?></th>
                <th scope="col"><?= __('Scheduled Out Time') ?></th>
                <th scope="col"><?= __('Work Time') ?></th>
                <th scope="col"><?= __('Over Time') ?></th>
                <th scope="col"><?= __('Paid Vacation') ?></th>
                <th scope="col"><?= __('Paid Vacation Start Time') ?></th>
                <th scope="col"><?= __('Paid Vacation End Time') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Attendance Store Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->time_cards as $timeCards): ?>
            <tr>
                <td><?= h($timeCards->id) ?></td>
                <td><?= h($timeCards->employee_id) ?></td>
                <td><?= h($timeCards->store_id) ?></td>
                <td><?= h($timeCards->date) ?></td>
                <td><?= h($timeCards->in_time) ?></td>
                <td><?= h($timeCards->out_time) ?></td>
                <td><?= h($timeCards->in_time2) ?></td>
                <td><?= h($timeCards->out_time2) ?></td>
                <td><?= h($timeCards->schedules_in_time) ?></td>
                <td><?= h($timeCards->scheduled_out_time) ?></td>
                <td><?= h($timeCards->work_time) ?></td>
                <td><?= h($timeCards->over_time) ?></td>
                <td><?= h($timeCards->paid_vacation) ?></td>
                <td><?= h($timeCards->paid_vacation_start_time) ?></td>
                <td><?= h($timeCards->paid_vacation_end_time) ?></td>
                <td><?= h($timeCards->note) ?></td>
                <td><?= h($timeCards->attendance_store_id) ?></td>
                <td><?= h($timeCards->created) ?></td>
                <td><?= h($timeCards->created_by) ?></td>
                <td><?= h($timeCards->modified) ?></td>
                <td><?= h($timeCards->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TimeCards', 'action' => 'view', $timeCards->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TimeCards', 'action' => 'edit', $timeCards->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TimeCards', 'action' => 'delete', $timeCards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeCards->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($store->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->code) ?></td>
                <td><?= h($users->company_id) ?></td>
                <td><?= h($users->store_id) ?></td>
                <td><?= h($users->name) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->type) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->created_by) ?></td>
                <td><?= h($users->modified) ?></td>
                <td><?= h($users->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
