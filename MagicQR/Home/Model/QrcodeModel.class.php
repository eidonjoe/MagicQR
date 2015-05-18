<?php
namespace Home\Model;
use Think\Model;
class QrcodeModel extends Model {
	 public function rand_code($type){
    	$arr[]=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    	switch ($type) {
    		case 'I':
					$image = D('image');
					$result = $image->order('id desc')->limit(1)->select();
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;
					$num = $num_code;
					$sum = 0;
					    for($i = 0;$i < 6; $i++)
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;
					$word = $arr[0]["$key"];
					$rand_code_new = 'I0'.$word.'AAA'.$num_code;
					echo $rand_code_new;
					break;
				case 'M':
					$movie = D('movie');
					$result = $movie->order('id desc')->limit(1)->select();
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;
					$num = $num_code;
					$sum = 0;
					    for($i = 0;$i < 6; $i++)
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;
					$word = $arr[0]["$key"];
					$rand_code_new = 'I0'.$word.'AAA'.$num_code;
					echo $rand_code_new;
					break;
				case 'V':
					$voice = D('voice');
					$result = $voice->order('id desc')->limit(1)->select();
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;
					$num = $num_code;
					$sum = 0;
					    for($i = 0;$i < 6; $i++)
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;
					$word = $arr[0]["$key"];
					$rand_code_new = 'I0'.$word.'AAA'.$num_code;
					echo $rand_code_new;
					break;
				case 'F':
					$function = D('function');
					$result = $function->order('id desc')->limit(1)->select();
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;
					$num = $num_code;
					$sum = 0;
					    for($i = 0;$i < 6; $i++)
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;
					$word = $arr[0]["$key"];
					$rand_code_new = 'I0'.$word.'AAA'.$num_code;
					echo $rand_code_new;
					break;
				case 'L':
					$limit = D('limit');
					$result = $limit->order('id desc')->limit(1)->select();
					$rand_code = $result[0]['rand_code'];
					$num_code = substr($rand_code,6,6)+1;
					$num = $num_code;
					$sum = 0;
					    for($i = 0;$i < 6; $i++)
					    {
					        $sum+=$num%10;
					        $num/=10;
					    }
					$key = $sum%26;
					$word = $arr[0]["$key"];
					$rand_code_new = 'I0'.$word.'AAA'.$num_code;
					echo $rand_code_new;
					break;
				default:
					break;
    	}

    }
}

?>