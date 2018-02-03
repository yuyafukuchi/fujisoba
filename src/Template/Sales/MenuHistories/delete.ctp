<header class="row">
    <div class="col-sm-12">
        <h2>マスタメニュー削除</h2>
    </div>
</header>

<p class="text-blue bold">以下のマスタメニューを<span class="text-red"><?=date('Y年m月d日',$date)?>以降削除</span>しますが、よろしいですか？</p>

<table class="table table-bordered">
    <tbody>
        <tr>
            <td>番号</td>
            <td><?=h($menuHistory->menu->menu_number)?></td>
        </tr>
        <tr>
            <td>品名</td>
            <td><?=h($menuHistory->name)?></td>
        </tr>
    </tbody>
</table>

<div class="text-center">
    <?=$this->Form->create(null, ['class' => 'form-inline']) ?>
        <?= $this->Form->submit("キャンセル", ['name'=>'button', 'style' => 'margin-right: 50px;']) ?>
        <?= $this->Form->submit("　削除　", ['name'=>'button']) ?>
    <?=$this->Form->end() ?>
</div>
