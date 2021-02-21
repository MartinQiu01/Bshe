<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>仓储环境监控历史</title>
</head>
<style type="text/css">
.wrapper {width: 1000px;margin: 20px auto;}
h2 {text-align: center;}
td {text-align: center;}
</style>
<body>
	<div class="wrapper">
		<h2>仓储环境监控历史</h2>

		<table width="960" border="1">
			<tr>
				<th>ID</th>
				<th>type</th>
				<th>value</th>
				<th>时间戳</th>
			</tr>

			<?php
                // 1.导入配置文件
                define("HOST","120.78.170.20");  
				define("USER","root");  
				define("PASS","123456");
				define("DBNAME","mydatabase");
                // 2. 连接mysql
                $link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
                // 选择数据库
                mysql_select_db(DBNAME,$link);
         
				
				// 编码设置
                mysql_set_charset('utf8',$link);

				// 3. 从DBNAME中查询到mydatabase数据库，返回数据库结果集,并按照addtime降序排列  
				$sql = 'select * from tb_data order by id desc';
                // 结果集
                $result = mysql_query($sql,$link);
                

				// 解析结果集,$row为历史所有数据，$newsNum为历史数目
				$newsNum=mysql_num_rows($result);  

				for($i=0; $i<$newsNum; $i++){
					$row = mysql_fetch_assoc($result);
					echo "<tr>";
					echo "<td>{$row['id']}</td>";
					echo "<td>{$row['type']}</td>";
					echo "<td>{$row['value']}</td>";
					echo "<td>{$row['storeTime']}</td>";
					echo "</tr>";
				}
				// 5. 释放结果集
				mysql_free_result($result);
				mysql_close($link);
			?>
		</table>
	</div>
	
</body>
</html>