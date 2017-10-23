<?php
/**
  * @var \App\View\AppView $this
  */
?>

<?php 
echo $this->Form->create('Users');
echo $this -> Form -> input ( "name", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "ユーザ",
                                           "default" => "" ]  );
echo $this -> Form -> input ( "password", [ "type" => "password",
                                           "size" => 10,
                                           "label" => "パスワード",
                                           "default" => "" ]  );
echo $this -> Form -> submit ( "ログイン");
echo $this -> Form -> end ();
?>
</div>
