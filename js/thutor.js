function dialogYesNo(text)
{
	var retVal = confirm(text);
	if( retVal == true ){
      return true;
	}else{
      return false;
	}
}
