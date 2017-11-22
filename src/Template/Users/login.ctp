<div class="login_form">
<?php
echo $this->Form->create('Users');
echo $this -> Form -> input ( "name", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "ユーザ",
                                           "default" => "" ]  );
echo $this -> Form -> input ( "password", [ "type" => "password",
                                           "size" => 10,
                                           "label" => "パスワード",
                                           'class' => 'bbbbb',
                                           "default" => "" ]  );
echo $this -> Form -> submit ( "ログイン", [
    'class' => 'login-button'
] );
echo $this -> Form -> end ();
?>
</div>