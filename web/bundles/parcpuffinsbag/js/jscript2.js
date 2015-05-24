function create_champ(i) {

	var i2 = i + 1, champ=document.getElementById('leschamps_'+i);
	var tablenom=['Action','Annee','Lieudit','Bague','Colonie','Secteur','Terrier'],
		tablenom1=['action','date','lieudit','bague','colonie','secteur','terrier'];
		
		//alert(champ);
	if(i>1)
	{
		var i3=i-1,
			img=document.getElementById('ferm'+i3);
		img.parentNode.removeChild(img);
	}
	var inputs=document.getElementsByTagName('span');

	var form='<br/><select onchange="change(this.value,this.id,'+i+')"  name="new_champ_'+i+'" id="new_champ_'+i+'">',
		form2, act1=true;
		
	for(var j=0; j<7; j++)
	{
		var act=true;
		
		for(var k=0; k<i; k++)
		{
			if(tablenom1[j]==inputs[k].childNodes[1].value || tablenom1[j]==inputs[0].childNodes[3].value) act=false;
		}
		if(act==true && act1==true)
		{
			form+='<option value="'+tablenom1[j]+'" selected>'+tablenom[j]+'</option>';
			act1=false;
		}
		else
		{
			form+='<option value="'+tablenom1[j]+'">'+tablenom[j]+'</option>';
		}
	}
	form+='</select>';
	champ.innerHTML = form;
	
	if(document.getElementById('new_champ_'+i).value=='action')
	{
		form+='<select name="champ'+i+'" id="action"> <option value="B">B</option><option value="C">C</option><option value="R">R</option><option value=""> </option></select>';
	}
	else if(document.getElementById('new_champ_'+i).value=='date')
	{
		form+='<select name="champ'+i+'" id="date">';
		for (var j=2023; j>1982; j--)
		{
			if(j==2014){
				form += '<option value="'+j+'" selected>'+j+'</option>';
			}
			else{
				form += '<option value="'+j+'">'+j+'</option>';
			}
		}
		form += '</select>';
	}
	else
	{
		form+='<input type="text" name="champ'+i+'" id="champ_'+i+'" />';
	}
	
	form+='<img src="../web/bundles/parcpuffinsbag/images/icone_fermer.png" alt="" id="ferm'+i+'" onclick="supprimer(this.id,'+i+')" class="icone"/>';
	
	
	form+= (i <= 8) ? '<span id="leschamps_'+i2+'"> <br/> <a href="javascript:create_champ('+i2+')" class="ajout">Ajouter un champ</a></span>' : '';
	
	//form2+='<script type="text/javascript">; </script>'
	//alert(champ.parentNode);
	//champ.parentNode.innerHTML+=form2;
	champ.innerHTML = form;
}

function change(select,id,i) {

	var form='';
		new_elmt=document.createElement('div'),
		inp=document.getElementById(id).parentNode;
		if(i==0) {k=5;}else{k=2}
	var	old_elmt=inp.childNodes[k];
		new_elmt.style.display='inline-block';
		//alert(old_elmt);
		
	if(select=='action')
	{
		form='<select name="champ'+i+'" id="action"> <option value="B">B</option><option value="C">C</option><option value="R">R</option><option value=""></option></select>';
	}
	else if(select=='date')
	{
		form='<select name="champ'+i+'" id="date">';
		for (var j=2023; j>1982; j--)
		{
			if(j==2014){
				form += '<option value="'+j+'" selected>'+j+'</option>';}
			else{form += '<option value="'+j+'">'+j+'</option>';}
		}
		form += '</select>';
	}
	else
	{
			form='<input type="text" name="champ'+i+'" id="champ_'+i+'" />';
	}
	
	//alert(inp);
	inp.replaceChild(new_elmt,old_elmt);
	inp.childNodes[k].innerHTML=form;
}

function supprimer(id,i){

	var a=document.getElementById(id).parentNode,
		form="", p=i-1;
	a.parentNode.removeChild(a);
	
	var champ=document.getElementById('leschamps_'+p);
	
	if(i>1) {form='<img src="../web/bundles/parcpuffinsbag/images/icone_fermer.png" alt="" id="ferm'+p+'" onclick="supprimer(this.id)" />';}
	form+='<span id="leschamps_'+i+'"> <br/> <a href="javascript:create_champ('+i+')" class="ajout">Ajouter un champ</a></span>';
	
	champ.innerHTML+=form;
}
