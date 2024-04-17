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

var wantToCreate = 0;

if (params.get('wantToCreate') != null) {
    wantToCreate = params.get('wantToCreate');
} else {
    if(getCookie('wantToCreate') != '') {
        wantToCreate = getCookie('wantToCreate');
    }
}

const sendDataToServer = async (formData) => {
    const response = await fetch('./login.php', {
        method: 'POST',
        body: formData
    })
    .catch(error => {
        console.error('Erreur:', error);
    })
    return response;
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
        error =1;
    }

    if (emailValue === '') {
        setError(email, trad[lang].emailVoid);
        error =1;
    }

    if (passwordValue === '') {
        setError(password, trad[lang].passwordVoid);
        error =1;
    }

    if (passwordConfirmationValue === '') {
        setError(passwordConfirmation, trad[lang].passwordConfVoid);
        error =1;
    }

    if (passwordValue !== passwordConfirmationValue) {
        setError(passwordConfirmation, trad[lang].passwordNotMatch);
        error =1;
    }

    if (!validateEmail(emailValue)) {
        setError(email, trad[lang].emailNotValid);
        error =1;
    }

    if (error == 0) {
        const formData = new FormData();
        formData.append('username', usernameValue);
        formData.append('email', emailValue);
        formData.append('password', passwordValue);
        formData.append('confirmPassword', passwordConfirmationValue);
    
        await sendDataToServer(formData);
        
        location.reload();
    }
}

const verifyLogin = async () => {
    let error = 0;
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    if (emailValue === '') {
        setError(email, trad[lang].emailVoid);
        error = 1;
    }

    if (passwordValue === '') {
        setError(password, trad[lang].passwordVoid);
        error = 1;
    }

    if (error == 0) {
        const formData = new FormData();
        formData.append('email', emailValue);
        formData.append('password', passwordValue);
    
        await sendDataToServer(formData);

        location.reload();
    }
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