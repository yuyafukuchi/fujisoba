<?php
echo $this -> Form -> create (
                "null", [ "type" => "post",
                          "url" => [ "controller" => "filename",
                                     "action" => "index" ] ] );
echo $this -> Form -> input ( "user", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員コード",
                                           "default" => "" ]  );
echo $this -> Form -> input ( "user", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員名",
                                           "default" => "" ]  );  
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "勤怠データ不備あり" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "未印刷" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "未承認" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "csv未出力" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "予定と実績が異なる" ] );
echo $this->Form->input('company_id', ['options' => $companies,'empty' => true, "label" => '会社名']);
 echo $this->Form->input('store_id', ['options' => $stores, 'empty' => true,"label" => '店舗名']);
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "退職者も表示" ] );
echo $this -> Form -> submit ( "検索");
echo $this -> Form -> end ();