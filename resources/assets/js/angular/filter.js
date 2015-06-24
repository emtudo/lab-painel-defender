function float2moeda(num) {
	x = 0;
	if(num<0) {
	  num = Math.abs(num);
	  x = 1;
	}
	if(isNaN(num)) num = "0";
		cents = Math.floor((num*100+0.5)%100);

	num = Math.floor((num*100+0.5)/100).toString();

	if(cents < 10)
		cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
	ret = num + ',' + cents;
	if (x == 1)
		ret = ' - ' + ret;
	return ret;
}
String.prototype.replaceAll = function(de, para){
    var str = this;
    var pos = str.indexOf(de);
    while (pos > -1){
		str = str.replace(de, para);
		pos = str.indexOf(de);
	}
    return (str);
}

app.filter('comma2decimal', [
function() { // should be altered to suit your needs
    return function(input) {
    	var ret=(input)?input.toString().replaceAll(",","").trim():'0.00';
//    	var ret=(input)?input.toString().replace(",","").trim().replace(".",","):'0,00';
//    	var ret=(input)?input.replace(',','').format(2, ",", ".").replace(',,',',').replace(',.','.'):'0,00';
    	 return float2moeda(ret);
    };
}]);


/*
app.filter('comma2decimal', [
function() { // should be altered to suit your needs
    return function(input) {
    var ret=(input)?input.toString().trim().replace(".",","):'0,00';
    return ret;
        //return parseFloat(ret);
    };
}]);*/



app.filter('dateMysqlToBR', function()
{
	return function(input)
	{
		if(input == null){
			return "";
		}
  		//var _date = $filter('date')(new Date(input),'dd/MM/yyyy - HH:mm:ss');
  		var _date=input.split("/").reverse().toString().replaceAll(',','-');
		return _date.toUpperCase();
		//return input;
	};
});

app.filter('MysqlToDateBR', function()
{
	return function(input)
	{
		if(input == null){
			return "";
		}
  		//var _date = $filter('date')(new Date(input),'dd/MM/yyyy - HH:mm:ss');
  		var _date=input.split("-").reverse().toString().replaceAll(',','/');
		return _date.toUpperCase();
		//return input;
	};
});

app.filter('dateTimeMysqlToBR', function()
{
	return function(input)
	{
		if(input == null){
			return "";
		}
  		//var _date = $filter('date')(new Date(input),'dd/MM/yyyy - HH:mm:ss');
  		var _datetime=input.split(' ');
  		var _date=_datetime[0].split("-").reverse().toString().replaceAll(',','/');
		return _date.toUpperCase()+' '+_datetime[1];
		//return input;
	};
});

app.filter('removeTime', function()
{
	return function(input)
	{
		if(input == null){
			return "";j		}
		return input.substring(0,10);
	};
});

app.filter('person', function()
{
	return function(input)
	{
		if(input == null){
			return "";
		}
		if(input == '2' || input =='pf'){
			return "Física";
		}
		if(input == '1' || input =='pj'){
			return "Jurídica";
		}
	};
});

app.filter('simNao', function()
{
	return function(input)
	{
		if(input == null){
			return "";
		}
		if(input == 'Sim' || input =='sim'){
			return "Sim";
		}
		if(input == 'Nao' || input =='Nao'){
			return "Não";
		}
	};
});

app.filter('sex', function()
{
	return function(input)
	{
		if(input == null){
			return "";
		}
		if(input == 'm'){
			return "Masculino";
		}
		if(input == 'f'){
			return "Feminino";
		}
	};
});

app.filter('removeDate', function()
{
	return function(input)
	{
		if(input == null){
			return "";
		}
		return input.substring(11,16);
	};
});
