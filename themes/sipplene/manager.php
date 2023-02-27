<!--
    @title
        fantasy.constellation Web GUI
    @author
        Original: Sipplene
        Theme: UpperStar
-->
<html>
    <head>
        <!-- CSS -->
        <link rel='stylesheet' href='css/noname.css'>
        <!-- script includes -->
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <script src='js/fantasy.constellation.js'></script>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

        <!-- title -->
        <title>fantasy.constellation - Steam Manager</title>
        <link rel='shortcut icon' href='images/constelia.ico'/>

        <!-- script -->
        <script>
            /// Prevent resubmit
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }

            /// start timer to check status of Constellation
            window.setInterval(check_status, 3000);

            function check_status() 
            {
                /// get current constellation game.
                game = constellation.game()

                /// constellation isn't even running.
                if( game == null )
                {

                    /// set constellation button text
                    $('#start_button').html('Calibrate constellation (Constellation isn\'t running)')

                    /// disable our start button
                    $('#start_button').prop('disabled', true)
                    return;
                }

                /// remove our disables
                $('#start_button').prop('disabled', false)

                /// change text
                $('#start_button').html('Calibrate constellation')
            }
        </script>
    </head>

    <body>
    <?php
        $constPath = getCookieValue('constPath');
        $steamPath = getCookieValue('steamPath');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_POST['hidden'] == 'steam'){
                if($_POST['steamPath'] != null && $_POST['steamPath'] != 'saved'){
                    saveCookie('steamPath', $_POST['steamPath']);
                } else {
                    $steamPath = shell_exec('powershell -ExecutionPolicy Bypass -Command "$path = Get-Process -name steam | Select-Object -ExpandProperty Path; Write-Host $path";exit;');
                    saveCookie('steamPath', $steamPath);
                }
            }

            if($_POST['hidden'] == 'login'){
                if($_POST['steamLogin'] != null){
                    $data = explode('°|°', $_POST['steamLogin']);
                    startSteam($steamPath, $data[0], $data[1]);
                }
            }

            if($_POST['hidden'] == 'constellation'){
                if($_POST['ConstPath'] == 'saved'){
                    exec('powershell -ExecutionPolicy Bypass -Command "Start-Process ' . $path .'"; exit;');
    
                }elseif($_POST['ConstPath'] == null){
                    $constPath = 'Path required!';
    
                }else{
                    $path = $_POST['ConstPath'];
                    saveCookie('constPath', $path);
                    exec('powershell -ExecutionPolicy Bypass -Command "Start-Process ' . $path .'"; exit;');
                }
            }

        }

        function saveCookie($cookieName, $path){
            setcookie($cookieName, $path, time()+31556952);
        }

        function getCookieValue($cookieName){
            if(isset($_COOKIE[$cookieName])){
                return $_COOKIE[$cookieName];
            } else{
                return null;
            }
        }

        function startSteam($steamPath, $user, $password){
            shell_exec('powershell -ExecutionPolicy Bypass -Command "Start-Process -FilePath ' . "'" . $steamPath . "'" . '  -ArgumentList ' . "'" . '-login ' . $user . ' ' . $password . "'" . '"; exit;');
        }
    ?>

        <div id='settings_box' class='flex-container'>
            <div class='flex-items'>
                <fieldset id='program_settings' class='flex-items'>
                    <legend>Program Settings</legend>
                    </p>
                    <form method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
                        <input type='text' name='steamPath' class='ConstPath' value='<?php print($steamPath); ?>' title="Path to 'steam.exe'&#10;If you don't know the path, open steam and press 'Save steam path'">
                        <input type='hidden' name='hidden' value='steam'>
                        <input type='submit' name='Login' class='greenButton' value='Save steam path'>
                    </form>
                    <p>
                        <form method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
                            <input type='text' name='ConstPath' class='ConstPath' value='<?php print($constPath); ?>' title="Path to 'fantasy.constellation.exe'&#10;I can't help you here :D">
                            <input type='hidden' name='hidden' value='constellation'>
                            <input type='submit' name='Start' class='greenButton' value='Start Constellation.exe'>
                        </form>
                    </p>
                    <button class='grayButton' onclick="parent.open('steam://rungame/730/76561202255233023/')" title="Open CS:GO if steam is running">Start CS:GO</button>
                    <button class='grayButton' onclick="parent.open('index.html')" title="Brings you to the PAIO">All-In-One</button>
                    <button class='grayButton' onclick="parent.open('settings.html')" title="Brings you to the settings">Constellation Settings</button>
                    <button disabled id='start_button' class='greenButton' onclick="start_constellation()">Loading...</button>
                    <button class='redButton' onclick="fantasy_cmd(this, 'exit')">Exit</button>
                </fieldset>
                </p>
                <fieldset id='login_buttons' class='flex-items'>
                    <legend>Steam Accounts</legend>
                    <div id='acc_buttonList'></div>
                    <div id='acc_add' style='float: right;'>
                        <form method=''>
                            </p>
                            <span>Username: </span><input type='text' class="login" id='username'></p>
                            <span>Password: </span><input type='password' class="login" id='password'></p>
                            <button class='greenButton' onclick="addNewAccount()">Save steam account</button>
                        </form>
                    </div>
                </fieldset>
            </div>
        </div>
    </body>
    <script>
        function addAccountButton(username, password) {
            var element = document.createElement('button');
            //Assign different attributes to the element. 
                element.type = 'button';
                element.innerHTML = username;
                element.setAttribute('name', 'loginButton');
                element.setAttribute('class', 'grayButton steamAccount');
                element.setAttribute('style', 'grayButton');
                element.onclick = function() {
                    /*var url = 'manager.php';
                    var message = '{"user": ' + username + ', "pass": ' + password + '}';
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', url, true);
                    xhr.setRequestHeader("Accept", "application/json");
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.send(message);*/
                    var message = username + '°|°' + password;
                    document.body.innerHTML += '<form id="' + username + '" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"><input type="text" name="steamLogin" value="' + message + '"><input type="hidden" name="hidden" value="login"></form>';
                    document.getElementById(username).submit();
                    document.getElementById(username).parentNode.removeChild(document.getElementById(username));
                };

            var buttonList = document.getElementById('acc_buttonList');
            buttonList.appendChild(element);
        }

        function getLogins(){
            //Get logins form cookie
            var storedArray = [["dummyUser","dummyPass"]];
            storedArray.shift();
            storedArray = JSON.parse(getCookie('SteamLogin'));
            //Loop addAccountButton for each login
            for(i = 0; i < storedArray.length; i++){
                addAccountButton(window.atob(storedArray[i][0]), window.atob(storedArray[i][1]));
            }
        }

        function addNewAccount(){
            // Create a timestamp in the future for the cookie so it is valid
            var nowPreserve = new Date();
            var oneYear = 365*24*60*60*1000; // one year in milliseconds
            var thenPreserve = nowPreserve.getTime() + oneYear;
            nowPreserve.setTime(thenPreserve);
            var expireTime = nowPreserve.toUTCString();

            //Get logins from input
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            //Get logins form cookie
            if(getCookie('SteamLogin') == ""){
                var storedArray = [["dummyUser","dummyPass"]];
                storedArray.shift();
            }else{
                var storedArray = JSON.parse(getCookie('SteamLogin')); 
            }
            var tempArray = [window.btoa(username), window.btoa(password)];
            storedArray.push(tempArray);

            document.cookie = "SteamLogin=" + JSON.stringify(storedArray) + ';expires=' + expireTime + ';domain=' + document.domain;
            addAccountButton(username, password);
        }

        document.addEventListener('DOMContentLoaded',() => {
            getLogins();
        });

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i <ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
        }

    </script>
</html>