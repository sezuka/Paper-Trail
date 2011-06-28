function OptMode(id){
    if(document.absence.type[0].checked == true || document.absence.type[1].checked == true || document.absence.type[2].checked == true){
	document.getElementById(id).style.display = 'block';
    }else if(document.absence.type[3].checked == true){
	document.getElementById(id).style.display = 'none';
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