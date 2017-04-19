
var Routine = {};
var StepCount = 0;

function PlayRoutine(RRoutine) { 
var T = 1;
for (var Id in RRoutine) { 
	setTimeout(function(b) { 
		console.log(b.Type);
		$(b.Selector).focus() 
		switch(b.Type) {
			case "INPUT" :
				Notify("information", b.Step+'. Llena el Campo "' + b.PlaceHolder + '".')
			break;
			case "BUTTON" :
				Notify("information", b.Step+'. Haz click en "' + b.PlaceHolder + '".')
			break;
			case "SELECT" :
				Notify("information", b.Step+'. Elige una opcion en "' + b.PlaceHolder + '".')
			break;
		}
	}, 1000*T++, RRoutine[Id]);
}
setTimeout(function() { 				
	Notify("success", '<button id="RBOINATE" onclick="PlayRoutine()"> Repetir rutina </button>', 1000*T)
}, 1000*T++)
return T;
//Routine = {};
}
        $("input, select, button").on("click", function(e) {
          e.preventDefault();
          var selector = $(this)
            .parents()
            .map(function() { return this.tagName; })
            .get()
            .reverse()
            .concat([this.nodeName])
            .join(">");

          var id = $(this).attr("name");
          if (id) { 
            selector += "[name='"+ id + "']";
          }
		
		  var rid = $(this).attr("id");
          if (rid) { 
            selector += "#"+ rid;
          } 

          if(rid == "RBOINATE") { 
          	return
          }
          
          Routine[StepCount++] = {"Step" : StepCount, "Selector" : selector, "isDone" : false, "Type": this.nodeName, "PlaceHolder" :  ($(this).attr("placeholder") || $(this).html()) };         	
          
      });