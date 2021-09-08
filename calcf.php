<?php
if (isset($_GET['op1']) && isset($_GET['ops']) && isset($_GET['op2'])) {
        $op1 = $_GET['op1'];
        $ops = $_GET['ops'];
        $op2 = $_GET['op2'];
        if ($ops == 'add') {
            $result = $op1 + $op2;
        }
        else if ($ops == 'subtract') {
            $result = $op1 - $op2;
        }
        else if ($ops == 'divide') {
            $result = $op1 / $op2;
        }
        else if ($ops == 'multiply') {
            $result = $op1 * $op2;
        }
        echo $result;
}
else {
?>
<html>
<head>
   <style>
   * {
      font: 18px helvetica;
   }
   
   #calc-container {
      width: auto;
      max-width:40%;
      height: auto;
      margin: 5px auto;
      padding:10px;
      background: #eee;
      border-radius: 9px;
   }
   
   .btn {
      font-size: 20px;
      height: 50px;
      min-width: 60px;
      max-width: 180px;
      margin: 7px 2px;
      padding: 10px;
      outline: none;
      text-align: center;
      text-decoration: none;
      box-shadow: 0px 8px #f80;
      background: #fa0;
      color: #fff;
      border: none;
      border-radius: 5px;
   }   
   
    .btn:active {
      box-shadow: 0px 8px #f90;
      transform: translateY(6px);
   }
   
   .digit {
       background: skyblue;
       box-shadow: 0px 8px #7ac;
   }
   
   .digit:active {
       box-shadow: 0px 8px #9ac;
       transform: translateY(6px);
   }
   
   .ops, #res {
      background: #4c4;
      box-shadow: 0px 8px #1a1;
   }
   
   .ops:active, #res:active {
      box-shadow: 0px 8px #0a0;
       transform: translateY(6px);
   }
   
   #calc-screen {
      width: 98%;
      height: 4%;
      max-height: 15%;
      overflow-y: scroll;
      margin: 5px;
      padding-top: 10px;
      border-radius: 9px;
      letter-spacing: 0px;
      background: #999;
      color: #fff;
      font-size: 24px;
   }
   
   #btn-container {
       display: flex;
       flex-flow: row wrap;
   }
   
   #auth {
       font: x-small helvetica;
       color: #8ac;
       text-align: center
   }
</style>
</head>
<body>
<div id='auth'>
SimpleCalc -- Made by doodoo
</div>
<div id='calc-container'>
<div id='calc-screen'>
0
</div>
<div id='btn-container'>
<button class='btn' id='sqrt'>&radic;</button>
<button class='btn' id='pcent'>&#37;</button>
<button class='btn pm'>
&#177;
</button>
<button class='btn' id='clear'>
C
</button>
<button id='clearall' class='btn'>
AC
</button>
<button class='btn ops' id='divide'>
&divide;
</button>
<br/>
<button class='btn digit'>&#49;</button>
<button class='btn digit'>&#50;</button>
<button class='btn digit'>&#51;</button>
<button class='btn' id='pow'>
ex
</button>
<button class='btn'>
1/x
</button>
<button class='btn ops' id='multiply'>
&times;
</button>
<br/>
<button class='btn digit'>&#52;</button>
<button class='btn digit'>&#53;</button>
<button class='btn digit'>&#54;</button>
<button class='btn' id='pi'>&#960;</button>
<button class='btn' id='rand'>
rand
</button>
<button class='btn ops' id='add'>
&plus;
</button>
<br/>
<button class='btn digit'>&#55;</button>
<button class='btn digit'>&#56;</button>
<button class='btn digit'>&#57;</button>
<button class='btn' id='fac'>
!
</button>
<button class='btn' id='mod'>
mod
</button>
<button class='btn ops' id='subtract'>&#45;</button>
<br/>
<button class='btn digit'>&#48;</button>
<button class='btn'>sin</button>
<button class='btn'>cos</button>
<button class='btn'>tan</button>
<button class='btn' id='dot'>&#46;</button>
<button class='btn' id='res'>
&#61;
</button>
</div>
</div>
<script>
var mydata = {
inputed : document.getElementById('calc-screen'),
btn : document.getElementsByClassName('btn')
}

