
var calendarObjForForm = new DHTMLSuite.calendar({minuteDropDownInterval:5,numberOfRowsInHourDropDown:10,callbackFunctionOnDayClick:'getDateFromCalendar',isDragable:true,displayTimeBar:true}); 
calendarObjForForm.setCallbackFunctionOnClose('myOtherFunction');
var mydaFormat;
	
function myOtherFunction(inputArray)
{
   
}

function pickDate(buttonObj,inputObject,daFormat,languageCode)
{
        daFormat = (typeof daFormat === "undefined") ? "yyyy-mm-dd" : daFormat;
        languageCode = (typeof languageCode=== "undefined") ? "en" : languageCode;
        mydaFormat=daFormat;
        calendarObjForForm.setCalendarPositionByHTMLElement(inputObject,0,inputObject.offsetHeight+2);	// Position the calendar right below the form input
        calendarObjForForm.setInitialDateFromInput(inputObject,mydaFormat);	// Specify that the calendar should set it's initial date from the value of the input field.
        calendarObjForForm.addHtmlElementReference('myDate',inputObject);	// Adding a reference to this element so that I can pick it up in the getDateFromCalendar below(myInput is a unique key)
        if(calendarObjForForm.isVisible()){
                calendarObjForForm.hide();
        }else{
                calendarObjForForm.resetViewDisplayedMonth();	// This line resets the view back to the inital display, i.e. it displays the inital month and not the month it displayed the last time it was open.
                calendarObjForForm.display();
        }		
}	

/* inputArray is an associative array with the properties
year
month
day
hour
minute
calendarRef - Reference to the DHTMLSuite.calendar object.
*/
function getDateFromCalendar(inputArray)
{
        var references = calendarObjForForm.getHtmlElementReferences(); // Get back reference to form field.
        var strDelimit;
        //references.myDate.value = inputArray.year + '-' + inputArray.month + '-' + inputArray.day + ' ' + inputArray.hour + ':' + inputArray.minute;
        //calendarObjForForm.hide();	
        
        var positionArray=new Object();
        positionArray.y=mydaFormat.indexOf('yyyy');
        positionArray.m=mydaFormat.indexOf('mm');
        positionArray.d=mydaFormat.indexOf('dd');
        positionArray.h=mydaFormat.indexOf('hh');
        positionArray.i=mydaFormat.indexOf('ii');
        //positionArray.sDelimit=mydaFormat.indexOf('/'); //forward slash
        //positionArray.dDelimit=mydaFormat.indexOf('-'); //dot 
        
        if ((mydaFormat.split("/").length - 1)==2)
            strDelimit="/";
        else if ((mydaFormat.split(".").length - 1)==2)
            strDelimit=".";
        else strDelimit="-"; 
            

        if (positionArray.h==-1) {
            if (positionArray.y<positionArray.m && positionArray.m <positionArray.d) 
                references.myDate.value = inputArray.year + strDelimit + inputArray.month + strDelimit + inputArray.day; 
            else if (positionArray.y<positionArray.d && positionArray.d <positionArray.m) 
                references.myDate.value = inputArray.year + strDelimit + inputArray.day + strDelimit + inputArray.month; 
            else if (positionArray.d<positionArray.m && positionArray.m< positionArray.y)
               references.myDate.value = inputArray.day + strDelimit + inputArray.month + strDelimit + inputArray.year;
            else if (positionArray.m<positionArray.d && positionArray.d< positionArray.y)
                references.myDate.value = inputArray.month + strDelimit + inputArray.day + strDelimit + inputArray.year;
        }else{
            if (positionArray.y<positionArray.m && positionArray.m <positionArray.d) 
                references.myDate.value = inputArray.year + strDelimit + inputArray.month + strDelimit + inputArray.day + ' ' + inputArray.hour + ':' + inputArray.minute;
            else if (positionArray.y<positionArray.d && positionArray.d <positionArray.m) 
                references.myDate.value = inputArray.year + strDelimit + inputArray.day + strDelimit + inputArray.moth;
            else if (positionArray.d<positionArray.m && positionArray.m< positionArray.y)
               references.myDate.value = inputArray.day + strDelimit + inputArray.month + strDelimit + inputArray.year + ' ' + inputArray.hour + ':' + inputArray.minute;
            else if (positionArray.m<positionArray.d && positionArray.d< positionArray.y)
                references.myDate.value = inputArray.month + strDelimit + inputArray.day + strDelimit + inputArray.year + ' ' + inputArray.hour + ':' + inputArray.minute;
        }
        calendarObjForForm.hide();
          
        
}