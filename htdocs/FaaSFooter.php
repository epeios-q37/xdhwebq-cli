<?php
/*
Copyright (C) 2015 Claude SIMON (http://q37.info/contact/).

This file is part of xdhwebq.

xdhwebq is free software: you can redistribute it and/or
modify it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

xdhwebq is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with xdhwebq. If not, see <http://www.gnu.org/licenses/>.
*/

const PATTERN = "_supplier=qrcode";

$rawUrl = $_REQUEST['url'];
$url = str_replace("&" . PATTERN, "", $rawUrl);
$detailsOpenAttribute = strpos($rawUrl, PATTERN) ? 'open="open"' : "";
$qrCodeId = "QRCode";

echo <<<EOS
<head>
  <script src="qrcode.min.js"></script>
  <script>
    function adjustHeight() {
      let iframe = window.frameElement;
      iframe.height = '50px';
      let body = document.body;
      iframe.height = body.scrollHeight + 'px';
      document.getElementById("$qrCodeId").scrollIntoView();
    }
  </script>
  <style>
    body div {
      font-size: 1rem;
      margin: auto;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      width: 100%;
      background: #ffffff;
      border-radius: 8px;
      position: relative;
      width: 150px;
    }
  </style>
  <script>
  function toggle() {
    var x = document.getElementById("$qrCodeId");
    if (x.style.display === "none") {
      x.style.display = "flex";
    } else {
      x.style.display = "none";
    }
    adjustHeight();
  }  
  </script>
  <style>
  .popup {
    position: relative;
    display: inline-block;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  
  .popup .popuptext {
    visibility: hidden;
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    left: -100;
    margin-left: -80px;
  }
  
  .popup .show {
    padding: 10px;
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
  }
  
  @-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 1;}
  }
  
  @keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
  }

  .hidden {
    display: none;
  }
  </style>
  <script>
  function prepare() {
    new QRCode('$qrCodeId', {width:100, height:100, correctLevel: QRCode.CorrectLevel.L}).makeCode('$url');
    adjustHeight();

    let id = undefined;
    
    if ( navigator.share ) {
      id = "Share";
    } else {
      id = "Copy";
    }

    document.getElementById(id).classList.remove("hidden");
  }

  function copy() {
    if ( window.isSecureContext ) {
      navigator.clipboard.writeText("$url");
      var popup = document.getElementById("copyReport");
      popup.classList.toggle("show");
      setTimeout(() => popup.classList.remove("show"), 2500);
    } else
      alert("Clipboard copy not available in this context.\\nPlease copy the URL directly from the address bar of your browser.");
  }

  function share() {
    if (navigator.share) { 
      navigator.share({
        url: "$url"
      }).then(() => {
         console.log('Thanks for sharing!');
      })
    } else
        alert("Sharing not available in this context.\\nPlease copy/paste the URL directly from the address bar of your browser to the application you want to share with.");
  }
</script>
</head>

