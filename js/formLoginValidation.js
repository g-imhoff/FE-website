trad = {
    "en": {
        "usernameVoid": "Username cannot be blank",
        "emailVoid": "Email cannot be blank",
        "passwordVoid": "Password cannot be blank",
        "passwordConfVoid": "Password confirmation cannot be blank",
        "passwordNotMatch": "Passwords do not match",
        "emailNotValid": "Email is not valid"
    },
    "fr": {
        "usernameVoid": "Le nom d'utilisateur ne peut pas être vide",
        "emailVoid": "L'email ne peut pas être vide",
        "passwordVoid": "Le mot de passe ne peut pas être vide",
        "passwordConfVoid": "La confirmation du mot de passe ne peut pas être vide",
        "passwordNotMatch": "Les mots de passe ne correspondent pas",
        "emailNotValid": "L'email n'est pas valide"
    }
}

var lang = 'fr';
var wantToCreate = 0;

params = new URLSearchParams(location.search);
if (params.get('lang') != null) {
    lang = params.get('lang');
} else {
    if(getCookie('lang') != '') {
        lang = getCookie('lang');
    }
}

if (params.get('wantToCreate') != null) {
    wantToCreate = params.get('wantToCreate');
} else {
    if(getCookie('wantToCreate') != '') {
        wantToCreate = getCookie('wantToCreate');
    }
}

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

const setError = (input, message) => {
    const newPara = document.createElement('p');
    newPara.innerText = message;
    newPara.setAttribute("class", 'error');

    parent = input.parentElement;
    parent.appendChild(newPara);
};

const setSuccess = (input) => {
    input.innerText = '';
};

const sendDataToServer = async (formData) => {
    const response = await fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .catch(error => {
        console.error('Erreur:', error);
    })
    return response;
};

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};
  

const verifyCreate = async () => {
    let error = 0;
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('confirm-password');

    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const passwordConfirmationValue = passwordConfirmation.value.trim();

    if (usernameValue === '') {
        setError(username, trad[lang].usernameVoid);
    } else {
        setSuccess(username);
    }

    if (emailValue === '') {
        setError(email, trad[lang].emailVoid);
    } else {
        setSuccess(email);
    }

    if (passwordValue === '') {
        setError(password, trad[lang].passwordVoid);
    } else {
        setSuccess(password);
    }

    if (passwordConfirmationValue === '') {
        setError(passwordConfirmation, trad[lang].passwordConfVoid);
    } else {    
        setSuccess(passwordConfirmation);
    }

    if (passwordValue !== passwordConfirmationValue) {
        setError(passwordConfirmation, trad[lang].passwordNotMatch);
    } else {
        setSuccess(passwordConfirmation);
    }

    if (!validateEmail(emailValue)) {
        setError(email, trad[lang].emailNotValid);
    } else {
        setSuccess(email);
    }

    const formData = new FormData();
    formData.append('username', usernameValue);
    formData.append('email', emailValue);
    formData.append('password', passwordValue);
    formData.append('confirmPassword', passwordConfirmationValue);

    await sendDataToServer(formData);

    location.reload();

}

const verifyLogin = async () => {
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    if (emailValue === '') {
        setError(email, trad[lang].emailVoid);
    } else {
        setSuccess(email);
    }

    if (passwordValue === '') {
        setError(password, trad[lang].passwordVoid);
    } else {
        setSuccess(password);
    }

    const formData = new FormData();
    formData.append('email', emailValue);
    formData.append('password', passwordValue);

    await sendDataToServer(formData);

    location.reload();
}

const form = document.getElementById('form-login');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const error = document.getElementsByClassName("error");
    if (error.length !=0) {
        var arr = Array.from(error);
        arr.forEach(element => {
            element.remove();
        });
    }

    if (wantToCreate == 1) {
        verifyCreate();
    } else {
        verifyLogin();
    }
});