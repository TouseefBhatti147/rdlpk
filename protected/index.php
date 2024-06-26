<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <title>phpMyAdmin 2.11.5.1</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="phpmyadmin.css.php?lang=en-iso-8859-1&amp;convcharset=iso-8859-1&amp;collation_connection=utf8_unicode_ci&amp;token=4affd0af8a2e788fd6d51382f1219600&amp;js_frame=right&amp;nocache=4048056235" />
    <link rel="stylesheet" type="text/css" href="print.css" media="print" />
<script type="text/javascript">
//<![CDATA[
// show login form in top frame
if (top != self) {
    window.top.location.href=location;
}
//]]>
</script>
</head>

<body class="loginform">

    
<div class="container">
<a href="http://www.phpmyadmin.net" target="_blank" class="logo"><img src="./themes/original/img/logo_right.png" id="imLogo" name="imLogo" alt="phpMyAdmin" border="0" /></a>
<h1>
    Welcome to <bdo dir="ltr" xml:lang="en">phpMyAdmin 2.11.5.1</bdo></h1>
    
<form method="post" action="index.php" target="_parent">
                <input type="hidden" name="collation_connection" value="utf8_unicode_ci" />
            <input type="hidden" name="convcharset" value="iso-8859-1" />
            <input type="hidden" name="server" value="1" />
