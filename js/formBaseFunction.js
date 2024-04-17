var lang = 'fr';

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

params = new URLSearchParams(location.search);
if (params.get('lang') != null) {
    lang = params.get('lang');
} else {
    if(getCookie('lang') != '') {
        lang = getCookie('lang');
    }
}

const setError = (input, message) => {
    const newPara = document.createElement('p');
    newPara.innerText = message;
    newPara.setAttribute("class", 'error');

    parent = input.parentElement;
    parent.appendChild(newPara);
};

const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};