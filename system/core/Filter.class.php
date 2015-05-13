<?php 
class Filter 
{
	public $input;//输入的内容
	private $cur_item;//当前验证项
	private $cur_rule;//当前验证规则
	//验证规则列表
	private $basic_rules=[
		'ip'=>[
			'type'=>'string',
			'pattern'=>'',
		],
	];
	//类型验证
	private function verify_type(){
		return $cur_rule['type']?typeof($cur_item)==$cur_rule['type']:true;
	}
	//范围验证
	private function verify_range(){
		switch($cur_rule['type']){
			case "int":
			$val=$cur_item;
			break;
			case "string":
			$val=strlen($cur_item);
			break;
			case "datetime":
			$val=strtotime($cur_item);
			$cur_rule['from']=$cur_rule['from']?strtotime($cur_rule['from']):null;
			$cur_rule['to']=$cur_rule['to']?strtotime($cur_rule['to']):null;
			break;
		}
		//如果没有指定上限或下限，就设置一个很大或者很小的数来代替
		$cur_rule['from']=$cur_rule['from']?$cur_rule['from']:-3e8;
		$cur_rule['to']=$cur_rule['to']?$cur_rule['to']:3e8;
		return $val>$cur_rule['from'] && $val < $cur_rule['to'];
	}
	//主验证函数
	public function exec_verification($input, $str_rule){
		

	}
}

 ?>