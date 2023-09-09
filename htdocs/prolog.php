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

$out = str_replace(array("\r", "\n", "\t"), '',<<<MLS
  <!DOCTYPE html>
  <html xmlns:xdh="http://q37.info/ns/xdh">
    <head>
      <!-- If modified, report modification in "xdhcefq.html" from "xdhcefq" -->
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta http-equiv="Cache-Control" content="no-cache"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <!-- Below both scripts are for DEV environment. -->
      <script src="xdhtml.js"></script>
      <script src="xdhwebq.js"></script>
      <!-- Below both scripts are for PROD environment. -->
      <script src="xdhtml_20230508.js"></script>
      <script src="xdhwebq_20230508.js"></script>
      <script data-goatcounter="https://faas.goatcounter.com/count" async src="//gc.zgo.at/count.js"></script>
      <!--link rel="stylesheet" href="https://unpkg.com/marx-css/css/marx.min.css"-->
      <style id="XDHStyle">
        html, body {
          margin: 0;
        }
        html {
          height: 100%;
        }
        body {
          min-height: 100%;
        }
        .xdh_style {
          margin: 10px auto auto auto;
          height: calc(100% - 10px);
        }
      </style>
      <style id="XDHStyleJupyter">
        .xdh_style {
          display: table;
          margin: 10px auto auto auto;
        }
      </style>
      <style id="XDHFullHeight">
        body {
          min-height: auto;
          height: 100%;
        }
      </style>
      <style id="XDHFullWidth">
        .xdh_style {
          width: 100%;
        }
      </style>
      <!-- BEGIN of the user head section -->
$head
      <!-- END of the user head section -->
      <script>
        function ignition(token,id,qrcodeOnly) {
          let iframe = document.body.lastElementChild.previousElementSibling.firstElementChild;
          iframe.src = "FaaSFooter.php?url=" + encodeURIComponent(window.location.href);
          document.getElementById("XDHFullHeight").disabled = true;
          document.getElementById("XDHFullWidth").disabled = true;
          if (!qrcodeOnly) connect(token,id);
        }
      </script>
    </head>
    <!--body id="Root" xdh:onevents="(keypress|About|SC+a)(keypress|Q37Refresh|SC+r)"-->
    <body onload="ignition('$token','$id',$qrcodeOnly);" style="display: flex; flex-flow: column;">
      <span class="xdh_style">
        <noscript>
          <div style="display: table; margin: 50px auto auto auto;">
            <fieldset>
              <h3><i>JavaScript</i> is disabled! You have to enable <i>JavaScript</i> for this application to work!</h3>
            </fieldset>
          </div>
        </noscript>
      </span>
      <span $additional>
        <iframe frameborder="0" width="100%"></iframe>
      </span>
      <!-- There must be one and only one element here, even an empty one, for the 'More' section to be handled correctly. -->
      <!--iframe style="border: none; width: 100%; height: 0px;" src="sponsors.php?$parameters"></iframe-->
      <span></span>
    </body>
  </html>
MLS
      );
?>
