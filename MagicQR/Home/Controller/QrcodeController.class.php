<?php

namespace Home\Controller;
use Think\Controller;
class QrcodeController extends Controller {
    public function index(){
		$qr = new \Org\Util\Qrcode;
		$qr ->png('');
    }
    public function check($check_code){//凭据码检测方法
		$label = D('label');//实例化标签索引表
		$result = $label ->where("check_code = '%s'",$check_code)->find();//检查标签凭据码是否存在
		if (!empty($result)) {//标签凭据码存在
			$rand_code = $result['rand_code'];//获取标签凭据码
			$type_code = substr($rand_code,0,1);//字符串分割,将标签类型分割
			switch ($type_code) {//判断类型,实例化不同的模型
				case 'I':
					$image = D('image');
					$find = $image->where("rand_code = '%s'",$rand_code)->find();//从image表中获取信息
					$state = $find['state'];//获取状态值,1为未使用,2为已使用
					echo $state;
					
					break;
				case 'M':
					$movie = D('movie');
                    $find = $movie->where("rand_code = '%s'",$rand_code)->find();//从movie表中获取信息
                    $state = $find['state'];//获取状态值,1为未使用,2为已使用
                    echo $state;
                    
                    break;
				case 'V':
					$voice = D('voice');
                    $find = $voice->where("rand_code = '%s'",$rand_code)->find();//从voice表中获取信息
                    $state = $find['state'];//获取状态值,1为未使用,2为已使用
                    echo $state;
                    
                    break;
				case 'F':
					$function = D('function');
					$state = $function->where("rand_code = '%s'",$rand_code)->getField('state');
					echo $state;
					break;
				case 'L':
					$limit = D('limit');
					$state = $function->where("rand_code = '%s'",$rand_code)->getField('state');
					echo $state;
					break;
				default:
					break;
			}
		}else{
				echo "Data not exist";
			}
    }
    public function return_code($check_code){//json返回方法
    	$label = D('label');//实例化标签索引表
		$result = $label ->where("check_code = '%s'",$check_code)->find();//检查标签凭据码是否存在
		if (!empty($result)) {//标签凭据码存在
			$rand_code = $result['rand_code'];//获取标签凭据码
			$type_code = substr($rand_code,0,1);//字符串分割,将标签类型分割
			switch ($type_code) {//判断类型,实例化不同的模型
				case 'I':
					$image = D('image');
					$find = $image->where("rand_code = '%s'",$rand_code)->find();//从image表中获取信息
					$state = $find['state'];//获取状态值,1为未使用,2为已使用
					switch ($state) {
						case '1'://状态为1时输出1
							echo "1";
							break;
						case '2'://状态为2时返回包含标题,内容和文件地址的json字符串
						$title = $result['title'];
						$content = $result['content'];
						$address = $find['address'];
						$add = explode("+",$address);
						$count = count($add)-1;
						for ($i=0; $i <$count ; $i++) {
							$arr[$i] = $add[$i];
						}
						$arr[$count] = $title;
						$arr[$count+1] = $content;
						$json = json_encode($arr);
						echo $json;
						//print_r($add);
						//echo(count($add));
							break;
						default:
							break;
					}
					break;
				case 'M':
					$movie = D('movie');
                    $find = $movie->where("rand_code = '%s'",$rand_code)->find();//从movie表中获取信息
                    $state = $find['state'];//获取状态值,1为未使用,2为已使用
                    switch ($state) {
                        case '1'://状态为1时输出1
                            echo "1";
                            break;
                        case '2'://状态为2时返回包含标题,内容和文件地址的json字符串
                        $title = $result['title'];
                        $content = $result['content'];
                        $address = $find['address'];
                        $arr[0] = $address;
                        $arr[1] = $title;
                        $arr[2] = $content;
                        $json = json_encode($arr);
                        echo $json;
                            break;
                        default:
                            break;
                    }
                    break;
				case 'V':
					$voice = D('voice');
                    $find = $voice->where("rand_code = '%s'",$rand_code)->find();//从voice表中获取信息
                    $state = $find['state'];//获取状态值,1为未使用,2为已使用
                    switch ($state) {
                        case '1'://状态为1时输出1
                            echo "1";
                            break;
                        case '2'://状态为2时返回包含标题,内容和文件地址的json字符串
                        $title = $result['title'];
                        $content = $result['content'];
                        $address = $find['address'];
                        $arr[0] = $address;
                        $arr[1] = $title;
                        $arr[2] = $content;
                        $json = json_encode($arr);
                        echo $json;
                            break;
                        
                        default:
                            break;
                    }
                    break;
				case 'F':
					$function = D('function');
					$state = $function->where("rand_code = '%s'",$rand_code)->getField('state');
					echo $state;
					break;
				case 'L':
					$limit = D('limit');
					$state = $function->where("rand_code = '%s'",$rand_code)->getField('state');
					echo $state;
					break;
				default:
					break;
			}
		}else{
			echo "Data not exist";
		}
    }
    public function rand_code($type){//凭据码生成方法
    	$arr[]=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');//定义字符数组
    	switch ($type) {
    		case 'I':
					$image = D('image');
					$label = D('label');
					$result = $image->order('rand_code desc')->limit(1)->select();//从数据库中查询凭据码的最大值,返回值为数组
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;//取凭据码后六位加1
					$num = $num_code;//将计算后的后六位凭据码重新赋值
					$length = strlen($num);
					$sum = 0;//定义求和变量
					    for($i = 0;$i < 6; $i++)//对新生成的后六位凭据码按位求和
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;//用和值对26取余
					$word = $arr[0]["$key"];//以余数为键名从字符数组中回去对应的字母

					$rand_code_new = 'I0'.$word.'AAA'.$num_code;//构造返回字符串,将新生成的凭据码存到变量中;其中I为标签类型,0为纸质打印类型,AAA分别为26进制的百万位,千万位和亿位
					$rand_code_new_insert = 'I0*AAA'.$num_code;//构造插入字符串,该字符串用于插入数据库
					$data['rand_code'] = $rand_code_new_insert;
					$data['check_code'] = $rand_code_new;
					$add_image = $image ->add($data);
					$add_label = $label ->add($data);

					// 显示新生成的凭据码
					// $result_all = $image->select();
					// $last = $image->where("rand_code = '$rand_code_new_insert'")->select();
					// $max_id = $last[0]['id'];
					// echo $max_id;
					// echo "<br>";
					// for ($i=164; $i <=$max_id ; $i++) {
					// 	$all[] = $result_all[$i]['check_code
					// 	'];
					// }
					// echo "从第164"."到最后"."共有:".count($all)."个";
					// echo "<br>";			
					$this->show($rand_code_new);//打印新的凭据码
					break;
				case 'M':
					$movie = D('movie');
					$label = D('label');
					$result = $movie->order('rand_code desc')->limit(1)->select();//从数据库中查询凭据码的最大值,返回值为数组
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;//取凭据码后六位加1
					$num = $num_code;//将计算后的后六位凭据码重新赋值
					$length = strlen($num);
					$sum = 0;//定义求和变量
					    for($i = 0;$i < 6; $i++)//对新生成的后六位凭据码按位求和
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;//用和值对26取余
					$word = $arr[0]["$key"];//以余数为键名从字符数组中回去对应的字母

					$rand_code_new = 'M0'.$word.'AAA'.$num_code;//构造返回字符串,将新生成的凭据码存到变量中;其中I为标签类型,0为纸质打印类型,AAA分别为26进制的百万位,千万位和亿位
					$rand_code_new_insert = 'M0*AAA'.$num_code;//构造插入字符串,该字符串用于插入数据库
					$data['rand_code'] = $rand_code_new_insert;
					$data['check_code'] = $rand_code_new;
					$add_movie = $movie ->add($data);
					$add_label = $label ->add($data);

					//显示新生成的凭据码
					// $result_all = $movie->select();
					// $last = $movie->where("rand_code = '$rand_code_new_insert'")->select();
					// $max_id = $last[0]['id'];
					// echo $max_id;
					// echo "<br>";
					// for ($i=139; $i <=$max_id ; $i++) {
					// 	$all[] = $result_all[$i]['check_code
					// 	'];
					// }
					// echo "从第".$max_id."到最后"."共有:".count($all)."个";
					// echo "<br>";
					$this->show($rand_code_new);//打印新的凭据码
					break;
				case 'V':
					$voice = D('voice');
					$label = D('label');
					$result = $voice->order('rand_code desc')->limit(1)->select();//从数据库中查询凭据码的最大值,返回值为数组
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;//取凭据码后六位加1
					$num = $num_code;//将计算后的后六位凭据码重新赋值
					$length = strlen($num);
					$sum = 0;//定义求和变量
					    for($i = 0;$i < 6; $i++)//对新生成的后六位凭据码按位求和
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;//用和值对26取余
					$word = $arr[0]["$key"];//以余数为键名从字符数组中回去对应的字母

					$rand_code_new = 'V0'.$word.'AAA'.$num_code;//构造返回字符串,将新生成的凭据码存到变量中;其中I为标签类型,0为纸质打印类型,AAA分别为26进制的百万位,千万位和亿位
					$rand_code_new_insert = 'V0*AAA'.$num_code;//构造插入字符串,该字符串用于插入数据库
					$data['rand_code'] = $rand_code_new_insert;
					$data['check_code'] = $rand_code_new;
					$add_voice = $voice ->add($data);
					$add_label = $label ->add($data);
					
					//显示新生成的凭据码
					// $result_all = $voice->select();
					// $last = $voice->where("rand_code = '$rand_code_new_insert'")->select();
					// $max_id = $last[0]['id'];
					// echo $max_id;
					// echo "<br>";
					// for ($i=165; $i <=$max_id ; $i++) {
					// 	$all[] = $result_all[$i]['check_code
					// 	'];
					// }
					// echo "从第"."到最后"."共有:".count($all)."个";
					// echo "<br>";
					$this->show($rand_code_new);//打印新的凭据码
					break;
				case 'F':
					$function = D('function');
					$label = D('label');
					$result = $function->order('rand_code desc')->limit(1)->select();//从数据库中查询凭据码的最大值,返回值为数组
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;//取凭据码后六位加1
					$num = $num_code;//将计算后的后六位凭据码重新赋值
					$length = strlen($num);
					$sum = 0;//定义求和变量
					    for($i = 0;$i < 6; $i++)//对新生成的后六位凭据码按位求和
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;//用和值对26取余
					$word = $arr[0]["$key"];//以余数为键名从字符数组中回去对应的字母

					$rand_code_new = 'F0'.$word.'AAA'.$num_code;//构造返回字符串,将新生成的凭据码存到变量中;其中I为标签类型,0为纸质打印类型,AAA分别为26进制的百万位,千万位和亿位
					$rand_code_new_insert = 'F0*AAA'.$num_code;//构造插入字符串,该字符串用于插入数据库
					$data['rand_code'] = $rand_code_new_insert;
					$data['check_code'] = $rand_code_new;
					$add_function = $function ->add($data);
					$add_label = $label ->add($data);
					
					$this->show($rand_code_new);//打印新的凭据码
					break;
				case 'L':
					$limit = D('limit');
					$label = D('label');
					$result = $limit->order('rand_code desc')->limit(1)->select();//从数据库中查询凭据码的最大值,返回值为数组
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;//取凭据码后六位加1
					$num = $num_code;//将计算后的后六位凭据码重新赋值
					$length = strlen($num);
					$sum = 0;//定义求和变量
					    for($i = 0;$i < 6; $i++)//对新生成的后六位凭据码按位求和
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;//用和值对26取余
					$word = $arr[0]["$key"];//以余数为键名从字符数组中回去对应的字母

					$rand_code_new = 'L0'.$word.'AAA'.$num_code;//构造返回字符串,将新生成的凭据码存到变量中;其中I为标签类型,0为纸质打印类型,AAA分别为26进制的百万位,千万位和亿位
					$rand_code_new_insert = 'L0*AAA'.$num_code;//构造插入字符串,该字符串用于插入数据库
					$data['rand_code'] = $rand_code_new_insert;
					$data['check_code'] = $rand_code_new;
					$add_limit = $limit ->add($data);
					$add_label = $label ->add($data);
					
					$this->show($rand_code_new);//打印新的凭据码
					break;
				default:
					break;
    	}
    }
}
