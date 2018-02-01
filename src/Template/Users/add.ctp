<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('code');
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('store_id', ['options' => $stores, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('password');
            echo $this->Form->input('password_confirm',['type' => 'password']);
            echo $this->Form->input('type');
            // echo $this->Form->input('created_by');
            // echo $this->Form->input('modified_by', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
