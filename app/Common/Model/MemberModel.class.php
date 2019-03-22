<?php
namespace Common\Model;
use Think\Model;
class MemberModel extends Model {
	//自动完成
	protected $_auto = array ( 
         array('status','1'),  // 新增的时候把status字段设置为1
         array('password','st_md5',3,'function') , 
         // array('name','getName',3,'callback'), // 对name字段在新增和编辑的时候回调getName方法
		 array('reg_ip','get_client_ip',1,'function'),
         array('reg_time','time',1,'function'), 
		 array('last_login_time','time',3,'function'),
		 array('last_login_ip','get_client_ip',3,'function'),
     );
	 
	 //自动验证
	  protected $_validate = array(
		 array('verify','require','验证码必须！'), //默认情况下用正则进行验证
		 //array('value',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
		 array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
		 array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
		 array('nickname','require','昵称不能为空'),
		 array('nickname', '', '昵称已被占用', self::EXISTS_VALIDATE, 'unique'),
		  
		 /* 验证邮箱 */
		array('email', 'email', '邮箱格式不正确', self::EXISTS_VALIDATE), //邮箱格式不正确
		array('email', '1,32', -6, self::EXISTS_VALIDATE, 'length'), //邮箱长度不合法
		array('email', '', -8, self::EXISTS_VALIDATE, 'unique'), //邮箱被占用
		
	  );
	 
	 
}
