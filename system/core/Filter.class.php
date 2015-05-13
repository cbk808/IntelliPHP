<?php 
class Filter 
{
	public $input;
	private $cur_item;
	private $cur_rule;
	private $rules=[
		'ip'=>[
			'type'=>'string',
			'pattern'=>'',
		],
	];
	private function verify_type(){
		return typeof($cur_item)==$cur_rule['type'];
	}
	private function verify_range(){

	}
}

 ?>