<body onload="prepare()">
  <div>
    <div style="justify-content: space-around; display: flex;">
      <span>
        <span onclick="toggle();" style="cursor: pointer">
          <img title="Displays the QR code to scan to access the application" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAQ9JREFUSEu1lLENAjEQBOdFA1AIJFQABRBRBogKSKACRBuQUABUQEQhUAKyZKT1iUNnrP/o9V7/2Ht719Hz0/X8fxQwAbbA0EBfwA54AOu8dgQi+gJwAubA3QCmwBVYAre8NgMi+gKgm5Wh3713T+8CVsAAOJhTewBP7wI2+UgWoDVQmKevtsi1QhYKqzVFZyAV71eR1YqIvrjBOMd0ZFL0BPY5pmpFRF8Aeuk5tUivn4q5EOIFSM1lNUmSvmvxVVPcQK/vAby0eIlqsijSdNWzKNKArkWR2WJt/FYD1TQ1Wih1miL11LPCFt+DfFL31yzS+P4NiMycaosis0WtizRm0yyKNGZTo1VbFNpQK3oD3s5tGW4LqcAAAAAASUVORK5CYII="/>
        </span>
        <span id="Copy" class="popup hidden" onclick="copy()">
          <img title="Copies the link of the application to the clipboard" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAONJREFUSEvt1cFJQ0EQxvFfSrCDkAZysAFz85CruYghaAsWYAHpIenAS+6xBG1A7MBbiOBBBjYQw9u3L+E9BMnAXJbh+883LDM9HUevY31/DnjCGJ8VTqO5DSbY5iZRchCAl5T7Glf4wCVmuMlBcoA5hhjgoQKwDw4Ht8nJ16GTHGCNEXIODt8Dco37NgH9NKbQXGKRmvrFONVBiEfu4hXPbQKqPs1urK04OAOUvul5RP9oRFPc1RylC0S+4w2Px+6i0sGLtR0Zy68y6nbRd0k9db86BdBAu1lJ6aI1U6mp6hzwA2dATRlJV2KvAAAAAElFTkSuQmCC"/>
          <span class="popuptext" style="width: max-content;" id="copyReport">Link to application copied</span> 
        </span>
        <span id="Share" style="cursor: pointer;" class="hidden" onclick="share()">
          <img title="Shares the link of the application" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAAAAADFHGIkAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAnRSTlMA/1uRIrUAAAEbSURBVCjPY/iPAzCgC1wpjyy7hEViJot+giHzNAyJ+6yF//7/K2G9gy4xh+EdkPzEMANdYhXDdSB5m2E5msRlDwbTa/9vmMt8RpF4msJsscyAgZNB/yrE8ncLWpd8/P+phltlFdDmcxvO/oM4d7sQnyGPWK2EcN8PFA8+4wn78v+jL0PWezSfz2J8A6QfMixDD5LZjK+B9D2GFegSL/gCPvx/686Q+ho9EPeKcWlxSLXK8rd/QwvdTyt6Vn/5/7WFT37R3/9/j608+gctdF9msxrO02IUYNS4gB66N/0YrO79v28j+RE9EFcy3AI7cSm6xFyGt0DyI8NMdImH7NlA+/PY7mFE7Xw2jQgt1jlYEsOt+sS6G9hSCQwAAM2v3hG+ldp/AAAAAElFTkSuQmCC"/>
        </span>
      </span>
      <a href="https://zelbinium.q37.info" target="_blank">
        <img title="Cyberaddiction, cyberbullying...: Zelbinium, so that smartphones no longer put our children in danger!" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAIAAABvFaqvAAAACXBIWXMAAAsTAAALEwEAmpwYAAADqUlEQVQ4y31UXUwcVRQ+d+bO7O/szrI7LARk+bGpg0vbtApbSy3SDU26oqaN+qBJbRoTE1OjNn3wwaT6oD5pjFETTTT6YIxJi+mDv4lELW2hVqhARRbaUNT9aQv7OzC/14ehy7jDch9Ozpz7ne9+5557Bl09HWc4L+3xYzdPO3mK5SnGj7AXaC9CbkS5AJwAACADWSGGBEbZ0IpELRhKTpdzupTTynmtWELRaBQAEEKmNRfcWZVP65YVQFGUaSlCCPx/WSO1fHsKJoSwGA12O3q7A5EOwRmolw0us4Sv3ShPXk13dW395NNvisWVSoJVTiVCCKEFQXiiGx9LcHdFOGBdeYm+VUA6YfkAv227mEjsb2lpHBmZUFWtVnWmjwEgVyJvnylN3ijcyusGWYf27Yv2xGK/j89IklxLUSWIAeC7aR0h4w73OvTAwH0A5NLY1Ia1VGCmT9W6xYawr/+hnRPj08m5v02A1dpFUbW6c+TpBxkWf/TxECGb9auayEpBCOlorTt8KPbjD6MXLs5UbQGAYRh2adSGb+Sl4/2yrLzz7te1HpFdI2WXE9/XFutp++DDb1PpHACcOvXc0aOPAMChx3p2bG8xwY/GG8V2t5WumsjPMSePx86fn/3iqzEzeGBgLwAdCnInXn7y8cO7CSFb2nwvPCsm+kJWadV39PwznQiM1978voJQVEVVV+PxXWNjU02NPADsjTWNjKaFOmbj0gBgZ6cvEW969Y3hm7elClE6vcQwjmDQNzW90BDmXU4sKzC/UGwOs9YOrBMxGL14JPLlUPLi5Yy12NS/2bs7mlOp5cXFbF3Q19cbuTSeTl4vCkHG51mbeQSW9h8bDKWz0vufJaua/efMfP/+3efO/TFx5Toh5OBA9K/5pctTOUnSHu71IoCuBoNGQAuCAAA72tmDe7hX3ltUVMM6loSQTOa2rmk/Df9WKsv1Idfwr7Nz8zd1Hf5JrQ7ucbX61QtJo6Qg1LtLfKqHFu/h3jojZZY1RSMUQg4HdrkdYYGPtDarqvbzL1fsE289DyGEywrc306Hm5nPX48Y7gByh7C73uGpd3hCs3P500OjZ8+ObDgTFclrM3xvp+hi0QOdjm2iry7sJ9ibzdPXFsoTk+l0tgCA7OdX/WfXtkRRtCPsyWbOJgVSmwy01TEH1Y6p9BfNDcVZP4e9PuzhaVeAZgMU66MwhzCHKA+i3ICcAABklZAVopdBL+lakSh5XV7WV3NaOaeW82qh9B+JkPDUpfvU0gAAAABJRU5ErkJggg=="/>
      </a>
      <a href="https://atlastk.org" target="_blank">
        <img title="Powered by the Atlas toolkit" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAbpJREFUSEul1E2IT2EUBvDfZHyUZkOJsNAsRo2ylA0LaWQjZGUslWZlLJCPko+wYkqUsvHRbIZhpWwsfGQ7FAmRj5W1hRWdeqdub/d/7/u/825u3fc9z3POc55zBpSfrVje8HwOv/P7gUL8cdxreTuDA10IIuuP+IXTNSRHsB9jeNaF4DzOYBteZgDr8QFP67KPt20SrUvZP8KhmuwfYhdG8a1OwjaCaezBRnzPAHYmSU7hcq/+NBGEa14hJDqXASzBWyzCJvztlyCI32AtRvAnA4isL2F30r+nwXpVEHrfTbrfz6JX4zMG8aJyN4ubJS6at+VPhEz/sqBVuINl6f92LMZZXCwhuJD8XmfLPP4KTuA6JktctAZfUtavKwFPcCMDuIajiO+x0ibn5Q9hC25hogJSBF4yaMdxFZuTLSOmVZZqNU1zEB7/hK/YkYL6Am+rYB9iFezF4zStJ5saWtLk6pvn2IDhZL++wZsqiOX1DtGDlegE3kRwGwfxAIf7laWtySvwA0vTMoshCp/nE91z/7QRxGSGW+IsCLxOonlrRnMXDF5HELs9mjuVdksnWdokCge976p53pj/x8VXGXemjWsAAAAASUVORK5CYII="/>
      </a>
    </div>
    <a style="color: transparent;" target="_blank" href="$url">
      <div title="$url" style="display: none; justify-content: space-around; padding: 5px 0px 10px" id="$qrCodeId"></div>
    </a>
  </div>
</body>
EOS;
?>
