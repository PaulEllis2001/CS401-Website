function getCookie(name){
    var nameEQ = name + "=";
   var ca = document.cookie.split(';');
   for (var i = 0; i < ca.length; i++){
        var c = ca[i];
      c = c.trim();
      if(c.indexOf(nameEQ) == 0) return c;
   }
   return null;

}
