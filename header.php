<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?=$title?> - <?=$name?></title>
    <script>!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):(t=t||self).pell=e()}(this,function(){"use strict";function t(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function e(e){for(var n=1;n<arguments.length;n++){var r=null!=arguments[n]?arguments[n]:{},i=Object.keys(r);"function"==typeof Object.getOwnPropertySymbols&&(i=i.concat(Object.getOwnPropertySymbols(r).filter(function(t){return Object.getOwnPropertyDescriptor(r,t).enumerable}))),i.forEach(function(n){t(e,n,r[n])})}return e}var n=function(t,e,n){return t.addEventListener(e,n)},r=function(t,e){return t.appendChild(e)},i=function(t){return document.createElement(t)},o=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;return document.execCommand(t,!1,e)},u=function(t){return document.queryCommandState(t)},c={bold:{icon:"<b>B</b>",result:function(){return o("bold")},state:function(){return u("bold")},title:"Bold"},code:{icon:"&lt;/&gt;",result:function(){return o("formatBlock","<pre>")},title:"Code"},heading1:{icon:"<b>H<sub>1</sub></b>",result:function(){return o("formatBlock","<h1>")},title:"Heading 1"},heading2:{icon:"<b>H<sub>2</sub></b>",result:function(){return o("formatBlock","<h2>")},title:"Heading 2"},image:{icon:"&#128247;",result:function(){var t=window.prompt("Enter the image URL");t&&o("insertImage",t)},title:"Image"},italic:{icon:"<i>I</i>",result:function(){return o("italic")},state:function(){return u("italic")},title:"Italic"},line:{icon:"&#8213;",result:function(){return o("insertHorizontalRule")},title:"Horizontal Line"},link:{icon:"&#128279;",result:function(){var t=window.prompt("Enter the link URL");t&&o("createLink",t)},title:"Link"},olist:{icon:"&#35;",result:function(){return o("insertOrderedList")},title:"Ordered List"},paragraph:{icon:"&#182;",result:function(){return o("formatBlock","<p>")},title:"Paragraph"},quote:{icon:"&#8220; &#8221;",result:function(){return o("formatBlock","<blockquote>")},title:"Quote"},strikethrough:{icon:"<strike>S</strike>",result:function(){return o("strikeThrough")},state:function(){return u("strikeThrough")},title:"Strike-through"},ulist:{icon:"&#8226;",result:function(){return o("insertUnorderedList")},title:"Unordered List"},underline:{icon:"<u>U</u>",result:function(){return o("underline")},state:function(){return u("underline")},title:"Underline"}},l={actionbar:"pell-actionbar",button:"pell-button",content:"pell-content",selected:"pell-button-selected"};return{init:function(t){var u=t.actions?t.actions.map(function(t){return"string"==typeof t?c[t]:c[t.name]?e({},c[t.name],t):t}):Object.keys(c).map(function(t){return c[t]}),a=e({},l,t.classes),s=t.defaultParagraphSeparator||"div",f=i("div");f.className=a.actionbar,r(t.element,f);var d=t.element.content=i("div");return d.contentEditable=!0,d.className=a.content,d.oninput=function(e){var n=e.target.firstChild;n&&3===n.nodeType?o("formatBlock","<".concat(s,">")):"<br>"===d.innerHTML&&(d.innerHTML=""),t.onChange(d.innerHTML)},d.onkeydown=function(t){var e;"Enter"===t.key&&"blockquote"===(e="formatBlock",document.queryCommandValue(e))&&setTimeout(function(){return o("formatBlock","<".concat(s,">"))},0)},r(t.element,d),u.forEach(function(t){var e=i("button");if(e.className=a.button,e.innerHTML=t.icon,e.title=t.title,e.setAttribute("type","button"),e.onclick=function(){return t.result()&&d.focus()},t.state){var o=function(){return e.classList[t.state()?"add":"remove"](a.selected)};n(d,"keyup",o),n(d,"mouseup",o),n(e,"click",o)}r(f,e)}),t.styleWithCSS&&o("styleWithCSS"),o("defaultParagraphSeparator",s),t.element}}});</script>
    <style>
        .pell {
            border: 1px solid hsla(0, 0%, 4%, .1);
        }

        .pell,
        .pell-content {
            box-sizing: border-box;
        }

        .pell-content {
            height: 300px;
            outline: 0;
            overflow-y: auto;
            padding: 10px;
        }

        .pell-actionbar {
            background-color: #fff;
            border-bottom: 1px solid hsla(0, 0%, 4%, .1);
        }

        .pell-button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            height: 30px;
            outline: 0;
            width: 30px;
            vertical-align: bottom;
        }

        .pell-button-selected {
            background-color: #007BFF;
            color: white;
        }

        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap');

        * {
            outline: 0;
            font-family: 'DM Sans', sans-serif;
            box-sizing: border-box;
        }

        code,
        pre {
            font-family: 'DM Mono', monospace;
            background: #393939;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
        }

        body {
            margin: 0;
        }

        main {
            padding: 10px 25px;
        }

        .nav {
            color: white;
            justify-content: space-between;
            display: flex;
            padding: 15px 25px;
            background: #007BFF;
        }

        .nav .spacer {
            flex-grow: 1;
        }

        .nav * {
            align-self: center;
        }

        .item {
            color: black;
            padding: 10px 15px;
            border-bottom: 2px solid #484848;
            display: block;
            text-decoration: none;
            cursor: pointer;
        }

        .item .desc {
            float: right;
            color: #7A7A7A;
        }

        .item:last-child {
            border-bottom: none;
        }

        .listbox {
            border: 2px solid #484848;
            border-radius: 5px;
        }

        .copyright {
            background: #434343;
            color: white;
            padding: 15px 25px;
        }

        .title {
            color: white;
            text-decoration: none;
        }

        .msg {
            color: black;
            border: 2px solid #484848;
            display: block;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 25px;
        }

        .msgheader {
            border-bottom: 2px solid #484848;
            padding: 0;
            display: block;
            text-decoration: none;
            color: black;
            padding: 10px 15px;
        }
        
        .msgfooter {
            border-top: 2px solid #484848;
            padding: 0;
            display: block;
            text-decoration: none;
            color: black;
            padding: 10px 15px;
        }
        
        .threadtitle {
            border-bottom: 2px solid #484848;
            padding: 0 15px;
            display: block;
            color: black;
        }

        .msgheader span {
            padding-left: 15px;
            align-self: center;
            display: inline-block;
        }

        .msgcontent {
            padding: 0 15px;
        }
        
        .msgcontent.html {
            padding: 15px;
        }

        .msg.reply {
            margin-left: 25px;
        }

        .msgheader.reply {
            height: 3em;
        }

        .msgcontent.replymsg {
            padding: 0;
        }

        .msgpost {
            border-top: 2px solid #484848;
            padding: 10px 15px;
        }

        .button {
            font-size: 1em;
            background: #007BFF;
            cursor: pointer;
            border: 0;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
        }

        .button:hover {
            background: #005DC0;
        }

        .button:active {
            background: #004085;
        }

        .navbtn {
            color: white;
            background: #0072EE;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 5px;
        }

        .navbtn:hover {
            background: #006EE5;
        }

        .navbtn:active {
            background: #0069DB;
        }

        .label {
            margin-bottom: 0;
        }

        input {
            border: 2px solid #585858;
            display: block;
            font-size: 1em;
            margin-bottom: 15px;
            padding: 10px 25px;
            border-radius: 5px;
            width: 100%;
        }

        input:focus {
            border: 2px solid #007BFF;
        }

        .wrong {
            background: #FF4A4A;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            border: 2px solid #FFA5A5;
        }
        
        .btn-block {
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .hidden {
            display: none;
        }
        
        .attr {
            color: white;
        }
    </style>
</head>

<body>
    <div class="nav">
        <span><a href="<?=$root?>" class="title"><b><?=$name?></b></a></span>
        <span class="spacer"></span>
        <?php
        if ($loggedin) {
            ?>
            <a href="<?=$root?>logout.php" class="navbtn">Logout</a>
            <?php
        } else {
            ?>
            <a href="<?=$root?>login.php" class="navbtn">Login</a>
            <?php
        }
        ?>
    </div>
    <main>
