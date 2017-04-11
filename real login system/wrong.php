<?php

$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(strpos($url, 'error=alreadylogin')){
        echo'you\'re already logged in!';
    }
    elseif(strpos($url, 'error=wrong')){
        echo'please don\'t contain in your username any charter expet from abc, underline and numbers';
    }
    elseif(strpos($url, 'error=empty')){
        echo'please fill all fields!';
    }
    elseif(strpos($url, 'error=usernametaken')){
        echo'username or email already taken!';
    }
    elseif(strpos($url, 'error=incorrect')||strpos($url, 'error=notlogin')){
        echo'your username or password is incorrect';
    }
    elseif(strpos($url, 'error=notverifyed')){
        echo'email does not verifyed!';
    }
    elseif(strpos($url, 'error=wrongemail')){
        echo'email does not exsist';
    }
    elseif(strpos($url, 'addmember')){
        echo'please verify your email!';
    }
    elseif(strpos($url, 'emailver')){
        echo'your account verifyed! you can go and edit your profile page!';
    }elseif(strpos($url, 'allempty')){
        echo'please fill one!';
    }elseif(strpos($url, 'passnotmatch')){
        echo'you entered wrong pass';
    }elseif(strpos($url, 'error=nocaptcha')){
        echo'please fill the captcha!';
    }
    else{
        header("Location: welcome.php");
    }
?>
<P>click <a href="welcome.php">here</a> to go back to welcome page</P>
