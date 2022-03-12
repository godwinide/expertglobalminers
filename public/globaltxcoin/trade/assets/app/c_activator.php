<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	$method=$_POST['method'];
	if($method == 'online')
	{
		$nama=$_POST['nama'];
		$password=$_POST['password'];
		if(strtoupper(PHP_OS) == strtoupper("LINUX"))
		{
			$ds=shell_exec('udevadm info --query=all --name=/dev/sda | grep ID_SERIAL_SHORT');
			$serialx = explode("=", $ds);
			$serial = $serialx[1];
		}
		else
		{
			function GetVolumeLabel($drive) {
				if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
					$volname = ' ('.$m[1].')';
				} else {
					$volname = '';
				}
				return $volname;
			}
			$serial = str_replace("(","",str_replace(")","",GetVolumeLabel("c")));
		}
		$url=$_POST['url'];
		$ch = curl_init();  

		curl_setopt($ch,CURLOPT_URL,$url.'/index.php?nama='.$nama.'&password='.$password.'&serial='.trim($serial));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$output=curl_exec($ch);

		curl_close($ch);

		$array= array();
		if($output == 'error')
		{
			$array['value'] = false;

		}else
		{
			$content='empty';
			$fp = fopen($output.'.key',"wb");
			fwrite($fp,$content);
			fclose($fp);
			$array['value'] = true;
		}
		echo json_encode($array);
	}
	

} else {
	exit('No direct access allowed.');
}