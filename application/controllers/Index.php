<?php
/**
 * @name IndexController
 * @author {&$AUTHOR&}
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends Yaf_Controller_Abstract {

	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/{&$APP_NAME&}/index/index/index/name/{&$AUTHOR&} 的时候, 你就会发现不同
     */
	public function indexAction($name = "Stranger") {
		$get = $this->getRequest()->getQuery("get", "default value");
		$model = new SampleModel();
		$this->getView()->assign("content", $model->selectSample());
		$this->getView()->assign("name", $name);
	}
	public function testAction()
	{
		$request = $this->getRequest();
		echo "<pre>";
		print_r($request); 
		echo "</pre>";
	}
	public function loginAction()
	{
		$request = $this->getRequest();
		echo "<pre>";
		print_r($request); 
		echo "</pre>";
	}
	public function zixunAction()
	{
		$request = $this->getRequest();
		echo "<pre>";
		print_r($request); 
		echo "</pre>";
	}
}
