<?php
class Person {
	public $name;
	function __construct($name) {
		$this->name = $name;
	}
}

interface Module {
	function execute();
}

class FtpModule implements Module {
	function setHost( $host ) {
		print "FtpModule::setHost(): $host\n";
	}

	function setUser( $user ) {
		print "FtpModule::setUser(): $user \n";
	}

	function execute() {
		// do something
	}

}

class PersonModule implements Module {
	function setPerson (Person $person) {
		print "PersonModule::setPerson(): {$person->name} \n";
	}

	function execute() {
		
	}
}

class ModuleRunner {
	private $configData
			= array (
					"PersonModule" => array('person'=>'bob'),
					"FtpModule"	   => array('host'=>'example.com','user' => 'anon')
				);
	private $module = array();

	function init() {
		//将module类的信息放到$interface变量中
		$interface = new ReflectionClass('Module');
		foreach ($this->configData as $modulename => $params) {
			//每个模块元素创建ReflectionClass对象
			$module_class = new ReflectionClass($modulename);
			//判断模块是否继承
			if( !$module_class->isSubclassof( $interface )) {
				throw new Exception("unknown module type: $modulename");
			}
			//实例化对象
			$module = $module_class->newInstance();
			var_dump($module);
			//循环可用ReflectionMethod对象的数组
			foreach ($module_class->getMethods() as $method) {
				# code...
				$this->handleMethod($module, $method, $params);
			}

			array_push( $this->modules, $module);
			# code...
		}
	}

	function handleMethod( Module $module, ReflectionMethod $method, $params) {
		//获取方法名
		$name = $method->getName();
		//获取方法参数
		$args = $method->getParameters();
		var_dump($args);
		var_dump($module);
		//检测是否set方法
		if( count( $args ) != 1 || substr($name, 0, 3) != "set") {
			return false;
		}
		//获取set的参数名
		$property = strtolower( substr( $name, 3 ) );
		if(! isset( $params[$property])){
			return false;
		}

		/**
		 * getClass
		 * 判断set方法的参数类型
		   返回空值，基本数据类型，其余是对象
		 */
		$arg_class = $args[0]->getClass();
		if(empty( $args_class )){
			$method->invoke($module,$params[$property]);
		} else {
			$method->invoke( $module, $arg_class->newInstance( $params[$property]));
		}

	}


}
$test = new ModuleRunner();
$test->init();