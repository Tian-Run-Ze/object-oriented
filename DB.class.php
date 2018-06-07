<?php 

header("content-type:text/html;charset=utf-8");

final class Db{

	public $rand;
	//私有的静态属性
	private static $inst;
    //公共的静态方法
	public static function getIntance(){
		if(self::$inst instanceof self){
			return self::$inst;
		}else{
			self::$inst = new self;
			return self::$inst;
		}
	}
    
	//私有的克隆方法
	private function __clone(){


	}
    
	//私有的构造方法
	private function __construct(){

		mysql_connect('127.0.0.1','root','root');
		mysql_select_db('dayexam');
		mysql_query('set name utf8');
	}
     //添加
	function insert($table,$arr){

		$str1 = "";
		$str2 = "";
		foreach ($arr as $key => $value) {
			
			$str1.=$key.',';
			$str2.="'$value'".',';qdom_error
		}

		$key_str = rtrim($str1,',');
		$value_str = rtrim($str2,',');

		$sql = "insert into $table($key_str) values($value_str)";
		$res = mysql_query($sql);
		return $res;
	}
    
   //查询
	function select($table,$where=1){

		$sql = "select * from $table where $where";
		$res = mysql_query($sql);
		return $res;
	}
     
	 //删除
	function delete($table,$where=1){

		$sql = "delete from $table where $where";
		$res = mysql_query($sql);
		return $res;
	}

    //修改
	function save($table,$arr){   
        $str_one = "";
        foreach($arr as $key =>$value){
            $str_one.= $key.'='."'$value'".',';
        }
        $str_one = rtrim($str_one,',');
        $sql = "update $table set $str_one where id =".$arr['id'];
        $res = mysql_query($sql);
        return $res;
    }
    
	//登录
    function login($table,$username,$password){

    	$sql = "select username,password from $table where username='$username' and password='$password'";
    	$res = mysql_query($sql);
    	return $res;
    }
}

$Db = Db::getIntance();

?>