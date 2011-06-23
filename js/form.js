function showOpt(id){
    if(document.absence.type[0].checked == true){
	document.getElementById(id).style.display = 'block';
    //}else{
	//not needed
    }
}

function validate(){
    if(document.absence.type[3].checked == true){
	return valid;
    }
    if(document.absence.lesson[7].checked == true){
	for(i=0;i<document.absence.lesson[i].checked;i++){
	    alert("You cannot select these because you selected "+document.absence.lesson[7].name);
	    return invalid;
	}
    }
}