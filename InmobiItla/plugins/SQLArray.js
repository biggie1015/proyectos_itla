	// ***************************//
	// SQL Array                  //
	// By Pablo Ferreira          //
	// 19/04/2016				  //
	// ***************************//
	var SQLCache = new Array();
	function ArrayQuery(sql) {
		if (!sql || sql == "") {
			return "NO QUERIES WHERE DONE."
		}
		var affectedRows = 0;
		var COUNT = 0;
		var querys = sql.split(';')
		var condition = "";
		for (var i = querys.length - 1; i >= 0; i--) {
			var querycorrection;

			if (querys[i].charAt(0) == " ") {
				querycorrection = querys[i].replace(querys[i].charAt(0),"")
			} else {
				querycorrection = querys[i];
			}
			

			if (querycorrection.split(' ')[0].toUpperCase() == "SELECT") {
				var array = querycorrection.split(' ')[3];
				try {
			    condition = querycorrection.split(' ')[4];
				} catch(e) {

				}
			    return ArrayExecution(querycorrection)
			}

			var shot = true;
			

			ArrayExecution(querycorrection);
			shot = true;

			if (shot) {
			var command = querycorrection.split(' ')[0].toUpperCase();
			} else {
			var command = "FALSE";
			}
			switch(command) { 
				case "INSERT" : 
							SQLCache.push(""+querycorrection+"");

				return "ROWS INSERT SUCCESFULL. 1 ROWS WHERE AFECTED";
				break
				case "UPDATE" : 
							SQLCache.push(""+querycorrection+"");

				return "ROWS WHERE UPDATED. "+ affectedRows +" ROWS WHERE AFECTED";
				break
				case "DELETE" : 
											SQLCache.push(""+querycorrection+"");

				return "ROWS WHERE DELETED. "+ affectedRows +" ROWS WHERE AFECTED";
				break
				case "CREATE" : 
				var ArrayD = querycorrection.split(' ')[2];
				if (!ArrayD) {return "QUERY COUDN'T BE DONE. 0 WHERE AFECTED"}
				SQLCache.push(""+querycorrection+"");
				return ""+ ArrayD + " WAS CREATED SUCCESFULLY. "+ affectedRows +" ROWS WHERE AFECTED";
				break
				case "ALTER" : 
				var ArrayD = querycorrection.split(' ')[2];
				if (!ArrayD) {return "QUERY COUDN'T BE DONE. 0 WHERE AFECTED"}
				SQLCache.push(""+querycorrection+"");
				return ""+ ArrayD + " WAS ALTERED SUCCESFULLY. "+ affectedRows +" ROWS WHERE AFECTED";
				break
				case "FALSE" : 
				return "QUERY COUDN'T BE DONE. 0 WHERE AFECTED";
				break
				default : 
				return "INVALID SQLARRAY COMMAND.";
			}

		};

		function ArrayExecution(query) {
			var command = query.split(' ')[0].toUpperCase();
			var parameter = query.split(' ')[1];

			var regExp = /\(([^)]+)\)/g;
			var VALUES = query.match(regExp);

			switch(command) {
			     case "INSERT": 
			     console.log("EXECUTING : " + command);
			     		var newRow = {};
			      		var array = query.split(' ')[2];
			      		if (array == "SQLCache") {return "No posees permisos para esto."};
						var valueDefinitions = VALUES[0].split(',')
						var values = VALUES[1].split(',')
						if (values.length == valueDefinitions.length){ 
				      	 	for (var i = valueDefinitions.length - 1; i >= 0; i--) 
				      	 	{
					      	 	var valname = valueDefinitions[i].replace("(","").replace(")","").replace(" ","");
					      	 	var val = values[i].replace("(","").replace(")","").replace(" ","");
					      	 		if(valname.split(':')[1]) {
							      	 	switch(valname.split(':')[1]) { 
					      					case "AI" :
								      	 		var val = this[array].length + 1;
								      	 	break;
							      	 	}
							      	 valname = valname.replace(":"+valname.split(':')[1],"")
						      	 	} 
						      	 	
					      	 	newRow[valname] = val;
				      	 	};
				    	this[array].push(newRow)
				    	console.log(this[array])

				      	 } else {
				      	 	return "SYNTAX ERROR : Invalid Parameters.";
				      	 }
			        break;
			     case "SELECT": 
			     //console.log("EXECUTING : " + command);
			     var result = new Array;
			     var array = query.split(' ')[3];
			     
			     for (var i = this[array].length - 1; i >= 0; i--) {
			     	
			     	if (parameter == "*") {
			      		if (condition) {
			      			var condition = query.split(' ')[4].toUpperCase();
			      			if (condition == "WHERE") {
			      				var firstconditioner = query.split(' ')[5];
			      				var operand = query.split(' ')[6];
			      				var secondconditioner = query.split(' ')[7];
			      				switch(operand) { 
			      					case "=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] == secondconditioner) {
				      							result.push(this[array][i]);
				      							affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      				    case "LIKE" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key].search(secondconditioner) > 0) {
				      							console.log(this[array][i][key].search(secondconditioner))
				      							result.push(this[array][i]);
				      							affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      				}
			      			}
			      		} else {
			      			result.push(this[array][i]);
			      			affectedRows++;

			      		}

			     	} else {

			      		if (condition) {
			      			if (condition == "WHERE") {
			      				var firstconditioner = query.split(' ')[5];
			      				var operand = query.split(' ')[6];
			      				var secondconditioner = query.split(' ')[7];
			      				switch(operand) { 
			      					case "=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] == secondconditioner) {
				      							result.push(this[array][i][parameter]);
				      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      				    case "LIKE" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key].search(secondconditioner) > 0) {
				      							console.log(this[array][i][key].search(secondconditioner));
				      									result.push(this[array][i][parameter]);
				      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case "<" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] < secondconditioner) {
				      							result.push(this[array][i][parameter]);
				      							affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case ">" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] > secondconditioner) {
				      							result.push(this[array][i][parameter]);
				      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case "!=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] != secondconditioner) {
				      							result.push(this[array][i][parameter]);
				      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case ">=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] >= secondconditioner) {
				      							result.push(this[array][i][parameter]);
				      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case "<=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] <= secondconditioner) {
				      							result.push(this[array][i][parameter]);
				      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      				}
			      			}
			      		} else {
			      			result.push(this[array][i][parameter]);
			      					affectedRows++;

			      		}
			     	}
			     }
			     //console.log(result);
			     return result;
			     break;
			     case "UPDATE": 
			     console.log("EXECUTING : " + command);
			     var array = query.split(' ')[1];
			     			      		if (array == "SQLCache") {return "No posees permisos para esto."};

			     var condition = query.split(' ')[6].toUpperCase();
			     var valName = query.split(' ')[3];
			     var newVal = query.split(' ')[5];
			     for (var i = this[array].length - 1; i >= 0; i--) {
			      		if (condition) {
			      			if (condition == "WHERE") {
			      				var firstconditioner = query.split(' ')[7];
			      				var operand = query.split(' ')[8];
			      				var secondconditioner = query.split(' ')[9];
			      				switch(operand) { 
			      					case "=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] == secondconditioner) {
			      							this[array][i][valName] = newVal;
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case ">" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] > secondconditioner) {
			      							this[array][i][valName] = newVal;
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			  
			      					case "<" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] < secondconditioner) {
			      							this[array][i][valName] = newVal;
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case "!=" :
									for (key in this[array][i]) {
										if (firstconditioner != key) {
				      						if (this[array][i][key] == secondconditioner) {
			      							this[array][i][valName] = newVal;
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case ">=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] >= secondconditioner) {
			      							this[array][i][valName] = newVal;
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case "<=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] <= secondconditioner) {
			      							this[array][i][valName] = newVal;
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      				}
			      			}
			      		} else {
			      			this[array][i][valName] = newVal;
			      					affectedRows++;

			      		}

			     }
			     break;
			     case "DELETE": 
			     console.log("EXECUTING : " + command);
			     var array = query.split(' ')[2];
			     			      		if (array == "SQLCache") {return "No posees permisos para esto."};

			     var condition = query.split(' ')[3].toUpperCase();
			     for (var i = this[array].length - 1; i >= 0; i--) {
			      		if (condition) {
			      			if (condition == "WHERE") {
			      				var firstconditioner = query.split(' ')[4];
			      				var operand = query.split(' ')[5];
			      				var secondconditioner = query.split(' ')[6];
			      				switch(operand) { 
			      					case "=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] == secondconditioner) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case "LIKE" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key].search(secondconditioner) > 0) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      					case ">" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] > secondconditioner) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case "<" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] < secondconditioner) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case "!=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] != secondconditioner) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case ">=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] >= secondconditioner) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case "<=" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] <= secondconditioner) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;			      					
			      					case "EQUAL" :
									for (key in this[array][i]) {
										if (firstconditioner == key) {
				      						if (this[array][i][key] == secondconditioner) {
			      							this[array].splice(i, 1);
			      									affectedRows++;

				      						} 
				      					} 
									}
			      					break;
			      				}
			      			}
			      		} else {
			      			this[array].splice(i, 1);
			      					affectedRows++;

			      		}

			     }
			     break;
			     case "CREATE":
			     var array = query.split(' ')[2];
			     if (array == "SQLCache") {return "No posees permisos para esto."};

			     window[array] = new Array;
			     break;
			     case "ALTER" :
			     console.log("EXECUTING : " + command);
			     var array = query.split(' ')[2];
			     			      		if (array == "SQLCache") {return "No posees permisos para esto."};

			     var action = query.split(' ')[3].toUpperCase();
			     var valName = query.split(' ')[4];
			     for (var i = this[array].length - 1; i >= 0; i--) {
			      		switch(action) { 
			      				case "DROP" :
									for (key in this[array][i]) {
										if (valName == key) {
				      							delete this[array][i][valName];
				      							affectedRows++;

				      					} 
									}
			      				break;
			      				case "ADD" : 
				      						this[array][i][valName] = "";
			      				break;
			      				case "MODIFY" : 
			      				for (key in this[array][i]) {
									if (valName == key) {
			      					var newVal = query.split(' ')[5];
				      				this[array][i][newVal] = this[array][i][valName];
									delete this[array][i][valName];
											affectedRows++;

									}
								}
			      				break;
			      			}
			     }
			     break;
			 } 
		}
	}

function storedProcedure(file) {

	var myJsonString = JSON.stringify(Questions);
    var JSONData = JSON.parse(myJsonString);
	
	        var parametros = {
                "content" : JSONData,
        };
  				$.ajax({
                data:  parametros,
                url:   './createForm.php',
                type:  'post',
                success:  function (response) 
                {
                }

})

/* var jqxhr = $.getJSON( file, function( json ) {
 var val;

	  $.each( json, function( key, val ) {

	    console.log( key + " " + val );

	  });
}) 
console.log(jqxhr);

return jqxhr;
*/
}