var firstOperand = "";
var secOperand = "";
var operator = "";
var newContent;
var p = 0;

function test() {
for (var c=0;c<=mydata.btn.length;c++) {
   mydata.btn[c].onclick = function (event) {
       var textLen = mydata.inputed.textContent.length;
       var displayValue = mydata.inputed.textContent;
       var btnContent = event.target.textContent;
       if (event.target.classList.contains('digit') && displayValue == 0) {
        mydata.inputed.textContent = btnContent;
          }
          else {
             mydata.inputed.textContent = displayValue + btnContent;
          }
          if (event.target.id == 'dot') {
             mydata.inputed.textContent = displayValue + '.';
          }
          if (event.target.classList.contains('ops') || event.target.id == 'pow' || event.target.id == 'mod') {
          firstOperand = displayValue;
         operator = event.target.id;
       mydata.inputed.textContent = "";
          }
          if (event.target.id == 'res') {
          secOperand = displayValue;
          /*mydata.inputed.textContent = calc(firstOperand,operator,secOperand);*/
          mydata.inputed.textContent = phpcalc(firstOperand,operator,secOperand);
          }
          if (event.target.id == 'clearall') {
          mydata.inputed.textContent = '0';
          }
          if (event.target.id == 'clear' && displayValue != '0') {
          newContent = mydata.inputed.textContent.substr(0,textLen-1);
          mydata.inputed.textContent = newContent;
          if (mydata.inputed.textContent == "") {
          mydata.inputed.textContent = '0';
             }
          }
          if (event.target.id == 'rand') {
         if (displayValue == 0) {
         mydata.inputed.textContent = Math.round(Math.random()*100)+1;
         }
         else { mydata.inputed.textContent = displayValue + Math.round(Math.random()*100);
             }
          }
          if (event.target.id == 'pi') {
         if (displayValue == 0) { mydata.inputed.textContent = Math.PI;
          }
          else {
          mydata.inputed.textContent = displayValue //+ Math.PI;
             }
          }
          if (event.target.classList.contains('pm')) {
              if (displayValue != 0) {
            mydata.inputed.textContent = -displayValue;
              }
            else {
                mydata.inputed.textContent = displayValue;
            }
          }
          if (event.target.id == 'pcent' ) {
              if (displayValue != '') {
                mydata.inputed.textContent = parseFloat(displayValue)/100;
              }
              else {
               mydata.inputed.textContent = displayValue;
              }
          }
          if (event.target.id == 'sqrt') {
              mydata.inputed.textContent = Math.sqrt(parseFloat(displayValue));
          }
          if (event.target.id == 'fac') {
            p = 0;
            for (var c=0;c<=parseFloat(displayValue);c++) {
               p += c*c-1;
              }
            mydata.inputed.textContent = p-1;
          }
      }
   }
}

test()

function phpcalc(op1,ops,op2) {
    var res;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        mydata.inputed.textContent = xmlhttp.responseText;
    }
    xmlhttp.open('GET','?op1='+op1+'&ops='+ops+'&op2='+op2);
    xmlhttp.send();
    return res;
}

/*function calc (op1,sign,op2) {
   var first = parseFloat(op1);
   var sec = parseFloat(op2);
   var ops = parseFloat(sign);
   var result;
   if (sign == "add") {
      result = first + sec;
   }
   else if (sign == "subtract") {
      result = first - sec;
   }
   else if (sign == "multiply") {
      result = first * sec;
   }
   else if (sign == "divide") {
      result = first / sec;
   }
   else if (sign == 'pow') {
      result = Math.pow(first,sec);
   }
   else if (sign == 'mod') {
      result = (first % sec);
   }
   return result;
}*/
</script>
</body>
</html>
<?php } ?>