<fieldset><legend xml:lang="en" dir="ltr">Language <a href="./translators.html" target="documentation"><img class="icon" src="./themes/original/img/b_info.png" width="11" height="11" alt="Info" /></a></legend>
    <select name="lang" onchange="this.form.submit();" xml:lang="en" dir="ltr">
            <option value="af-iso-8859-1">Afrikaans (iso-8859-1)</option>
        <option value="af-utf-8">Afrikaans (utf-8)</option>
        <option value="sq-iso-8859-1">Shqip - Albanian (iso-8859-1)</option>
        <option value="sq-utf-8">Shqip - Albanian (utf-8)</option>
        <option value="ar-utf-8">&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577; - Arabic (utf-8)</option>
        <option value="ar-win1256">&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577; - Arabic (win1256)</option>
        <option value="az-iso-8859-9">Az&#601;rbaycanca - Azerbaijani (iso-8859-9)</option>
        <option value="az-utf-8">Az&#601;rbaycanca - Azerbaijani (utf-8)</option>
        <option value="eu-iso-8859-1">Euskara - Basque (iso-8859-1)</option>
        <option value="eu-utf-8">Euskara - Basque (utf-8)</option>
        <option value="becyr-utf-8">&#1041;&#1077;&#1083;&#1072;&#1088;&#1091;&#1089;&#1082;&#1072;&#1103; - Belarusian (utf-8)</option>
        <option value="becyr-win1251">&#1041;&#1077;&#1083;&#1072;&#1088;&#1091;&#1089;&#1082;&#1072;&#1103; - Belarusian (win1251)</option>
        <option value="belat-utf-8">Byelorussian - Belarusian latin (utf-8)</option>
        <option value="bs-utf-8">Bosanski - Bosnian (utf-8)</option>
        <option value="bs-win1250">Bosanski - Bosnian (win1250)</option>
        <option value="ptbr-iso-8859-1">Portugu&ecirc;s - Brazilian portuguese (iso-8859-1)</option>
        <option value="ptbr-utf-8">Portugu&ecirc;s - Brazilian portuguese (utf-8)</option>
        <option value="bg-koi8-r">&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; - Bulgarian (koi8-r)</option>
        <option value="bg-utf-8">&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; - Bulgarian (utf-8)</option>
        <option value="bg-win1251">&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; - Bulgarian (win1251)</option>
        <option value="ca-iso-8859-1">Catal&agrave; - Catalan (iso-8859-1)</option>
        <option value="ca-utf-8">Catal&agrave; - Catalan (utf-8)</option>
        <option value="zh-gb2312">&#20013;&#25991; - Chinese simplified (gb2312)</option>
        <option value="zh-utf-8">&#20013;&#25991; - Chinese simplified (utf-8)</option>
        <option value="zhtw-big5">&#20013;&#25991; - Chinese traditional (big5)</option>
        <option value="zhtw-utf-8">&#20013;&#25991; - Chinese traditional (utf-8)</option>
        <option value="hr-iso-8859-2">Hrvatski - Croatian (iso-8859-2)</option>
        <option value="hr-utf-8">Hrvatski - Croatian (utf-8)</option>
        <option value="hr-win1250">Hrvatski - Croatian (win1250)</option>
        <option value="cs-iso-8859-2">&#268;esky - Czech (iso-8859-2)</option>
        <option value="cs-utf-8">&#268;esky - Czech (utf-8)</option>
        <option value="cs-win1250">&#268;esky - Czech (win1250)</option>
        <option value="da-iso-8859-1">Dansk - Danish (iso-8859-1)</option>
        <option value="da-utf-8">Dansk - Danish (utf-8)</option>
        <option value="nl-iso-8859-1">Nederlands - Dutch (iso-8859-1)</option>
        <option value="nl-iso-8859-15">Nederlands - Dutch (iso-8859-15)</option>
        <option value="nl-utf-8">Nederlands - Dutch (utf-8)</option>
        <option value="en-iso-8859-1" selected="selected">English (iso-8859-1)</option>
        <option value="en-iso-8859-15">English (iso-8859-15)</option>
        <option value="en-utf-8">English (utf-8)</option>
        <option value="et-iso-8859-1">Eesti - Estonian (iso-8859-1)</option>
        <option value="et-utf-8">Eesti - Estonian (utf-8)</option>
        <option value="fi-iso-8859-1">Suomi - Finnish (iso-8859-1)</option>
        <option value="fi-iso-8859-15">Suomi - Finnish (iso-8859-15)</option>
        <option value="fi-utf-8">Suomi - Finnish (utf-8)</option>
        <option value="fr-iso-8859-1">Fran&ccedil;ais - French (iso-8859-1)</option>
        <option value="fr-iso-8859-15">Fran&ccedil;ais - French (iso-8859-15)</option>
        <option value="fr-utf-8">Fran&ccedil;ais - French (utf-8)</option>
        <option value="gl-iso-8859-1">Galego - Galician (iso-8859-1)</option>
        <option value="gl-utf-8">Galego - Galician (utf-8)</option>
        <option value="ka-utf-8">&#4325;&#4304;&#4320;&#4311;&#4323;&#4314;&#4312; - Georgian (utf-8)</option>
        <option value="de-iso-8859-1">Deutsch - German (iso-8859-1)</option>
        <option value="de-iso-8859-15">Deutsch - German (iso-8859-15)</option>
        <option value="de-utf-8">Deutsch - German (utf-8)</option>
        <option value="el-iso-8859-7">&Epsilon;&lambda;&lambda;&eta;&nu;&iota;&kappa;&#940; - Greek (iso-8859-7)</option>
        <option value="el-utf-8">&Epsilon;&lambda;&lambda;&eta;&nu;&iota;&kappa;&#940; - Greek (utf-8)</option>
        <option value="he-iso-8859-8-i">&#1506;&#1489;&#1512;&#1497;&#1514; - Hebrew (iso-8859-8-i)</option>
        <option value="he-utf-8">&#1506;&#1489;&#1512;&#1497;&#1514; - Hebrew (utf-8)</option>
        <option value="hi-utf-8">&#2361;&#2367;&#2344;&#2381;&#2342;&#2368; - Hindi (utf-8)</option>
        <option value="hu-iso-8859-2">Magyar - Hungarian (iso-8859-2)</option>
        <option value="hu-utf-8">Magyar - Hungarian (utf-8)</option>
        <option value="id-iso-8859-1">Bahasa Indonesia - Indonesian (iso-8859-1)</option>
        <option value="id-utf-8">Bahasa Indonesia - Indonesian (utf-8)</option>
        <option value="it-iso-8859-1">Italiano - Italian (iso-8859-1)</option>
        <option value="it-iso-8859-15">Italiano - Italian (iso-8859-15)</option>
        <option value="it-utf-8">Italiano - Italian (utf-8)</option>
        <option value="ja-euc">&#26085;&#26412;&#35486; - Japanese (euc)</option>
        <option value="ja-sjis">&#26085;&#26412;&#35486; - Japanese (sjis)</option>
        <option value="ja-utf-8">&#26085;&#26412;&#35486; - Japanese (utf-8)</option>
        <option value="ko-euc-kr">&#54620;&#44397;&#50612; - Korean (euc-kr)</option>
        <option value="ko-utf-8">&#54620;&#44397;&#50612; - Korean (utf-8)</option>
        <option value="lv-utf-8">Latvie&scaron;u - Latvian (utf-8)</option>
        <option value="lv-win1257">Latvie&scaron;u - Latvian (win1257)</option>
        <option value="lt-utf-8">Lietuvi&#371; - Lithuanian (utf-8)</option>
        <option value="lt-win1257">Lietuvi&#371; - Lithuanian (win1257)</option>
        <option value="mkcyr-utf-8">Macedonian - Macedonian (utf-8)</option>
        <option value="mkcyr-win1251">Macedonian - Macedonian (win1251)</option>
        <option value="ms-iso-8859-1">Bahasa Melayu - Malay (iso-8859-1)</option>
        <option value="ms-utf-8">Bahasa Melayu - Malay (utf-8)</option>
        <option value="mn-utf-8">&#1052;&#1086;&#1085;&#1075;&#1086;&#1083; - Mongolian (utf-8)</option>
        <option value="no-iso-8859-1">Norsk - Norwegian (iso-8859-1)</option>
        <option value="no-utf-8">Norsk - Norwegian (utf-8)</option>
        <option value="fa-utf-8">&#1601;&#1575;&#1585;&#1587;&#1740; - Persian (utf-8)</option>
        <option value="fa-win1256">&#1601;&#1575;&#1585;&#1587;&#1740; - Persian (win1256)</option>
        <option value="pl-iso-8859-2">Polski - Polish (iso-8859-2)</option>
        <option value="pl-utf-8">Polski - Polish (utf-8)</option>
        <option value="pl-win1250">Polski - Polish (win1250)</option>
        <option value="pt-iso-8859-1">Portugu&ecirc;s - Portuguese (iso-8859-1)</option>
        <option value="pt-iso-8859-15">Portugu&ecirc;s - Portuguese (iso-8859-15)</option>
        <option value="pt-utf-8">Portugu&ecirc;s - Portuguese (utf-8)</option>
        <option value="ro-iso-8859-1">Rom&acirc;n&#259; - Romanian (iso-8859-1)</option>
        <option value="ro-utf-8">Rom&acirc;n&#259; - Romanian (utf-8)</option>
        <option value="ru-cp-866">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; - Russian (cp-866)</option>
        <option value="ru-koi8-r">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; - Russian (koi8-r)</option>
        <option value="ru-utf-8">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; - Russian (utf-8)</option>
        <option value="ru-win1251">&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; - Russian (win1251)</option>
        <option value="srcyr-utf-8">&#1057;&#1088;&#1087;&#1089;&#1082;&#1080; - Serbian (utf-8)</option>
        <option value="srcyr-win1251">&#1057;&#1088;&#1087;&#1089;&#1082;&#1080; - Serbian (win1251)</option>
        <option value="srlat-utf-8">Srpski - Serbian latin (utf-8)</option>
        <option value="srlat-win1250">Srpski - Serbian latin (win1250)</option>
        <option value="si-utf-8">&#3523;&#3538;&#3458;&#3524;&#3517; - Sinhala (utf-8)</option>
        <option value="sk-iso-8859-2">Sloven&#269;ina - Slovak (iso-8859-2)</option>
        <option value="sk-utf-8">Sloven&#269;ina - Slovak (utf-8)</option>
        <option value="sk-win1250">Sloven&#269;ina - Slovak (win1250)</option>
        <option value="sl-iso-8859-2">Sloven&scaron;&#269;ina - Slovenian (iso-8859-2)</option>
        <option value="sl-utf-8">Sloven&scaron;&#269;ina - Slovenian (utf-8)</option>
        <option value="sl-win1250">Sloven&scaron;&#269;ina - Slovenian (win1250)</option>
        <option value="es-iso-8859-1">Espa&ntilde;ol - Spanish (iso-8859-1)</option>
        <option value="es-iso-8859-15">Espa&ntilde;ol - Spanish (iso-8859-15)</option>
        <option value="es-utf-8">Espa&ntilde;ol - Spanish (utf-8)</option>
        <option value="sv-iso-8859-1">Svenska - Swedish (iso-8859-1)</option>
        <option value="sv-utf-8">Svenska - Swedish (utf-8)</option>
        <option value="tt-iso-8859-9">Tatar&ccedil;a - Tatarish (iso-8859-9)</option>
        <option value="tt-utf-8">Tatar&ccedil;a - Tatarish (utf-8)</option>
        <option value="th-tis-620">&#3616;&#3634;&#3625;&#3634;&#3652;&#3607;&#3618; - Thai (tis-620)</option>
        <option value="th-utf-8">&#3616;&#3634;&#3625;&#3634;&#3652;&#3607;&#3618; - Thai (utf-8)</option>
        <option value="tr-iso-8859-9">T&uuml;rk&ccedil;e - Turkish (iso-8859-9)</option>
        <option value="tr-utf-8">T&uuml;rk&ccedil;e - Turkish (utf-8)</option>
        <option value="uk-utf-8">&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072; - Ukrainian (utf-8)</option>
        <option value="uk-win1251">&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072; - Ukrainian (win1251)</option>

    </select>
    </fieldset>
    <noscript>
    <fieldset class="tblFooters">
        <input type="submit" value="Go" />
    </fieldset>
    </noscript>
