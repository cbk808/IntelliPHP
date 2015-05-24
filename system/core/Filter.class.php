<?php 
class Filter 
{
	private $input;//输入的内容
	private $conf;//验证配置. 这应该是一个约定好的样式，例如：
	/**
	 * $conf=[
	 *    'username.firstname'=>["required username [6,12]", 'some error msg'],
	 * ];
	 */
	private $cur_item;//当前验证项
	private $cur_item_name;//当前验证项的名称
	private $cur_rule;//当前验证规则
	public $cur_err= [];//存放验证结果
	public $verify_result;//用来存放返回结果
	//验证规则列表
	private $basic_rules=[
		'ip'=>[
			'type'=>'string',
			'pattern'=>'',
		],
	];
	//构造函数
	public function __construct($conf,$input){
		$this->conf=$conf;
		$this->input=$input;
	}
	//类型验证
	private function verify_type(){
		return $this->cur_rule['type']? gettype ($this->cur_item)==$this->cur_rule['type']:true;
	}
	//验证范式
	private function verify_pattern(){
		if(empty($this->cur_rule['pattern']))return true;
		preg_match($this->cur_rule['pattern'], $this->cur_item,$matches);
		if(count($matches))return true;
		else return false;
	}
	//范围验证
	private function verify_range(){
		switch($this->cur_rule['type']){
			case "int":
			$val=$this->cur_item;
			break;
			case "string":
			$val=strlen($this->cur_item);
			break;
			case "datetime":
			$val=strtotime($this->cur_item);
			$this->cur_rule['from']=$this->cur_rule['from']?strtotime($this->cur_rule['from']):null;
			$this->cur_rule['to']=$this->cur_rule['to']?strtotime($this->cur_rule['to']):null;
			break;
		}
		//如果没有指定上限或下限，就设置一个很大或者很小的数来代替
		$this->cur_rule['from']=$this->cur_rule['from']?$this->cur_rule['from']:-3e8;
		$this->cur_rule['to']=$this->cur_rule['to']?$this->cur_rule['to']:3e8;
		return $val>$this->cur_rule['from'] && $val < $this->cur_rule['to'];
	}

	//主验证函数
	private function exec_verification($str_rule){
		$arr_rule=explode(' ', $str_rule);
		$this->cur_rule=$arr_rule[1];
		if(!empty($arr_rule[2])){
			$arr_range=explode(',',trim($arr_rule[2],"[]"));
			$this->cur_rule['from']=$arr_range[0];
			$this->cur_rule['to']=$arr_range[1];
		}
		$this->cur_err[$this->cur_item_name]=$this->verify_range() && $this->verify_type() && $this->verify_pattern();
	}
	//验证数组
	public function exec_verification_r(){
		if(is_array($this->input)){
			foreach($this->conf as $key=>$value){
				$temp_item=preg_replace("/\./","][",$key);
                $temp_item=eval("\$input[".$temp_item."]");
				$this->cur_item=$temp_item;
				$this->exec_verification($value[0]);
			}
		}else{
			$this->cur_item=$this->input;
			$this->exec_verification($this->conf[0]);
		}
	}


}

