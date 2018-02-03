<header class="row">
    <div class="col-sm-12">
        <h2>マスターメニュー名変更</h2>
    </div>
</header>

<p class="text-blue bold">新しいメニュー名、出庫アイテム番号・名を入力してください。</p>

<?=$this->Form->create(null, ['class' => 'form-inline']) ?>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>メニュー番号</td>
                <td><?=h($menuHistory->menu->menu_number)?></td>
            </tr>
            <tr>
                <td>メニュー名</td>
                <td><?=h($menuHistory->name)?></td>
            </tr>
            <tr>
                <td>新メニュー名</td>
                <td class="green"><?= $this->Form->control('name', ['label' => false, 'required' => true, 'style' => 'min-width: 20em;']) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="text-center">
        <?= $this->Form->submit("キャンセル", ['name'=>'button', 'style' => 'margin-right: 50px;']) ?>
        <?= $this->Form->submit("　変更　", ['name'=>'button']) ?>
    </div>
<?=$this->Form->end() ?>