</form>
    <br />
<!-- Login form -->
<form method="post" action="index.php" name="login_form" target="_top" class="login">
    <fieldset>
    <legend>
Log in<a href="./Documentation.html" target="documentation" title="phpMyAdmin documentation"><img class="icon" src="./themes/original/img/b_help.png" width="11" height="11" alt="phpMyAdmin documentation" /></a></legend>

        <div class="item">
            <label for="input_username">Username:</label>
            <input type="text" name="pma_username" id="input_username" value="" size="24" class="textfield" />
        </div>
        <div class="item">
            <label for="input_password">Password:</label>
            <input type="password" name="pma_password" id="input_password" value="" size="24" class="textfield" />
        </div>
        <input type="hidden" name="server" value="1" />    </fieldset>
    <fieldset class="tblFooters">
        <input value="Go" type="submit" />
        <input type="hidden" name="lang" value="en-iso-8859-1" />
        <input type="hidden" name="convcharset" value="iso-8859-1" />
        </fieldset>
</form>
    <div class="notice">Cookies must be enabled past this point.</div>
</div>
<script type="text/javascript">
// <![CDATA[
function PMA_focusInput()
{
    var input_username = document.getElementById('input_username');
    var input_password = document.getElementById('input_password');
    if (input_username.value == '') {
        input_username.focus();
    } else {
        input_password.focus();
    }
}

window.setTimeout('PMA_focusInput()', 500);
// ]]>
</script>
</body>
</html>
    