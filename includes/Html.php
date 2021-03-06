<?php

class Html
{

	public function container($rowData=array(),$isFluid='no')
	{
		$class='container';

		if($isFluid=='yes')
		{
			$class='container-fluid';			
		}

		$content='';

		$attr='';

		$moreClass='';

		$before='';

		$after='';

		if(isset($rowData['before']))
		{
			$before="\r\n".$rowData['before']."\r\n";
		}

		if(isset($rowData['after']))
		{
			$after="\r\n".$rowData['after']."\r\n";
		}

		if(isset($rowData['class']))
		{
			$class=$rowData['class'];
		}

		if(isset($rowData['moreclass']))
		{
			$moreClass=' '.$rowData['moreclass'];
		}

		if(isset($rowData['content']))
		{
			$content=$rowData['content'];
		}

		if(isset($rowData['attr']))
		{
			$attr=$rowData['attr'];
		}


		$resultData="\r\n".$before.'<div class="'.$class.$moreClass.'" '.$attr.'>'.$content.'</div>'.$after."\r\n";

		return $resultData;
	}	


	public function row($rowData=array())
	{
		$class='row';

		$content='';

		$attr='';

		$moreClass='';

		$before='';

		$after='';

		if(isset($rowData['before']))
		{
			$before="\r\n".$rowData['before']."\r\n";
		}

		if(isset($rowData['after']))
		{
			$after="\r\n".$rowData['after']."\r\n";
		}

		if(isset($rowData['class']))
		{
			$class=$rowData['class'];
		}
		
		if(isset($rowData['moreclass']))
		{
			$moreClass=' '.$rowData['moreclass'];
		}

		if(isset($rowData['content']))
		{
			$content=$rowData['content'];
		}

		if(isset($rowData['attr']))
		{
			$attr=$rowData['attr'];
		}


		$resultData="\r\n".$before.'<div class="'.$class.$moreClass.'" '.$attr.'>'.$content.'</div>'.$after."\r\n";

		return $resultData;
	}

	public function col($inputData=array())
	{
		$class='col-lg-12 col-md-12 col-sm-12 col-xs-12';

		$content='';

		$attr='';

		$moreClass='';

		$before='';

		$after='';

		if(isset($inputData['before']))
		{
			$before="\r\n".$inputData['before']."\r\n";
		}

		if(isset($inputData['after']))
		{
			$after="\r\n".$inputData['after']."\r\n";
		}

		if(isset($inputData['class']))
		{
			$class=$inputData['class'];
		}
		
		if(isset($inputData['moreclass']))
		{
			$moreClass=' '.$inputData['moreclass'];
		}

		if(isset($inputData['content']))
		{
			$content=$inputData['content'];
		}

		if(isset($inputData['attr']))
		{
			$attr=$inputData['attr'];
		}


		$resultData="\r\n".$before.'<div class="'.$class.$moreClass.'" '.$attr.'>'.$content.'</div>'.$after."\r\n";

		return $resultData;
	}





}

?>