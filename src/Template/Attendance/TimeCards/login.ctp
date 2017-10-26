<?php
/**
  * @var \App\View\AppView $this
  */
?>

<?php 
echo $store_name;
echo nl2br("\n");
echo $this->Html->link('ログアウト', ['controller'=>'/../Users', 'action'=>'logout']);
echo $this->Form->create('Employees') ;
echo $this -> Form -> input ( "code", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員コード",
                                           "default" => "" ]  );
echo $this -> Form -> submit ( "ログイン", array('name' => 'loginButton'));
echo $this -> Form -> submit ( "勤怠データ確認", array('name' => 'loginButton'));
echo $this -> Form -> submit ( "別店舗応援", array('name' => 'loginButton'));
echo $this -> Form -> end ();
?>
</div>
