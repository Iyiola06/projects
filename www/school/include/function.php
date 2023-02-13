<?php
function executeThis($dbconn,$post){
		$statement = $dbconn->prepare("INSERT INTO teachers VALUES(NULL,:fnm,:age,:qn,:sd,:cs,:sb,NOW(),NOW() )");
	$data = array(
		":fnm" =>$post['fullname'],
		":age" =>$post['age'],
		":qn" => $post['qualification'],
		":sd"=>$post['department'],
		":cs"=>$post['courses'],
		":sb" => $post['subject'],

	);
	$statement->execute($data);
	
}


function createStudents($dbconn,$post){
	$statement = $dbconn->prepare("INSERT INTO students VALUES(NULL,:sn,:sa,:sc,:sd,:cs,NOW(),NOW() )");
		
		$data = array(
			":sn"=>$post['fullname'],
			":sa"=>$post['age'],
			":sc"=>$post['class'],
			":sd"=>$post['department'],
			":cs"=>$post['courses']
		);
		
		$statement->execute($data);
}


function addDepartments($dbconn,$post){
		$statement = $dbconn->prepare("INSERT INTO department VALUES(NULL,:dn,:cb,NOW(),NOW() )");
		$statement->bindParam(":dn",$post['department']);
		$statement->bindParam(":cb",$_SESSION['admin_id']);
		$statement->execute();
	
}

function addCourses($dbconn,$post){
			$stmt = $dbconn->prepare("INSERT INTO courses VALUES(NULL,:cn,:cb,NOW(),NOW() )");
	
	$stmt->bindParam(":cn",$post['courses']);
	$stmt->bindParam(":cb",$_SESSION['admin_id']);
	$stmt->execute();
	
	header("Location:add_courses.php");
	
}



