<?php 

class tools
{
	static private $param;
	static function setparam($host,$user,$pass,$dbname){
		tools::$param=array($host,$user,$pass,$dbname);
	}
	static function connect(){
		$dsn='mysql:host='.tools::$param[0].';dbname='.tools::$param[3].';charset=utf8;';//строка подключения
		$options=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,//при ошибке - прерывать работу и сигнализировать об ошибке
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,//получание данных в ассоциативном массиве
			PDO::MYSQL_ATTR_INIT_COMMAND=>'set names "utf8"',
			);//массив параметров для PDO
		$pdo = new PDO($dsn,tools::$param[1],tools::$param[2],$options);
		return $pdo;
	}
}
//////////////////////////////////////////////
class Customer{
	protected $id;
	protected $login;
	protected $pass;
	protected $roleid;
	protected $discount;
	protected $total;
	protected $imagepath;

	function __construct($login,$pass,$imagepath,$id=0){
		if ($imagepath=='') $imagepath='images/loading.gif';
		$this->login=$login;
		$this->pass=$pass;
		$this->imagepath=$imagepath;
		$this->id=$id;
		$this->discount=0;
		$this->total=0;
		$this->roleid=2;
	}

	function IntoDb(){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('insert into customers(login,pass,roleid,discount,total,imagepath)
			values (:login,:pass,:roleid,:discount,:total,:imagepath)');
		$data=array('login'=>$this->login,'pass'=>$this->pass,'roleid'=>$this->roleid,'discount'=>$this->discount,'total'=>$this->total,'imagepath'=>$this->imagepath);
		$ps->execute($data);
	}
	static function FromDb($id){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('select * from customers where id=?');
		$ps->execute(array($id));
		$row=$ps->fetch(PDO::FETCH_LAZY);//получаем значения при обращении к массиву
		$customer=new Customer($row['login'],$row['pass'],$row['imagepath'],$id);
		return $customer;
	}
}
////////////////////////////////////////////////////
class Item{
	protected $id,$itemname,$catid,$subid,$pricein,$pricesale,$info,$rate,$imagepath,$action;
	function __construct(array $data){
		$this->id=$data['id'];
		$this->itemname=$data['itemname'];
		$this->catid=$data['catid'];
		$this->subid=$data['subid'];
		$this->pricein=$data['pricein'];
		$this->pricesale=$data['pricesale'];
		$this->info=$data['info'];
		$this->imagepath=$data['imagepath'];
		$this->action=0;
		$this->rate=0;
	}
	function IntoDb(){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('insert into Items(itemname,catid,subid,pricein,pricesale,info,rate,imagepath,action)
			values (:itemname,:catid,:subid,:pricein,:pricesale,:info,:rate,:imagepath,:action)');
		$data=array('itemname'=>$this->itemname,
			'catid'=>$this->catid,
			'subid'=>$this->subid,
			'pricein'=>$this->pricein,
			'pricesale'=>$this->pricesale,
			'info'=>$this->info,
			'rate'=>$this->rate,
			'imagepath'=>$this->imagepath,
			'action'=>$this->action);
		$ps->execute($data);
	}
}