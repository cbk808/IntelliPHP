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
	public function __construct(){

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
		$this->cur_rule=$this->basic_rules[$arr_rule[1]];
		if(!empty($arr_rule[2])){
			$arr_range=explode(',',trim($arr_rule[2],"[]"));
			$this->cur_rule['from']=$arr_range[0];
			$this->cur_rule['to']=$arr_range[1];
		}
		$this->cur_err[$this->cur_item_name]=$this->verify_range() && $this->verify_type() && $this->verify_pattern();
	}

    //递归函数
    private function verify_item_r($cur_index,$arr,$index,$rule){
        if($index<count($arr)-1){
            //如果是数字下标则执行递归
            if($arr[$index]=='~'){
                    $cur_input=eval("\$this->input".$cur_index);
                    for($i=0,$l=count($cur_input);$i<$l;$i++) {
                        $this->verify_item_r($cur_index."[".$i."]",$arr,$index+1,$rule);
                    }
            }else{
                $this->verify_item_r($cur_index."[".$arr[$index]."]",$arr,$index+1,$rule);
            }
        }else{
            //执行验证
            if($arr[$index]=='~'){
                $cur_input=eval("\$this->input".$cur_index);
                foreach($cur_input as $val){
                    $this->cur_item=$val;
                    $this->exec_verification($rule[0]);
                }
            }else{
                $cur_input=eval("\$this->input".$cur_index."[".$arr[$index]."]");
                $this->cur_item=$cur_input;
                $this->exec_verification($rule[0]);
            }
        }
    }

	//验证数组
	private function exec_verification_r(){
            //采用逐条的方式进行验证
			foreach($this->conf as $key=>$value){
                $key_arr=explode(".",$key);
                $this->verify_item_r("",$key_arr,0,$value);
			}
	}

    //验证入口
    public function verify($conf,$input){
        $this->conf=$conf;
        $this->input=$input;
        if(is_array($this->input)){
            $this->exec_verification_r();
        }else{
            $this->cur_item=$this->input;
            $this->exec_verification($this->conf[0]);
        }
    }
}
