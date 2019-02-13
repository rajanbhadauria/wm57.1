    var h = window.innerHeight;

    var w = window.innerWidth;

    document.getElementById('heightSet').style.height= (h-133) +"px";
    var doutContainer = h-133;

    setTimeout(function(){ 
      document.getElementById('loginDiv').style.display = "block";
    }, 500);
    
    if(w<767){
        if(430>doutContainer){
            //document.getElementById('footer').style.position= "relative";
        }
    } 