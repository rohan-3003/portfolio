<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/set_paper_design.css">
</head>
<body onload="showList()">
  <div id="queBox"></div>
	<button id="addQueBox" onclick="addQueBox()">ADD</button>
	<button id="addNewQue" style="display:none" onclick="addQue()">Update</button>
	<script>
  function showList() {
  if (window.XMLHttpRequest){
      xmlhttpn = new XMLHttpRequest();
    }
  else{
      xmlhttpn = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpn.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          myeditFunction(this);
      }
    };
    xmlhttpn.open("GET", "json/questions.json?nocache=" + (new Date()).getTime(), true);
    xmlhttpn.send();
}
function myeditFunction(xml) {
    var x, i, txt,opt1,opt2,opt3,opt4,ans;
    jsonObj = JSON.parse(xml.responseText);
    txt = "";
    x = jsonObj.question;
    for (i = 0; i< x.length; i++) {
      txt = x[i].ques;
      opt1=x[i].one;
      opt2=x[i].two;
      opt3=x[i].three;
      opt4=x[i].four;
      ans=x[i].ans;

      var breakLine = document.createElement("br");
      var que = document.createElement("input");
      var option1 = document.createElement("input");
      var option2 = document.createElement("input");
      var option3 = document.createElement("input");
      var option4 = document.createElement("input");
      var answer = document.createElement("input");
      var queText = document.createTextNode("Ques");

      var removeB = document.createElement("button");
      var updateB = document.createElement("button");
      removeB.appendChild(document.createTextNode("Remove"));
      updateB.appendChild(document.createTextNode("Update"));
      que.setAttribute("class","ques");
      que.setAttribute("type","text");
      que.setAttribute("value",txt);

      option1.setAttribute("class","opt1");
      option1.setAttribute("type","text");
      option1.setAttribute("value",opt1);

      option2.setAttribute("class","opt2");
      option2.setAttribute("type","text");
      option2.setAttribute("value",opt2);

      option3.setAttribute("class","opt3");
      option3.setAttribute("type","text");
      option3.setAttribute("value",opt3);

      option4.setAttribute("class","opt4");
      option4.setAttribute("type","text");
      option4.setAttribute("value",opt4);

      answer.setAttribute("class","ans");
      answer.setAttribute("type","text");
      answer.setAttribute("value",ans);

      removeB.setAttribute("class","removeButton");
      removeB.setAttribute("value",i);
      removeB.setAttribute("onclick","removeFunction("+i+")");
      updateB.setAttribute("class","updateButton");
      updateB.setAttribute("value",i);
      updateB.setAttribute("onclick","updateFunction("+i+")");
      document.getElementById("queBox").appendChild(document.createTextNode(i+1));
      document.getElementById("queBox").appendChild(document.createElement("br"));
      document.getElementById("queBox").appendChild(queText);
      document.getElementById("queBox").appendChild(que);
      document.getElementById("queBox").appendChild(document.createElement("br"));
      document.getElementById("queBox").appendChild(document.createTextNode("Opt 1"));
      document.getElementById("queBox").appendChild(option1);
      document.getElementById("queBox").appendChild(document.createTextNode("Opt 2"));
      document.getElementById("queBox").appendChild(option2);
      document.getElementById("queBox").appendChild(document.createTextNode("Opt 3"));
      document.getElementById("queBox").appendChild(option3);
      document.getElementById("queBox").appendChild(document.createTextNode("Opt 4"));
      document.getElementById("queBox").appendChild(option4);
      document.getElementById("queBox").appendChild(document.createElement("br"));
      document.getElementById("queBox").appendChild(document.createTextNode("Ans"));
      document.getElementById("queBox").appendChild(answer);
      document.getElementById("queBox").appendChild(removeB);
      document.getElementById("queBox").appendChild(updateB);
      document.getElementById("queBox").appendChild(breakLine);
    }
}
function removeFunction(i){
  var buttonClass=document.getElementsByClassName("removeButton")[i];
  var buttonId=buttonClass.getAttribute("value");
  document.getElementById("queBox").removeChild(buttonClass);
  document.getElementById("queBox").removeChild(document.getElementsByClassName("ques")[i]);
  document.getElementById("queBox").removeChild(document.getElementsByClassName("opt1")[i]);
  document.getElementById("queBox").removeChild(document.getElementsByClassName("opt2")[i]);
  document.getElementById("queBox").removeChild(document.getElementsByClassName("opt3")[i]);
  document.getElementById("queBox").removeChild(document.getElementsByClassName("opt4")[i]);
  document.getElementById("queBox").removeChild(document.getElementsByClassName("ans")[i]);
  document.getElementById("queBox").removeChild(document.getElementsByClassName("updateButton")[i]);

  if (window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
      }
    else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          myremoveFunction(this,buttonId);
      }
      };
      xmlhttp.open("GET", "json/questions.json?nocache=" + (new Date()).getTime(), true);
      xmlhttp.send();
}
function myremoveFunction(xml, buttonId) {
    var jsonObj, x;
    jsonObj = JSON.parse(xml.responseText);
    jsonObj.question.splice(buttonId,1);
    var str_json = JSON.stringify(jsonObj);
    var request= new XMLHttpRequest();
    request.open("POST", "JSON_News_Handler.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(str_json);
    alert("Question Removed");
    }

  function updateFunction(i){
  var buttonClass=document.getElementsByClassName("updateButton")[i];
  var buttonId=buttonClass.getAttribute("value");
  if (window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
      }
    else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          myupdateFunction(this,buttonId);
      }
      };
      xmlhttp.open("GET", "json/questions.json?nocache=" + (new Date()).getTime(), true);
      xmlhttp.send();
}
function myupdateFunction(xml, buttonId) {
    var jsonObj, x;
    jsonObj = JSON.parse(xml.responseText);
    var changedQue = document.getElementsByClassName("ques")[buttonId].value;
    var changedOpt1 = document.getElementsByClassName("opt1")[buttonId].value;
    var changedOpt2 = document.getElementsByClassName("opt2")[buttonId].value;
    var changedOpt3 = document.getElementsByClassName("opt3")[buttonId].value;
    var changedOpt4 = document.getElementsByClassName("opt4")[buttonId].value;
    var changedAns = document.getElementsByClassName("ans")[buttonId].value;

    jsonObj.question[buttonId].ques = changedQue;
    jsonObj.question[buttonId].one = changedOpt1;
    jsonObj.question[buttonId].two = changedOpt2;
    jsonObj.question[buttonId].three = changedOpt3;
    jsonObj.question[buttonId].four = changedOpt4;
    jsonObj.question[buttonId].ans = changedAns;

    var str_json = JSON.stringify(jsonObj);
    var request= new XMLHttpRequest();
    request.open("POST", "JSON_News_Handler.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(str_json);
    alert("Question Updated");
    }
	function addQueBox(){
		document.getElementById("addQueBox").style.display="none";
		var newQue=document.createElement("input");
    var newOpt1=document.createElement("input");
    var newOpt2=document.createElement("input");
    var newOpt3=document.createElement("input");
    var newOpt4=document.createElement("input");
    var newAns=document.createElement("input");

		newQue.setAttribute("type","text");
    newQue.setAttribute("class","ques");
		newQue.setAttribute("id","newQue");

    newOpt1.setAttribute("type","text");
    newOpt1.setAttribute("class","opt1");
		newOpt1.setAttribute("id","newOpt1");

    newOpt2.setAttribute("type","text");
    newOpt2.setAttribute("class","opt2");
		newOpt2.setAttribute("id","newOpt2");

    newOpt3.setAttribute("type","text");
    newOpt3.setAttribute("class","opt3");
		newOpt3.setAttribute("id","newOpt3");

    newOpt4.setAttribute("type","text");
    newOpt4.setAttribute("class","opt4");
		newOpt4.setAttribute("id","newOpt4");

    newAns.setAttribute("type","text");
    newAns.setAttribute("class","ans");
		newAns.setAttribute("id","newAns");

    document.getElementById("queBox").appendChild(document.createTextNode("Ques"));
		document.getElementById("queBox").appendChild(newQue);
    document.getElementById("queBox").appendChild(document.createElement("br"));
    document.getElementById("queBox").appendChild(document.createTextNode("Opt 1"));
    document.getElementById("queBox").appendChild(newOpt1);
    document.getElementById("queBox").appendChild(document.createTextNode("Opt 2"));
    document.getElementById("queBox").appendChild(newOpt2);
    document.getElementById("queBox").appendChild(document.createTextNode("Opt 3"));
    document.getElementById("queBox").appendChild(newOpt3);
    document.getElementById("queBox").appendChild(document.createTextNode("Opt 4"));
    document.getElementById("queBox").appendChild(newOpt4);
    document.getElementById("queBox").appendChild(document.createElement("br"));
    document.getElementById("queBox").appendChild(document.createTextNode("Ans"));
    document.getElementById("queBox").appendChild(newAns);
		document.getElementById("addNewQue").style.display="block";
	}
	function addQue(){
		if (window.XMLHttpRequest){
    	xmlhttp = new XMLHttpRequest();
  		}
		else{
    	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  		}
  		xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
      		myaddFunction(this);
    	}
  		};
  		xmlhttp.open("GET", "json/questions.json?nocache=" + (new Date()).getTime(), true);
  		xmlhttp.send();
	}
	function myaddFunction(xml) {
  	var jsonObj, x;
  	jsonObj = JSON.parse(xml.responseText);
  	var newQue=document.getElementById("newQue").value;
    var newOpt1=document.getElementById("newOpt1").value;
    var newOpt2=document.getElementById("newOpt2").value;
    var newOpt3=document.getElementById("newOpt3").value;
    var newOpt4=document.getElementById("newOpt4").value;
    var newAns=document.getElementById("newAns").value;

  	x = jsonObj.question;
  	x.push({"ques":newQue,"one":newOpt1,"two":newOpt2,"three":newOpt3,"four":newOpt4,"ans":newAns});
  	var str_json = JSON.stringify(jsonObj);
  	var request= new XMLHttpRequest();
    request.open("POST", "JSON_News_Handler.php", true);
    request.setRequestHeader("Content-type", "application/json");
    request.send(str_json);
    alert("Question Added");
  	}
	</script>
</body>
</html>
