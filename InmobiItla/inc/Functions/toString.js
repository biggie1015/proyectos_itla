var CommonToString = function(Parse) {
	Parse = Parse || false;
	if(Parse) {
		var Params = Parse.split("");
			var Type 	    = Params[0];
			var Count 		= Params[1];
				
				switch(Type) {
					case "D" : 
						  width = parseInt(Count);
						  z = 0
						  n = this + "";
						  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
					break;
					case "N" :
					var FullNum = this + "";
					var LastDecimal = (FullNum.substr(FullNum.length - Count)).toString("D2");
					var FullNum = FullNum.substring(0, FullNum.length-Count) 
					return FullNum.split( /(?=(?:...)*$)/ ).join(",")+"."+LastDecimal+"";
					break;
					default :
					return ""+this+""; 
					break
				}
	} else {
		return ""+this+"";
	}
};
String.prototype.toString = CommonToString;
Number.prototype.toString = CommonToString;
Function.prototype.toString = CommonToString;


Date.prototype.toString = function(Parse) {
	Parse = Parse || "dd/MM/yyyy";
	if(Parse) {
		var thisDate = this;
		var Replaces = {
			"dd" : thisDate.getDate().toString("D2"),
			"MM" : (thisDate.getMonth()+1).toString("D2"),
			"yyyy" : thisDate.getFullYear().toString(),
			"yy" : thisDate.getYear().toString().substr(thisDate.getYear().toString().length - 2),
			"hh" : (thisDate.getHours() > 12 ? thisDate.getHours()-12 : thisDate.getHours()).toString("D2"),
			"HH" : thisDate.getHours().toString("D2"),
			"mm" :  thisDate.getMinutes().toString("D2"),
			"ss" :  thisDate.getSeconds().toString("D2"),
			"ms" :  thisDate.getMilliseconds().toString("D2")
		}

		for (var R in Replaces) {
				Parse = Parse.split(R).join(Replaces[R]);
		}
		return Parse;
	} else {
		return ""+this+"";
	}
};