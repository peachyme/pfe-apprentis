
$(function () {

	'use strict';

// Masquer le PlaceHolder quand la zone reçoie le focus

		$('[placeholder]').focus(function () {
			$(this).attr('data-text', $(this).attr('placeholder'));

			$(this).attr('placeholder', '');

		}).blur(function () {

			$(this).attr('placeholder', $(this).attr('data-text'));

		});



//Afficher le mot de passe en cliquant sur l'icone de la zone pw1

var input_pwd1=$('#pwd1'); 	//#pwd1 fait réfèrence à l'element HTML ayant id="pwd1"
		var span_oeil1=$('.oeil1'); 	//.oeil1 fait rèfèrence à l'element HTML ayant class="oeil1"
		
		$(span_oeil1).click(
		
			function(){
			
				if($(input_pwd1).attr('type')==='password'){
					$(input_pwd1).attr('type','text');
					$(this).attr('class','show-pwd1 fa fa-eye-slash fa-2x oeil1');
					//this : l'element ayant declanché l'évenement click
				}
				else{
					$(input_pwd1).attr('type','password');
					$(this).attr('class','show-pwd1 fa fa-eye fa-2x oeil1');				
				}
			}
			
		);
    
//Afficher le mot de passe en cliquant sur l'icone de la zone pw2
  
    var input_pwd2=$('#pwd2'); 	//#pwd2 fait réfèrence à l'element HTML ayant id="pwd2"
		var span_oeil2=$('.oeil2'); 	//.oeil2 fait rèfèrence à l'element HTML ayant class="oeil2"
		
		$(span_oeil2).click(
		
			function(){
			
				if($(input_pwd2).attr('type')==='password'){
					$(input_pwd2).attr('type','text');
					$(this).attr('class','show-pwd2 fa fa-eye-slash fa-2x oeil2');
					//this : l'element ayant declanché l'évenement click
				}
				else{
					$(input_pwd2).attr('type','password');
					$(this).attr('class','show-pwd2 fa fa-eye fa-2x oeil2');				
				}
			}
			
		);

//Afficher le mot de passe en cliquant sur l'icone de la zone oldpwd

var input_oldpwd=$('#oldpwd'); 	//#oldpwd fait réfèrence à l'element HTML ayant id="oldpwd"
		var span_oeil3=$('.oeil3'); 	//.oeil3 fait rèfèrence à l'element HTML ayant class="oeil3"
		
		$(span_oeil3).click(
		
			function(){
			
				if($(input_oldpwd).attr('type')==='password'){
					$(input_oldpwd).attr('type','text');
					$(this).attr('class','show-oldpwd fa fa-eye-slash fa-2x oeil3');
					//this : l'element ayant declanché l'évenement click
				}
				else{
					$(input_oldpwd).attr('type','password');
					$(this).attr('class','show-oldpwd fa fa-eye fa-2x oeil3');				
				}
			}
			
		);
    
//Afficher le mot de passe en cliquant sur l'icone de la zone newpwd

    var input_newpwd=$('#newpwd'); 	//#newpwd fait réfèrence à l'element HTML ayant id="newpwd"
		var span_oeil4=$('.oeil4'); 	//.oeil4 fait rèfèrence à l'element HTML ayant class="oeil4"
		
		$(span_oeil4).click(
		
			function(){
			
				if($(input_newpwd).attr('type')==='password'){
					$(input_newpwd).attr('type','text');
					$(this).attr('class','show-newpwd fa fa-eye-slash fa-2x oeil4');
					//this : l'element ayant declanché l'évenement click
				}
				else{
					$(input_newpwd).attr('type','password');
					$(this).attr('class','show-newpwd fa fa-eye fa-2x oeil4');				
				}
			}
			
		);
// Afficher la boite du dialogue confirm
		$('.confirm').click(function () {
			return confirm("Etes Vous sûr?")
		});
});