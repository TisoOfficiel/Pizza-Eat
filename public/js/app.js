function dropdownmenu(){
    document.getElementById("infoUserDropdown").style.display = "flex";

};

document.addEventListener('click', function(event) {
    var ignoreClickOnMeElement = document.getElementById('infoUser');
    var ignoreClickOnMeElement1 =document.getElementById('infoUserDropdown');
    var isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    var isClickInsideElement1 = ignoreClickOnMeElement1.contains(event.target);
    if (!isClickInsideElement && !isClickInsideElement1 ) {
//         //Do something click is outside specified element
        document.getElementById("infoUserDropdown").style.display = "none";
    }
});

function dashboardMenureduce(){
        
    if(document.getElementById('dashboardMenu').style.width =="auto"){
        var els = document.querySelectorAll(".dashboardMenuLinkText");
        for (var x = 0; x < els.length; x++)
        els[x].style.display = 'flex';
        document.getElementById('dashboardMenu').style.width="20%"
    }else{
        var els = document.querySelectorAll(".dashboardMenuLinkText");
        for (var x = 0; x < els.length; x++)
        els[x].style.display = 'none';
        document.getElementById('dashboardMenu').style.width = "auto";
    }
}


function openModalAddpizza(){
    document.getElementById('modalPizza').style.display = 'flex';
    document.getElementById('containerAddModalPizza').style.display = 'flex';
    document.getElementById('containerEditModalPizza').style.display = 'none';

}

function openModalEditpizza(id,nom,description,prix){

    document.getElementById('NomPizzaEdit').value = nom;
    document.getElementById('descriptionPizzEdit').value = description;
    document.getElementById('PrixPizzaEdit').value = prix;
    
    document.getElementById('FormEditModalPizza').action ="/admin/modificationPizza/edit/"+id;


    document.getElementById('modalPizza').style.display = 'flex';
    document.getElementById('containerAddModalPizza').style.display = 'none';
    document.getElementById('containerEditModalPizza').style.display = 'flex';
}
function closeModalpizza(){
    document.getElementById('modalPizza').style.display = 'none';
}
function openModalAddUser(){
    document.getElementById('modalUserListe').style.display = 'flex';
}
function closeModalUserListeadd(){
    document.getElementById('modalUserListe').style.display = 'none';
}




        
function openNav() {
   
    document.getElementById("mySidenav").style.transform="translateX(0px)";
    document.getElementById("mySidenav").style.opacity = "1";
    document.getElementById("containersidebar").style.visibility = "visible";
   
 }
 
 
 function closeNav() {
     document.getElementById("mySidenav").style.transform="translateX(-250px)";
     document.getElementById("mySidenav").style.opacity = "0";
     document.getElementById("containersidebar").style.visibility = "hidden";
 
 }


function visiblemdplogin(){
  
    if(document.getElementById("mdpLogin").type =="password"){
        document.getElementById("mdpLogin").type="text";
        document.getElementById("passwordNotVisble").innerHTML = "visibility";
        
    }
    else{
        document.getElementById("passwordNotVisble").innerHTML = "visibility_off";
        document.getElementById("mdpLogin").type="password";
    }

   
}

function visiblemdpregister(){
    if(document.getElementById("mdpRegister").type =="password"){
        document.getElementById("mdpRegister").type="text";
        document.getElementById("passwordNotVisble").innerHTML = "visibility";
    }
    else{
        document.getElementById("mdpRegister").type="password";
        document.getElementById("passwordNotVisble").innerHTML = "visibility_off";
    }
}


function closePanier(){
    
    document.getElementById("panierContainer").style.display="none";
}

function openPanier(){
    document.getElementById("panierContainer").style.display="block";
}

function closeModalnewmdp(){
    document.getElementById("modalBgChangementmdp").style.display="none";
}
function openModalnewmdp(){
    
    document.getElementById("modalBgChangementmdp").style.display="flex";
    
}

function openremoveCountp(){
    document.getElementById("modalBgRemoveCount").style.display="flex";
}
function closeremoveCount(){
    document.getElementById("modalBgRemoveCount").style.display="none";
}
    

function opendropdownmenuserliste(id){
    var element = document.getElementById(id);
        if (element.style.display == "none") {
            element.style.display = "flex";
        } else {
            element.style.display = "none";
        }
}
    
function show(id){
    if(document.getElementById(id).style.display == "flex"){
        document.getElementById(id).style.display = "none";
    }else{

        document.getElementById(id).style.display = "flex";
    }
}